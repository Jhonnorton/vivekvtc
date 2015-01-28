<?php
namespace Sales\Model;

use Zend\InputFilter\Factory as InputFactory;     // <-- Add this import
use Zend\InputFilter\InputFilter;                 // <-- Add this import
use Zend\InputFilter\InputFilterAwareInterface;   // <-- Add this import
use Zend\InputFilter\InputFilterInterface;        // <-- Add this import
use Zend\ServiceManager\ServiceLocatorInterface;
use Sendmail\Controller\SendmailController;

class Vouchers extends \Base\Model\BaseModel implements InputFilterAwareInterface{
	
    
   protected $_maxImageSize = 2097152;             //2*1024*1024 = 2Mb

    public function getImagePath() {
        return \Base\Model\Plugins\Imagine::$imagesBaseUrl . 'voucherimage/thumbnails_80x80/';
    }

     protected $_imageOptions = array(
            //img 80x80
            array(
            'options' => array('width'=>80, 'height'=>80), 
            'destination' => 'voucherimage/thumbnails_80x80/'
            ),                       
            //img 150x150
            array(
            'options' => array('width'=>250, 'height'=>250), 
            'destination' => 'voucherimage/small/'
            ),
            //img large 800x600
            array(
            'options' => array('width'=>800, 'height'=>600), 
            'destination' => 'voucherimage/large/'
            ),
            //img
            array(
            'options' => null, 
            'destination' => 'voucherimage/'
            )           
        );
    
    
    protected $inputFilter;    
    private static $serviceManager;        
    
    public static function initServiceManager($serviceManager){        
        if ( self::$serviceManager == null ){			
            self::$serviceManager = $serviceManager;
        }
    }    
    
    public function setInputFilter(InputFilterInterface $inputFilter){
        
        throw new \Exception("Not used");
    }

    public function getInputFilter(){
        
        
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory = new InputFactory();




            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
        
    }
    
    public function getVoucher(){
        $voucher = $this->_entityManager
                    ->getRepository('\Base\Entity\Vouchers')->findAll();
        return $voucher;
    }
    
    public function saveVoucher($data,$image){
        $voc = new \Base\Entity\Vouchers();
        $img_array =  explode('.', $image['image']['name']);
        $image_name= $img_array[0].time().".".$img_array[1];
        $this->uploadImages($image['image']['tmp_name'], $image_name);
        $created = new \DateTime();
        $voc->SetVoucherCode($data->voucher_code);
        $voc->SetVoucherName($data->voucher_name);
        $voc->SetTemplateId($data->template_id);
        $voc->SetType($data->type);
        $receipient_name=$data->receipient_name;
        if(!empty($receipient_name)){
        $voc->SetReceipientName($receipient_name);
        $voc->SetEmail($data->email);
        }
        $voc->SetLinkToType($data->link_to_type);
        $voc->SetLinkToTypeName($data->resortId);
        $voc->SetDiscount($data->discount);
        $voc->SetImage($image_name);
        $voc->SetCreated($created);
        $numOfUse=$data->number_of_use;
        if(!empty($numOfUse)){
        $voc->SetNumberOfUse($numOfUse);
        }
        $unlimited=$data->is_unlimited;
        if($unlimited=='on'){
            $voc->SetIsUnlimited('1');
        }else{
            $voc->SetIsUnlimited('0');
        }
        $startdate=date('d-m-Y',strtotime($data->from_date));
        $from_date = new \DateTime($startdate);
        $enddate=date('d-m-Y',strtotime($data->to_date));
        $to_date = new \DateTime($enddate);
        $voc->SetFromDate($from_date);
        $voc->SetToDate($to_date);
        $voc->Setdetails($data->details);
        $em = $this->_entityManager;                
        $em->persist($voc);                              
        $em->flush();
        return true;
    }
    
    protected function uploadImages($tmpName, $imgName){            
            foreach($this->_imageOptions as $imgOption){                
                \Base\Model\Plugins\Imagine::uploadImage($tmpName, $imgName, $imgOption['options'], $imgOption['destination']);
            }                 
        }
    
    public function updateVoucher($data,$image){
        $voc = $this->_entityManager
                    ->find('\Base\Entity\Vouchers', (int)$data['id']);
        if(!empty($image['image']['name'])){
        $img_array =  explode('.', $image['image']['name']);
        $image_name= $img_array[0].time().".".$img_array[1];
        $this->uploadImages($image['image']['tmp_name'], $image_name);
        }
        $created = new \DateTime();
        //$voc->SetVoucherCode($data->voucher_code);
        $voc->SetVoucherName($data->voucher_name);
        $voc->SetTemplateId($data->template_id);
        $voc->SetType($data->type);
        $receipient_name=$data->receipient_name;
        if(!empty($receipient_name)){
        $voc->SetReceipientName($receipient_name);
        $voc->SetEmail($data->email);
        }
        $voc->SetLinkToType($data->link_to_type);
        $voc->SetLinkToTypeName($data->resortId);
        $voc->SetDiscount($data->discount);
        if(!empty($image['image']['name'])){
        $voc->SetImage($image_name);
        }
        $numOfUse=$data->number_of_use;
        if(!empty($numOfUse)){
        $voc->SetNumberOfUse($numOfUse);
        }
        $unlimited=$data->is_unlimited;
        if($unlimited=='on'){
            $voc->SetIsUnlimited('1');
        }else{
            $voc->SetIsUnlimited('0');
        }
        $startdate=date('d-m-Y',strtotime($data->from_date));
        $from_date = new \DateTime($startdate);
        $enddate=date('d-m-Y',strtotime($data->to_date));
        $to_date = new \DateTime($enddate);
        $voc->SetFromDate($from_date);
        $voc->SetToDate($to_date);
        $voc->Setdetails($data->details);
        if(isset($data['resortId'])){
        $voc->setForId($data->resortId);
        }
            
            $em = $this->_entityManager;                
            $em->persist($voc);                              
            $em->flush(); 
            
    }
    
     public function getVoucherDetail($id){ 
        
        $voucher  = $this->getEntityManager()->getRepository('\Base\Entity\Vouchers')->findOneBy(array('id' => $id));        
        return $voucher;        
    }
     
    public function getForTypeForId($type,$id){
       if($type==1){
         $path='\Base\Entity\Avp\Resorts';  
       }elseif($type==2){
         $path='\Base\Entity\Avp\Events';    
       }elseif($type==3){
         $path='\Base\Entity\Avp\Cruises';    
       }elseif($type==4){
         $path='\Base\Entity\InventoryItem';    
       }elseif($type==5){
         $path='\Base\Entity\InventoryExcursion';    
       }elseif($type==6){
         $path='\Base\Entity\InventoryTransfer';    
       } 
        
       $data= $this->getEntityManager()->getRepository($path)->findOneBy(array('id' => $id)); 
       return $data;
    }
    
    public function sendMailReceipt($data) {

        $to = $data['email'];
        $subject = "Receipt";
        
        return SendmailController::sendReceiptToClient($this->_serviceManager, $to, $subject, $data);

        return true;
    }
    
    public function deleteVoucher($id){
    	
        $em = $this->_entityManager;
        
        if(!is_array($id)){
        	
            $entity = $em->getReference('\Base\Entity\Vouchers', (int)$id);
            
            $em->remove($entity);
            
         
        }
        
        $em->flush();
        
        return true;
        
    }
} 