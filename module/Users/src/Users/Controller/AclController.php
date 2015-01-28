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

class AclController extends \Base\Controller\BaseController{
	
    protected $_entity = false;

    public function onDispatch(MvcEvent $e){
        $this->model = $this->getModel('Acl');
        if($this->params()->fromRoute('id', 0)){
                $this->_entity = $this->model->getItem($this->params()->fromRoute('id', 0));
        }
        $e->getViewModel()->setVariable('modulename', 'Users');
        parent::onDispatch($e);
    }
	
    public function indexAction(){
    	           	
    	$data = array(
            'collection' => $this->model->getCollection(),
            'usercount' => $this->model->getUser(),
            'message'=>$this->getPageMessages(),
    	);    	
        return $this->getView($data);
    }
	
    public function addAction(){
    	$form = new \Users\Form\AclForm($this->getEm(), '\Base\Entity\Role');    	
    	if($this->request->isPost()){
            $data = $this->request->getPost(); 

         // d($data);
            $form->setInputFilter($this->model->getInputFilter());
            $form->setData($data);	            	
            if($form->isValid()){					
                if($this->model->isValidModel($form)){		
                    //$this->model->saveAcl($form->getData(), $data['resource']);		
                   // d($data['module']);
                    
                    $this->model->saveModel($form->getData(), $data['resource']);				                                                    
                    $this->addPageMessage('The role has been saved.','success');				
                    $this->redirect()->toRoute('acl');
                }
            } else {
                $form->getMessages(); 
            }       	
        }

       // d($form);
        $permission=$this->model->getModuleName();
        $view = $this->getView(array('form' => $form,'permission'=>$permission));    	
    	return $view;
    }
    
    public function editAction(){
    	if(!$this->_entity) throw new \Exception('Invalid Entity');    	
    	$form = new \Users\Form\AclForm($this->getEm(), $this->_entity, $this->_entity->getId());
    	$form->get('submit')->setValue('edit');    	
    	if($this->request->isPost()){
            $data = $this->request->getPost();

            $form->setInputFilter($this->model->getInputFilter());
            $form->setData($data);

            if($form->isValid()){
                if($this->model->isValidModelOnEdit($form)){
                    //$this->model->saveAcl($form->getData(), $data['resource']);    			
                    $this->model->update($form->getData(), $data['resource']);    			
                    $this->addPageMessage('The role has been updated.','success');    			
                    $this->redirect()->toRoute('acl');
                }
            } else {
                $form->getMessages();
            }    		
    	}    	
        
        $permission=$this->model->getModuleName();
        $checkIds = $this->model->getCheckedPermissions($this->_entity->getId());
    	$view = $this->getView(array('form' => $form,'permission'=>$permission,'checked'=>$checkIds));    	
    	return $view;
    }
    
    public function deleteAction(){
    	if(!$this->_id && !$this->request->isPost())
    		throw new \Exception('Invalid Entity');    	
    	$currentUser = $this->getSessionData('User', 'user');    	
    	if(!is_null($currentUser)){
            if($currentUser->getRole()->getId() == $this->_id){
                    $this->addPageMessage('The role has not been deleted.','error');
            } else{
                    $this->model->delete($this->_id);
                    $this->addPageMessage('The role has been deleted.','success');
            }
            $this->redirect()->toRoute('acl');
    	}else{
            $this->redirect()->toRoute('login');
    	}    	
    }
    
    
     public function suspendAction(){
    	if(!$this->_id && !$this->request->isPost())
    		throw new \Exception('Invalid Entity');    	
    	$currentUser = $this->getSessionData('User', 'user');    	
    	if(!is_null($currentUser)){
            if($currentUser->getRole()->getId() == $this->_id){
                    $this->addPageMessage('The role has not been suspended.','error');
            } else{
                    $this->model->suspend($this->_id);
                    $this->addPageMessage('The role has been suspended.','success');
            }
            $this->redirect()->toRoute('acl');
    	}else{
            $this->redirect()->toRoute('login');
    	}    	
    }
    
    public function isValidMd5($md5){
    	return preg_match('/^[a-f0-9]{32}$/', $md5);
    }
}
