<?php

namespace Inventory\Controller;

use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\Mvc\Controller\AbstractActionController;
use Inventory\Model\Promos;

class AjaxController extends AbstractActionController {    
    	
    protected $_entity = false; 
    public $model;
    
    public function onDispatch(MvcEvent $e){

        Promos::initServiceManager($e->getApplication()->getServiceManager());
        $e->getViewModel()->setVariable('modulename', 'Inventory');                
        $this->layout('layout/ajax');

        return parent::onDispatch($e);			
    }

    protected function getModel($model) {

        return $this->getServiceLocator()->get($model);
    }

    public function cabinsAction() {
        
        $id = $this->params()->fromRoute('id', 0);        
        $this->model = $this->getModel('InventoryCruise');        
        $cabins = $this->model->getCabinsByCruiseIdCollection($id);
        $cruises = $this->getModel('AjaxModel')->getCruiseById(array('id'=>(int)$id));
        $data = array(
            'collection' => $cabins,
            'data' => $cruises
        );          
        return new ViewModel($data);
    } 
    
    public function roomsAction() {
        
        $id = $this->params()->fromRoute('id', 0);        
        $this->model = $this->getModel('InventoryHotels');        
        $rooms = $this->model->getRoomsByResortIdCollection($id);                        
        $data = array(
            'collection' => $rooms,             
        );
        
         if($this->request->isPost()){
            $post = $this->request->getPost();
            if(isset($post['roomId'])) $data['roomId'] = (int)$post['roomId'];
        }
        
        return new ViewModel($data);
    }
        
    public function eventroomsAction() {        
        $id = $this->params()->fromRoute('id', 0);        
        $this->model = $this->getModel('InventoryEvent');        
        $rooms = $this->model->getRoomsByEventIdCollection($id);
        $events = $this->getModel('AjaxModel')->getEventById(array('id'=>(int)$id));
        $data = array(
            'collection' => $rooms,
            'data' => $events
        );   
        
        if($this->request->isPost()){
            $post = $this->request->getPost();
            if(isset($post['roomId'])) $data['roomId'] = (int)$post['roomId'];
        }
        
        return new ViewModel($data);
    }
    
    public function resortsAction() {                      
        $this->model = $this->getModel('AjaxModel');        
        $collection = $this->model->getHotelsCollection();                                
        $data = array(
            'collection' => $collection,             
        );          
        return new ViewModel($data);
    }
    
    public function eventsAction() {        
        $this->model = $this->getModel('AjaxModel');        
        $collection = $this->model->getEventsCollection();                                
        $data = array(
            'collection' => $collection,             
        );          
        return new ViewModel($data);
    }
    
    public function cruisesAction() {        
        $this->model = $this->getModel('AjaxModel');        
        $collection = $this->model->getCruisesCollection();                                
        $data = array(
            'collection' => $collection,             
        );          
        return new ViewModel($data);
    }
            
    public function eventcategoriesAction() {        
        $this->model = $this->getModel('AjaxModel');        
        $collection = $this->model->getEventCategoriesCollection();                                
        $data = array(
            'collection' => $collection,             
        );          
        return new ViewModel($data);
    }
    
    ///promo    
    
    public function promolinkedtoAction(){        
        $id = (int)$this->params()->fromRoute('id', 0);    
		$linkedTo = Promos::linkedTo();       
        $collection = $linkedTo[$id]['collection'];            
        $data = array(
                'collection' => $collection,       
                'typeCode' => $id,
        );
            
        return new ViewModel($data);
    }
    
     public function roomDetailsByIdAction() {
        
        $id = $this->params()->fromRoute('id', 0);        
        $this->model = $this->getModel('InventoryHotels');        
        $rooms = $this->model->getRoomDetailsByIdCollection($id);
        $rooms = json_encode($rooms[0]);
        echo $rooms;die;
    }
    
    public function cabinDetailsByIdAction() {
        
        $id = $this->params()->fromRoute('id', 0);        
        $this->model = $this->getModel('InventoryCruise');        
        $cabin = $this->model->getCabinDetailByIdCollection($id);
        $cabin = json_encode($cabin[0]);
        echo $cabin;die;
    }
    
    public function typeAction() {
        
      // echo 'hello';die;
        
        $id = $this->params()->fromRoute('id', 0);          
        $typeid = $this->params()->fromRoute('typeid', 0);          
        
      // echo $id; die;
        $this->model = $this->getModel('AjaxModel');        
        $rooms = $this->model->getallCollection($id);                        
        $data = array(
            'collection' => $rooms, 
            'typeid'=>$typeid
        );
       
       // echo '<pre>';
       // print_r($data);die;
        return new ViewModel($data);
    }
    
     
    public function viewAction() {
        
      // echo 'hello';die;
//        d($this->request->getPost());
        $id = $this->params()->fromRoute('id', 0); 
        $data=$this->request->getPost();
       
        $this->model = $this->getModel('AjaxModel');        
        $reservations = $this->model->getallReservationCollection($id, $data['typeId']);                        
        $data = array(
            'collection' => $reservations, 
        );
       
       // echo '<pre>';
       // print_r($data);die;
        return new ViewModel($data);
        
    }
    
    public function checkAction() {
        $id = $this->params()->fromRoute('rid', 0); 
        $type = $this->params()->fromRoute('type', 0); 
        if($this->request->isPost()){
           $post = $this->request->getPost();
           $model = $this->getModel('Orders');     
           $data=$model->getRoomsAvailable((int)$post['roomId'],$post['dateFrom'],$post['dateTo'],(int)$post['type']);
//           d($post);
           return new JsonModel($data);
        }
        $data=array('type'=>$type,'id'=>$id);
        return new ViewModel($data);
    }
}
