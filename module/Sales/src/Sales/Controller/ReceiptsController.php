<?php
namespace Sales\Controller;

use Zend\Mvc\MvcEvent;
use Sales\Model\Receipts;
use Zend\View\Model\ViewModel;
use Sendmail\Controller\SendmailController;

class ReceiptsController extends \Base\Controller\BaseController {
	        
    protected $_entity = false;        

    public function onDispatch(MvcEvent $e){
        
        Receipts::initServiceManager($this->getServiceLocator());
        
        $this->model = $this->getModel('Receipts');
        if($this->params()->fromRoute('id', 0)){
                $this->_entity = $this->model->getItem($this->params()->fromRoute('id', 0));			
        }             
        $e->getViewModel()->setVariable('modulename', 'Promos');
        return parent::onDispatch($e);		
    }


    public function indexAction() {
      
    }
    
    public function listAction(){
        $receipt_data = $this->model->getReceipt();  
        $data = array(
                'receipt' => $receipt_data,
                'message' => $this->getPageMessages(),
            );
        return new ViewModel($data);
    }
    
    public function addAction(){
        $form = new \Sales\Form\AddReceiptForm($this->getEm(self::AVP_CONFIG), '\Base\Entity\Receipts'); 
        $data = array(
                'item' => $user_data,                                 
                'form' => $form,
            );
        if($this->request->isPost()){
            $receipt_content=$this->request->getPost();
            $sub_type=$receipt_content['send'];
            $inserted_id=$this->model->add($receipt_content);
            if($sub_type=='Send'){
                $this->sendmailAction($inserted_id,'1');
            }
            $this->addPageMessage('Receipt has been saved.','success');				
            $this->redirect()->toRoute('receipts-list');
        }
        return new ViewModel($data);
    }
    
    public function editAction(){
        $id = $this->params()->fromRoute('id', 0);        
        $receipt = $this->model->getReceiptDetail($id);
        $form = new \Sales\Form\AddReceiptForm($this->getEm(self::AVP_CONFIG), '\Base\Entity\Receipts'); 
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
        $data['for_type']=$receipt->getForType();
        $data['description']=$receipt->getDescription();
        $form->setData($data);
            $data = array(
                'receipt'=>$receipt,
                'form' =>$form,
            );
        if($this->request->isPost()){
            $receipt_detail=$this->request->getPost();
            $this->model->updateReceipt($receipt_detail);
            $this->addPageMessage('Receipt has been updated.','success');				
            $this->redirect()->toRoute('receipts-list');
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
        $receipt_id=$this->params('id');
        $del_note=$this->model->deleteReceipt($receipt_id);
        $this->addPageMessage('The receipt has been deleted.','success');    	
    	$this->redirect()->toRoute('receipts-list');
    }
         
}
