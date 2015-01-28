<?php
namespace Sales\Controller;

use Zend\Mvc\MvcEvent;
use Sales\Model\Vouchers;
use Zend\View\Model\ViewModel;
use Sendmail\Controller\SendmailController;

class VouchersController extends \Base\Controller\BaseController {
	        
    protected $_entity = false;        

    public function onDispatch(MvcEvent $e){
        
        Vouchers::initServiceManager($this->getServiceLocator());
        
        $this->model = $this->getModel('Vouchers');
        if($this->params()->fromRoute('id', 0)){
                $this->_entity = $this->model->getItem($this->params()->fromRoute('id', 0));			
        }             
        $e->getViewModel()->setVariable('modulename', 'Promos');
        return parent::onDispatch($e);		
    }


    public function indexAction() {
      $voucher_data = $this->model->getVoucher();    
      $data = array(
                'voucher' => $voucher_data,
                'message' => $this->getPageMessages(),
            );
        return new ViewModel($data);
    }
    
    
    
    public function addAction(){
        $form = new \Sales\Form\AddVoucherForm($this->getEm(self::AVP_CONFIG), '\Base\Entity\Vouchers');
        $random_num =  rand(10000,99999);
        $vc_number = 'VC'.$random_num;
        $data = array(
                'vc_num'=>$vc_number,
                'item' => $user_data,                                 
                'form' => $form,
            );
        if($this->request->isPost()){
             $data1=$this->request->getPost();
             $image = $this->request->getFiles()->toArray();
             $status=$this->model->saveVoucher($data1,$image);
             if($status){
                $this->addPageMessage('Voucher added successfully.','success');				
           
             }else{
                $this->addPageMessage('Voucher could not be added successfully.','error'); 
             }
             $this->redirect()->toRoute('vouchers'); 
        }
        return new ViewModel($data);
    }
    
    public function editAction(){
        $id = $this->params()->fromRoute('vid', 0);        
        $voucher = $this->model->getVoucherDetail($id);
        $form = new \Sales\Form\AddVoucherForm($this->getEm(self::AVP_CONFIG), '\Base\Entity\Vouchers'); 
        $data=array();
        $data['id']=$voucher->getId();
        $data['voucher_name']=$voucher->getVoucherName();
        $data['voucher_code']=$voucher->getVoucherCode();
        $data['template_id']=$voucher->getTemplateId();
        $data['type']=$voucher->getType();
        $data['receipient_name']=$voucher->getReceipientName();
        $data['email']=$voucher->getEmail();
        $data['link_to_type']=$voucher->getLinkToType();
        $data['link_to_type_name']=$voucher->getLinkToTypeName();
        $data['discount']=$voucher->getDiscount();
        $data['number_of_use']=$voucher->getNumberOfUse();
        $data['is_unlimited']=$voucher->getIsUnlimited();
        $data['image']=$voucher->getImage();
        $data['from_date']=$voucher->getFromDate()->format('Y-m-d');
        $data['to_date']=$voucher->getToDate()->format('Y-m-d');
        $data['details']=$voucher->getDetails();
        $form->setData($data);
            $data = array(
                'voucher'=>$voucher,
                'form' =>$form,
                'voucher_code'=>$data['voucher_code'],
            );
        if($this->request->isPost()){
            $voucher_detail=$this->request->getPost();
            $image = $this->request->getFiles()->toArray();
            $this->model->updateVoucher($voucher_detail,$image);
            $this->addPageMessage('Voucher has been updated.','success');				
            $this->redirect()->toRoute('vouchers');
        } 
        return new ViewModel($data);
        
    }
    
    public function viewreceiptAction(){
        $id = $this->params()->fromRoute('id', 0);        
        $receipt = $this->model->getReceiptDetail($id);
        $data = array(
            'receipt'=>$receipt,
        );
        return new ViewModel($data);
    }
    
    public function sendmailAction($id=null,$call=null){
        if($call==null){
        $id = $this->params()->fromRoute('id', 0);
        }
        $receipt = $this->model->getReceiptDetail($id);
        $data=array();
        $data['id']=$receipt->getId();
        $data['name']=$receipt->getName();
        $data['phone']=$receipt->getPhone();
        $data['email']=$receipt->getEmail();
        $data['address']=$receipt->getAddress();
        $data['suite']=$receipt->getSuite();
        $data['city']=$receipt->getCity();
        $data['state']=$receipt->getState();
        $data['countryId']=$receipt->getCountry();
        $data['zip']=$receipt->getZip();
        $data['total_received']=$receipt->getTotalReceived();
        $data['date']=$receipt->getDate()->format('Y-m-d');
        $type=$receipt->getForType();
        $forId=$this->model->getForTypeForId($type,$receipt->getForId());
        if($type==1){
         $data['for_type']='Resorts';
         $data['for_id']=$forId->getTitle();
       }elseif($type==2){
         $data['for_type']='Events'; 
         $data['for_id']=$forId->getTitle();
       }elseif($type==3){
         $data['for_type']='Cruises'; 
         $data['for_id']=$forId->getTitle();
       }elseif($type==4){
         $data['for_type']='Item'; 
         $data['for_id']=$forId->getName();
       }elseif($type==5){
         $data['for_type']='Excursion';
         $data['for_id']=$forId->getExcursionName();
       }elseif($type==6){
         $data['for_type']='Transfer';
         $data['for_id']=$forId->getTransferName();
       }
        $this->model->sendMailReceipt($data);
        $this->addPageMessage('Mail has been sent successfully.','success');				
        $this->redirect()->toRoute('receipts-list');
        
    }
    
    public function deleteAction(){
        $voucher_id=$this->params('vid');
        $del_note=$this->model->deleteVoucher($voucher_id);
        $this->addPageMessage('The voucher has been deleted.','success');    	
    	$this->redirect()->toRoute('vouchers');
    }
         
}
