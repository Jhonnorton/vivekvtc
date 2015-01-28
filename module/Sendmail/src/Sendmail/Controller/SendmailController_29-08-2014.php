<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Sendmail for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Sendmail\Controller;
use Zend\Mvc\MvcEvent;


class SendmailController extends \Base\Controller\BaseController{
    
    protected $_entity = false;
    public function onDispatch(MvcEvent $e){
        $this->model = $this->getModel('Email');		
        if($this->params()->fromRoute('id', 0)){
                $this->_entity = $this->model->getItem($this->params()->fromRoute('id', 0));				
        }		
        $e->getViewModel()->setVariable('modulename', 'Sendmail');
        return parent::onDispatch($e);	
    }

    public function indexAction(){        
        $model = $this->getModel('Email');
        $data = array(
                    'collection' => $model->getSendmailCollection(),
                    'message'=>$this->getPageMessages(),
        );
        return $this->getView($data); 
    }

    public function addAction() {
        $form = new \Sendmail\Form\AddSendmailForm($this->getEm(), '\Base\Entity\EmailDetails');
        if($this->request->isPost()){
            $form->setInputFilter($this->model->getInputFilter());
            $form->setData($this->request->getPost());
            if($form->isValid()){ 
                if($this->model->isValidModel($form)){
                    $this->model->save($form->getData());    			
                    //success / error / info / warning
                    $this->addPageMessage('The sendmail has been saved.','success');    			
                    $this->redirect()->toRoute('sendmail');
                }
            } else {            
                $form->getMessages();    
            }             
        }
        $view = $this->getView(array('form' => $form));    	
        return $view;
    }

    public function editAction() {

        if(!$this->_entity)
                throw new \Exception('Invalid Entity');

        $form = new \Sendmail\Form\AddSendmailForm($this->getEm(), $this->_entity);
        $form->get('submit')->setValue('edit');

        if($this->request->isPost()){

                $form->setInputFilter($this->model->getInputFilter());
                $form->setData($this->request->getPost());

                if($form->isValid()){
                        if($this->model->isValidModelOnEdit($form)){    			
                                $this->model->update($form->getData());    			
                                //success / error / info / warning\
                                //d( $this->addPageMessage('The mail has been Sent.', 'success'));
                                $this->addPageMessage('The sandmail has been updated.','success');    	
                                //d( $this->addPageMessage('The mail has been Sent.', 'success'));
                                $this->redirect()->toRoute('sendmail');
                        }
                } else {
                        $form->getMessages();
                }    
        }
        $view = $this->getView(array('form' => $form));
        return $view;        
    }

    public function deleteAction() {                
        if(!$this->_id && !$this->request->isPost())
                        throw new \Exception('Invalid Entity');
        $this->model->delete($this->_id);
        //success error info warning
        $this->addPageMessage('The sandmail has been deleted.','success');
        $this->redirect()->toRoute('sendmail');    	    	                     
    }          

    public function getSendmail($id){

        $this->model = $this->getModel('Email');		            
        return $this->model->getItem($id);				            
    }

    public function fooAction(){
        
        $viewRender = $this->getServiceLocator()->get("ViewRenderer");
        $viewModel = new ViewModel();
        $viewModel->setTemplate("base-template");        
        $html = $viewRender->render($viewModel);
        d($viewRender->render($viewModel));                
        //return $this->getView(array());        
    }     
    
    public static function sendMailOnReservation($serviceManager, $to,  array $data, array $params = null, $subject = 'Reservation'){
        if($serviceManager){
            $model = $serviceManager->get('Email');                
            return $model->sendMailOnReservation($to, $data, $subject, $params);        
        }   
        return false;
    }
    
     public static function sendMailOnLead($serviceManager, $to, $subject,$message){
        if($serviceManager){
            $model = $serviceManager->get('Email');                
            return $model->sendMailOnLead($to,$subject,$message);        
        }   
        return false;
    }
    
    public static function sendMailToClient($serviceManager, $to, $subject,$message){
        if($serviceManager){
            $model = $serviceManager->get('Email');                
            return $model->sendMailToClient($to,$subject,$message);        
        }   
        return false;
    }
    
     public static function sendMailOnDue($serviceManager,$to,array $params = null){
        if($serviceManager){
            $model = $serviceManager->get('Email');                
            return $model->sendMailOnDue($to,$subject='Payment Due',$params);        
        }   
        return false;
    }
    
    public static function sendMailOnReminder($serviceManager, $to, $id, array $params = null, $subject = ' Payment Reminder for Res no.'){
       
      //  d($id);
        if($serviceManager){
            $model = $serviceManager->get('Email');                
            return $model->sendMailOnReminder($to, $id, $subject, $params);        
        }   
        return false;
    }
    
    
    public static function sendMailOnInvoice($serviceManager, $to,array $data = null, $subject = ' Payment Reminder.'){
        //echo "<pre>";
        //print_r($data);die;
        if($serviceManager){
            $model = $serviceManager->get('Email');                
            return $model->sendMailOnInvoice($to, $data, $subject);        
        }   
        return false;
    }
    
    
    
      public static function sendMailOnQuote($serviceManager, $to,$clientName,array $data=null, array $params = null, $message = null,$subject=null){
  //  d($data);
        if($serviceManager){
            $model = $serviceManager->get('Email');                
            return $model->sendMailOnQuote($to,$clientName,$data, $params,$message,$subject );        
        }   
        return false;
    }
    
     public static function sendMailOnReservationPending($serviceManager, $to,  array $data, array $params = null, $subject = 'Reservation'){
     
         // d($data);
          if($serviceManager){
            $model = $serviceManager->get('Email');                
            return $model->sendMailOnReservationPending($to, $data, $subject, $params);        
        }   
        return false;
    }
    
    public static function sendMailOnQuoteReservation($serviceManager, $to,  array $data, array $params = null, $subject = 'Reservation'){
        if($serviceManager){
            $model = $serviceManager->get('Email');                
            return $model->sendMailOnQuoteReservation($to, $data, $subject, $params);        
        }   
        return false;
    }
    
}
