<?php

namespace Orders\Controller;

use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Inventory\Model\Promos;
use Zend\View\Model\JsonModel;
use Inventory\Model\Items;
use Sendmail\Controller\SendmailController;

class AjaxController extends AbstractActionController {

    protected $_entity = false; 
    public $model;
    
    const RESORT_ROOMS = 1;
    const EVENT_ROOMS = 2;
    const CRUISE_CABINS = 3;
    
    public function onDispatch(MvcEvent $e){
        
        Promos::initServiceManager($this->getServiceLocator());
        
        $e->getViewModel()->setVariable('modulename', 'Orders');                
        $this->layout('layout/ajax');
        return parent::onDispatch($e);			
    }

    protected function getModel($model) {
        return $this->getServiceLocator()->get($model);
    }
    
    protected function getConfig($type, $id){
        $data = null;
        
        $this->model = $this->getModel('OrdersAjaxModel');
        
        switch ((int)$type){
            
            case self::RESORT_ROOMS:
                  //  $data = $this->model->getHotelRoom(array('id'=>(int)$id));
                    $data = $this->model->getHotelRoom(array('roomId'=>(int)$id));
                    break;
            case self::EVENT_ROOMS:
                    $data = $this->model->getEventRoom(array('roomId'=>(int)$id)); 
                    break;
            case self::CRUISE_CABINS:
                    $data = $this->model->getCruiseCabin(array('suiteId'=>(int)$id));
                    break; 
        }        
        return $data;
        
    }

    protected function getItems($type, $id){     
        $typeCode = 0;
        switch ((int)$type){            
            case self::RESORT_ROOMS:
                $typeCode = Items::LINKED_TO_RESORT_NAME;
                break;
            case self::EVENT_ROOMS:
                $typeCode = Items::LINKED_TO_EVENT_NAME;
                break;
            case self::CRUISE_CABINS:
                $typeCode = Items::LINKED_TO_CRUISE_NAME;
        }    
        if($typeCode){                            
            return $this->model->getItems($typeCode, $id);  
        }
        return null;
        
    }
    
    public function ajaxAction() {

        if ($this->request->isPost()) {

            $data = $this->request->getPost();
            
            $type = $data['type'];
            $id = $data['id'];
            
            //to get the rooms data from inventory
//            switch ((int)$type){            
//            case self::RESORT_ROOMS:
//                $this->model = $this->getModel('OrdersAjaxModel');        
//                $collection = $this->model->getResortRoomDetailByInventory((int)$id,$dateFrom,$dateTo);
//                $type = $data['type'];
//                 if($collection[0]){
//                    $id = $collection[0]->getId();
//                }else{ $id= null;}
//                break;
//            case self::EVENT_ROOMS:
//                $this->model = $this->getModel('OrdersAjaxModel');        
//                $collection = $this->model->getEventRoomDetailByInventory((int)$id);
//                $type = $data['type'];
//                if($collection[0]){
//                    $id = $collection[0]->getId();
//                }else{ $id= null;}
//                break;
//            case self::CRUISE_CABINS:
//                $this->model = $this->getModel('OrdersAjaxModel');        
//                $collection = $this->model->getEventRoomsCustomCollection();
//                $type = $data['type'];
//                $id = $data['id'];
//        }    
            
            if($id){
                $result = $this->getConfig($type, $id);
                if($result):
                    return new JsonModel(array('result' => $this->getConfig($type, $id)->toArray()));
                else:
                    return new JsonModel(array('result' => "You cannot book this room.",'status'=>0));
                endif;
            }else{
                return new JsonModel(array('result' => "You cannot book this room.",'status'=>0));
            }
        }
    }

    public function reservationAction(){                
        if ($this->request->isPost()){
            $postData = $this->request->getPost(); 
            $data = array();
            parse_str($postData['data'], $data);                        
            
            $dataPart = array();                   
            $type = $data['type'];
                       
            switch ((int)$type){            
            case self::RESORT_ROOMS:

                $id = isset($data['roomCategory']) ? $data['roomCategory']:0; 
                $item = $this->getConfig($type, $id);   
                if($item){
                    $dataPart['room'] = $item->getRoomCategory();
                    $dataPart['hotel'] = $item->getHotelName();
                }
                break;
            case self::EVENT_ROOMS:
                $id = isset($data['roomCategory']) ? $data['roomCategory']:0;                
                $item = $this->getConfig($type, $id);                                
                if($item){
                    $dataPart['room'] = $item->getRoomCategory();
                    $dataPart['event'] = $item->getHotelName();
                }
                break;
            case self::CRUISE_CABINS:
                $id = isset($data['suiteName']) ? $data['suiteName']:0;                
                $item = $this->getConfig($type, $id);                                
                if($item){                    
                    $dataPart['suite'] = $item->getSuiteName();
                    $dataPart['cruise'] = $item->getCruiseName();
                }
                break;
            }  
            if(isset($data['items'])){
                $items = $this->getItems($type, $id);                
                foreach ($items as $item){
                    if(in_array($item->getId(), $data['items'])){                        
                        $dataPart['itemsArray'][$item->getId()] = $item->getName().' ($'.$item->getGrossPrice().')';
                    }
                }
            }                        
            $data = array_merge($data, $dataPart);              
        }     
        $this->model = $this->getModel('OrdersAjaxModel');  
       // d($data);
        if($data['travellerCountry']){
            $data['travellerCountry'] = $this->model->getCountry(isset($data['travellerCountry']) ? (int)$data['travellerCountry'] : 0);           
        }
        return new ViewModel(array('data'=>$data));                            
    }
    
    public function resortsAction() {                      
        $this->model = $this->getModel('OrdersAjaxModel');        
        $collection = $this->model->getHotelsCollection();                                
        $data = array(
            'collection' => $collection,             
        );  
        return new ViewModel($data);
    }
    
    public function eventsAction() {  
        
        $this->model = $this->getModel('OrdersAjaxModel');        
        //$collection = $this->model->getEventsCollection();
        $collection = $this->model->getFilteredEventsCollection();
        $data = array(
            'collection' => $collection,             
        );
        return new ViewModel($data);
    }
    
    public function cruisesAction() {        
        $this->model = $this->getModel('OrdersAjaxModel');        
        $collection = $this->model->getCruisesCollection();                                
        $data = array(
            'collection' => $collection,             
        );          
        return new ViewModel($data);
    }
    
    public function resortroomsAction() { 
        $id = $this->params()->fromRoute('id', 0); 
        $request = $this->getRequest();
        $dateFrom = $request->getPost("dateFrom");
        $dateTo = $request->getPost("dateTo");
        $this->model = $this->getModel('OrdersAjaxModel');        
        //$collection = $this->model->getHotelRoomsCollection(array('resortId'=>(int)$id));
        $collection = $this->model->getRoomsByResortIdCollection($id);
       // $collection = $this->model->getHotelRoomsCollection(array('resortId'=>(int)$id,'dateFrom'=>$dateFrom,'dateTo'=>$dateTo));
        
        $data = array(
            'collection' => $collection,             
        );          
        return new ViewModel($data);
    }
    public function eventroomsAction() { 
        $id = $this->params()->fromRoute('id', 0); 
        $this->model = $this->getModel('OrdersAjaxModel');        
        //$collection = $this->model->getEventRoomsCollection(array('eventId'=>(int)$id));
        $collection = $this->model->getRoomsByEventIdCollection($id);
        $events = $this->model->getEventById(array('id'=>(int)$id));
        //$collection = $this->model->getEventRoomsCustomCollection(array('eventId'=>(int)$id));  
        $data = array(
            'collection' => $collection,
            'data'      => $events
        );          
        return new ViewModel($data);
    }
    public function cruisecabinsAction() { 
        $id = $this->params()->fromRoute('id', 0); 
        $this->model = $this->getModel('OrdersAjaxModel');        
       // $collection = $this->model->getCruiseCabinsCollection(array('cruiseId'=>(int)$id));  
        $collection = $this->model->getCabinsByCruiseIdCollection((int)$id);
        //$collection = $this->model->getCruiseCabinsCustomCollection(array('cruiseId'=>(int)$id));
        $cruises = $this->model->getCruiseById(array('id'=>(int)$id));
        $data = array(
            'collection' => $collection,
            'data' => $cruises
        );          
        return new ViewModel($data);
    } 
    public function resortroomAction() {  
                
        $id = $this->params()->fromRoute('id', 0); 
        $this->model = $this->getModel('OrdersAjaxModel');               
        //$this->model->getDiscountToResort($id);                
        $item = $this->model->getHotelRoom(array('id'=>(int)$id));                                
        $data = array(
            'item' => $item,             
        );         
        return new ViewModel($data);        
    }    
    public function eventroomAction() {         
        $id = $this->params()->fromRoute('id', 0); 
        $this->model = $this->getModel('OrdersAjaxModel');        
        $item = $this->model->getEventRoomFromEventRoom(array('id'=>(int)$id));                                
        $data = array(
            'item' => $item,             
        );
        return new ViewModel($data);        
    }
    public function cruisecabinAction() {         
        $id = $this->params()->fromRoute('id', 0); 
        $this->model = $this->getModel('OrdersAjaxModel');        
        $item = $this->model->getCruiseCabin(array('id'=>(int)$id));                                
        $data = array(
            'item' => $item,             
        );         
        return new ViewModel($data);        
    }
    
    public function itemsAction() {                         
        $data = $this->request->getPost();
        $typeCode = isset($data['typeCode'])?(int)$data['typeCode'] : 0;        
        $id = isset($data['id'])?(int)$data['id'] : 0;                   
        $this->model = $this->getModel('OrdersAjaxModel');        
        $collection = $this->model->getItems($typeCode, $id);        
        $data = array(
            'collection' => $collection,             
        );         
        return new ViewModel($data);        
    }
    
     public function clientDetailsAction() {                         
        $post = $this->request->getPost('cId');
        $customerId = isset($post)?$post : null;
        $this->model = $this->getModel('OrdersAjaxModel');        
        $item = $this->model->getClientDetails(array('customerId'=>$customerId));                                
        $data =  $item;
        $dataArray = array();
        $dataArray['name'] = $data->getName();
        $dataArray['phone'] = $data->getPhone();
        $dataArray['dob'] = $data->getDob();
        $dataArray['email'] = $data->getEmail();
        $dataArray['address1'] = $data->getAddressLine1();
        $dataArray['address2'] = $data->getAddressLine2();
        $dataArray['city'] = $data->getCity();
        $dataArray['state'] = $data->getState();
        $dataArray['country'] = $data->getCountryId();
        $dataArray['zip'] = $data->getZip();
        return new JsonModel($dataArray);            
    }
    
     public function orderRoomsAvailableAction() { 
         if ($this->request->isPost() && $this->request->isXmlHttpRequest()) {
            $this->model = $this->getModel('Orders');
             $roomId = $this->request->getPost('roomId');
              $start = $this->request->getPost('start');
               $end = $this->request->getPost('end');
               $type = $this->request->getPost('type');
            $data = $this->model->getRoomsAvailable($roomId,$start,$end,$type);
            return new JsonModel($data);
        }
     }
     

     public function excursionsAction() {                         
        $data = $this->request->getPost();
        $typeCode = isset($data['typeCode'])?(int)$data['typeCode'] : 0;        
        $id = isset($data['id'])?(int)$data['id'] : 0;                   
        $this->model = $this->getModel('OrdersAjaxModel');        
        $collection = $this->model->getExcursions($typeCode, $id);        
        $data = array(
            'collection' => $collection,
            'type' => $typeCode
        );         
        return new ViewModel($data);        
    }
    
     public function transfersAction() {                         
        $data = $this->request->getPost();
        $typeCode = isset($data['typeCode'])?(int)$data['typeCode'] : 0;        
        $id = isset($data['id'])?(int)$data['id'] : 0;                   
        $this->model = $this->getModel('OrdersAjaxModel');        
        $collection = $this->model->getTransfers($typeCode, $id);        
        $data = array(
            'collection' => $collection,             
        );         
        return new ViewModel($data);        
    }
    
    public function printreservationAction() {
         $this->model = $this->getModel('Orders');


	

         if ($this->params()->fromRoute('id', 0)) {

            $this->_entity = $this->model->getItem($this->params()->fromRoute('id', 0));
        }

       
        $collection = array('reservation' => $this->model->getItemView($this->_entity->getId()));
        $data = array(
            'collection' => $collection,             
        ); 
      
        return new ViewModel($data);     
    }


    public function printinvoiceAction() {
         $this->model = $this->getModel('Invoices');

	 $id= $this->getEvent()->getRouteMatch()->getParam('id'); //print_r($id); die;
	 $data = array(
            'collection' => $this->model->getItemView($id),
	  //  'traveller'=>$this->model->getclientinfo($this->collection[0]['orderId']),
  
           
        ); 

	 
	


        return new ViewModel($data);     
    }
    
    public function allClientsAction() { 

      $pattern = $this->request->getPost('pattern');
      $data = $this->getModel("OrdersAjaxModel")->getAllClients($pattern);
      return new JsonModel($data);
    }
    
    public function getDepositExceptionsAction(){
        $post = $this->request->getPost();
        $data = $this->getModel("Orders")->getDepositException($post);
        return new JsonModel($data);
    }
    
   

    
    public function addTravellerAction(){
//        d('here');
        $this->model = $this->getModel('Front');
        $count= $this->params()->fromRoute('count', 0);
        $count=$count+1;
        
        $post = $this->request->getPost();
        $result=$this->model->checkOccupancy($post,$count);
        
        if($result==1 || $count==2){
            $data = array(
                'count' => $count,             
            ); 

            return new ViewModel($data);  
        }elseif($result==2){
            $result=array('msg'=>'Triple Occupancy Not allowed.','status'=>$result);
            return new JsonModel($result);
        }elseif($result==3){
            $result=array('msg'=>'Quad Occupancy Not allowed.','status'=>$result);
            return new JsonModel($result);
        }
    }
 
}
