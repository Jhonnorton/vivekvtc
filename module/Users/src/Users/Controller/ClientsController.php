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

class ClientsController extends \Base\Controller\BaseController {	
	
    protected $_entity = false;    

    public function onDispatch(MvcEvent $e){
	
        $this->model = $this->getModel('Clients');		
        if($this->params()->fromRoute('id', 0)){					
            $this->_entity = $this->model->getItem($this->params()->fromRoute('id', 0));			
	}
        $e->getViewModel()->setVariable('modulename', 'Users');	
        return parent::onDispatch($e);    
    }
	
    public function indexAction(){
    	
    	$data = array(
            'collection' => $this->model->getCollection(),
            'message'=>$this->getPageMessages(),
    	);    	
        return $this->getView($data);
    }
	
    public function addAction(){
    	    	
        $form = new \Users\Form\AddClientForm($this->getEm(self::AVP_CONFIG), '\Base\Entity\Avp\Clients'); 
        if($this->request->isPost()){  
            $form->setInputFilter($this->model->getInputFilter());
            $data = $this->request->getPost();     
            $form->setData($data);              
            if($form->isValid()){	                
                if($this->model->isValidModel($form)){                    
                    $this->model->save($form->getData());				
                    $this->addPageMessage('The client has been saved.','success');				
                    $this->redirect()->toRoute('clients');
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
                        $this->redirect()->toRoute('clients');
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
    	$this->redirect()->toRoute('clients');
    }    	       
}
