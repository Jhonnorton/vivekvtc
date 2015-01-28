<?php

namespace Reseller\Controller;

use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Inventory\Model\Promos;
use Zend\View\Model\JsonModel;
use Inventory\Model\Items;
use Sendmail\Controller\SendmailController;
use Payments\Controller\PaymentsController;

class AjaxController extends AbstractActionController {

    protected $_entity = false; 
    public $model;
    
    const RESORT_ROOMS = 1;
    const EVENT_ROOMS = 2;
    const CRUISE_CABINS = 3;
    
    public function onDispatch(MvcEvent $e){
        
        Promos::initServiceManager($this->getServiceLocator());
        
        $e->getViewModel()->setVariable('modulename', 'Payments');                
        $this->layout('layout/ajax');
        return parent::onDispatch($e);			
    }

    protected function getModel($model) {
        return $this->getServiceLocator()->get($model);
    }
    
    protected function getConfig($type, $id){
        
        $data = null;
        
        $this->model = $this->getModel('LeadsAjaxModel');
        
        switch ((int)$type){
            
            case self::RESORT_ROOMS:
                    $data = $this->model->getHotelRoom(array('id'=>(int)$id));
                    break;
            case self::EVENT_ROOMS:
                    $data = $this->model->getEventRoom(array('id'=>(int)$id)); 
                    break;
            case self::CRUISE_CABINS:
                    $data = $this->model->getCruiseCabin(array('id'=>(int)$id));
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



            return new JsonModel(array('result' => $this->getConfig($type, $id)->toArray()));
        }
    }

    public function reservationAction(){      
          $id = $this->params()->fromRoute('id', 0);
          // d($id);
          $this->model = $this->getModel('PaymentsAjaxModel');       
       //   d($id);
          
          $collection = $this->model->getReservation(array('id'=>(int)$id));
          $data = array('collection' => $collection );
         
        // d($data);
        /*
        
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
        $this->model = $this->getModel('LeadsAjaxModel');        
        $data['travellerCountry'] = $this->model->getCountry(isset($data['travellerCountry']) ? $data['travellerCountry'] : 0); */          
        return new ViewModel($data);                            
    }
    
    public function resortsAction() {                      
        $this->model = $this->getModel('LeadsAjaxModel');        
        $collection = $this->model->getHotelsCollection();                                
        $data = array(
            'collection' => $collection,             
        );  
        return new ViewModel($data);
    }
    
    public function eventsAction() {  
        
        $this->model = $this->getModel('LeadsAjaxModel');        
        $collection = $this->model->getEventsCollection();                                
        $data = array(
            'collection' => $collection,             
        );         
        return new ViewModel($data);
    }
    
    public function cruisesAction() {        
        $this->model = $this->getModel('LeadsAjaxModel');        
        $collection = $this->model->getCruisesCollection();                                
        $data = array(
            'collection' => $collection,             
        );          
        return new ViewModel($data);
    }
    
    public function resortroomsAction() { 
        $id = $this->params()->fromRoute('id', 0); 
        $this->model = $this->getModel('LeadsAjaxModel');        
        //$collection = $this->model->getHotelRoomsCollection(array('resortId'=>(int)$id));
        $collection = $this->model->getHotelRoomsCustomCollection(array('resortId'=>(int)$id));
        
        $data = array(
            'collection' => $collection,             
        );          
        return new ViewModel($data);
    }
    public function eventroomsAction() { 
        $id = $this->params()->fromRoute('id', 0); 
        $this->model = $this->getModel('LeadsAjaxModel');        
        $collection = $this->model->getEventRoomsCollection(array('eventId'=>(int)$id));                                
        $data = array(
            'collection' => $collection,             
        );          
        return new ViewModel($data);
    }
    public function cruisecabinsAction() { 
        $id = $this->params()->fromRoute('id', 0); 
        $this->model = $this->getModel('LeadsAjaxModel');        
        $collection = $this->model->getCruiseCabinsCollection(array('cruiseId'=>(int)$id));                                
        $data = array(
            'collection' => $collection,             
        );          
        return new ViewModel($data);
    } 
    public function resortroomAction() {  
                
        $id = $this->params()->fromRoute('id', 0); 
        $this->model = $this->getModel('LeadsAjaxModel');               
        //$this->model->getDiscountToResort($id);                
        $item = $this->model->getHotelRoom(array('id'=>(int)$id));                                
        $data = array(
            'item' => $item,             
        );         
        return new ViewModel($data);        
    }    
    public function eventroomAction() {         
        $id = $this->params()->fromRoute('id', 0); 
        $this->model = $this->getModel('LeadsAjaxModel');        
        $item = $this->model->getEventRoom(array('id'=>(int)$id));                                
        $data = array(
            'item' => $item,             
        );
        return new ViewModel($data);        
    }
    public function cruisecabinAction() {         
        $id = $this->params()->fromRoute('id', 0); 
        $this->model = $this->getModel('LeadsAjaxModel');        
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
        $this->model = $this->getModel('LeadsAjaxModel');        
        $collection = $this->model->getItems($typeCode, $id);        
        $data = array(
            'collection' => $collection,             
        );         
        return new ViewModel($data);        
    }
    
     public function clientDetailsAction() {                         
        $post = $this->request->getPost('cId');
        $customerId = isset($post)?$post : null;
        $this->model = $this->getModel('LeadsAjaxModel');        
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
         echo "dsfs";die;
     }
     
     public function excursionsAction() {                         
        $data = $this->request->getPost();
        $typeCode = isset($data['typeCode'])?(int)$data['typeCode'] : 0;        
        $id = isset($data['id'])?(int)$data['id'] : 0;                   
        $this->model = $this->getModel('LeadsAjaxModel');        
        $collection = $this->model->getExcursions($typeCode, $id);        
        $data = array(
            'collection' => $collection,             
        );         
        return new ViewModel($data);        
    }
    
     public function transfersAction() {                         
        $data = $this->request->getPost();
        $typeCode = isset($data['typeCode'])?(int)$data['typeCode'] : 0;        
        $id = isset($data['id'])?(int)$data['id'] : 0;                   
        $this->model = $this->getModel('LeadsAjaxModel');        
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

    public function getEmailAction() {
        $this->model = $this->getModel('Reseller');
       $client_list=$this->model->getEmails($this->request->getPost('pattern'));
//        $client_list = $this->User->find('all', array('conditions' => array('User.email LIKE' => '%' . $this->request->data['pattern'] . '%'), 'group' => 'email', 'fields' => array('id', 'first_name', 'last_name', 'email')));
        
        $list = array();
        foreach ($client_list as $k => $l) {
            $list[$k] = array('label' => $l->getFirstName() . ' - ' . $l->getEmail(), 'value' => $l->getFirstName() . ' - ' . $l->getEmail(), 'key' => $l->getId());
        }
        
//        echo json_encode($list);
        
        return new JsonModel($list);
        
        
    }
    
     public function viewUsersAction() {
         $this->model = $this->getModel('Reseller');
         $themeid=$this->request->getPost('id');
         $users=$this->model->getTemplateUsers($themeid);
//         d($users);
        $data = array(
            'collection' => $users,             
        ); 
      
        return new ViewModel($data);  
     }
 
     public function checkNameAction(){
        
         if ($this->request->isPost()) {
            $model = $this->getModel('Reseller');
            $value = $this->request->getPost('value');
//            d($value);
            $array=$model->getUrlExtension($value);
//            d($array);
            if($array){
                $data = array('data' =>"0"); 
            }else{
                $data = array('data' =>"1"); 
            }
//            d($data);
            return new JsonModel($data);
         }else{
             echo "Not Authorised"; die;
         }
     }
}
