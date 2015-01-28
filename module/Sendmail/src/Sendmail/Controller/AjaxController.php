<?php

namespace Sendmail\Controller;

use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;

class AjaxController extends AbstractActionController {    
    	
        protected $_entity = false; 
        public $model;

        public function onDispatch(MvcEvent $e){
						
		$e->getViewModel()->setVariable('modulename', 'Sendmail');                
                $this->layout('layout/ajax');
                
		return parent::onDispatch($e);			
	}
       	
	public function sendmailAction() {            
            
            $this->model = $this->getModel('Email');
            $data = array(                
                'content'=>$this->model->getContent($this->params()->fromRoute('id', 0)),                
            );
            
            return new ViewModel($data);                                   
	}        

        protected function getEm(){
            return $this->getServiceLocator()->get('doctrine.entitymanager.orm_avp');
        }
        
        protected function getModel($model) {
            return $this->getServiceLocator()->get($model);
        }        
}
