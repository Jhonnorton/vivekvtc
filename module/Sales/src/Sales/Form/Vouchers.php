<?php
namespace Sales\Model;

use Zend\InputFilter\Factory as InputFactory;     // <-- Add this import
use Zend\InputFilter\InputFilter;                 // <-- Add this import
use Zend\InputFilter\InputFilterAwareInterface;   // <-- Add this import
use Zend\InputFilter\InputFilterInterface;        // <-- Add this import
use Zend\ServiceManager\ServiceLocatorInterface;
use Sendmail\Controller\SendmailController;

class Vouchers extends \Base\Model\BaseModel implements InputFilterAwareInterface{
	
    
    //echo 'hello'; die;
    
    
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
    
    public function getReceipt(){
        $receipt = $this->_entityManager
                    ->getRepository('\Base\Entity\Receipts')->findAll();
        return $receipt;
    }
    
    public function add($object){
            $receipt = new \Base\Entity\Receipts();
            $date=date('d-m-Y',strtotime($object->date));
            $date1 = new \DateTime($date);
            $created = new \DateTime();
            $receipt->setName($object->name);
            $receipt->setEmail($object->email);
            $receipt->setPhone($object->phone);
            $receipt->setAddress($object->address);
            $receipt->setCity($object->city);
            $receipt->setState($object->state);
            $receipt->setCountry($object->countryId);
            $receipt->setSuite($object->suite);
            $receipt->setZip($object->zip);
            $receipt->setTotalReceived($object->total_received);
            $receipt->setForType($object->for_type);
            $receipt->setForId($object->resortId);
            $receipt->setDate($date1);
            $receipt->setMailStatus('0');
            $receipt->setCreatedAt($created);
            $receipt->setDescription($object->description);
            $em = $this->_entityManager;                
            $em->persist($receipt);                              
            $em->flush(); 
            $inserted_id=$receipt->getId();
            return $inserted_id;
        
    }
    
    public function updateReceipt($object){
        $receipt = $this->_entityManager
                    ->find('\Base\Entity\Receipts', (int)$object['id']);
        $date=date('d-m-Y',strtotime($object->date));
            $date1 = new \DateTime($date);
            $receipt->setName($object->name);
            $receipt->setEmail($object->email);
            $receipt->setPhone($object->phone);
            $receipt->setAddress($object->address);
            $receipt->setCity($object->city);
            $receipt->setState($object->state);
            $receipt->setCountry($object->countryId);
            $receipt->setSuite($object->suite);
            $receipt->setZip($object->zip);
            $receipt->setTotalReceived($object->total_received);
            $receipt->setForType($object->for_type);
            if(isset($object['resortId'])){
            $receipt->setForId($object->resortId);
            }
            $receipt->setDate($date1);
            $receipt->setDescription($object->description);
            $em = $this->_entityManager;                
            $em->persist($receipt);                              
            $em->flush(); 
            
    }
    
     public function getReceiptDetail($id){        
        $receipt  = $this->getEntityManager()->getRepository('\Base\Entity\Receipts')->findOneBy(array('id' => $id));        
        return $receipt;        
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
    
    public function deleteReceipt($id){
    	
        $em = $this->_entityManager;
        
        if(!is_array($id)){
        	
            $entity = $em->getReference('\Base\Entity\Receipts', (int)$id);
            
            $em->remove($entity);
            
         
        }
        
        $em->flush();
        
        return true;
        
    }
} 