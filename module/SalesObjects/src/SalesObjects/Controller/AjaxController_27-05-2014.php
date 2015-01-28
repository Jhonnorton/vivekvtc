<?php

namespace SalesObjects\Controller;

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
       	
	public function resortAction() {
            
            $this->model = $this->getModel('Resorts');
            $entity = $this->model->getItem($this->params()->fromRoute('id', 0));            
            $category = $this->getEm()->getRepository('\Base\Entity\Avp\Categorys')->findOneById($entity->getCategoryId());
            $country  =  $this->getEm()->getRepository('\Base\Entity\Avp\Countries')->findOneById($entity->getCountryId());
            
            $data = array(
                'item' => $entity, 
                'imagePath'=>$this->model->getImagePath(),
                'category' => $category,
                'country'  => $country,
            );
            
            return new ViewModel($data);                                   
	}

        public function cruiseAction(){            
            
            $this->model = $this->getModel('Cruises');
            $entity = $this->model->getItem($this->params()->fromRoute('id', 0));                                    
            $category = $this->getEm()->getRepository('\Base\Entity\Avp\CruisesCategory')->findOneById($entity->getCategoryId());
            $country  =  $this->getEm()->getRepository('\Base\Entity\Avp\Countries')->findOneById($entity->getCountryId());
            
            $data = array(
                'item' => $entity, 
                'imagePath'=>$this->model->getImagePath(),
                'category' => $category,
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
