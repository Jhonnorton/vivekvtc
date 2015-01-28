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

class OrdersPendingController extends \Base\Controller\BaseController {

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
        $data = array('collection' => $this->model->getCollectionPending(), 'message' => $this->getPageMessages(),);
        if ($this->request->isPost()) {
            $startdate = $this->getRequest()->getPost('mydate');
            $enddate = $this->getRequest()->getPost('mydate1');
            $data = array('collection' => $this->model->getCollectionPending($startdate, $enddate), 'startdat' => $startdate, 'enddat' => $enddate);
        }

        return $this->getView($data);
    }

    public function deleteAction() {

        if (!$this->_id && !$this->request->isPost())
            throw new \Exception('Invalid Entity');

        $this->model->pendingdelete($this->_id);
        $this->addPageMessage('Reservation has been deleted.', 'success');
        return $this->redirect()->toRoute('orders-pending');
    }

    public function viewAction() {

        if (!$this->_entity)
            throw new \Exception('Invalid Entity');


        $data = array('reservation' => $this->model->getItemView($this->_entity->getId()));

        return $this->getView($data);
    }

    public function markCompleteAction() {

        if (!$this->_id && !$this->request->isPost())
            throw new \Exception('Invalid Entity');

        $this->model->markComplete($this->_id);
        $this->addPageMessage('Reservation marked as completed.', 'success');
        return $this->redirect()->toRoute('orders-pending');
    }

    public function sendmailAction() {
        if (!$this->_id && !$this->request->isPost())
            throw new \Exception('Invalid Entity');

        //   $data = array('reservation' => $this->model->getPendingItemView($this->_entity->getId()));
        $travellers = array('traveller' => $this->model->getTravellers($this->_entity->getId()));
        $to = $travellers['traveller'][0]->getTraveller()->getemail();
       // d($to);
        $id = $this->_entity->getId();
       // $to = 'rm@mailinator.com';

        $this->model->sendmailonpending($id, $to);
        $this->addPageMessage('Mail sent to client.', 'success');

        return $this->redirect()->toRoute('orders-pending');
    }
    
     public function expressResponseAction(){
        $request = $_REQUEST;
        //d($request);
        $response = \Base\Model\Plugins\Paypals::PPGetExpressCheckoutDetails($request);
//        d($response);
//        echo "<pre>"; print_r($_SESSION['Reservation']->reservation);die;
//        $reservation = new Container('Reservation');
        if ($response['ACK']['ACK'] == 'Success'){
            $data = array('collection' => $this->model->getItemViewDetail($_SESSION['Reservation']->reservation->getId()));
            $this->getModel('payments')->updatePaymentStatus($_SESSION['Reservation']->reservation,$response,$data,1);
            //$this->model->markComplete($_SESSION['Reservation']->reservation->getId(),$response);
            $this->addPageMessage('Payment Done Successfully', 'success');
            $this->redirect()->toRoute('orders-pending');
        }else{
           $this->addPageMessage('Payment Failed', 'success');
           $this->redirect()->toRoute('orders-pending');
        }
        
    }
    
    public function paymentApplyAction() {
        if (!$this->_entity)
            throw new \Exception('Invalid Entity');

        $form = new \Payments\Form\PaymentsForm($this->getEm(), $this->_entity);

        $data = array('collection' => $this->model->getItemViewDetail($this->_entity->getId()));
        //echo "<pre>"; print_r($data['collection']['travellers']); die;
        if ($this->request->isPost()) {
            $allvalue = $data;
            $reservation = $data['collection']['reservation']; //$data->getCollection();
//            d($reservation);
            $data = array();
            $type = $this->getRequest()->getPost('payment-type');

//             d($this->getRequest()->getPost());
            if($this->getRequest()->getPost('type')==2){
            switch ($type) {
                case 1:
                    $amount=$this->getRequest()->getPost('totalCost');
//                    d($amount);
                    $currency='USD';
                    $returnUrl="http://".$_SERVER['HTTP_HOST']."/admin/reservation/express-payment-response";
                    $cancelUrl="http://".$_SERVER['HTTP_HOST']."/admin/reservation/express-payment-response";
                    $referenceNumber = $reservation->getReferenceNumber();
                    $this->setSessionData('Reservations', 'reservation', $amount);
                    $this->setSessionData('Reservation', 'reservation', $reservation);
                    
                    $response = \Base\Model\Plugins\Paypals::PPSetExpressCheckout($amount, $currency, $returnUrl, $cancelUrl, $referenceNumber);
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
//                    d($response);
                    if ($response['ACK']['ACK'] == 'Success'):
//                        d('success');
                        $data = $this->getModel('payments');
                        $data->updatePaymentStatus($reservation, $response, $allvalue);
                        //$this->model->markComplete($this->_entity->getId());
                        return $this->redirect()->toRoute('orders-pending');
                    endif;

                    break;
            }
            }else{
                 //$response['ACK']['AMT']=$this->request->getPost("totalCost");
                 $data = $this->getModel('payments');
                 $response = array("ACK" => array("ACK" => 'Success', "CURRENCYCODE" => 'USD', "TRANSACTIONID" => "", "AMT" => $this->request->getPost("totalCost")));
                 $data->updatePaymentStatusDirect($reservation, $response, $allvalue);
                  //$this->model->markComplete($this->_entity->getId());
                 return $this->redirect()->toRoute('orders-pending');
            }
        }
        $view = $this->getView(array('form' => $form, 'collection' => $this->model->getItemViewDetail($this->_entity->getId()),'countries'=>$this->model->getCountries()));
        return $view;
    }

}
