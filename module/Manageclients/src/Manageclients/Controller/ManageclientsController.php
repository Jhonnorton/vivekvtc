<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Orders for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License 123
 */

namespace Manageclients\Controller;

use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;
use Sendmail\Controller\SendmailController;

class ManageclientsController extends \Base\Controller\BaseController {

    protected $_entity = false;

    public function onDispatch(MvcEvent $e) {

        //echo "hello"; die;
        $this->model = $this->getModel('Manageclients');

        if ($this->params()->fromRoute('id', 0)) {

            $this->_entity = $this->model->getItem($this->params()->fromRoute('id', 0));
        }

        $e->getViewModel()->setVariable('modulename', 'Manageclients');

        return parent::onDispatch($e); //smart
    }

    public function indexAction() {
        $data = array(
            'collection' => $this->model->getCollection(),
            'message'=>$this->getPageMessages(),
    	);    	
        return $this->getView($data);
 	
    }
    
    public function addAction(){
    	    	
        $form = new \Manageclients\Form\AddClientForm($this->getEm(self::AVP_CONFIG), '\Base\Entity\Avp\Clients'); 
        if($this->request->isPost()){  
            $form->setInputFilter($this->model->getInputFilter());
            $data = $this->request->getPost();     
            $form->setData($data);              
            if($form->isValid()){	                
                if($this->model->isValidModel($form)){                    
                    $this->model->save($form->getData());				
                    $this->addPageMessage('The client has been saved.','success');				
                    $this->redirect()->toRoute('manageclients');
                }
            } else {	                
		$form->getMessages(); 
            }
    	}
    	$view = $this->getView(array('form' => $form));
    	return $view;
    }
    
    public function editAction(){
    	if(!$this->_entity){
            throw new \Exception('Invalid Entity');        
        }
    	$form = new \Users\Form\AddClientForm($this->getEm(self::AVP_CONFIG), $this->_entity);    	    	    	
    	$form->get('submit')->setValue('edit');    	
    	if($this->request->isPost()){    		
            $form->setInputFilter($this->model->getInputFilter());
            $form->setData($this->request->getPost());    			            
            if($form->isValid()){                
                if($this->model->isValidModelOnEdit($form)){                        
                        $this->model->update($form->getData());    			
                        $this->addPageMessage('The client has been updated.','success');    			
                        $this->redirect()->toRoute('manageclients');
                }
            } else {
                $form->getMessages();
            }    		
    	}    	    	
    	$view = $this->getView(array('form' => $form));    	
    	return $view;
    }
    
    public function deleteAction(){
        
    	if(!$this->_id && !$this->request->isPost())
    			throw new \Exception('Invalid Entity');
    	$this->model->delete($this->_id);    	
    	$this->addPageMessage('The client has been deleted.','success');    	
    	$this->redirect()->toRoute('manageclients');
    }
    
    public function sendmailAction(){
        
        $form = new \Manageclients\Form\SendClientMailForm($this->getEm(self::AVP_CONFIG), '\Base\Entity\Avp\Clients'); 
        $user_data = $this->model->getUser($this->params('id'));                        
        
            $data = array(
                'item' => $user_data,                                 
                'form' => $form,
            );
            if($this->request->isPost()){    
                $mail_content = $this->request->getPost();
                
                $to = isset($mail_content['to']) ? $mail_content['to'] : '';
                $subject = isset($mail_content['subject']) ? $mail_content['subject'] : '';
                $message = isset($mail_content['message']) ? $mail_content['message'] : '';
                $this->model->sendmailnew($to, $subject, $message);
                $this->addPageMessage('The mail has been Sent.', 'success');

                $this->redirect()->toRoute('manageclients');
                
                
            }
            return new ViewModel($data); 
        
    }
    
    public function noteAction(){
        $form = new \Manageclients\Form\ClientNoteForm($this->getEm(self::AVP_CONFIG), '\Base\Entity\Avp\Clients'); 
        $user_data = $this->model->getUser($this->params('id'));                        
        
            $data = array(
                'item' => $user_data,                                 
                'form' => $form,
            );
            if($this->request->isPost()){    
                $note_content = $this->request->getPost();
                $this->model->saveNote($note_content);
                $this->addPageMessage('Note for client has been saved.','success');				
                $this->redirect()->toRoute('manageclients-viewnotes',array('id'=>$this->params('id')));
            }
            return new ViewModel($data); 
    }
    
    public function viewnotesAction(){
        
        $user_data = $this->model->getUser($this->params('id'));                        
        $note_list = $this->model->getNoteList($this->params('id'));
            $data = array(
                'item' => $user_data,                                 
                'note' => $note_list,
                'message'=>$this->getPageMessages(),
            );
            
            return new ViewModel($data); 
    }
    
    public function editnotesAction(){
        
        $note_list = $this->model->getNoteDetails($this->params('id'));
        $form = new \Manageclients\Form\ClientNoteForm($this->getEm(self::AVP_CONFIG), '\Base\Entity\Avp\Clients'); 
        $data=array();
        $data['subject']=$note_list->getSubject();
        $data['message']=$note_list->getMessage();
        $data['travellerId']=$note_list->getTravellerId();
        $data['reminderDate']=$note_list->getreminderDate()->format('Y-m-d');
        $form->setData($data);
            $data = array(
                
                'note' => $note_list,
                'form' =>$form,
            );
        if($this->request->isPost()){
            $note_detail=$this->request->getPost();
            $this->model->updateNote($note_detail);
            $this->addPageMessage('Note for client has been updated.','success');				
            $this->redirect()->toRoute('manageclients-viewnotes',array('id'=>$note_detail['travellerId']));
        }    
        return new ViewModel($data); 
        
    }
    
    public function deletenotesAction(){
        $note_id=$this->params('id');
        $c_id=$this->model->getNoteDetails($note_id);
        $client_id=$c_id->getTravellerId();
        $del_note=$this->model->deleteNote($note_id);
        $this->addPageMessage('The client note has been deleted.','success');    	
    	$this->redirect()->toRoute('manageclients-viewnotes',array('id'=>$client_id));
    }
    
    public function orderhistoryAction(){
        $user_data = $this->model->getUser($this->params('id')); 
        $user_email = $user_data->getEmail();
        $user_orders = $this->model->getUserList('email',$user_email);
        $data = array(
                'item' => $user_data,
                'order' => $user_orders,
                'message'=>$this->getPageMessages(),
            );
          
            return new ViewModel($data); 
        
    }
    
}
