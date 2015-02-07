<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Orders for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License 123
 */

namespace Orders\Controller;

use Zend\Mvc\MvcEvent;
use Sendmail\Controller\SendmailController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Zend\View\Model\JsonModel;
use Zend\CustomValidate;

class OrdersController extends \Base\Controller\BaseController {

    protected $_entity = false;

    public function onDispatch(MvcEvent $e) {
        
        $uri = $this->getRequest()->getUri();
        $scheme = $uri->getScheme();
        $host = $uri->getHost();
        $base = sprintf('%s://%s', $scheme, $host);
        $this->base = $base;

        $this->model = $this->getModel('Orders');

        if ($this->params()->fromRoute('id', 0)) {

            $this->_entity = $this->model->getItem($this->params()->fromRoute('id', 0));
        }

        $e->getViewModel()->setVariable('modulename', 'Orders');

        return parent::onDispatch($e); //smart
    }

    public function indexAction() {
//         $this->model->updateReservationStatus();
//         $this->model->updateExtraPaymentStatus();
//         $this->model->updateDepositDueAmounts();
        $data = array('collection' => $this->model->getCollection(), 'message' => $this->getPageMessages(),);
        if ($this->request->isPost()) {
            $startdate = $this->getRequest()->getPost('mydate');
            $enddate = $this->getRequest()->getPost('mydate1');
            $data = array('collection' => $this->model->getCollection($startdate, $enddate), 'message' => $this->getPageMessages(), 'startdat' => $startdate, 'enddat' => $enddate);
            //   return $this->getView($data);
        }

        return $this->getView($data);
    }

    public function addAction() {

        //d($this->getEm(self::AVP_CONFIG));
        $form = new \Orders\Form\AddOrdersForm($this->getEm(), $this->getEm(self::AVP_CONFIG), '\Base\Entity\Orders');

        //d($form);
        $dataUrl = $this->params()->fromRoute('dataUrl', null);
        $dataUrl = json_decode(urldecode($dataUrl));
        $data = $this->model->getReservationData($dataUrl);
        //d($dataUrl);
//d($data);
        if ($this->request->isPost()) {
            $data = $this->request->getPost();
            //d($data);

            $form->setInputFilter($this->model->getInputFilter());
            $form->setData($data);
            //if ($form->isValid()) {
            //d($data);
            $reservation = $this->model->save($data);
            // $newUser = $this->model->addUser($data);
            $this->setSessionData('Reservation', 'reservation', $reservation);

            if($reservation->getIsDraft() == 1){
                return $this->redirect()->toRoute('orders');
            }
            // 17 oct 
            if ($this->request->getPost("submit") == 'Finish') {
               // if($reservation->getDepositMethod() == 1){
                $amt=$this->request->getPost("depositAmount");
                $response = array("ACK" => array("ACK" => 'Success', "CURRENCYCODE" => 'USD', "TRANSACTIONID" => "", "AMT" => $amt),'message'=>"You have succesfully completed your reservation.");
                $this->setSessionData('PaymentResponse', 'paymentresponse', $response);

                if ($response['ACK']['ACK'] == 'Success'):
                    $data = $this->getModel('orders');
                 $reservation = new Container('Reservation');
                    $data->updatePaymentStatus($reservation, $response, 3);
                endif;
                return $this->redirect()->toRoute("thank-you");
            }

            
            return $this->redirect()->toRoute('payment-process');

            $form->getMessages();
        }
        $view = $this->getView(array('form' => $form, "data" => $data, "dataSearch" => $dataUrl));
        return $view;
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
        $this->model->updateExtraPaymentStatus($this->_entity->getId());
        $this->model->updateDepositDueAmounts($this->_entity->getId());
        if ($this->request->isPost()) {
           // d($this->request->getPost());
            $form->setInputFilter($this->model->getInputFilter());
            $form->setData($this->request->getPost());
            $data = $this->request->getPost();
            //if ($form->isValid()) {
            $reservation = $this->model->update($data, $this->_entity);
            $this->setSessionData('Reservation', 'reservation', $reservation);//added on 13-08-2014
//            if($reservation->getIsDraft() == 1){
//                return $this->redirect()->toRoute('payment-process');
//            }
            
            // 17 oct 
            if ($reservation->getDepositMethod() == 1 || $this->request->getPost("submit") == 'Finish') {
                //d($reservation);
                $response = array("ACK" => array("ACK" => 'Success', "CURRENCYCODE" => 'USD', "TRANSACTIONID" => "", "AMT" => $this->request->getPost("depositAmount")),'message'=>"You have succesfully updated your reservation.");
                $this->setSessionData('PaymentResponse', 'paymentresponse', $response);

                if ($response['ACK']['ACK'] == 'Success'):
                    $datas = $this->getModel('orders');
                 $reservations = new Container('Reservation');
                    $datas->updatePaymentStatus($reservations, $response, 3);
                endif;
               // return $this->redirect()->toRoute("thank-you");
                //return $this->redirect()->toRoute('orders');
                
                
            }
            if ($reservation->getDepositMethod() == 0 && $this->request->getPost("depositAmount") > 0) {
                return $this->redirect()->toRoute('payment-process');
            }
            
            /*else{
                return $this->redirect()->toRoute('payment-process');
            }*/
                 //send email to traveller
                $id = $reservation->getId();
                $to = isset($data['travellerEmail']) ? $data['travellerEmail'] : '';
                $url = $this->url()->fromRoute('orders', array(), array('force_canonical' => true));
                if($this->request->getPost("submit1")=="Update and Send" || $this->request->getPost("submit1")=="Finish and Send"){
                    $this->model->sendmail($id, $to, array('link' => $url, 'linkName' => 'Link to Reservations'));
                }
                $this->addPageMessage('Order has been updated.', 'success');
                return $this->redirect()->toRoute('orders');
           
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
//        if($this->_entity->getIsBooked() == 1){
//            $form->get('depositAmount')->setAttribute('value', $this->_entity->getFinalCost() - $this->_entity->getDepositAmoun());
//        }else{
//            $form->get('depositAmount')->setAttribute('value', $this->_entity->getDepositAmoun());
//        }
         $form->get('depositAmount')->setAttribute('value', 0);
        if($this->_entity->getPaymenttype() == 0){
             $form->get('balansAfterDeposit')->setAttribute('value', $this->_entity->getBalansAfterDeposit());
        }
        
         if($this->_entity->getIsBooked() == 0){
             $form->get('balansAfterDeposit')->setAttribute('value', $this->_entity->getFinalCost());
        }
     
        $view = $this->getView(array('form' => $form, 'data' => $this->_entity, 'typeData' => $typeData, 'collection' => $collection, 'roomsData' => $roomsData, 'addons' => array("items" => $items, "excursions" => $excursions, 'transfers' => $transfers)));

        return $view;
    }

    public function deleteAction() {

        if (!$this->_id && !$this->request->isPost())
            throw new \Exception('Invalid Entity');

        $ids = $this->request->getPost("cc");

        if(is_null($ids)){
            $this->model->delete($this->_id);
        }else{
            foreach($ids as $key=>$value){
                $this->model->delete($value);
            }
        }
        //return $this->redirect()->toRoute('orders');
        $url = $this->getRequest()->getHeader('Referer')->getUri();
        $this->addPageMessage('Orders Deleted', 'success');
        $this->redirect()->toUrl($url);
    }

    public function viewAction() {

        if (!$this->_entity)
            throw new \Exception('Invalid Entity');


        $data = array('reservation' => $this->model->getItemView($this->_entity->getId()));

        return $this->getView($data);
    }

    public function cancelAction() {

        //die;

        if (!$this->_id && !$this->request->isPost())
            throw new \Exception('Invalid Entity');
        $this->model->cancelResortReservation($this->_id);
        if ($this->_entity->getstatus() == 0) {

            $this->addPageMessage('Order has been cancelled.', 'success');
        }
        return $this->redirect()->toRoute('orders');
    }
    
    public function reinstateAction() {

        //die;

        if (!$this->_id && !$this->request->isPost())
            throw new \Exception('Invalid Entity');
        $this->model->reinstateCancelledReservation($this->_id);
        if ($this->_entity->getstatus() != 0) {
            $this->addPageMessage('Order has been reinstated.', 'success');
        }
        return $this->redirect()->toRoute('orders');
    }

    public function eventsAction() {



        /* return $this->getView (array (
          'collection' => $this->model->getCollection(),
          'message'=>$this->getPageMessages(),

          ) );
         */
        $data = array('collection' => $this->model->getCollection(),);

        return $this->getView($data);
    }

    public function creditPaymentAction() {
        $reservation = new Container('Reservation');
        $data = $reservation->reservation;

        if ($data):
//            d($this->getRequest()->getPost());
            $amount = $data->getDepositAmoun();
            if($data->getIsUpdated()==1){
                $amount = $data->getExtraDepAmt();
            }
            //$totalAmount = $data->getDepositAmoun()+$data->getMerchantFee();
            //echo $totalAmount;die;
            $referenceNumber = $data->getReferenceNumber();
            //$this->base="http://192.155.246.146:9122";
            $returnUrl = $this->base."/admin/reservation/payment-response";
            $currency = 'USD';
            $cancelUrl = $this->base."/admin/reservation/payment-response";
            $type = $this->getRequest()->getPost('payment-type');
//            d($type);
            $data = array();
            switch ($type) {
                case 1:
//                    d('here-express');
//                    echo $amount." ".$currency." ".$returnUrl." ".$cancelUrl." ".$referenceNumber; die;
                    $response = \Base\Model\Plugins\Paypal::PPSetExpressCheckout($amount, $currency, $returnUrl, $cancelUrl, $referenceNumber);
                    break;
                case 2:
                    $billingDetailOption = $this->request->getPost("billing_det");
                    $data['name'] = ($this->request->getPost("billName")) ? $this->request->getPost("billName") : null;
                    $data['travellerCity'] = ($this->request->getPost("billCity")) ? $this->request->getPost("billCity") : null;
                    $data['travellerState'] = ($this->request->getPost("billState")) ? $this->request->getPost("billState") : null;
                    $data['travellerZip'] = null;
                    $data['country'] = ($this->request->getPost("billCountry")) ? $this->request->getPost("billCountry") : null;
                    $data['typeOfCard'] = $this->request->getPost("typeOfCard");
                    $data['cardNumber'] = $this->request->getPost("cardNumber");
                    $data['cardMonth'] = $this->request->getPost("cardMonth");
                    $data['cardYear'] = $this->request->getPost("cardYear");
                    $data['cvvNumber'] = $this->request->getPost("cvvNumber");
                    $data['depositAmount'] = $amount;

                    $response = \Base\Model\Plugins\Paypal::PPDoDirectPayment($data);
                    $this->setSessionData('PaymentResponse', 'paymentresponse', $response);

                    if ($response['ACK']['ACK'] == 'Success'):
                        $data = $this->getModel('orders');
                        $data->updatePaymentStatus($reservation, $response, $type);
                    endif;


                    return $this->redirect()->toRoute("thank-you");
                    break;
            }
        else:
            return $this->redirect()->toRoute("orders");
        endif;
    }

    public function getPaymentResponseAction() {

        $request = $_REQUEST;
        $reservation = new Container('Reservation');

        if ($_REQUEST['token'] && $reservation->reservation) {
            $response = \Base\Model\Plugins\Paypal::PPGetExpressCheckoutDetails($request);
            $this->setSessionData('PaymentResponse', 'paymentresponse', $response);
            if ($response['ACK']['PAYMENTSTATUS'] == 'Completed'):
                $data = $this->getModel('orders');
                $data->updatePaymentStatus($reservation, $response);
            endif;
            $view = $this->getView(array("response" => $response));
            return $this->redirect()->toRoute("thank-you");
        }else {
            return new JsonModel(array("Restricted" => "You do not access this page."));
        }
        return $view;
    }

    public function paymentProcessAction() {
        $reservation = new Container('Reservation');
        //$reservation = $this->getSessionData('Reservation');
        if ($reservation->reservation) {
            $form = new \Orders\Form\AddOrdersForm($this->getEm(), $this->getEm(self::AVP_CONFIG), '\Base\Entity\Orders');
            $model = $this->getModel('orders');
            $view = $this->getView(array('form' => $form, 'reservation' => $reservation->reservation,'countries'=>$model->getCountries()));
        } else {
            return new JsonModel(array("Restricted" => "You do not access this page."));
        }

        return $view;
    }

    public function thankYouAction() {
        $reservation = new Container('Reservation');
        $reservationObject = new Container('ReservationObject');
        $data = $reservationObject->reservationobject;

        if ($reservation->reservation):

            //send email to traveller
            $id = $reservation->reservation->getId();
            $to = isset($data['travellerEmail']) ? $data['travellerEmail'] : '';

            $url = $this->url()->fromRoute('orders', array(), array('force_canonical' => true));
            
            $paymentResponse = new Container('PaymentResponse');
            //d($paymentResponse->paymentresponse);
            if ($paymentResponse->paymentresponse['ACK']['PAYMENTSTATUS'] == 'Completed' || $paymentResponse->paymentresponse['ACK']['ACK'] == 'Success'){
                $this->model->sendmail($id, $to, array('link' => $url, 'linkName' => 'Link to Reservations'));
            }

            $view = $this->getView(array('data' => $paymentResponse->paymentresponse));

            $session = $this->getSessionData('Reservation');
            $session->getManager()->getStorage()->clear('Reservation');

            $session = $this->getSessionData('Room');
            $session->getManager()->getStorage()->clear('Room');

            $session = $this->getSessionData('ReservationObject');
            $session->getManager()->getStorage()->clear('ReservationObject');

            $session = $this->getSessionData('PaymentResponse');
            $session->getManager()->getStorage()->clear('PaymentResponse');

            return $view;
        else:
            return $this->redirect()->toRoute("orders");
        endif;
    }

    public function sendmailAction() {
        if (!$this->_id && !$this->request->isPost())
            throw new \Exception('Invalid Entity');

        $travellers = array('traveller' => $this->model->getTravellers($this->_entity->getId()));
        $to = $travellers['traveller'][0]->getTraveller()->getemail();

        $id = $this->_entity->getId();
  
//d($to);
        $this->model->sendmail($id, $to, array('link' => $url, 'linkName' => 'Link to Reservations'));
        $this->addPageMessage('Mail sent to client.', 'success');

        return $this->redirect()->toRoute('orders');

        /* $id = $this->_entity->getId();
          $to = 'rm@mailinator.com';
          $url = $this->url()->fromRoute('orders', array(), array('force_canonical' => true));
          $this->model->sendmail($id, $to, array('link' => $url, 'linkName' => 'Link to Reservations'));

          return $this->redirect()->toRoute('orders');
         */
    }

    public function reservationRoomsAction() {
        $error = 0;
        if ($this->request->isPost() && $this->request->isXmlHttpRequest()) {
            $data = $this->request->getPost();
            
           /* validations */ 
            $from  = $data['from'];
            $to  = $data['to'];
            $numMales  = $data['numMales'];
            $numFemales  = $data['numFemales'];
            $singleShare = $data['singleShare'];
            if(($numMales + $numFemales) == 1):
                if($from == "" || $to== "" || $numFemales == "" || $numFemales=="" && $singleShare == 1):
                    $error = 1;
                endif;
                else:
                    if($from == "" || $to== "" || $numFemales == "" || $numFemales==""):
                        $error = 1;
                endif; 
            endif;
                
                
            $collection = $this->model->getReservationRooms($data);
            //return new JsonModel(array('data'=>$collection[0]));
        }

        $view = $this->getView(array("response" => $response,'error'=>$error));
        return $view;
    }
    
    
     public function addTravellerAction(){
        $this->layout('layout/ajax');
        $post = $this->params()->fromRoute('c');
        $form = new \Orders\Form\AddOrdersForm($this->getEm(), $this->getEm(self::AVP_CONFIG), '\Base\Entity\Orders');
        $view = $this->getView(array('form' => $form, "travellerCount" => $post));
        return $view;
    }
    
     public function addPaymentAction(){
        $this->layout('layout/ajax');
        $post = $this->request->getPost();
//        d('here');
//        echo "here";
        $this->model = $this->getModel('Orders');
        $paymentData  = $this->model->createDepositDues($post);
//        d($paymentData);
        $form = new \Orders\Form\AddOrdersForm($this->getEm(), $this->getEm(self::AVP_CONFIG), '\Base\Entity\Orders');
        $view = $this->getView(array('form' => $form, "post"=>$post,"paymentData"=>$paymentData));
        return $view;
    }
    
     public function addDuesAction(){
        $this->layout('layout/ajax');
        $post = $this->params()->fromRoute('d');
        $form = new \Orders\Form\AddOrdersForm($this->getEm(), $this->getEm(self::AVP_CONFIG), '\Base\Entity\Orders');
        $view = $this->getView(array('form' => $form, "duesCount" => $post));
        return $view;
    }


   

}
