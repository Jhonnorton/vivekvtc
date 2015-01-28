<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Orders for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License 123
 */

namespace Payments\Controller;

use Zend\Mvc\MvcEvent;
use Sendmail\Controller\SendmailController;

class PaymentsController extends \Base\Controller\BaseController {

    protected $_entity = false;

    public function onDispatch(MvcEvent $e) {

        //   echo "hello"; die;
        $this->model = $this->getModel('Payments');

        if ($this->params()->fromRoute('id', 0)) {

            $this->_entity = $this->model->getItem($this->params()->fromRoute('id', 0));
        }

        $e->getViewModel()->setVariable('modulename', 'Payments');

        return parent::onDispatch($e); //smart
    }

    public function indexAction() {

        //  echo "hello index"; die;    
        $data = array('collection' => $this->model->getCollection(), 'message' => $this->getPageMessages(),);

        //  d($data);

        if ($this->request->isPost()) {

            //  d($this->getRequest()->getPost());
            $paymenttype = $this->getRequest()->getPost('myselect');
            $startdate = $this->getRequest()->getPost('mydate');
            $enddate = $this->getRequest()->getPost('mydate1');
            $data = array('collection' => $this->model->getCollection($paymenttype, $startdate, $enddate), 'paymenttyp' => $paymenttype, 'startdat' => $startdate, 'enddat' => $enddate);
            //d($data);
            return $this->getView($data);
        }

        return $this->getView($data);
        //echo "hello index"; die;
    }

    public function editAction() {
        if (!$this->_entity)
            throw new \Exception('Invalid Entity');

        //$form->get('submit')->setValue('edit');
        $form = new \Payments\Form\PaymentsForm($this->getEm(), $this->_entity);
        if ($this->request->isPost()) {
            //   $form->setInputFilter($this->model->getInputFilter());
            //   $form->setData($this->request->getPost());
            //   if ($form->isValid()) {
            $this->model->save($this->request->getPost());
            $this->addPageMessage('The Payment has been updated.', 'success');
            return $this->redirect()->toRoute('payments');
            //  } else {
            //     $this->model->save($this->request->getPost());
            //     die;
            //     $form->getMessages();
            //}
        }


        $data = array('collection' => $this->model->getItemViewDetail($this->_entity->getId()));

        $view = $this->getView(array('form' => $form, 'collection' => $this->model->getItemViewDetail($this->_entity->getId())));
        return $view;
    }

    public function cancelAction() {

        if (!$this->_id && !$this->request->isPost())
            throw new \Exception('Invalid Entity');

        $this->model->cancelReservation($this->_id);
        $this->addPageMessage('The Reservation has been canceled.', 'success');
        return $this->redirect()->toRoute('payments');
    }

    public function resortAction() {

        $data = array('collection' => $this->model->getResort(),);

        if ($this->request->isPost()) {
            $paymenttype = $this->getRequest()->getPost('myselect');
            $startdate = $this->getRequest()->getPost('mydate');
            $enddate = $this->getRequest()->getPost('mydate1');
            $data = array('collection' => $this->model->getResort($paymenttype, $startdate, $enddate), 'paymenttyp' => $paymenttype, 'startdat' => $startdate, 'enddat' => $enddate, 'message' => $this->getPageMessages());
            return $this->getView($data);
        }
        //  d($data);
        return $this->getView($data);
    }

    public function cruiseAction() {

        $data = array('collection' => $this->model->getCruise(),);
        if ($this->request->isPost()) {
            $paymenttype = $this->getRequest()->getPost('myselect');
            $startdate = $this->getRequest()->getPost('mydate');
            $enddate = $this->getRequest()->getPost('mydate1');
            $data = array('collection' => $this->model->getCruise($paymenttype, $startdate, $enddate), 'paymenttyp' => $paymenttype, 'startdat' => $startdate, 'enddat' => $enddate, 'message' => $this->getPageMessages());
            return $this->getView($data);
        }

        return $this->getView($data);
    }

    public function eventAction() {

        $data = array('collection' => $this->model->getEventPayment(),);
        if ($this->request->isPost()) {
            $paymenttype = $this->getRequest()->getPost('myselect');
            $startdate = $this->getRequest()->getPost('mydate');
            $enddate = $this->getRequest()->getPost('mydate1');
            $data = array('collection' => $this->model->getEventPayment($paymenttype, $startdate, $enddate), 'paymenttyp' => $paymenttype, 'startdat' => $startdate, 'enddat' => $enddate, 'message' => $this->getPageMessages());
            return $this->getView($data);
        }

        return $this->getView($data);
    }

    public static function viewReservation($serviceManager, $id) {
        //d($serviceManager);
        // echo 'in payment'; die;
        if ($serviceManager) {
            $model = $serviceManager->get('Payments');

            //d($id);
            return $model->getViewReservation($id);
        }
        return false;
    }

    public function paymentAction() {
        if (!$this->_entity)
            throw new \Exception('Invalid Entity');

        $form = new \Payments\Form\PaymentsForm($this->getEm(), $this->_entity);

        $data = array('collection' => $this->model->getItemViewDetail($this->_entity->getId()));

        if ($this->request->isPost()) {
            $allvalue = $data;
            $reservation = $data['collection']['reservation']; //$data->getCollection();
            $data = array();
            $type = $this->getRequest()->getPost('payment-type');

            // d($type);
            switch ($type) {
                case 1:
                    //   $response = \Base\Model\Plugins\Paypal::PPSetExpressCheckout($amount, $currency, $returnUrl, $cancelUrl, $referenceNumber);


                    $data = $this->getModel('payments');
                    $data->updateReservationPaymentStatus($reservation, $this->getRequest()->getPost(), $allvalue);
                    $this->addPageMessage('The Reservation Payment has been made.', 'success');
                    return $this->redirect()->toRoute('payments');
                    //  d('success');
                    break;
                case 2:

                    $paymenttype = $this->getRequest()->getPost('type');
                    d($paymenttype);

                    switch ($paymenttype) {
                       
                        case 1:
                            $response = \Base\Model\Plugins\Paypal::PPSetExpressCheckout($amount, $currency, $returnUrl, $cancelUrl, $referenceNumber);
                            // d($response);
                            break;
                        case 2:
                            $billingDetailOption = $this->request->getPost("billing_det");

                            $data['depositAmount'] = $this->request->getPost("totalCost");
                            $data['typeOfCard'] = $this->request->getPost("typeOfCard");
                            $data['cardNumber'] = $this->request->getPost("cardNumber");
                            $data['cardMonth'] = $this->request->getPost("cardMonth");
                            $data['cardYear'] = $this->request->getPost("cardYear");
                            $data['cvvNumber'] = $this->request->getPost("cvvNumber");

                            $response = \Base\Model\Plugins\Paypals::PPDoDirectPayment($data);

                            if ($response['ACK']['ACK'] == 'Success'):
                                $data = $this->getModel('payments');
                                $data->updatePaymentStatus($reservation, $response, $allvalue);
                                $this->addPageMessage('The Reservation Payment has been made.', 'success');
                                return $this->redirect()->toRoute('payments');
                            endif;

                            break;
                    }
            }
        }
        // $data = array('collection' => $this->model->getItemViewDetail($this->_entity->getId()));
        $view = $this->getView(array('form' => $form, 'collection' => $this->model->getItemViewDetail($this->_entity->getId())));
        return $view;
    }

    
     public function getPaymentResponseAction() {

        $request = $_REQUEST;
        d($request);
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

    
    
    public function sendmailAction() {
        if ($this->request->isPost()) {
            $dta = $this->request->getPost();
            //echo "<pre>"; print_r($dta); die;
            $to = isset($dta['toemail']) ? $dta['toemail'] : '';
            $subject = isset($dta['subject']) ? $dta['subject'] : '';
            $message = isset($dta['message']) ? $dta['message'] : '';
            $cc = isset($dta['ccemail']) ? $dta['ccemail'] : '';

            $this->model->sendmailnew($to, $subject, $message, $cc);
            $this->addPageMessage('The mail has been Sent.', 'success');

            $this->redirect()->toRoute('payments');
        }


        $data = array('collection' => $this->model->getTravellers($this->_entity->getId()));

        return $this->getView($data);
    }

    public function sendReminderAction() {




        if ($this->request->isPost()) {
            $dta = $this->request->getPost();
            //echo "<pre>"; print_r($dta); die;
            $to = isset($dta['toemail']) ? $dta['toemail'] : '';
            $subject = isset($dta['subject']) ? $dta['subject'] : '';
            $message = isset($dta['message']) ? $dta['message'] : '';
            $cc = isset($dta['ccemail']) ? $dta['ccemail'] : '';

            $this->model->sendmailnew($to, $subject, $message, $cc);
            $this->addPageMessage('The reminder mail has been Sent.', 'success');

            $this->redirect()->toRoute('payments');
        }


        $data = array('collection' => $this->model->getPaymentdues());

        //  d($data);
        $datebefore7days = date('Y-m-d', strtotime('7 days'));
        $datetoday = date('Y-m-d');
        $dateafter10days = date('Y-m-d', strtotime('-10 days'));
        $dateafter7days = date('Y-m-d', strtotime('-7 days'));
        $item = $data['collection'];
        //  d($item);
        //  d($item['paymentDues']);

        foreach ($data['collection'] as $item) {
            echo "<pre>";
            // print_r($item['paymentDues']->getReservation()->getId());

            echo "<pre>";
            $duedate = ($item['paymentDues']->getDueDate() instanceof \DateTime) ? $item['paymentDues']->getDueDate()->format('Y-m-d') : $item['paymentDues']->getDueDate();

            if ($datebefore7days == $duedate) {

                echo $duedate . '7 days after reminder';

                $travellerss = array('traveller' => $this->model->getTravellers($item['paymentDues']->getReservation()->getId()));

                print_r($travellerss['traveller'][0]->getTraveller()->getemail());
                print_r($item['paymentDues']->getReservation()->getId());
                //$url = $this->url()->fromRoute('payments', array(), array('force_canonical' => true));
                //$this->model->sendmail($id, $to, array('link' => $url, 'linkName' => 'Link to Reservations'));
            } else if ($datetoday == $duedate) {

                //echo $duedate . 'today payment due';
                $id = $item['paymentDues']->getReservation()->getId();
                $travellerss = array('traveller' => $this->model->getTravellers($item['paymentDues']->getReservation()->getId()));
                //   print_r($travellerss['traveller'][0]->getTraveller()->getemail());
                $to = $travellerss['traveller'][0]->getTraveller()->getemail();
                $url = $this->url()->fromRoute('paymentdue', array('id' => $id), array('force_canonical' => true));
                $this->model->sendmailfortoday($to, array('link' => $url, 'linkName' => 'Link to Payment'));
            } else if ($dateafter7days == $duedate) {

                //echo $duedate . 'today payment due';
                $id = $item['paymentDues']->getReservation()->getId();
                $travellerss = array('traveller' => $this->model->getTravellers($item['paymentDues']->getReservation()->getId()));
                //   print_r($travellerss['traveller'][0]->getTraveller()->getemail());
                $to = $travellerss['traveller'][0]->getTraveller()->getemail();
                $url = $this->url()->fromRoute('paymentdue', array('id' => $id), array('force_canonical' => true));
                $this->model->sendmailfortoday($to, array('link' => $url, 'linkName' => 'Link to Payment'));
            } else if ($dateafter10days == $duedate) {

                echo $duedate . 'past date and reserrvation is canceled';
                $travellerss = array('traveller' => $this->model->getTravellers($item['paymentDues']->getReservation()->getId()));

                //foreach($travellerss['traveller'] as $travelprson){

                $this->model->sendmailnew($travellerss['traveller'][0]->getTraveller()->getemail(), 'Payment Cancelation', 'Your Recervation has been canceled', $cc = NULL);

                //  print_r($travellerss['traveller'][0]->getTraveller()->getemail());
                //echo $travelprson->getName();
                //}
                //    print_r($travellerss);
                $this->model->cancelReservations($item['paymentDues']->getReservation()->getId());
                //       print_r($item['paymentDues']->getReservation()->getId());
            }
        }
        d($dateafter10days);

        return false;
        // return $this->getView($data);
    }

    public function sendinvoiceAction() {

        if (!$this->_entity)
            throw new \Exception('Invalid Entity');



        $data = array('collection' => $this->model->getViewInvoice($this->_entity->getId()));

        //   echo "<pre>";
        //   print_r($data);

        $to = $data['collection'][0]['travellers'][0]->getTraveller()->getemail();

        //   print_r($to);die;
        $this->model->sendmailinvoice($to, array($data['collection'][0]));
        $this->addPageMessage('The Reservation Payment Invoice has been sent.', 'success');
        return $this->redirect()->toRoute('payments');

        // d($data);
    }

}
