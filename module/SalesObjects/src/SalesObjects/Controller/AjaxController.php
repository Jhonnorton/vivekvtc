<?php

namespace SalesObjects\Controller;

use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

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
        
        public function eventAction(){            
            $this->model = $this->getModel('Events');
            $entity = $this->model->getItem($this->params()->fromRoute('id', 0));  
            $category = $this->getEm()->getRepository('\Base\Entity\Avp\EventsCategory')->findOneById($entity->getCategoryId());
            $country  =  'None';//$this->getEm()->getRepository('\Base\Entity\Avp\Countries')->findOneById($entity->getCountryId());
            
            $data = array(
                'item' => $entity, 
                'imagePath'=>$this->model->getImagePath(),
                'category' => $category,
                'country'  => $country,
            );
            
            return new ViewModel($data);  
        }
        
        public function saveEventRoomsAction(){
            $this->model = $this->getModel('Events');
            $results = $_POST;
            $msg = $this->model->saveEventRooms($results);
            $msg['roomId'] = $_POST['roomId'];
            return new JsonModel($msg);
        }

        protected function getEm(){
            return $this->getServiceLocator()->get('doctrine.entitymanager.orm_avp');
        }
        
        protected function getModel($model) {
            return $this->getServiceLocator()->get($model);
        }
        
        public function eventRoomsAction(){
            $model = $this->getModel('Events');
            $entity = $model->getResortRooms($this->params()->fromRoute('id', 0));   
            $eventRooms = $model->getEventtRooms($this->params()->fromRoute('id', 0));   
            if ($this->request->isPost()) {         
                $data=$this->request->getPost();
                $model->saveEventtRooms($data, $this->params()->fromRoute('id', 0));   
//                $this->addPageMessage('Event Rooms is saved','success');
                $this->redirect()->toRoute('events');
            }
            $data=array('collection'=>$entity,'eventRooms'=>$eventRooms,'eventId'=>$this->params()->fromRoute('id', 0));
            return new ViewModel($data);  
        }
        
        public function setCommissionAction(){
            $model = $this->getModel('Events');
            $type = $this->params()->fromRoute('type', 0);   
            $id = $this->params()->fromRoute('id', 0);
            $typeCommission=$model->getTypeCommission($type,$id);
            $entity=$model->getTypeData($type,$id);
            
            if ($this->request->isPost()) {         
                $data=$this->request->getPost();
                $model->saveCommission($data);   
                
                $type=$this->request->getPost('type');
                switch($type){
                    case 1:
                        $this->redirect()->toRoute('hotels');
                        break;
                    case 2:
                        $this->redirect()->toRoute('events');
                        break;
                    case 3:
                        $this->redirect()->toRoute('cruises');
                        break;
                }
            }
            $data=array('collection'=>$entity,'type'=>$type,"typeCommission"=>$typeCommission);
//            d($data);
            return new ViewModel($data); 
        }
}
