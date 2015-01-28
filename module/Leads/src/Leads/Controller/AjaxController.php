<?php

namespace Leads\Controller;

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

    public function onDispatch(MvcEvent $e) {

        Promos::initServiceManager($this->getServiceLocator());

        $e->getViewModel()->setVariable('modulename', 'Leads');
        $this->layout('layout/ajax');
        return parent::onDispatch($e);
    }

    protected function getModel($model) {
        return $this->getServiceLocator()->get($model);
    }

    protected function getConfig($type, $id) {
        $data = null;

        $this->model = $this->getModel('LeadsAjaxModel');

        switch ((int) $type) {

            case self::RESORT_ROOMS:
                $data = $this->model->getHotelinRoom(array('id' => (int) $id));
                d($data);
                break;
            case self::EVENT_ROOMS:
                $data = $this->model->getEventRoom(array('id' => (int) $id));

                d($data);
                break;
            case self::CRUISE_CABINS:
                $data = $this->model->getCruiseinCabin(array('id' => (int) $id));
                break;
        }
        return $data;
    }

    protected function getItems($type, $id) {
        $typeCode = 0;
        switch ((int) $type) {
            case self::RESORT_ROOMS:
                $typeCode = Items::LINKED_TO_RESORT_NAME;
                break;
            case self::EVENT_ROOMS:
                $typeCode = Items::LINKED_TO_EVENT_NAME;
                break;
            case self::CRUISE_CABINS:
                $typeCode = Items::LINKED_TO_CRUISE_NAME;
        }
        if ($typeCode) {
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
        //   $collection = $this->model->getFilteredEventsCollection();
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
        $request = $this->getRequest();
        $dateFrom = $request->getPost("dateFrom");
        $dateTo = $request->getPost("dateTo");
        $this->model = $this->getModel('LeadsAjaxModel');
        $collection = $this->model->getHotelRoom(array('resortId' => (int) $id,'isDeleted'=>0));
        //   $collection = $this->model->getHotelRoomsCollection(array('resortId'=>(int)$id,'dateFrom'=>$dateFrom,'dateTo'=>$dateTo));
        // d($collection);
        $data = array(
            'collection' => $collection,
        );
        return new ViewModel($data);
    }

    public function cruisecabinsAction() {
        $id = $this->params()->fromRoute('id', 0);
        $this->model = $this->getModel('LeadsAjaxModel');
        $collection = $this->model->getCruiseCabin(array('cruiseId' => (int) $id,'isDeleted'=>0));
        //$collection = $this->model->getCruiseCabinsCustomCollection(array('cruiseId'=>(int)$id));
        //$cruises = $this->model->getCruiseById(array('id'=>(int)$id));
        //d($collection);
        $data = array(
            'collection' => $collection,
                //  'data' => $cruises
        );
        return new ViewModel($data);
    }

    public function eventroomsAction() {
        $id = $this->params()->fromRoute('id', 0);
        $this->model = $this->getModel('LeadsAjaxModel');
        $collection = $this->model->getEventRoom(array('eventId' => (int) $id,'isDeleted'=>0));
        //d($collection);
        //$events = $this->model->getEventById(array('id'=>(int)$id));
        //$collection = $this->model->getEventRoomsCustomCollection(array('eventId'=>(int)$id));  
        $data = array(
            'collection' => $collection,
            'data' => $collection
        );
        return new ViewModel($data);
    }

   

    protected function getConfigRooms($type, $id) {
        $data = null;

        $this->model = $this->getModel('LeadsAjaxModel');

        switch ((int) $type) {

            case self::RESORT_ROOMS:
                $data = $this->model->getHotelRoom(array('id' => (int) $id));
                d($data);
                break;
            case self::EVENT_ROOMS:
                $data = $this->model->getEventRoom(array('id' => (int) $id));

                d($data);
                break;
            case self::CRUISE_CABINS:
                $data = $this->model->getCruiseinCabin(array('id' => (int) $id));
                break;
        }
        return $data;
    }

    public function ajaxRoomDetailsAction() {

      if ($this->request->isPost()) {

            $data = $this->request->getPost();
//d($data);
            $type = $data['type'];
            $id = $data['id'];
            $count=$data['count'];
            $this->model = $this->getModel('LeadsAjaxModel');
            switch ((int) $type) {

                case self::RESORT_ROOMS:
                    $data = $this->model->getHotelRoom(array('resortId' => (int) $id));;
//d($data);
                    break;
                case self::EVENT_ROOMS:
                   $data = $this->model->getEventRoom(array('eventId' => (int) $id));

                    //d($data);
                    break;
                case self::CRUISE_CABINS:
                    $data =$this->model->getCruiseCabin(array('cruiseId' => (int) $id));
                    break;
            }

            $data = array(
                'collection' => $data,
                'count'=>$count,
                'type'=>$type,
            );
            return new ViewModel($data);
            // return new JsonModel(array('result' => $this->getConfigRooms($type, $id)->toArray()));
        }
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
    
    public function ajaxGetDescriptionAction() {

      if ($this->request->isPost()) {

            $data = $this->request->getPost();
//d($data);
            $type = $data['type'];
            $id = $data['id'];
            $this->model = $this->getModel('LeadsAjaxModel');
            switch ((int) $type) {

                case self::RESORT_ROOMS:
                    $data = $this->model->getHotelRoom(array('id' => (int) $id));
                    $image="/img/user_uploads/resortroom/thumbnails_80x80/".$data['0']->getImage();
                    $desc=$data['0']->getDescription();
//d($data);
                    break;
                case self::EVENT_ROOMS:
                   $data = $this->model->getEventRoom(array('id' => (int) $id));
                    $image="/img/user_uploads/resortroom/thumbnails_80x80/".$data['0']->getRoomId()->getImage();
                    $desc=$data['0']->getRoomId()->getDescription();
                    //d($data);
                    break;
                case self::CRUISE_CABINS:
                    $data =$this->model->getCruiseCabin(array('id' => (int) $id));
                    $image="/img/user_uploads/deck/thumbnails_80x80/".$data['0']->getDeckImageUrl();
                    $desc=$data['0']->getDescription();
                    break;
            }
//            d($data['0']);
//            $data = array(
//                'collection' => $data,
//                'count'=>$count,
//                'type'=>$type,
//            );
//            return new ViewModel($data);
             return new JsonModel(array('result' => strip_tags($desc),'img'=>$image));
        }
    }

}