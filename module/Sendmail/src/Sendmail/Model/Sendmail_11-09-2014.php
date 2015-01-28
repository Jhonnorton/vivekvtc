<?php

namespace Sendmail\Model;

use Zend\InputFilter\Factory as InputFactory;     // <-- Add this import
use Zend\InputFilter\InputFilter;                 // <-- Add this import
use Zend\InputFilter\InputFilterAwareInterface;   // <-- Add this import
use Zend\InputFilter\InputFilterInterface;        // <-- Add this import
use Zend\View\Model\ViewModel;
use Sendmail\Model\Plugin\SendMailHelper;

class Sendmail extends \Base\Model\BaseModel implements InputFilterAwareInterface {

    const RESORT_ROOM = 1;
    const EVENT_ROOM = 2;
    const CRUISE_CABIN = 3;
    const CANCELED = 0;
    const OPEN_BALANCE = 1;
    const CLOSED_BALANCE = 2;

    protected $inputFilter;

    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Not used");
    }

    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory = new InputFactory();


            $inputFilter->add($factory->createInput(array(
                        'name' => 'name',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => 3,
                                    'max' => 50,
                                ),
                            ),
                        ),
            )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'header',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => 6,
                                ),
                            ),
                        ),
            )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'footer',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => 6,
                                ),
                            ),
                        ),
            )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'message',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => 6,
                                ),
                            ),
                        ),
            )));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

    protected function isValidName($object) {
        if ($this->checkItem(array('name' => $object->getData()->getName()))) {
            $object->get('name')->setMessages(array('Sendmail with this name already exists'));
            return false;
        }
        return true;
    }

    public function isValidModel($object) {
        return $this->isValidName($object);
    }

    public function isValidModelOnEdit($object) {
        if ($this->checkItem(array(
                    'id' => $object->getData()->getId(),
                    'name' => $object->getData()->getName()))
        ) {
            return true;
        }
        return $this->isValidName($object);
    }

    public function getContent($id) {
        $sendmailHelper = new Plugin\SendMailHelper($this->_serviceManager);
        $where = array(
            'id' => $id,
        );
        $data = array();
        $content = $sendmailHelper->getContent($where, $data);
        return $content;
    }

    public function save($object) {

        if ($object->getAction()) {
            $item = $this->getItemBy(array('action' => $object->getAction()), true);
            if (isset($item)) {
                $item->setAction(0);
                parent::save($item);
            }
        }
        parent::save($object);
    }

    public function update($object) {
        if ($object->getAction()) {
            $item = $this->getItemBy(array('action' => $object->getAction()), true);
            if (isset($item)) {
                if ($object->getId() != $item->getId()) {
                    $item->setAction(0);
                    parent::save($item);
                }
            }
        }
        parent::save($object);
    }

    public function getSendmailCollection($page = false) {

        return parent::getCollection($page);
    }

    public function sendMailOnEdit($to, array $data) {
        $sendmailHelper = new SendMailHelper($this->_serviceManager);
        $where = array(
            'action' => SendMailHelper::RESERVATION,
        );
        $emailData = array(
            'title' => 'Reservation',
            'data' => $data,
        );
        $isSend = $sendmailHelper->sendEmail(SendMailHelper::FROM, $to, $emailData['title'], $emailData, $where);
        return $isSend;
    }

    protected function _getItemName($reservationId, $type) {

        $em = $this->getEntityManager();


        switch ($type) {
            case self::RESORT_ROOM:
                $item = $em->getRepository('\Base\Entity\ReservationResortRoom')->findOneBy(array('reservation' => $reservationId));
                $name = !is_null($item) ? $item->getRoom() : null;
                break;
            case self::EVENT_ROOM:
                $item = $em->getRepository('\Base\Entity\ReservationEventRoom')->findOneBy(array('reservation' => $reservationId));
                $name = !is_null($item) ? $item->getEventRoom() : null;

                break;
            case self::CRUISE_CABIN:
                $item = $em->getRepository('\Base\Entity\ReservationCruiseCabin')->findOneBy(array('reservation' => $reservationId));
                $name = !is_null($item) ? $item->getCabin() : null;
                break;
        }

        return $name;
    }

    public function getTravellers($reservationId) {

        $em = $this->getEntityManager();

        $travellers = array();

        $collection = $em->getRepository('\Base\Entity\ReservationTravellers')->findBy(array('reservation' => $reservationId));

        //   d($collection[0]->getTraveller());

        return $collection[0]->getTraveller();
    }

    public function sendMailOnReservation($to, array $data, $subject, array $params = null) {
        // d($to);

        $viewRender = $this->_serviceManager->get("ViewRenderer");
        $viewModel = new ViewModel();
        $viewModel->setTemplate("template/templates/reservation1.phtml");
        if ($data) {
            $viewModel->setVariable('data', $data);


            if ($data['reservation']->getAffiliateId()) {

                $affliate = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Affiliates')->findOneBy(array('id' => $data['reservation']->getAffiliateId()));
                $affliatename = $affliate->getName();
                //  d($affliatename);
                $viewModel->setVariable('affliatename', $affliatename);
            }

            $invoice = $this->getEntityManager()->getRepository('\Base\Entity\Avp\OrderInvoices')->findBy(array('orderId' => $data['reservation']->getId()));
            // d($invoice[0]);

            $viewModel->setVariable('invoice', $invoice[0]);



            $itemname = $this->_getItemName($data['reservation']->getId(), $data['reservation']->getType());

            $type = $data['reservation']->getType();
            $viewModel->setVariable('itemname', $itemname);

            $traveller = $this->getTravellers($data['reservation']->getId());
            $viewModel->setVariable('clientdetail', $traveller);
            // d($traveller);

            if ($type == 2) {
                if ($itemname->getRoomId()->getResortId()) {
                    $resort = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Resorts')->findOneBy(array('id' => $itemname->getRoomId()->getResortId()));
                    $country = $this->getEntityManager()->getRepository('Base\Entity\Countries')->findOneBy(array('id' => $resort->getCountryId()));
                    //  d($itemname);
                    $eventName = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Events')->findOneBy(array('id' => $itemname->getEventId()));
                    //d( $itemname);
                    $inventorydetails = $this->getEntityManager()->getRepository('\Base\Entity\InventoryEvent')->findOneBy(array('eventId' => $itemname->getEventId(), 'roomId' => $itemname->getId(), 'resortId' => $resort->getId()));
                    //   d($inventoryevent);
                    if ($country) {
                        $viewModel->setVariable('country', $country->getCountryName());
                    } else {
                        $viewModel->setVariable('country', 'N/A');
                    }
                    $viewModel->setVariable('resorts', $resort);
                    $viewModel->setVariable('eventname', $eventName->getTitle());
                    $viewModel->setVariable('inventorydetails', $inventorydetails);

                    //d($country);
                    //    $country=$this->_getItemName($data['reservation']->getId(),$data['reservation']->getType());
                }
            }

            if ($type == 1) {
                if ($itemname->getResortId()) {
                    $resort = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Resorts')->findOneBy(array('id' => $itemname->getResortId()));
                    $country = $this->getEntityManager()->getRepository('Base\Entity\Countries')->findOneBy(array('id' => $resort->getCountryId()));

                    $inventorydetails = $this->getEntityManager()->getRepository('\Base\Entity\InventoryHotels')->findOneBy(array('resortId' => $resort->getId(), 'roomId' => $itemname->getId()));

                    if ($country) {
                        $viewModel->setVariable('country', $country->getCountryName());
                    } else {
                        $viewModel->setVariable('country', 'N/A');
                    }
                    $viewModel->setVariable('resorts', $resort);
                    $viewModel->setVariable('inventorydetails', $inventorydetails);

                    //d($country);
                    //    $country=$this->_getItemName($data['reservation']->getId(),$data['reservation']->getType());
                }
            }

            if ($type == 3) {
                $cruise = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Cruises')->findOneBy(array('id' => $itemname->getCruiseId()));
                $country = $this->getEntityManager()->getRepository('Base\Entity\Countries')->findOneBy(array('id' => $cruise->getCountryId()));

                $inventorydetails = $this->getEntityManager()->getRepository('\Base\Entity\InventoryCruise')->findOneBy(array('cruiseId' => $cruise->getId(), 'suiteId' => $itemname->getId()));
                $viewModel->setVariable('inventorydetails', $inventorydetails);


                if ($country) {
                    $viewModel->setVariable('country', $country->getCountryName());
                } else {
                    $viewModel->setVariable('country', "N/A");
                }
                $viewModel->setVariable('cruise', $cruise);
            }
        }

        $html = $viewRender->render($viewModel);
        // echo $html;die;
        $sendmail = $this->getItemBy(array('action' => SendMailHelper::RESERVATION), true);
        $viewModel->data = $data;

        // d($data);
        if ($params) {
            foreach ($params as $key => $value) {
                $viewModel->__set($key, $value);
            }
        }
        if ($sendmail) {
            $viewModel->header = htmlspecialchars_decode($sendmail->getHeader());
            $viewModel->footer = htmlspecialchars_decode($sendmail->getFooter());
            $viewModel->message = htmlspecialchars_decode($sendmail->getMessage());
        }
        $html = $viewRender->render($viewModel);

      //  echo "<pre>";
        //print_r($html);
        //die;


        $from = SendMailHelper::FROM;

        return Plugin\SendMail::sendMail($from, $to, $subject, $html);
    }

    public function sendMail($to, array $data, $subject, $template, $action, array $params = null) {
        $viewRender = $this->_serviceManager->get("ViewRenderer");
        $viewModel = new ViewModel();
        $viewModel->setTemplate($template);
        $sendmail = $this->getItemBy(array('action' => $action), true);
        $viewModel->data = $data;
        if ($params) {
            foreach ($params as $key => $value) {
                $viewModel->__set($key, $value);
            }
        }


        if ($sendmail) {
            $viewModel->header = htmlspecialchars_decode($sendmail->getHeader());
            $viewModel->footer = htmlspecialchars_decode($sendmail->getFooter());
            $viewModel->message = htmlspecialchars_decode($sendmail->getMessage());
        }
        $html = $viewRender->render($viewModel);
        $from = SendMailHelper::FROM;

        return Plugin\SendMail::sendMail($from, $to, $subject, $html);
    }

    public function sendMailOnLead($to, $subject, $message, $cc=NULL) {
        $viewRender = $this->_serviceManager->get("ViewRenderer");
        $viewModel = new ViewModel();
        $viewModel->setTemplate("lead-template");
        //  $sendmail = $this->getItemBy(array('action'=> SendMailHelper::Reservation), true);
        // d($cc);
        //     d($subject);
        $viewModel->data = $data;
        /*    if($params){
          foreach ($params as $key => $value) {
          $viewModel->__set($key, $value);
          }
          } */
        /*  if($sendmail){            
          $viewModel->header = htmlspecialchars_decode($sendmail->getHeader());
          $viewModel->footer = htmlspecialchars_decode($sendmail->getFooter());
          $viewModel->message = htmlspecialchars_decode($sendmail->getMessage());
          } */
        $html = $viewRender->render($viewModel);

        // d($html);
        $from = SendMailHelper::FROM;
        //    $to="test@mailinator.com ";
        return Plugin\SendMail::sendMail($from, $to, $subject, $message, $cc);
    }

    
    public function sendMailToClient($to, $subject, $message) {
        
        //d($to);
       
        $viewRender = $this->_serviceManager->get("ViewRenderer");
        $viewModel = new ViewModel();
        $viewModel->setTemplate("lead-template");
        //  $sendmail = $this->getItemBy(array('action'=> SendMailHelper::Reservation), true);
        // d($cc);
        //     d($subject);
        //$viewModel->data = $data;
        /*    if($params){
          foreach ($params as $key => $value) {
          $viewModel->__set($key, $value);
          }
          } */
        /*  if($sendmail){            
          $viewModel->header = htmlspecialchars_decode($sendmail->getHeader());
          $viewModel->footer = htmlspecialchars_decode($sendmail->getFooter());
          $viewModel->message = htmlspecialchars_decode($sendmail->getMessage());
          } */
        $html = $viewRender->render($viewModel);

        // d($html);
        $from = SendMailHelper::FROM;
        //    $to="test@mailinator.com ";
        return Plugin\SendMail::sendMail($from, $to, $subject, $message);
    }
    
    public function sendReceiptToClient($to, $subject, $receipt) {
        
        $viewRender = $this->_serviceManager->get("ViewRenderer");
        $viewModel = new ViewModel();
        $viewModel->setTemplate("template/templates/receipt.phtml");
        $viewModel->setVariable('receipt', $receipt);
        
        $html = $viewRender->render($viewModel);
        //d($html);
        //echo "<pre>";        print_r($html);
        
        $from = SendMailHelper::FROM;
        return Plugin\SendMail::sendMail($from, $to, $subject, $html);
    }
    
    
    public function sendMailOnDue($to, $subject, array $params = null) {
        $viewRender = $this->_serviceManager->get("ViewRenderer");
        $viewModel = new ViewModel();
        $viewModel->setTemplate('template/templates/reservation1.phtml');
        $sendmail = $this->getItemBy(array('action' => $action), true);
        $viewModel->data = $data;
        if ($params) {
            foreach ($params as $key => $value) {
                $viewModel->__set($key, $value);
            }
        }
        if ($sendmail) {
            $viewModel->header = htmlspecialchars_decode($sendmail->getHeader());
            $viewModel->footer = htmlspecialchars_decode($sendmail->getFooter());
            $viewModel->message = htmlspecialchars_decode($sendmail->getMessage());
        }
        $html = $viewRender->render($viewModel);
        $from = SendMailHelper::FROM;

        return Plugin\SendMail::sendMail($from, $to, $subject, $html);

        //return Plugin\SendMail::sendMail($from, $to, $subject, $message,$cc);
    }

    public function getPaymentdues($reservationId) {
        //   d('here');
        $em = $this->getEntityManager();

        $paymentDue = array();



        $datebefore7days = date('Y-m-d', strtotime('7 days'));
        $datetoday = date('Y-m-d');

        $dateafter7days = date('Y-m-d', strtotime('-7 days'));

        $qb = $em->createQueryBuilder();
        $qb->select('c')->from('\Base\Entity\ReservationPaymentDue', 'c')
                ->where('c.reservation= :reservation')
                ->setParameter('reservation', $reservationId)
                ->andWhere('c.dueDate BETWEEN :id AND :endid')
                ->setParameter('id', $dateafter7days)
                ->setParameter('endid', $datebefore7days)
                ->andWhere('c.status=0');

        $query = $qb->getQuery();
        $results = $query->getResult();

//       d($results);
        return $results;
    }

    public function sendMailOnReminder($to, $id, $subject, array $params = null) {
        // d($to);

        $viewRender = $this->_serviceManager->get("ViewRenderer");
        $viewModel = new ViewModel();
        $viewModel->setTemplate("template/templates/paymentdue.phtml");
        $data['reservation'] = $this->getEntityManager()->getRepository('\Base\Entity\Reservation')->findOneBy(array('id' => $id));

        $paymentdue = $this->getPaymentdues($id);
        $viewModel->setVariable('paymentdue', $paymentdue[0]);
        // d($paymentdue);

        if ($data) {
            $viewModel->setVariable('data', $data);
            if ($data['reservation']->getAffiliateId()) {

                $affliate = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Affiliates')->findOneBy(array('id' => $data['reservation']->getAffiliateId()));
                $affliatename = $affliate->getName();
                //d($affliatename);
                $viewModel->setVariable('affliatename', $affliatename);
            }

            $invoice = $this->getEntityManager()->getRepository('\Base\Entity\Avp\OrderInvoices')->findBy(array('orderId' => $data['reservation']->getId()));
            $viewModel->setVariable('invoice', $invoice[0]);


            $itemname = $this->_getItemName($data['reservation']->getId(), $data['reservation']->getType());

            $type = $data['reservation']->getType();
            $viewModel->setVariable('itemname', $itemname);

            $traveller = $this->getTravellers($data['reservation']->getId());
            $viewModel->setVariable('clientdetail', $traveller);




            if ($type == 2) {
                if ($itemname->getRoomId()->getResortId()) {
                    $resort = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Resorts')->findOneBy(array('id' => $itemname->getRoomId()->getResortId()));
                    $country = $this->getEntityManager()->getRepository('Base\Entity\Countries')->findOneBy(array('id' => $resort->getCountryId()));

                    if ($country) {
                        $viewModel->setVariable('country', $country->getCountryName());
                    } else {
                        $viewModel->setVariable('country', 'N/A');
                    }
                    $viewModel->setVariable('resorts', $resort);
                    //d($country);
                    //    $country=$this->_getItemName($data['reservation']->getId(),$data['reservation']->getType());
                }
            }

            if ($type == 1) {
                if ($itemname->getResortId()) {
                    $resort = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Resorts')->findOneBy(array('id' => $itemname->getResortId()));
                    $country = $this->getEntityManager()->getRepository('Base\Entity\Countries')->findOneBy(array('id' => $resort->getCountryId()));
                    if ($country) {
                        $viewModel->setVariable('country', $country->getCountryName());
                    } else {
                        $viewModel->setVariable('country', 'N/A');
                    }
                    $viewModel->setVariable('resorts', $resort);
                    //d($country);
                    //    $country=$this->_getItemName($data['reservation']->getId(),$data['reservation']->getType());
                }
            }

            if ($type == 3) {
                $cruise = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Cruises')->findOneBy(array('id' => $itemname->getCruiseId()));
                $country = $this->getEntityManager()->getRepository('Base\Entity\Countries')->findOneBy(array('id' => $cruise->getCountryId()));
                if ($country) {
                    $viewModel->setVariable('country', $country->getCountryName());
                } else {
                    $viewModel->setVariable('country', "N/A");
                }
                $viewModel->setVariable('cruise', $cruise);
            }
        }
        $html = $viewRender->render($viewModel);
        $sendmail = $this->getItemBy(array('action' => SendMailHelper::RESERVATION), true);
        $viewModel->data = $data;

        // d($data);
        if ($params) {
            foreach ($params as $key => $value) {
                $viewModel->__set($key, $value);
            }
        }
        if ($sendmail) {
            $viewModel->header = htmlspecialchars_decode($sendmail->getHeader());
            $viewModel->footer = htmlspecialchars_decode($sendmail->getFooter());
            $viewModel->message = htmlspecialchars_decode($sendmail->getMessage());
        }
        $html = $viewRender->render($viewModel);

        //d($html);
        $from = SendMailHelper::FROM;

        return Plugin\SendMail::sendMail($from, $to, $subject, $html);
    }

    public function sendMailOnInvoice($to, array $data, $subject) {
        //d($data[0]);

        $viewRender = $this->_serviceManager->get("ViewRenderer");
        $viewModel = new ViewModel();
        $viewModel->setTemplate("template/templates/sendinvoice.phtml");

        if ($data) {
            $viewModel->setVariable('collection', $data);
        }





        $html = $viewRender->render($viewModel);
        $sendmail = $this->getItemBy(array('action' => SendMailHelper::RESERVATION), true);
        $viewModel->data = $data;

        //  d($data);



        if ($sendmail) {
            $viewModel->header = htmlspecialchars_decode($sendmail->getHeader());
            $viewModel->footer = htmlspecialchars_decode($sendmail->getFooter());
            $viewModel->message = htmlspecialchars_decode($sendmail->getMessage());
        }
        $html = $viewRender->render($viewModel);
        // echo '<pre>'; print_r($html);
        //d($html);
        //  $to="anup007@mailinator.com";
        $from = SendMailHelper::FROM;

        return Plugin\SendMail::sendMail($from, $to, $subject, $html);
    }

    public function sendMailOnQuote($to, $clientname, array $data = null, array $params = null, $messagebody = null, $subject) {

        // d($params);
        $viewRender = $this->_serviceManager->get("ViewRenderer");
        $viewModel = new ViewModel();
        $viewModel->setTemplate("template/templates/sendquote.phtml");

        if ($data) {
            $viewModel->setVariable('collection', $data);
        }
        $viewModel->setVariable('clientName', $clientname);
        $viewModel->setVariable('bodymessage', $messagebody);
        if ($params) {
            foreach ($params as $key => $value) {
                $viewModel->__set($key, $value);
            }
        }




        $html = $viewRender->render($viewModel);
        $sendmail = $this->getItemBy(array('action' => SendMailHelper::RESERVATION), true);
        $viewModel->data = $data;


        if ($sendmail) {
            $viewModel->header = htmlspecialchars_decode($sendmail->getHeader());
            $viewModel->footer = htmlspecialchars_decode($sendmail->getFooter());
            $viewModel->message = htmlspecialchars_decode($sendmail->getMessage());
        }
        $html = $viewRender->render($viewModel);
        //  echo "<pre>";        print_r($html)    ;
        $from = SendMailHelper::FROM;

        return Plugin\SendMail::sendMail($from, $to, $subject, $html);
    }

    public function sendMailOnReservationPending($to, array $data, $subject, array $params = null) {
        // d($to);

        $viewRender = $this->_serviceManager->get("ViewRenderer");
        $viewModel = new ViewModel();
        $viewModel->setTemplate("template/templates/reservationpending.phtml");
        if ($data) {
            $viewModel->setVariable('data', $data);


            if ($data['reservation']->getAffiliateId()) {

                $affliate = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Affiliates')->findOneBy(array('id' => $data['reservation']->getAffiliateId()));
                $affliatename = $affliate->getName();
                //  d($affliatename);
                $viewModel->setVariable('affliatename', $affliatename);
            }

            $invoice = $this->getEntityManager()->getRepository('\Base\Entity\Avp\OrderInvoices')->findBy(array('orderId' => $data['reservation']->getId()));
            // d($invoice[0]);

            $viewModel->setVariable('invoice', $invoice[0]);



            $itemname = $this->_getItemName($data['reservation']->getId(), $data['reservation']->getType());

            $type = $data['reservation']->getType();
            $viewModel->setVariable('itemname', $itemname);

            $traveller = $this->getTravellers($data['reservation']->getId());

            $viewModel->setVariable('clientdetail', $traveller);
            // d($traveller);

            if ($type == 2) {
                if ($itemname->getRoomId()->getResortId()) {
                    $resort = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Resorts')->findOneBy(array('id' => $itemname->getRoomId()->getResortId()));
                    $country = $this->getEntityManager()->getRepository('Base\Entity\Countries')->findOneBy(array('id' => $resort->getCountryId()));

                    if ($country) {
                        $viewModel->setVariable('country', $country->getCountryName());
                    } else {
                        $viewModel->setVariable('country', 'N/A');
                    }
                    $viewModel->setVariable('resorts', $resort);
                    //d($country);
                    //    $country=$this->_getItemName($data['reservation']->getId(),$data['reservation']->getType());
                }
            }

            if ($type == 1) {
                if ($itemname->getResortId()) {
                    $resort = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Resorts')->findOneBy(array('id' => $itemname->getResortId()));
                    $country = $this->getEntityManager()->getRepository('Base\Entity\Countries')->findOneBy(array('id' => $resort->getCountryId()));
                    if ($country) {
                        $viewModel->setVariable('country', $country->getCountryName());
                    } else {
                        $viewModel->setVariable('country', 'N/A');
                    }
                    $viewModel->setVariable('resorts', $resort);
                    //d($country);
                    //    $country=$this->_getItemName($data['reservation']->getId(),$data['reservation']->getType());
                }
            }

            if ($type == 3) {
                $cruise = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Cruises')->findOneBy(array('id' => $itemname->getCruiseId()));
                $country = $this->getEntityManager()->getRepository('Base\Entity\Countries')->findOneBy(array('id' => $cruise->getCountryId()));
                if ($country) {
                    $viewModel->setVariable('country', $country->getCountryName());
                } else {
                    $viewModel->setVariable('country', "N/A");
                }
                $viewModel->setVariable('cruise', $cruise);
            }
        }

        $html = $viewRender->render($viewModel);
        // echo $html;die;
        $sendmail = $this->getItemBy(array('action' => SendMailHelper::RESERVATION), true);
        $viewModel->data = $data;

        // d($data);
        if ($params) {
            foreach ($params as $key => $value) {
                $viewModel->__set($key, $value);
            }
        }
        if ($sendmail) {
            $viewModel->header = htmlspecialchars_decode($sendmail->getHeader());
            $viewModel->footer = htmlspecialchars_decode($sendmail->getFooter());
            $viewModel->message = htmlspecialchars_decode($sendmail->getMessage());
        }
        $html = $viewRender->render($viewModel);

        //d($html);
        // echo "<pre>";
        //print_r($html); die;
        $from = SendMailHelper::FROM;

        return Plugin\SendMail::sendMail($from, $to, $subject, $html);
    }
    
     public function sendMailOnQuoteReservation($to, array $data, $subject, array $params = null) {
        // d($to);

        $viewRender = $this->_serviceManager->get("ViewRenderer");
        $viewModel = new ViewModel();
        $viewModel->setTemplate("template/templates/quotereservation.phtml");
        if ($data) {
            $viewModel->setVariable('data', $data);


            if ($data['reservation']->getAffiliateId()) {

                $affliate = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Affiliates')->findOneBy(array('id' => $data['reservation']->getAffiliateId()));
                $affliatename = $affliate->getName();
                //  d($affliatename);
                $viewModel->setVariable('affliatename', $affliatename);
            }

            $invoice = $this->getEntityManager()->getRepository('\Base\Entity\Avp\OrderInvoices')->findBy(array('orderId' => $data['reservation']->getId()));
            // d($invoice[0]);

            $viewModel->setVariable('invoice', $invoice[0]);



            $itemname = $this->_getItemName($data['reservation']->getId(), $data['reservation']->getType());

            $type = $data['reservation']->getType();
            $viewModel->setVariable('itemname', $itemname);

            $traveller = $this->getTravellers($data['reservation']->getId());
            $viewModel->setVariable('clientdetail', $traveller);
            // d($traveller);

            if ($type == 2) {
                if ($itemname->getRoomId()->getResortId()) {
                    $resort = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Resorts')->findOneBy(array('id' => $itemname->getRoomId()->getResortId()));
                    $country = $this->getEntityManager()->getRepository('Base\Entity\Countries')->findOneBy(array('id' => $resort->getCountryId()));
                    //  d($itemname);
                    $eventName = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Events')->findOneBy(array('id' => $itemname->getEventId()));
                    //d( $itemname);
                    $inventorydetails = $this->getEntityManager()->getRepository('\Base\Entity\InventoryEvent')->findOneBy(array('eventId' => $itemname->getEventId(), 'roomId' => $itemname->getId(), 'resortId' => $resort->getId()));
                    //   d($inventoryevent);
                    if ($country) {
                        $viewModel->setVariable('country', $country->getCountryName());
                    } else {
                        $viewModel->setVariable('country', 'N/A');
                    }
                    $viewModel->setVariable('resorts', $resort);
                    $viewModel->setVariable('eventname', $eventName->getTitle());
                    $viewModel->setVariable('inventorydetails', $inventorydetails);

                    //d($country);
                    //    $country=$this->_getItemName($data['reservation']->getId(),$data['reservation']->getType());
                }
            }

            if ($type == 1) {
                if ($itemname->getResortId()) {
                    $resort = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Resorts')->findOneBy(array('id' => $itemname->getResortId()));
                    $country = $this->getEntityManager()->getRepository('Base\Entity\Countries')->findOneBy(array('id' => $resort->getCountryId()));

                    $inventorydetails = $this->getEntityManager()->getRepository('\Base\Entity\InventoryHotels')->findOneBy(array('resortId' => $resort->getId(), 'roomId' => $itemname->getId()));

                    if ($country) {
                        $viewModel->setVariable('country', $country->getCountryName());
                    } else {
                        $viewModel->setVariable('country', 'N/A');
                    }
                    $viewModel->setVariable('resorts', $resort);
                    $viewModel->setVariable('inventorydetails', $inventorydetails);

                    //d($country);
                    //    $country=$this->_getItemName($data['reservation']->getId(),$data['reservation']->getType());
                }
            }

            if ($type == 3) {
                $cruise = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Cruises')->findOneBy(array('id' => $itemname->getCruiseId()));
                $country = $this->getEntityManager()->getRepository('Base\Entity\Countries')->findOneBy(array('id' => $cruise->getCountryId()));

                $inventorydetails = $this->getEntityManager()->getRepository('\Base\Entity\InventoryCruise')->findOneBy(array('cruiseId' => $cruise->getId(), 'suiteId' => $itemname->getId()));
                $viewModel->setVariable('inventorydetails', $inventorydetails);


                if ($country) {
                    $viewModel->setVariable('country', $country->getCountryName());
                } else {
                    $viewModel->setVariable('country', "N/A");
                }
                $viewModel->setVariable('cruise', $cruise);
            }
        }

        $html = $viewRender->render($viewModel);
        // echo $html;die;
        $sendmail = $this->getItemBy(array('action' => SendMailHelper::RESERVATION), true);
        $viewModel->data = $data;

        // d($data);
        if ($params) {
            foreach ($params as $key => $value) {
                $viewModel->__set($key, $value);
            }
        }
        if ($sendmail) {
            $viewModel->header = htmlspecialchars_decode($sendmail->getHeader());
            $viewModel->footer = htmlspecialchars_decode($sendmail->getFooter());
            $viewModel->message = htmlspecialchars_decode($sendmail->getMessage());
        }
        $html = $viewRender->render($viewModel);

      //  echo "<pre>";
        //print_r($html);
        //die;


        $from = SendMailHelper::FROM;

        return Plugin\SendMail::sendMail($from, $to, $subject, $html);
    }

}

