<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Orders for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License 123
 */

namespace Front\Controller;

use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Zend\Session\Container;
use Sendmail\Controller\SendmailController;

class FrontController extends AbstractActionController {

    const AVP_CONFIG = 1;
    const RM_config = 0;

    public function indexAction() {

        //return new ViewModel();   
        echo "hello in controller";
        die;
        // return new ViewModel();
    }

    public function reservationAction() {
//d('down here');
        $this->model = $this->getModel('Front');
	
        $dataUrl = $this->params()->fromRoute('dataUrl', null);
       // $sendurl=urlencode($dataUrl);
        //d(urlencode($dataUrl));
        $dataUrl = json_decode(urldecode($dataUrl));
        if($dataUrl->affiliateId){
            $affiliateId=$dataUrl->affiliateId;
        }else{
            $affiliateId='';
        }
        if ($this->request->isPost()) {
//            d($this->request->getPost());
            // d( $this->getRequest()->getPost('payment-type'));
            // d($this->request->getPost());
            //$reservation = $this->model->save($this->request->getPost(),$affiliateId);
            $step = $this->request->getPost('step');

            if(isset($_POST['billProcess'])== 'Submit'){
                 $reservation = $this->model->save($this->request->getPost(),$affiliateId);
                 //d($reservation);
            }else{
            switch ((int)$step) {
                case 1:
                    $reservation = $this->model->_saveStep1($this->request->getPost(),$affiliateId);
                    return new JsonModel(array("id"=>$reservation->getId()));
                    break;
                case 2:
                    $reservation = $this->model->_saveStep2($this->request->getPost(),$affiliateId);
                    return new JsonModel(array("id"=>$reservation->getId()));
                    break;
                case 3:
                    $reservation = $this->model->_saveStep3($this->request->getPost(),$affiliateId);
                    return new JsonModel(array("id"=>$reservation->getId()));
                    break;
            }
            }
            
            
            
            if($affiliateId!=''){
                $resellerData = $this->model->getResellerData($affiliateId);
            }
            if($reservation){
            $data = $reservation;
            $amount = $data->getDepositAmoun();
            $amount=number_format((float)$amount, 2, '.', '');
            $referenceNumber = $data->getReferenceNumber();

          //  d('here');
            //   $reservation = new Container('Reservation');
            //d($reservation);
            $this->setSessionData('Reservation', 'reservation', $reservation);
            if($affiliateId!=''){
                $this->setSessionData('AffiliateId', 'affiliateId', $affiliateId);
                $this->setSessionData('ResellerData', 'reseller', $resellerData);
                $this->setSessionData('Post', 'post', $this->request->getPost());
            }

            //d($amount);
            $returnUrl = "http://".$_SERVER['HTTP_HOST']."/reservation/reservation-response";
            //$currency = 'USD';
            $currency = $this->request->getPost('currencytype')?$this->request->getPost('currencytype'):'USD';
            $cancelUrl = "http://".$_SERVER['HTTP_HOST']."/reservation/reservation-response";

            //d($data);
            $type = (int) $this->getRequest()->getPost('payment-type');

            //$type = 2;
//            d($type);
            
            switch ($type) {
                case 1:
//                   d($amount);
                    
                    $response = \Base\Model\Plugins\Paypal::PPSetExpressCheckout($amount, $currency, $returnUrl, $cancelUrl, $referenceNumber);
                     //d($response);
                    break;
                case 2:
                    $response = \Base\Model\Plugins\Paypals::PPDoDirectPayment($this->request->getPost(),$isReservation = 1);
                    //d($data);
                    $this->setSessionData('PaymentResponse', 'paymentresponse', $response);
                    if ($response['ACK']['ACK'] == 'Success'):
                        $this->model->updatePaymentDoDirectStatus($data,$response,$type);
                    endif;
                    return $this->redirect()->toRoute("thank-you-page");
                    break;
            }
        }
        }
        $form = new \Front\Form\AddOrdersForm($this->getEm(), $this->getEm(self::AVP_CONFIG), '\Base\Entity\Orders');

        
        $collection = $this->model->getReservation($dataUrl);

        $data = array('collection' => $collection, 'form' => $form,"dataSearch"=>$dataUrl,"posturl"=>$sendurl,"terms"=>$this->model->getTerms());

        // d($collection);

        return new ViewModel($data);
    }

    public function editAction() {
        
    }

    public function deleteAction() {
        
    }

    protected function getModel($model) {
        return $this->getServiceLocator()->get($model);
    }

    public function getPaymentResponseAction() {

        $request = $_REQUEST;
        $reservation = new Container('Reservation');
        if ($_REQUEST['token'] && $reservation->reservation) {
            $response = \Base\Model\Plugins\Paypal::PPGetExpressCheckoutDetails($request);
            $this->setSessionData('PaymentResponse', 'paymentresponse', $response);

            if ($response['ACK']['PAYMENTSTATUS'] == 'Completed'):
                $data = $this->getModel('Front');
                $data->updatePaymentStatus($reservation, $response);
            endif;
         //   $view = $this->getView(array("response" => $response));
          //  d('here');
            return $this->redirect()->toRoute("thank-you-page");
        }else {
            return new JsonModel(array("Restricted" => "You do not access this page."));
        }
        return $view;
        //$view = $this->getView(array("response" => $response));
        //return $view;
    }

    public function thankYouAction() {
       // echo"sdfsd";die;
        $reservation = new Container('Reservation');
        $reservationObject = new Container('ReservationObject');
        $affiliateId = new Container('AffiliateId');
        $aId = $affiliateId->affiliateId;
        $reseller = new Container('ResellerData');
        $resellerData = $reseller->reseller;
        $data = $reservationObject->reservationobject;
        //d($reservation->reservation);
        if ($reservation->reservation):
                $paymentResponse = new Container('PaymentResponse');
            $response = $paymentResponse->paymentresponse;
            //send email to traveller
            $id = $reservation->reservation->getId();
        
             $to = isset($data['travellerEmail']) ? $data['travellerEmail'] : '';
             $url = $this->url()->fromRoute('orders', array(), array('force_canonical' => true));
             
              if ($response['ACK']['ACK'] == 'Success'):
                $this->getModel('Front')->sendmail($id, $to, array('link' => $url, 'linkName' => 'Link to Reservations'));
                
                if($aId!=''){
                   $post = new Container('Post');
                   $object = $post->post; 
                   $object['Reservation']=$id;
                   $this->getModel('Front')->_calculateAffiliateCommission($object,$aId);
                }
              endif;
            
            //echo "Affiliate Id :" .$aId;
            //d($resellerData);
          //  d($paymentResponse->paymentresponse);
              
            //get details of Affiliate
               if($aId!=''){
                $resellerData = $this->getModel('Front')->getResellerData($aId);
            }
              
            $view = $this->getView(array('data' => $paymentResponse->paymentresponse,'email'=>$data['travellerEmail'],'affiliateId'=>$aId,'resellerData'=>$resellerData));

            $session = $this->getSessionData('Reservation');
            $session->getManager()->getStorage()->clear('Reservation');

            $session = $this->getSessionData('Room');
            $session->getManager()->getStorage()->clear('Room');

            $session = $this->getSessionData('ReservationObject');
            $session->getManager()->getStorage()->clear('ReservationObject');

            $session = $this->getSessionData('PaymentResponse');
            $session->getManager()->getStorage()->clear('PaymentResponse');
            
            $session = $this->getSessionData('AffiliateId');
            $session->getManager()->getStorage()->clear('AffiliateId');
            
            $session = $this->getSessionData('ResellerData');
            $session->getManager()->getStorage()->clear('ResellerData');
            
            $session = $this->getSessionData('Post');
            $session->getManager()->getStorage()->clear('Post');            
//d('Thank you');
            
            return $view;
        else:
            //return $this->redirect()->toRoute("reservation");
        endif;
    }
    
    protected function getView(array $data) {

        return new ViewModel($data);
    }

    public function paymentAction() {
        
        
        $id = $this->params()->fromRoute('id', 0);
        $date = $this->params()->fromRoute('date', 0);
        
        $datedec=base64_decode(strtr($date, '-_,', '+/='));
        $dateexp=date('Y-m-d H:i:s',strtotime("+1 day", strtotime($datedec)));
        /*if($dateexp<date('Y-m-d H:i:s')){
            $view = new ViewModel(array(
                'msg' => "Link Expired Please Contact Administrator..",
            ));
            $view->setTemplate('front/front/get-express-payment-response.phtml');
            return $view;
        }*/
        
        $this->model = $this->getModel('Front');
        $form = new \Front\Form\PaymentsForm($this->getEm(), $this->getEm(self::AVP_CONFIG), '\Base\Entity\Orders');
//        d($id);
        $data = array('collection' => $this->model->getPaymentdues($id));
//        d($data);
        if ($this->request->isPost()) {
//            d( $this->request->getPost());
            $allvalue = $data;
            $reservation = $data['collection'][0]->getReservation();
            $coll = $this->model->_getTravellersDetail($reservation->getId());
             foreach ($coll as  $traveller) {
                $travellers[] = $traveller->getTraveller()->getEmail();
            }

            // d($allvalue['collection'][0]->getpaymentDue());

            $this->setSessionData('Reservations', 'reservations', $allvalue['collection'][0]->getpaymentDue());

            // $this->setSessionData('Reservation', 'reservation', $reservation);

            $data = array();
            $type = $this->getRequest()->getPost('ptype');
            
            switch ($type) {
                case 1:
                    //d('here in xpres');
                    $returnUrl = "http://".$_SERVER['HTTP_HOST']."/express-response";
                    $currency = 'USD';
                    $cancelUrl = "http://".$_SERVER['HTTP_HOST']."/express-response";

                    //  $reservation12 =$this->model->getReservationByIdCollection($id);
                    //  d($reservation12);
                    $this->setSessionData('Reservations', 'reservation', $this->getRequest()->getPost('amount'));
                    $this->setSessionData('PaymentDue', 'payment', $allvalue['collection'][0]->getId());
                    $this->setSessionData('Reservation', 'reservation', $id);

//                    $amount = $allvalue['collection'][0]->getpaymentDue();
                    $amount=$this->getRequest()->getPost('amount');
//                    $amount=($amount)+($amount*0.025);
//                    $amount=round($amount,2);
                    
                    $referenceNumber = $reservation->getReferenceNumber();



                    $response = \Base\Model\Plugins\Paypals::PPSetExpressCheckout($amount, $currency, $returnUrl, $cancelUrl, $referenceNumber);

                    //  d('success');
                    break;
                case 2:

//                      d( $this->request->getPost());    
                    $billingDetailOption = $this->request->getPost("billing_det");

                    $data4 = $this->getModel('Front');
                    $country = $data4->getCountry($this->request->getPost("billCountry"));
                    //  d($country);
                    if (!empty($country)) {
                        $data['country'] = $country;
                    } else {
                        $data['country'] = null;
                    }

                    // d($country);

                    $data['travellerName'] = ($this->request->getPost("billName")) ? $this->request->getPost("billName") : null;
                    $data['travellerCity'] = ($this->request->getPost("billCity")) ? $this->request->getPost("billCity") : null;
                    $data['travellerState'] = ($this->request->getPost("billState")) ? $this->request->getPost("billState") : null;
                    $data['travellerZip'] = null;
                        $data['country'] =  'US';
                     $data['depositAmount'] = $this->request->getPost("totalCost");
                    $data['typeOfCard'] = $this->request->getPost("typeOfCard");
                    $data['cardNumber'] = $this->request->getPost("cardNumber");
                    $data['cardMonth'] = $this->request->getPost("cardMonth");
                    $data['cardYear'] = $this->request->getPost("cardYear");
                    $data['cvvNumber'] = $this->request->getPost("cvvNumber");

//                    d($data);

                    $response = \Base\Model\Plugins\Paypals::PPDoDirectPayment($data);
                    //  $response=21;
                    // $data = $this->getModel('Front');
                    //$data->updateDuePaymentStatus($reservation, $response, $allvalue);

//                    d($response);
                    if ($response['ACK']['ACK'] == 'Success'){
                        $data = $this->getModel('Front');
                        $data->updateDuePaymentStatus($reservation, $response, $allvalue);
                        $this->model->sendmail($reservation->getId(), $travellers[0], array('link' => $url, 'linkName' => 'Link to Reservations'));
                        $view = new ViewModel(array(
                            'msg' => 'Thank You.. Your Due Payment Received Successfully',
                        ));
                        $view->setTemplate('front/front/get-express-payment-response.phtml');
                        return $view; 
                    }else{
                        $view = new ViewModel(array(
                            'msg' => "We'er Sorry. Payment Could not be received.",
                        ));
                        $view->setTemplate('front/front/get-express-payment-response.phtml');
                        return $view; 
                    }
                    
//                    d($response);
                     
                    break;
            }
        }
        //d($data);
        
        $data1 = $this->getModel('Front');
        $traveller=$data1->getTravellerData($id);
        $orderfor=$data1->getOrderFor($id);
        $data = array('form' => $form, 'collection' => $data, 'id' => $id,'traveller'=>$traveller,'orderfor'=>$orderfor,'date'=>$date);

//        return new ViewModel($data);
        
        $viewModel = new ViewModel($data);
        $viewModel->setTerminal(true); // Disable layout.
        
        return $viewModel;
    }

    public function getExpressPaymentResponseAction() {

        $request = $_REQUEST;
        $response = \Base\Model\Plugins\Paypals::PPGetExpressCheckoutDetails($request);
        $data = $this->getModel('Front');
        
        $reservation = new Container('Reservation');
//        d($reservation->reservation);
        
        $paymentdue = new Container('PaymentDue');
        if ($response['ACK']['ACK'] == 'Success'){
            $data = $this->getModel('Front');
        
            $data->updatePaymentStatusForExpress($reservation->reservation, $response, $paymentdue);
            
            $coll = $data->_getTravellersDetail($reservation->reservation);
             foreach ($coll as  $traveller) {
                $travellers[] = $traveller->getTraveller()->getEmail();
            }
            $data->sendmail($reservation->reservation, $travellers[0], array('link' => $url, 'linkName' => 'Link to Reservations'));
       // if($data){
            $msg="Thank You.. Your Due Payment Received Successfully";
        }else{
            $msg="We'er Sorry. Payment Could not be received. ";
        }

//        if ($response['ACK']['PAYMENTSTATUS'] == 'Completed'):
//            $data = $this->getModel('Front');
//            $data->updatePaymentStatusForExpress($reservation, $response, $paymentdue);
//        endif;
//        d($response);

        $view = $this->getView(array("msg" => $msg));
        return $view;
    }

    protected function getEm($name = 0) {

        $doctrine = 'doctrine.entitymanager.orm_default';

        switch ($name) {
            case self::AVP_CONFIG:
                $doctrine = 'doctrine.entitymanager.orm_avp';
                break;
            default :
                $doctrine = 'doctrine.entitymanager.orm_default';
                break;
        }

        return $this->getServiceLocator()->get($doctrine);
    }

//    public function sendReminderAction() {
//    
//        $this->model = $this->getModel('Front');
//        $data = array('collection' => $this->model->getPaymentduesnew());
//      //  d($data);
//        $datebefore7days = date('Y-m-d', strtotime('7 days'));
//        $datetoday = date('Y-m-d');
//        $dateafter10days = date('Y-m-d', strtotime('-10 days'));
//        $dateafter7days = date('Y-m-d', strtotime('-7 days'));
//        $item = $data['collection'];
//
//        foreach ($data['collection'] as $item) {
//            echo "<pre>";
//            // print_r($item['paymentDues']->getReservation()->getId());
//
//            echo "<pre>";
//            $duedate = ($item['paymentDues']->getDueDate() instanceof \DateTime) ? $item['paymentDues']->getDueDate()->format('Y-m-d') : $item['paymentDues']->getDueDate();
//
//            if ($datebefore7days == $duedate) {
//
//                echo $duedate . '7 days before reminder';
//                
//               // d('here');
//                $id = $item['paymentDues']->getReservation()->getId();
//                $travellerss = array('traveller' => $this->model->getTravellers($item['paymentDues']->getReservation()->getId()));
//
//           //     print_r($travellerss['traveller'][0]->getTraveller()->getemail());
//           //     print_r($item['paymentDues']->getReservation()->getId());
//                $url = $this->url()->fromRoute('paymentdue', array('id' => $id), array('force_canonical' => true));
//                
//                $to = $travellerss['traveller'][0]->getTraveller()->getemail();
//                echo $to;
//                $this->model->sendmailreminder($to,$id, array('link' => $url, 'linkName' => 'Link to payment'));
//                
//                
//                
//                //$url = $this->url()->fromRoute('payments', array(), array('force_canonical' => true));
//                //$this->model->sendmail($id, $to, array('link' => $url, 'linkName' => 'Link to Reservations'));
//            }  if ($datetoday == $duedate) {
//
//                //echo $duedate . 'today payment due';
//                $id = $item['paymentDues']->getReservation()->getId();
//                $travellerss = array('traveller' => $this->model->getTravellers($item['paymentDues']->getReservation()->getId()));
//                //   print_r($travellerss['traveller'][0]->getTraveller()->getemail());
//                $to = $travellerss['traveller'][0]->getTraveller()->getemail();
//                $url = $this->url()->fromRoute('paymentdue', array('id' => $id), array('force_canonical' => true));
//                $this->model->sendmailreminder($to,$id,array('link' => $url, 'linkName' => 'Link to payment'));
//            }  if ($dateafter7days == $duedate) {
//
//                echo $duedate . '<br>7 days after due date';
//                $id = $item['paymentDues']->getReservation()->getId();
//                $travellerss = array('traveller' => $this->model->getTravellers($item['paymentDues']->getReservation()->getId()));
//                //   print_r($travellerss['traveller'][0]->getTraveller()->getemail());
//                $to = $travellerss['traveller'][0]->getTraveller()->getemail();
//                $url = $this->url()->fromRoute('paymentdue', array('id' => $id), array('force_canonical' => true));
//                $this->model->sendmailreminder($to,$id,array('link' => $url, 'linkName' => 'Link to payment'));
//            } if ($dateafter10days == $duedate) {
//
//                echo $duedate . 'past date and reserrvation is canceled';
//                $travellerss = array('traveller' => $this->model->getTravellers($item['paymentDues']->getReservation()->getId()));
//
//                //foreach($travellerss['traveller'] as $travelprson){
//
//                $this->model->sendmailnew($travellerss['traveller'][0]->getTraveller()->getemail(), 'Payment Cancelation', 'Your Recervation has been canceled', $cc = NULL);
//
//                //  print_r($travellerss['traveller'][0]->getTraveller()->getemail());
//                //echo $travelprson->getName();
//                //}
//                //    print_r($travellerss);
//                $this->model->cancelReservations($item['paymentDues']->getReservation()->getId());
//                //       print_r($item['paymentDues']->getReservation()->getId());
//            }
//        }
//        d($dateafter10days);
//
//        return false;
//        // return $this->getView($data);
//    }
    
    public function sendReminderAction() {
    
        $this->model = $this->getModel('Front');
        $data = array('collection' => $this->model->getPaymentduesnew());
      //  d($data);
        $datebefore7days = date('Y-m-d', strtotime('7 days'));
        $datetoday = date('Y-m-d');
        $dateafter10days = date('Y-m-d', strtotime('-10 days'));
        $dateafter7days = date('Y-m-d', strtotime('-7 days'));
        $item = $data['collection'];

        foreach ($data['collection'] as $item) {
            echo "<pre>";
            // print_r($item['paymentDues']->getReservation()->getId());

            echo "<pre>";
            $duedate = ($item['paymentDues']->getDueDate() instanceof \DateTime) ? $item['paymentDues']->getDueDate()->format('Y-m-d') : $item['paymentDues']->getDueDate();

            if ($datebefore7days == $duedate) {

                echo $duedate . '7 days before reminder';
                
               // d('here');
                $id = $item['paymentDues']->getReservation()->getId();
                $travellerss = array('traveller' => $this->model->getTravellers($item['paymentDues']->getReservation()->getId()));

                print_r($travellerss['traveller'][0]->getTraveller()->getemail());
           //     print_r($item['paymentDues']->getReservation()->getId());
                $url = $this->url()->fromRoute('paymentdue', array('id' => $id), array('force_canonical' => true));
                
                $to = $travellerss['traveller'][0]->getTraveller()->getemail();
                echo $to;
                $this->model->sendmailreminder($to,$id, array('link' => $url, 'linkName' => 'Link to payment'));
                
                
                
                //$url = $this->url()->fromRoute('payments', array(), array('force_canonical' => true));
                //$this->model->sendmail($id, $to, array('link' => $url, 'linkName' => 'Link to Reservations'));
            }  if ($datetoday == $duedate) {

                //echo $duedate . 'today payment due';
                $id = $item['paymentDues']->getReservation()->getId();
                $travellerss = array('traveller' => $this->model->getTravellers($item['paymentDues']->getReservation()->getId()));
                   print_r($travellerss['traveller'][0]->getTraveller()->getemail());
                $to = $travellerss['traveller'][0]->getTraveller()->getemail();
                $url = $this->url()->fromRoute('paymentdue', array('id' => $id), array('force_canonical' => true));
                $this->model->sendmailreminder($to,$id,array('link' => $url, 'linkName' => 'Link to payment'));
            }  if ($dateafter7days == $duedate) {

                echo $duedate . '<br>7 days after due date';
                $id = $item['paymentDues']->getReservation()->getId();
                $travellerss = array('traveller' => $this->model->getTravellers($item['paymentDues']->getReservation()->getId()));
                   print_r($travellerss['traveller'][0]->getTraveller()->getemail());
                $to = $travellerss['traveller'][0]->getTraveller()->getemail();
                $url = $this->url()->fromRoute('paymentdue', array('id' => $id), array('force_canonical' => true));
                $this->model->sendmailreminder($to,$id,array('link' => $url, 'linkName' => 'Link to payment'));
            } if ($dateafter10days == $duedate) {

                echo $duedate . 'past date and reserrvation is canceled';
                $travellerss = array('traveller' => $this->model->getTravellers($item['paymentDues']->getReservation()->getId()));

                //foreach($travellerss['traveller'] as $travelprson){

                $this->model->sendmailnew($travellerss['traveller'][0]->getTraveller()->getemail(), 'Payment Cancelation', 'Your Recervation has been canceled', $cc = NULL);

                  print_r($travellerss['traveller'][0]->getTraveller()->getemail());
                //echo $travelprson->getName();
                //}
                //    print_r($travellerss);
                $this->model->cancelReservations($item['paymentDues']->getReservation()->getId());
                //       print_r($item['paymentDues']->getReservation()->getId());
            }
        }
       // print_r($datebefore7days);
       // print_r($dateafter7days);
        d($datetoday);

        return false;
        // return $this->getView($data);
    }

    protected function setSessionData($namespace, $name, $value) {

        $session = new Container($namespace);

        $session->$name = $value;
    }

    protected function getSessionData($namespace, $name = null) {

        $session = new Container($namespace);

        if (!is_null($name))
            return $session->$name;

        return $session;
    }
    
    public function quoteReservationAction(){
        $this->model = $this->getModel('Front');
        $leadId=$this->params()->fromRoute('id');
        $inventoryId=$this->params()->fromRoute('inventoryid');
        $date = $this->params()->fromRoute('date', 0);
        
        $datedec=base64_decode(strtr($date, '-_,', '+/='));
        $dateexp=date('Y-m-d H:i:s',strtotime("+1 day", strtotime($datedec)));
        if($dateexp<date('Y-m-d H:i:s')){
            $view = new ViewModel(array(
                'msg' => "Link Expired Please Contact Administrator..",
            ));
            $view->setTemplate('front/front/get-express-payment-response.phtml');
            return $view;
        }
        
        $lead = $this->model->getLeads($leadId);
        $inventorylead = $this->model->getInventoryLead($inventoryId);
//        d($inventorylead);
        if(!empty($inventorylead)){
        $inventoryrooms = $this->model->getInventoryRooms($inventoryId);
        $inventoryaddons = $this->model->getInventoryAddons($inventoryId);
//        d($inventoryaddons);
        
        if ($this->request->isPost()) {
            $post = $this->getRequest()->getPost();
            $reservation=$this->model->saveReservation($post,$inventoryaddons);
            //$traveller=$this->model->saveTraveller($lead,$reservation);
//            d($reservation);
             switch ($post['paymentType']) {
                case 'paypal':
                    $returnUrl = "http://".$_SERVER['HTTP_HOST']."/quote-reservation/express-response";
                    $currency = 'USD';
                    $cancelUrl = "http://".$_SERVER['HTTP_HOST']."/quote-reservation/express-response";

                    $this->setSessionData('Reservations', 'reservation', $post['finalCost']);
                    $this->setSessionData('Reservation', 'reservation', $reservation);
                    $this->setSessionData('InventoryLead', 'inventoryLead', $inventorylead);
                    $this->setSessionData('Lead', 'lead', $lead);

                    $amount=$post['finalCost'];
                    $referenceNumber = $reservation->getReferenceNumber();



                    $response = \Base\Model\Plugins\Paypals::PPSetExpressCheckout($amount, $currency, $returnUrl, $cancelUrl, $referenceNumber);

                    //  d('success');
                    break;
                case 'card':
                    $data['travellerName'] = $post['cardName'];
                    $data['travellerCity'] = null;
                    $data['travellerState'] = null;
                    $data['travellerZip'] = null;
                    $data['country'] =  'US';
                    $data['depositAmount'] = $post['finalCost'];
                    $data['typeOfCard'] = $post['cardType'];
                    $data['cardNumber'] = $post['cardNumber'];
                    $data['cardMonth'] = $post['cardMonth'];
                    $data['cardYear'] = $post['cardYear'];
                    $data['cvvNumber'] = $post['cardCvv'];

//                    d($data);

                    $response = \Base\Model\Plugins\Paypals::PPDoDirectPayment($data);
                    //  $response=21;
                    // $data = $this->getModel('Front');
                    //$data->updateDuePaymentStatus($reservation, $response, $allvalue);

//                    d($response);
                    if ($response['ACK']['ACK'] == 'Success'){
                        //d($reservation);
                        $this->model->updateReservationStatus($reservation);
                        $this->model->updateInventoryleadStatus($inventorylead,$lead);
                        $this->model->saveInvoice($response,$reservation,'DoDirectPayment');
                        
                        $mail=$this->model->sendquotemail($reservation->getId(),$inventorylead->getLeadId()->getEmail());
//                        d($mail);
                        $view = new ViewModel(array(
                            'msg' => 'Thank You.. Your Payment Received Successfully',
                        ));
                        $view->setTemplate('front/front/get-express-payment-response.phtml');
                        return $view; 
                    }else{
                        $view = new ViewModel(array(
                            'msg' => "We'er Sorry. Payment Could not be received.",
                        ));
                        $view->setTemplate('front/front/get-express-payment-response.phtml');
                        return $view; 
                    }
                     
                    break;
            }
           
        }
        $data = array('leadId' => $leadId,'lead'=>$lead,'inventoryLead'=>$inventorylead,'inventoryRooms'=>$inventoryrooms,'inventoryAddons'=>$inventoryaddons);
        $viewModel = new ViewModel($data);
        $viewModel->setTerminal(true); // Disable layout.
        
        return $viewModel;
        
        }else{
//          $data=array('message'=>'Reservation For this Quote is already Done');  
           $view = new ViewModel(array(
                'msg' => 'Reservation For this Quote is already Done',
            ));
            $view->setTemplate('front/front/get-express-payment-response.phtml');
            return $view; 
        }
        
    }

   public function quoteECResponseAction(){
       $request = $_REQUEST;
       $response = \Base\Model\Plugins\Paypals::PPGetExpressCheckoutDetails($request);
       $this->model = $this->getModel('Front');
      
       $reservation = new Container('Reservation');
      // d($reservation['reservation']);
       $inventorylead = new Container('InventoryLead');
       $lead = new Container('Lead');
//       d($inventorylead['inventoryLead']);
//       $reservation = $_SESSION['Reservation']['reservation'];
//       $inventorylead = $_SESSION['InventoryLead']['inventoryLead'];
       //d($inventorylead);
       if ($response['ACK']['ACK'] == 'Success'){
            $this->model->updateReservationStatus($reservation['reservation']);
            $this->model->updateInventoryleadStatus($inventorylead['inventoryLead'],$lead['lead']);
            $this->model->saveInvoice($response,$reservation['reservation'],'DoDirectPayment');
            $mail=$this->model->sendquotemail($reservation['reservation']->getId(),$inventorylead['inventoryLead']->getLeadId()->getEmail());
            $view = new ViewModel(array(
                'msg' => 'Thank You.. Your Payment Received Successfully',
            ));
            $view->setTemplate('front/front/get-express-payment-response.phtml');
            return $view; 
        }else{
            $view = new ViewModel(array(
                'msg' => "We'er Sorry. Payment Could not be received.",
            ));
            $view->setTemplate('front/front/get-express-payment-response.phtml');
            return $view; 
        }
   }
   
     public function applyDiscountAction(){
        $post = $this->request->getPost();
        $this->model = $this->getModel('Front');

        $promoData = $this->model->getPromoDiscount($post);

        if($promoData){
            $promoData['code'] = $promoData[0]->getPromoCode(); 
            $promoData['discountType'] = $promoData[0]->getDiscountType();
            $promoData['discount'] = $promoData[0]->getDiscount();
            
        }else{
            $promoData['discountType'] = 0;
            $promoData['discount'] = 0;
        }

       return new JsonModel($promoData);
        
    } 
    
    public function reminderMessageAction(){
        $model = $this->getModel('Front');
        $session=$this->getSessionData('User', 'user');
//        d($session);
        $notes=$model->getTravellerNotes($session);
        
        d("Email Sent...");
    }
    public function leadReminderAction(){
        $model = $this->getModel('Front');
        $session=$this->getSessionData('User', 'user');
//        d($session);
        $notes=$model->getLeadReminder($session);
        
        d("Email Sent...");
    }
    
     public function ajaxRoomDetailsAction(){
        $id = $this->params()->fromRoute('roomId', 0);
        $type = $this->params()->fromRoute('type', 0);
        
        if ($id != 0 && $type != 0):
            $this->model = $this->getModel('Front');
            $details = $this->model->_getRoomDetails($id,$type);
        endif;
        //echo "test";die;
           // d($details);
      echo json_encode($details);
       die;
    }
    
    public function addPaymentAction(){
        $this->layout('layout/ajax');
        $post = $this->request->getPost();
        $this->model = $this->getModel('Orders');
        $paymentData  = $this->model->createDepositDues($post);
//        d($paymentData);
        $form = new \Orders\Form\AddOrdersForm($this->getEm(), $this->getEm(self::AVP_CONFIG), '\Base\Entity\Orders');
        $view = $this->getView(array('form' => $form, "post"=>$post,"paymentData"=>$paymentData));
        return $view;
    }
}
