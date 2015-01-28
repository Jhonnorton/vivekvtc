<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Orders for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License 123
 */

namespace Reseller\Controller;

use Zend\Mvc\MvcEvent;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;
use Sendmail\Controller\SendmailController;

class ResellerController extends \Base\Controller\BaseController {

    protected $_entity = false;
    protected $_session = null;

    public function onDispatch(MvcEvent $e) {
        $this->_session = new Container('image');
        $this->_session = new Container('banner');
        $this->_session = new Container('listing');
        $this->model = $this->getModel('Reseller');

        if ($this->params()->fromRoute('id', 0)) {

            $this->_entity = $this->model->getItem($this->params()->fromRoute('id', 0));
        }

        $e->getViewModel()->setVariable('modulename', 'Reseller');

        return parent::onDispatch($e); //smart
    }

    public function indexAction() {
        $data = array('collection' => $this->model->getCollectiosssn(),'message' => $this->getPageMessages());
        return $this->getView($data);
    }

    public function addAction() {
        $form = new \Reseller\Form\ResellerForm($this->getEm(), '\Base\Entity\Users');
        if ($this->request->isPost()) {

            $data = $this->request->getPost();

            $form->setInputFilter($this->model->getInputFilter());
            $form->setData($this->request->getPost());
//               d($data);

            if ($form->isValid()) {
                if ($this->model->isValidModel($form)) {

                   $affiliate=$this->model->save($form->getData(), $data);
                   
                   $to=$affiliate->getEmail();
                   $subject="Reseller Account Created.";
                   $message="Hello,<br>New Reseller Account is created using your email id<br>username=".$affiliate->getEmail();
                   $message.="<br>password=".$data['password'];
                   SendmailController::sendMailOnLead($this->_serviceManager, $to, $subject, $message, $cc);
                   
                    $type = $this->getRequest()->getPost('paytype');
            
                    switch ($type) {
                        case 1:
                            $returnUrl = "http://".$_SERVER['HTTP_HOST']."/admin/addaffiliate/express-response";
                            $currency = 'USD';
                            $cancelUrl = "http://".$_SERVER['HTTP_HOST']."/admin/addaffiliate/express-response";

                            $this->setSessionData('Reservations', 'reservation', $this->getRequest()->getPost('finalamt'));
//                            $this->setSessionData('PaymentDue', 'payment', $allvalue['collection'][0]->getId());
                            $this->setSessionData('Reservation', 'reservation', $affiliate);

                            $amount=$this->getRequest()->getPost('finalamt');
//                            $referenceNumber = $reservation->getReferenceNumber();



                            $response = \Base\Model\Plugins\Paypals::PPSetExpressCheckout($amount, $currency, $returnUrl, $cancelUrl);

                            //  d('success');
                            break;
                        case 0:
   
                            $billingDetailOption = $this->request->getPost("billing_det");


                            $data1['travellerName'] = $data['firstName'];
                            $data1['travellerCity'] = ($this->request->getPost("city")) ? $this->request->getPost("city") : null;
                            $data1['travellerState'] = ($this->request->getPost("state")) ? $this->request->getPost("state") : null;
                            $data1['travellerZip'] = null;
                            $data1['country'] =  'US';
                            $data1['depositAmount'] = $this->request->getPost("finalamt");
                            $data1['typeOfCard'] = $this->request->getPost("typeOfCard");
                            $data1['cardNumber'] = $this->request->getPost("cardNumber");
                            $data1['cardMonth'] = $this->request->getPost("cardMonth");
                            $data1['cardYear'] = $this->request->getPost("cardYear");
                            $data1['cvvNumber'] = $this->request->getPost("cvvNumber");

                            $response = \Base\Model\Plugins\Paypals::PPDoDirectPayment($data1);
//                            d($response);
                            if ($response['ACK']['ACK'] == 'Success'){
                                $data = $this->getModel('Reseller');
                                $data->updatePaymentStatus($affiliate,$response);
                                
                                $to=$affiliate->getEmail();
                                $subject="Reseller Account Setup Payment.";
                                $message="Hello,<br>Setup fee payment done successfully and your Transaction id is ".$response['ACK']['TRANSACTIONID'];
                                SendmailController::sendMailOnLead($this->_serviceManager, $to, $subject, $message, $cc);
                   
                                $this->addPageMessage('Reseller Added.', 'success');
                                 $this->redirect()->toRoute('affiliate');
                            }else{
                                $this->addPageMessage('Payment not Successfull.', 'success');
                                 $this->redirect()->toRoute('affiliate');
                            }
                            
                            break;
                    }
                    
                }
            } else {
                // d($form->getMessages());
                $form->getMessages();
            }
        }
        $view = $this->getView(array('form' => $form,'accounts'=>$this->model->getResellerAccounts()));
        return $view;
    }
    
    public function paymentResponseAction(){
        $request = $_REQUEST;
        $response = \Base\Model\Plugins\Paypals::PPGetExpressCheckoutDetails($request);
        $data = $this->getModel('Reseller');
        
        $reservation = new Container('Reservation');

        if ($response['ACK']['ACK'] == 'Success'){
            $data = $this->getModel('Reseller');
            $data->updatePaymentStatus($reservation->reservation,$response);
  
            $to=$reservation->reservation->getEmail();
            $subject="Reseller Account Setup Payment.";
            $message="Hello,<br>Setup fee payment done successfully and your Transaction id is ".$response['ACK']['TRANSACTIONID'];
            SendmailController::sendMailOnLead($this->_serviceManager, $to, $subject, $message, $cc);
                                
            $this->addPageMessage('Reseller Added.', 'success');
            $this->redirect()->toRoute('affiliate');
        }else{
            $this->addPageMessage('Payment not Successfull.', 'success');
            $this->redirect()->toRoute('affiliate');
        }

    }
    
    public function editAction() {

        if (!$this->_entity)
            throw new \Exception('Invalid Entity');

        $form = new \Reseller\Form\ResellerForm($this->getEm(), $this->_entity);


        if ($this->request->isPost()) {

            $data = $this->request->getPost();

            $form->setInputFilter($this->model->getInputFilter());
            $form->setData($this->request->getPost());

            if ($form->isValid()) {
                if ($this->model->isValidModel($form)) {
                    $this->model->update($form->getData(), $data);
                    $this->addPageMessage('Reseller Added.', 'success');
                    $this->redirect()->toRoute('affiliate');
                }
            } else {
                $form->getMessages();
            }
        }

        $data = array('collection' => $this->model->getItemViewDetail($this->_entity->getId()));
        // d($form);
        $view = $this->getView(array('form' => $form, 'collection' => $data));
        return $view;
    }

    public function cancelAction() {
        d($this->_id);

        if (!$this->_id && !$this->request->isPost())
            throw new \Exception('Invalid Entity');

        $this->model->cancelReservation($this->_id);
        return $this->redirect()->toRoute('payments');
    }

    public function orderAction() {

        // d('hello');
        $data = array('collection' => $this->model->getOrders(),);
        return $this->getView($data);
    }

    public function orderhistoryAction() {

     //   if (!$this->_entity)
       //     throw new \Exception('Invalid Entity');


        // d('hello');
        $data = array('collection' => $this->model->getOrderHistory($this->_id),);
        return $this->getView($data);
    }

   

    public function cruiseAction() {

        $data = array('collection' => $this->model->getCruise(),);
        if ($this->request->isPost()) {
            $paymenttype = $this->getRequest()->getPost('myselect');
            $startdate = $this->getRequest()->getPost('mydate');
            $enddate = $this->getRequest()->getPost('mydate1');
            $data = array('collection' => $this->model->getCruise($paymenttype, $startdate, $enddate), 'paymenttyp' => $paymenttype, 'startdat' => $startdate, 'enddat' => $enddate);
            return $this->getView($data);
        }

        return $this->getView($data);
    }

    public function eventAction() {

        $data = array('collection' => $this->model->getResellerEvent(),);
        return $this->getView($data);
    }

    public function eventeditAction() {

        $data = $this->getEm()->find('Base\Entity\Avp\Events',$this->_id);
        $form = new \Reseller\Form\EventsForm($this->getEm(), $data);


        if ($this->request->isPost()) {
            $files = $this->request->getFiles()->toArray();
            $data = $this->request->getPost();
            //d($files);
            if (!empty($files['image']['name'])) {
                $data['image'] = $files['image']['name'];
            }
            if (!empty($files['bannerImage']['name'])) {
                //    d('here in banner');
                $data['bannerImage'] = $files['bannerImage']['name'];
            }
            if (!empty($files['listingImage']['name'])) {
                $data['listingImage'] = $files['listingImage']['name'];
            }

       
            $form->setData($data);
            if ($this->model->isValidModel($form)) { //&&   $this->model->isValidImage($form, $files)) {
                $object = array('object' => $this->request->getPost(),
                    'tmpImage' => $this->_session->offsetGet('image'),
                    'files' => $files);
                $this->model->eventsave($object);
                $this->addPageMessage('The event has been updated.', 'success');
                $this->redirect()->toRoute('affiliate-event');
            }
            //    }
            /* else {
              d('else');
              d($form->getMessages());
              } */
        } else {
            $this->_session->offsetSet('image', $data->getImage());
            $this->_session->offsetSet('banner', $data->getBannerImage());
            $this->_session->offsetSet('listing', $data->getListingImage());
        }


        $view = $this->getView(array(
            'form' => $form,
            'image' => $this->model->getImagePath() . $this->_session->offsetGet('image'),
            'banner' => $this->model->getImagePath() . $this->_session->offsetGet('banner'),
            'listing' => $this->model->getImagePath() . $this->_session->offsetGet('listing'),
        ));

        return $view;
    }

    public function galleryaddAction() {

      //  if (!$this->_entity)
        //    throw new \Exception('Invalid Entity');
        //     $data = $this->getEm()->find('Base\Entity\Avp\Events', $this->_entity->getId());
        $form = new \Reseller\Form\EventsForm($this->getEm(self::AVP_CONFIG), '\Base\Entity\Avp\EventImages');
        if ($this->request->isPost()) {
            $files = $this->request->getFiles()->toArray();
            $data = $this->request->getPost();
            if (!empty($files['image']['name'])) {
                $data['image'] = $files['image']['name'];
            }

            //  d($data);    
            $form->setData($data);

            if ($this->model->isValidModel($form)) {
                $object = array('object' => $this->request->getPost(),
                    'files' => $files);
                $this->model->eventimagesave($object);
                $this->addPageMessage('The event image has been added.', 'success');
                $this->redirect()->toRoute('affiliate-gallery', array('id' => $this->_id));
            }
        }

        $view = $this->getView(array(
            'form' => $form, 'id' => $this->_id
        ));

        return $view;
    }

    public function eventgalleryAction() {

        $data = $this->getEm()->find('Base\Entity\Avp\Events', $this->_id);
        // d($data);

        $data = array('collection' => $this->model->getEventGallery($data->getId()), 'id' => $data->getId());
        return $this->getView($data);
    }

    public function gallerydeleteAction() {
        
        $data = $this->getEm()->find('Base\Entity\Avp\EventImages', $this->_id);
        // d($data);
        $this->model->deleteimage($this->_id);

        $this->addPageMessage('The event gallery image has been deleted.', 'success');
        $this->redirect()->toRoute('affiliate-gallery', array('id' => $data->getEventId()));
    }

    public function eventfeatureAction() {

        $allGetValues = $this->params(); 
      //  d($this->_id);
        $data = $this->getEm()->find('Base\Entity\Avp\Events', $this->_id);
        $data = array('collection' => $this->model->getEventFeature($data->getId()), 'id' => $data->getId());
        return $this->getView($data);
    }

    
    
    
     public function eventfeatureaddAction() {

    
        $form = new \Reseller\Form\EventsForm($this->getEm(self::AVP_CONFIG), '\Base\Entity\Avp\EventImages');
        if ($this->request->isPost()) {
            $files = $this->request->getFiles()->toArray();
            $data = $this->request->getPost();
            if (!empty($files['image']['name'])) {
                $data['image'] = $files['image']['name'];
            }

            //  d($data);    
            $form->setData($data);

            if ($this->model->isValidModel($form)) {
                $object = array('object' => $this->request->getPost(),
                    'files' => $files);
                $this->model->eventfeaturesave($object);
                $this->addPageMessage('The event feature has been added.', 'success');
                $this->redirect()->toRoute('affiliate-event-feature', array('id' =>$this->_id));
            }
        }

        $view = $this->getView(array(
            'form' => $form, 'id' => $this->_id ));

        return $view;
    }
    
    
     public function eventfeatureeditAction() {

    
        $data = $this->getEm()->find('Base\Entity\Avp\EventFeatures',$this->_id);
        $eventid=$data->getEventId();
        $form = new \Reseller\Form\EventsForm($this->getEm(), $data);


        if ($this->request->isPost()) {
            
            $files = $this->request->getFiles()->toArray();
            $data = $this->request->getPost();
            if (!empty($files['image']['name'])) {
                $data['image'] = $files['image']['name'];
            }
            $form->setData($data);
            if ($this->model->isValidModel($form)) { 
                $object = array('object' => $this->request->getPost(),
                    'tmpImage' => $this->_session->offsetGet('image'),
                    'files' => $files);
                $this->model->eventfeatureupdate($object);
               // d($this->_id);
                $this->addPageMessage('The event feature has been updated.', 'success');
                $this->redirect()->toRoute('affiliate-event-feature', array('id' =>$eventid));
            }
           
        } else {
            $this->_session->offsetSet('image', $data->getImage());
           
        }


        $view = $this->getView(array(
            'form' => $form,
            'image' => $this->model->getImagePath() . $this->_session->offsetGet('image'),
             'id' => $this->_id,
              
            
        ));

        return $view;

    }
    
    
    
      public function eventfeaturedeleteAction() {
        
        $data = $this->getEm()->find('Base\Entity\Avp\EventFeatures', $this->_id);
        // d($data);
        $this->model->deletefeature($this->_id);

        $this->addPageMessage('The event feature has been deleted.', 'success');
        $this->redirect()->toRoute('affiliate-event-feature', array('id' => $data->getEventId()));
    }

    
    
    public function eventitineraryAction() {

        $allGetValues = $this->params(); 
      //  d($this->_id);
        $data = $this->getEm()->find('Base\Entity\Avp\Events', $this->_id);
        $data = array('collection' => $this->model->getEventItineraries($data->getId()), 'id' => $data->getId());
        return $this->getView($data);
    }

    
    
    
     public function eventitineraryaddAction() {

        $data1 = $this->getEm()->find('Base\Entity\Avp\Events', $this->_id);
      //  d($data);
        $form = new \Reseller\Form\EventsForm($this->getEm(self::AVP_CONFIG), '\Base\Entity\Avp\EventItineraries');
        if ($this->request->isPost()) {
         
            $data = $this->request->getPost();
              
          // d($data);
            $form->setData($data);

            if ($this->model->isValidModel($form)) {
                $object = array('object' => $this->request->getPost(), );
                $this->model->eventitinerarysave($object);
                $this->addPageMessage('The event itinerary has been added.', 'success');
            //    d($this->_id);
                $this->redirect()->toRoute('affiliate-event-itinerary', array('id' =>$this->_id));
            }
        }

        $view = $this->getView(array(
            'form' => $form, 'id' => $this->_id,'data'=>$data1 ));

        return $view;
    }
    
    
     public function eventitineraryeditAction() {

    
        $data = $this->getEm()->find('Base\Entity\Avp\EventItinerarySchedules',$this->_id);
     //   d($data);
        $eventid=$data->getEventItineraryId()->getEventId();
        $form = new \Reseller\Form\EventsForm($this->getEm(), $data);


        if ($this->request->isPost()) {
           $data = $this->request->getPost();
          
            $form->setData($data);
            if ($this->model->isValidModel($form)) { 
                $object = array('object' => $this->request->getPost(),);
                $this->model->eventitinerariesupdate($object);
               // d($this->_id);
                $this->addPageMessage('The event itineraries has been updated.', 'success');
                $this->redirect()->toRoute('affiliate-event-itinerary', array('id' =>$eventid));
            }
           
        }

        $view = $this->getView(array(
            'form' => $form,
            
             'id' => $this->_id,
              
            
        ));

        return $view;

    }
    
    
    
      public function eventitinerarydeleteAction() {
        
        $data = $this->getEm()->find('Base\Entity\Avp\EventItinerarySchedules', $this->_id);
        //d($data);
        $this->model->deleteitinerary($this->_id);

        $this->addPageMessage('The event itinerary has been deleted.', 'success');
        $this->redirect()->toRoute('affiliate-event-itinerary', array('id' => $data->getEventItineraryId()->getEventId()));
    }
    
    
    
    
    
     public function eventroomsAction() {

        $allGetValues = $this->params(); 
      //  d($this->_id);
        $data = $this->getEm()->find('Base\Entity\Avp\Events', $this->_id);
        $data = array('collection' => $this->model->getEventRooms($data->getId()), 'id' => $data->getId());
        return $this->getView($data);
    }
    
    
     public function eventroomsaddAction() {

        $data1 = $this->getEm()->find('Base\Entity\Avp\Events', $this->_id);
        
        $resortrooms=$this->model->resortrooms($data1->getId(),$data1->getResortId());
      //  d($resortrooms);

        $form = new \Reseller\Form\EventsForm($this->getEm(self::AVP_CONFIG), '\Base\Entity\Avp\EventRooms');
        if ($this->request->isPost()) {
         
            $data = $this->request->getPost();
              
           //d($data);
            $form->setData($data);

            if ($this->model->isValidModel($form)) {
                $object = array('object' => $this->request->getPost(), );
                $this->model->eventroomsave($object);
                $this->addPageMessage('The event rooms has been added.', 'success');
            //    d($this->_id);
                $this->redirect()->toRoute('affiliate-event-rooms', array('id' =>$this->_id));
            }
        }

        $view = $this->getView(array(
            'form' => $form, 'id' => $this->_id,'data'=>$resortrooms ));

        return $view;
    }
    
    
    public function eventroomseditAction() {

    
        $data = $this->getEm()->find('\Base\Entity\Avp\EventRooms',$this->_id);
   
        $eventid=$data->getEventId();
        $form = new \Reseller\Form\EventsForm($this->getEm(), $data);


        if ($this->request->isPost()) {
           $data = $this->request->getPost();
          
            $form->setData($data);
            if ($this->model->isValidModel($form)) { 
                $object = array('object' => $this->request->getPost(),);
                $this->model->eventroomsupdate($object);
               // d($this->_id);
                $this->addPageMessage('The event rooms has been updated.', 'success');
                $this->redirect()->toRoute('affiliate-event-rooms', array('id' =>$eventid));
            }
           
        }

        $view = $this->getView(array(
            'form' => $form,
            
             'id' => $this->_id,
              
            
        ));

        return $view;

    }
    
        public function eventroomsdeleteAction() {
        
        $data = $this->getEm()->find('\Base\Entity\Avp\EventRooms', $this->_id);
        //d($data);
        $this->model->deleterooms($this->_id);

        $this->addPageMessage('The event rooms has been deleted.', 'success');
        $this->redirect()->toRoute('affiliate-event-rooms', array('id' => $data->getEventId()));
    }
    
    
      public function eventsetfeatureAction() {
       
        $data = $this->getEm()->find('\Base\Entity\Avp\Events', $this->_id);
      //  d($data);
        $this->model->setfeature($data);

        $this->addPageMessage('The event has been featured.', 'success');
        $this->redirect()->toRoute('affiliate-event');
    }
    
     public function eventunsetfeatureAction() {
        
          
        $data = $this->getEm()->find('\Base\Entity\Avp\Events', $this->_id);  
        
        $this->model->unetfeature($data);
        $this->addPageMessage('The event has been un-featured.', 'success');
        $this->redirect()->toRoute('affiliate-event');
    }
    
    
     public function eventviewAction() {
        
         $data = $this->getEm()->find('\Base\Entity\Avp\Events', $this->_id);
         $this->_session->offsetSet('image', $data->getImage());
           
        
        $view = $this->getView(array(
            'data' => $data,
            'image' => $this->model->getImagePath() . $this->_session->offsetGet('image'),
        ));

        return $view;
    }
    
      
      public function eventdeleteAction() {
        
        $data = $this->getEm()->find('Base\Entity\Avp\Events', $this->_id);
        //d($data);
        $this->model->deleteevent($this->_id);

        $this->addPageMessage('The event has been deleted.', 'success');
        $this->redirect()->toRoute('affiliate-event');
    }
    
    
     public function resortAction() {

        $data = array('collection' => $this->model->getResellerResort(),);
       
        return $this->getView($data);
    }
    

    
    public static function viewReservation($serviceManager, $id) {
//d($serviceManager);
// echo 'in payment'; die;
        if ($serviceManager) {
            $model = $serviceManager->get('Reseller');

//d($id);
            return $model->getViewReservation($id);
        }
        return false;
    }

}
