<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Users for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Users\Controller;

use Zend\Mvc\MvcEvent;
use Zend;
use Zend\View\Model\ViewModel;


class UsersController extends \Base\Controller\BaseController
{
	
    protected $_entity = false;

    public function onDispatch(MvcEvent $e){


            //d('before parent');
            $this->model = $this->getModel('Users');

            if($this->params()->fromRoute('id', 0)){			
                    $this->_entity = $this->model->getItem($this->params()->fromRoute('id', 0));			
            }

            $e->getViewModel()->setVariable('modulename', 'Users');
            //d($this->getSessionData('Zend_Auth'));
            return parent::onDispatch($e);


    }
	
    public function indexAction(){    	
    	$model = $this->getModel('Users');    	
    	$data = array(
            'collection' => $model->getCollection(),
            'message'=>$this->getPageMessages(),
    	);  
        return $this->getView($data);
    }
	
    public function addAction(){    	
    	$form = new \Users\Form\AddUserForm($this->getEm(), '\Base\Entity\Users');    	
    	if($this->request->isPost()){    				            
            $form->setInputFilter($this->model->getInputFilter());
            $form->setData($this->request->getPost());
            $files = $this->request->getFiles()->toArray(); 
            
            if($form->isValid()){
                if($this->model->isValidModel($form)){

                    $url = $this->url()->fromRoute('profile', array(), array('force_canonical' => true));                    
                    $this->model->sendMailOnAdd($form->getData(), array('profile'=>$url));
                    
                     $object = array('object'=>$form->getData(), 
                                     'files'=>$files);               
                    
                    $this->model->save($object);
                    $this->addPageMessage('Login and password has been sent on email.','success');								
                    $this->redirect()->toRoute('users');                                    
                }				    
            } else {
             
                $form->getMessages(); 				                        
            }
        }
        $view = $this->getView(array('form' => $form));
        return $view;
    }
    
    public function editAction(){
                
    	if(!$this->_entity) throw new \Exception('Invalid Entity');    	
    	$form = new \Users\Form\AddUserForm($this->getEm(), $this->_entity);
    	$form->get('submit')->setValue('edit');    	   	
        if($this->request->isPost()){    		
            $form->setInputFilter($this->model->getInputFilter());
            $form->setData($this->request->getPost());
            $files = $this->request->getFiles()->toArray(); 
            if($form->isValid()){
                if($this->model->isValidModelOnEdit($form)){
                    
               //     d('heer');
                    
                    $url = $this->url()->fromRoute('profile', array(), array('force_canonical' => true));                    
                    $date = new \DateTime();
					$date = $date->format('d M Y');
                    $this->model->sendMailOnEdit($form->getData(), 
                            array(                        
                                'profile'=>$url,
                                'date'=>$date,                        
                    ));  
                    
               //     d('here');
                   // d($form->getData());
                     $object = array('object'=>$form->getData(), 
                                     'files'=>$files);               
                    $this->model->save($object);
                    $this->addPageMessage('Profile Updated !','success');
                    $this->redirect()->toRoute('users');
                }
            } else {
                $form->getMessages();
            }    		
    	}    	    	
    	$view = $this->getView(array('form' => $form));    	
    	return $view;
    }
    
    public function deleteAction()
    {
    	if(!$this->_id && !$this->request->isPost())
    			throw new \Exception('Invalid Entity');

    	$currentUser = $this->getSessionData('User', 'user');
    	    	
    	if(!is_null($currentUser)){
    		if( ($currentUser->getId() == $this->_id) || ($this->_id == 1) ){
    			$this->addPageMessage('The user has not been deleted.','error');
    		} else{
    			$this->model->delete($this->_id);
    			$this->model->deleteAffiliate($this->_id);
    			$this->addPageMessage('The user has been deleted.','success');
    		}
    		$this->redirect()->toRoute('users');
    	}else{
    		$this->redirect()->toRoute('login');
    	}    	    		
    }
    
    public function profileAction(){
    	
    	$auth = $this->getModel('Zend\Authentication\AuthenticationService');
    	
    	$user = $auth->getIdentity();
    	
    	return $this->getView(array('user' => $user));
    	
    }
    
    public function saveAction(){
    	
    	if($this->request->isPost()){
    		
    		$data = $this->request->getPost();
    		
    		$user = $this->model->getItem($data['id']);
    		
    		$form = new \Users\Form\AddUserForm($this->getEm(), '\Base\Entity\Users');
    		
    		$form->setInputFilter($this->model->getInputFilter());
    		
    		$form->setData($data);
    		
    		
    		
    		if($form->isValid()){
    			 sleep(2);
                          $files = $this->request->getFiles()->toArray(); 
                         $object = array('object'=>$form->getData(), 
                                     'files'=>$files);         
    			//$this->model->save($form -> getData());
                         $this->model->save($object);
    			echo json_encode(array('result' => true));
    			
    			die();
    		} else {
    			sleep(2);
    			echo json_encode($form->getMessages());
    			die();	
    			
    		}
    		
    		//$user->setCollection($data);
    		
    		d('end');
    		
    	}
    	
    }
    
    public function isValidMd5($md5)
    {
    	return preg_match('/^[a-f0-9]{32}$/', $md5);
    }
   
}
