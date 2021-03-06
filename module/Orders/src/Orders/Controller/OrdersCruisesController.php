<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Orders for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Orders\Controller;

use Zend\Mvc\MvcEvent;

class OrdersCruisesController extends \Base\Controller\BaseController {

    protected $_entity = false;

    public function onDispatch(MvcEvent $e) {


        $this->model = $this->getModel('Orders');
        if ($this->params()->fromRoute('id', 0)) {
            $this->_entity = $this->model->getItem($this->params()->fromRoute('id', 0));
        }
        $e->getViewModel()->setVariable('modulename', 'Orders');
        return parent::onDispatch($e); //smart	
    }

    public function indexAction() {

        //$this->model = $this->getModel('Orders');		  
        $data = array('collection' => $this->model->getCollection(), 'message' => $this->getPageMessages(),);
        if ($this->request->isPost()) {
            $startdate = $this->getRequest()->getPost('mydate');
            $enddate = $this->getRequest()->getPost('mydate1');
            $data = array('collection' => $this->model->getCollection($startdate, $enddate),'startdat' => $startdate, 'enddat' => $enddate);
            //   return $this->getView($data);
        }

        return $this->getView($data);
    }

    public function deleteAction() {

        if (!$this->_id && !$this->request->isPost())
            throw new \Exception('Invalid Entity');

        $this->model->delete($this->_id);
        $this->addPageMessage('Order has been deleted.', 'success');
        return $this->redirect()->toRoute('orders-event');
    }

    public function viewAction() {

        if (!$this->_entity)
            throw new \Exception('Invalid Entity');


        $data = array('reservation' => $this->model->getItemView($this->_entity->getId()));

        return $this->getView($data);
    }

    public function cancelAction() {



        if (!$this->_id && !$this->request->isPost())
            throw new \Exception('Invalid Entity');

        $this->model->cancelResortReservation($this->_id);
        //d($data);
        if($this->_entity->getstatus()==0){
            
            $this->addPageMessage('Order has been cancelled.', 'success');
        }else{
        $this->addPageMessage('Order has been reinstated.', 'success');
        }
        return $this->redirect()->toRoute('orders-cruise');
    }

     public function editAction() {
        if (!$this->_entity)
            throw new \Exception('Invalid Entity');

        $form = new \Orders\Form\AddOrdersForm($this->getEm(), $this->getEm(self::AVP_CONFIG), $this->_entity);

        //$form->get('submit')->setValue('edit');
        
//        if($this->_entity->getIsDraft() != 1){
//            $this->addPageMessage('You cannot edit the reservation as payment is done', 'success');
//            $this->redirect()->toRoute('orders');
//        }

        if ($this->request->isPost()) {
            
            $form->setInputFilter($this->model->getInputFilter());
            $form->setData($this->request->getPost());
            $data = $this->request->getPost();
            //if ($form->isValid()) {
               $reservation =  $this->model->update($data,$this->_entity);
                
            //send email to traveller
            $id = $reservation->getId();
            $to = isset($data['travellerEmail']) ? $data['travellerEmail'] : '';
            $url = $this->url()->fromRoute('orders', array(), array('force_canonical' => true));
            $this->model->sendmail($id, $to, array('link' => $url, 'linkName' => 'Link to Reservations'));
             $this->addPageMessage('Order has been updated.', 'success');
                return $this->redirect()->toRoute('orders-cruise');
           // } else {
                $form->getMessages();
            //}
        }

        $collection = array('reservation' => $this->model->getItemViewDetail($this->_entity->getId()));
        
       // d($collection);
        switch ($this->_entity->getType()) {
            case 1:
               
                $typeCode = 4;
                $id = (int) $collection['reservation']['hotelId']->getId();
                $typeData = $this->getModel('OrdersAjaxModel')->getHotelsCollection();
                $roomsData = $this->getModel('OrdersAjaxModel')->getHotelRoomsCustomCollection(array('resortId' => (int) $collection['reservation']['hotelId']));
                $excursions = $this->getModel('OrdersAjaxModel')->getExcursions($typeCode, $id);
                $transfers = $this->getModel('OrdersAjaxModel')->getTransfers($typeCode, $id);
                $items = $this->getModel('OrdersAjaxModel')->getItems($typeCode, $id);
                break;
            case 2:
                $typeCode = 6;
                $id = (int) $collection['reservation']['hotelId']->getId();
                //echo $id;die;
                $typeData = $this->getModel('OrdersAjaxModel')->getEventsCollection();
                $roomsData = $this->getModel('OrdersAjaxModel')->getEventRoomsCollection(array('eventId' => (int) $collection['reservation']['hotelId']));
                $excursions = $this->getModel('OrdersAjaxModel')->getExcursions($typeCode, $id);
                $transfers = $this->getModel('OrdersAjaxModel')->getTransfers($typeCode, $id);
                $items = $this->getModel('OrdersAjaxModel')->getItems($typeCode, $id);
               // d($items);
                break;
            case 3:
                $typeCode = 7;
                $id = (int) $collection['reservation']['hotelId'];
                $typeData = $this->getModel('OrdersAjaxModel')->getCruisesCollection();
                $roomsData = $this->getModel('OrdersAjaxModel')->getCruiseCabinsCollection(array('cruiseId' => (int) $collection['reservation']['hotelId']));
                $excursions = $this->getModel('OrdersAjaxModel')->getExcursions($typeCode, $id);
                $transfers = $this->getModel('OrdersAjaxModel')->getTransfers($typeCode, $id);
                $items = $this->getModel('OrdersAjaxModel')->getItems($typeCode, $id);
                break;
        }
        //set values 
        $form->get('totalCost')->setAttribute('value', $this->_entity->getTotalCost());
        $form->get('travelFrom')->setAttribute('value', $this->_entity->getDateFrom()->format("Y-m-d"));
        $form->get('travelTo')->setAttribute('value', $this->_entity->getDateTo()->format("Y-m-d"));
        $form->get('noOfDays')->setAttribute('value', $this->_entity->getNoOfDays());
        $form->get('roomRate')->setAttribute('value', $this->_entity->getRoomRate());
        $form->get('roomRequired')->setAttribute('value', $this->_entity->getRoomRequired());
        $form->get('noOfPersons')->setAttribute('value', $this->_entity->getNoOfPersons());
        $form->get('finalCost')->setAttribute('value', $this->_entity->getFinalCost());
        $form->get('discount')->setAttribute('value', $this->_entity->getAppliDiscount());
        $form->get('merchantFee')->setAttribute('value', $this->_entity->getMerchantFee());
        $form->get('adminNotes')->setValue($this->_entity->getAdminNotes());
        $form->get('clientNotes')->setValue($this->_entity->getClientNotes());
        $form->get('depositAmount')->setAttribute('value', $this->_entity->getDepositAmoun());
        
        $view = $this->getView(array('form' => $form, 'data' => $this->_entity, 'typeData' => $typeData, 'collection' => $collection, 'roomsData' => $roomsData, 'addons' => array("items" => $items, "excursions" => $excursions, 'transfers' => $transfers)));

        return $view;
    }
    
        
      public function sendmailAction() {
        if (!$this->_id && !$this->request->isPost())
            throw new \Exception('Invalid Entity');
        $travellers = array('traveller' => $this->model->getTravellers($this->_entity->getId()));
        $to = $travellers['traveller'][0]->getTraveller()->getemail();
        $id = $this->_entity->getId();
        $this->model->sendmailonpending($id, $to);
        $this->addPageMessage('Mail sent to client.', 'success');
        return $this->redirect()->toRoute('orders-cruise');

    }

}
