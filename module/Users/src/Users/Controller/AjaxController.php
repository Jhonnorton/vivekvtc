<?php

namespace Users\Controller;

use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;

//class AjaxController extends \Base\Controller\BaseController {
class AjaxController extends AbstractActionController {    
    	
        protected $_entity = false; 
        public $model;

        public function onDispatch(MvcEvent $e){
						
		$e->getViewModel()->setVariable('modulename', 'SalesObjects');                
                $this->layout('layout/ajax');
                
		return parent::onDispatch($e);			
	}
       	
	public function clientAction() {
            
            $this->model = $this->getModel('Clients');
            $entity = $this->model->getItem($this->params()->fromRoute('id', 0));                        
            $country  =  $this->getEm()->getRepository('\Base\Entity\Avp\Countries')->findOneById($entity->getCountryId());            
            $data = array(
                'item' => $entity,                                 
                'country'  => $country,
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
