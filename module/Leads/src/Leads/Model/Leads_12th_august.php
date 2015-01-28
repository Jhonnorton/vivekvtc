<?php

namespace Leads\Model;

use Zend\InputFilter\Factory as InputFactory;     // <-- Add this import
use Zend\InputFilter\InputFilter;                 // <-- Add this import
use Zend\InputFilter\InputFilterAwareInterface;   // <-- Add this import
use Zend\InputFilter\InputFilterInterface;        // <-- Add this import
use Sendmail\Controller\SendmailController;

class Leads extends \Base\Model\BaseModel implements InputFilterAwareInterface {

    protected $inputFilter;

    const RESORT_ROOM = 1;
    const EVENT_ROOM = 2;
    const CRUISE_CABIN = 3;

    //  const CANCELED = 0;
    //  const OPEN_BALANCE = 1;
    //  const CLOSED_BALANCE = 2;

    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Not used");
    }

    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory = new InputFactory();




            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

    public function isValidModel($form) {

        return true;
    }

    public function getCollection($startdate = null, $enddate = null, $page = false) {

        if (!empty($startdate) || !empty($enddate)) {

            If (!empty($startdate) && !empty($enddate)) {
                // echo "both condtn";die;

                $qury = "c.createdAt >= '$startdate' AND c.createdAt <= '$enddate' ";
            } else if (!empty($startdate) && empty($enddate)) {
                //  echo "start date condtn";die;
                $qury = "c.createdAt >= '$startdate'";
            } else if (empty($startdate) && !empty($enddate)) {
                //echo "end datte condtn";die;
                $qury = "c.createdAt <= '$enddate'";
            }



            $em = $this->getEntityManager();

            $em = $this->_serviceManager->get('doctrine.entitymanager.orm_avp');
            $qb = $em->createQueryBuilder();
            $qb->select('c')->from('\Base\Entity\Leads', 'c')
                    ->where($qury);
            /*     ->setParameter('id', $startdate)
              ->setParameter('endid', $enddate);
             */
            $query = $qb->getQuery();
            $collection = $query->getResult();

            // d($collection);
            //  die;
        } else {

            $collection = parent::getCollection($page);
        }



        $newCollection = array();
        foreach ($collection as $item) {
            //d($item->getId());
            $newCollection[$item->getId()] = array(
                'id' => $item->getId(),
                'name' => $item->getName(),
                'email' => $item->getEmail(),
                'phone' => $item->getPhone(),
                'roomid' => $item->getRoomId(),
                'Typename' => $item->getTypename(),
                'roomName' => $this->_getItemName($item->getTypename(), $item->getType()),
                'hotelName' => $this->_getHotelName($item->getTypename(), $item->getType()),
                'typeid' => $item->getType(),
                'type' => $this->_getType($item->getType()),
                'dateFrom' => $item->getDateFrom(),
                'dateTo' => $item->getDateTo(),
                'subject' => $item->getSubject(),
                'message' => $item->getmessage(),
                'lead' => $item,
                    //'roomid'=>$item->getRoomId(),
            );
        }
        // d($newCollection);
        return $newCollection;
    }

    public function getResort($startdate = null, $enddate = null, $page = false) {

        $em = $this->getEntityManager();
        $em = $this->_serviceManager->get('doctrine.entitymanager.orm_avp');
        $qb = $em->createQueryBuilder();

        if (!empty($startdate) || !empty($enddate)) {

            If (!empty($startdate) && !empty($enddate)) {
                //echo "both condtn";die;

                $qury = "c.createdAt >= '$startdate' AND c.createdAt <= '$enddate' ";
            } else if (!empty($startdate) && empty($enddate)) {
                //  echo "start date condtn";die;
                $qury = "c.createdAt >= '$startdate'";
            } else if (empty($startdate) && !empty($enddate)) {
                //echo "end datte condtn";die;
                $qury = "c.createdAt <= '$enddate'";
            }


            $qb->select('c')->from('\Base\Entity\Leads', 'c')
                    ->where($qury . "AND c.type=1");
            /*   ->setParameter('id', $startdate)
              ->setParameter('endid', $enddate);
             */


            // d($collection);
            //  die;
        } else {
            $qb->select('c')->from('\Base\Entity\Leads', 'c')
                    ->where('c.type=1');
            $collection = parent::getCollection($page);
        }

        $query = $qb->getQuery();
        $collection = $query->getResult();

        $newCollection = array();
        foreach ($collection as $item) {
            //d($item->getId());
            $newCollection[$item->getId()] = array(
                'id' => $item->getId(),
                'name' => $item->getName(),
                'email' => $item->getEmail(),
                'phone' => $item->getPhone(),
                'roomid' => $item->getRoomId(),
                'roomName' => $this->_getItemName($item->getTypename(), $item->getType()),
                'hotelName' => $this->_getHotelName($item->getTypename(), $item->getType()),
                'type' => $this->_getType($item->getType()),
                'dateFrom' => $item->getDateFrom(),
                'dateTo' => $item->getDateTo(),
                'subject' => $item->getSubject(),
                'message' => $item->getmessage(),
                'lead' => $item,
                    //'roomid'=>$item->getRoomId(),
            );
        }
        // d($newCollection);
        return $newCollection;
    }

    public function getCruise($startdate = null, $enddate = null, $page = false) {

        $em = $this->getEntityManager();
        $em = $this->_serviceManager->get('doctrine.entitymanager.orm_avp');
        $qb = $em->createQueryBuilder();

        if (!empty($startdate) || !empty($enddate)) {

            If (!empty($startdate) && !empty($enddate)) {
                //echo "both condtn";die;

                $qury = "c.createdAt >= '$startdate' AND c.createdAt <= '$enddate' ";
            } else if (!empty($startdate) && empty($enddate)) {
                //  echo "start date condtn";die;
                $qury = "c.createdAt >= '$startdate'";
            } else if (empty($startdate) && !empty($enddate)) {
                //echo "end datte condtn";die;
                $qury = "c.createdAt <= '$enddate'";
            }



            $qb->select('c')->from('\Base\Entity\Leads', 'c')
                    ->where($qury . 'AND c.type=3');
            /*  ->setParameter('id', $startdate)
              ->setParameter('endid', $enddate);
             */


            // d($collection);
            //  die;
        } else {
            $qb->select('c')->from('\Base\Entity\Leads', 'c')
                    ->where('c.type=3');
            $collection = parent::getCollection($page);
        }

        $query = $qb->getQuery();
        $collection = $query->getResult();

        $newCollection = array();
        foreach ($collection as $item) {
            //d($item->getId());
            $newCollection[$item->getId()] = array(
                'id' => $item->getId(),
                'name' => $item->getName(),
                'email' => $item->getEmail(),
                'phone' => $item->getPhone(),
                'roomid' => $item->getRoomId(),
                'roomName' => $this->_getItemName($item->getTypename(), $item->getType()),
                'hotelName' => $this->_getHotelName($item->getTypename(), $item->getType()),
                'type' => $this->_getType($item->getType()),
                'dateFrom' => $item->getDateFrom(),
                'dateTo' => $item->getDateTo(),
                'lead' => $item,
                    //'roomid'=>$item->getRoomId(),
            );
        }
        // d($newCollection);
        return $newCollection;
    }

    public function getEventLead($startdate = null, $enddate = null, $page = false) {

        $em = $this->getEntityManager();
        $em = $this->_serviceManager->get('doctrine.entitymanager.orm_avp');
        $qb = $em->createQueryBuilder();

        if (!empty($startdate) || !empty($enddate)) {


            If (!empty($startdate) && !empty($enddate)) {
                //echo "both condtn";die;

                $qury = "c.createdAt >= '$startdate' AND c.createdAt <= '$enddate' ";
            } else if (!empty($startdate) && empty($enddate)) {
                //  echo "start date condtn";die;
                $qury = "c.createdAt >= '$startdate'";
            } else if (empty($startdate) && !empty($enddate)) {
                //echo "end datte condtn";die;
                $qury = "c.createdAt <= '$enddate'";
            }


            $qb->select('c')->from('\Base\Entity\Leads', 'c')
                    ->where($qury . 'AND c.type=2');

            // d($collection);
            //  die;
        } else {
            $qb->select('c')->from('\Base\Entity\Leads', 'c')
                    ->where('c.type=2');
            $collection = parent::getCollection($page);
        }

        $query = $qb->getQuery();
        $collection = $query->getResult();

        $newCollection = array();
        foreach ($collection as $item) {
            //d($item->getId());
            $newCollection[$item->getId()] = array(
                'id' => $item->getId(),
                'name' => $item->getName(),
                'email' => $item->getEmail(),
                'phone' => $item->getPhone(),
                'roomid' => $item->getRoomId(),
                'roomName' => $this->_getItemName($item->getTypename(), $item->getType()),
                'hotelName' => $this->_getHotelName($item->getTypename(), $item->getType()),
                'type' => $this->_getType($item->getType()),
                'dateFrom' => $item->getDateFrom(),
                'dateTo' => $item->getDateTo(),
                'subject' => $item->getSubject(),
                'message' => $item->getmessage(),
                'lead' => $item,
                    //'roomid'=>$item->getRoomId(),
            );
        }
        // d($newCollection);
        return $newCollection;
    }

    protected function _getItemName($reservationId, $type) {

        $em = $this->getEntityManager();


        switch ($type) {
            case self::RESORT_ROOM:
                $item = $em->getRepository('\Base\Entity\InventoryHotels')->findOneBy(array('resortId' => $reservationId));
                $name = !is_null($item) ? $item->getRoomCategory() : null;
                break;
            case self::EVENT_ROOM:
                $item = $em->getRepository('\Base\Entity\InventoryEvent')->findOneBy(array('eventId' => $reservationId));
                $name = !is_null($item) ? $item->getRoomCategory() : null;

                break;
            case self::CRUISE_CABIN:
                $item = $em->getRepository('\Base\Entity\InventoryCruise')->findOneBy(array('cruiseId' => $reservationId));
                $name = !is_null($item) ? $item->getSuiteName() : null;
                break;
        }

        return $name;
    }

    protected function _getHotelName($reservationId, $type) {

        $em = $this->getEntityManager();


        switch ($type) {
            case self::RESORT_ROOM:
                $item = $em->getRepository('\Base\Entity\InventoryHotels')->findOneBy(array('resortId' => $reservationId));
                $name = !is_null($item) ? $item->gethotelName() : null;
                break;
            case self::EVENT_ROOM:
                $item = $em->getRepository('\Base\Entity\InventoryEvent')->findOneBy(array('eventId' => $reservationId));
                $name = !is_null($item) ? $item->getEventName() : null;
                break;
            case self::CRUISE_CABIN:
                $item = $em->getRepository('\Base\Entity\InventoryCruise')->findOneBy(array('cruiseId' => $reservationId));
                $name = !is_null($item) ? $item->getCruiseName() : null;
                break;
        }

        return $name;
    }

    protected function _getType($type) {

        switch ($type) {
            case self::RESORT_ROOM:
                $type = 'Resort';
                break;
            case self::EVENT_ROOM:
                $type = 'Event';
                break;
            case self::CRUISE_CABIN:
                $type = 'Cruise';
                break;
        }

        return $type;
    }

    public function save($object) {
        //   $em = $this->getEntityManager();
        //  print_r($em);
        // die;
        $entity = new \Base\Entity\Leads();
       // d($object); die;
        //  print_r($entity);
        //die;
        $entity->setName($object['contactname']);
        $entity->setType($object['type']);
        $entity->setEmail($object['email']);
        $entity->setPhone($object['phone']);

        if (!empty($object['resortId']) && !empty($object['roomCategory'])) {

            $em = $this->getEntityManager();

            $item = $em->getRepository('\Base\Entity\InventoryHotels')->findOneBy(array('id' => $object['roomCategory']));

          //  d($item);
            $entity->setRoomId($item->getRoomId()->getId());
            $entity->setTypename($object['resortId']);
        } else if (!empty($object['eventId']) && !empty($object['roomCategory'])) {

            $em = $this->getEntityManager();

            $item = $em->getRepository('\Base\Entity\InventoryEvent')->findOneBy(array('id' => $object['roomCategory']));
//d($item);
            //d($item->getRoomId()->getId());
            $entity->setRoomId($item->getRoomId()->getId());
            // $entity->setRoomId($object['roomCategory']);
            $entity->setTypename($object['eventId']);
        } else if (!empty($object['cruiseId']) && !empty($object['suiteName'])) {
            $em = $this->getEntityManager();
            $item = $em->getRepository('\Base\Entity\InventoryCruise')->findOneBy(array('id' => $object['suiteName']));

           // d($item);
            $entity->setRoomId($item->getSuiteId()->getId());
            $entity->setTypename($object['cruiseId']);
        }


        $entity->setSubject($object['subject']);
        $entity->setMessage($object['message']);
        $entity->setStatus(1);
        $entity->setDateFrom(new \DateTime($object['travelFrom']));
        $entity->setDateTo(new \DateTime($object['travelTo']));
        $entity->setCreatedAt(new \DateTime);
        $entity->setUpdatedAt(new \DateTime);

        $entity->setReminderType($object['remindertype']);
        $entity->setReminderDate(new \DateTime($object['reminderDate']));
        $entity->setSubjectReminder($object['subjectReminder']);
        $entity->setMessageReminder($object['messageReminder']);
        /*  echo "<pre>";
          print_r($entity);
          die; */
        parent::save($entity);
        /*    echo "<pre>";
          print_r($entity);
          die;

          $object->setHotelName($item[0]['hotelName']);
          $object->setResortId($item[0]['resortId']);
          $object->setEventName($item[0]['eventName']);

          parent::save($object); */
    }

    public function getItemView($id) {

        $collection = $this->getCollection();

        return $collection[$id];
    }

    public function sendmail($id, $to, array $params = null) {

        //   echo "hello"; die;
        $data[] = "Hello Guys";
        if ($data) {
            return SendmailController::sendMailOnReservation($this->_serviceManager, $to, $data, $params, 'dsadsads');
        }
        return true;
    }

    public function sendmailnew($to, $subject, $message, $cc, array $params = null) {

        //echo "sendmailnew"; die;

        return SendmailController::sendMailOnLead($this->_serviceManager, $to, $subject, $message, $cc);

        return true;
    }

    public function update($object) {

        // d($object);
        $em = $this->getEntityManager();
        $entity = $em->find('Base\Entity\Leads', (int) $object['id']);
        $entity->setName($object['clientname']);
        $entity->setType($object['type']);
        $entity->setEmail($object['toemail']);
        $entity->setPhone($object['clientphone']);


        $entity->setRoomId($object['roomid']);
        $entity->setTypename($object['Typename']);

        $entity->setSubject($object['subject']);
        $entity->setMessage(htmlentities($object['message']));
        //$entity->setMessage($object['message']);
        $entity->setStatus(1);
        $entity->setDateFrom(new \DateTime($data['dateFrom']));
        $entity->setDateTo(new \DateTime($data['dateTo']));
        $entity->setCreatedAt(new \DateTime);
        $entity->setUpdatedAt(new \DateTime);

        parent::save($entity);

        //  d('success');
    }
    
      public function sendquote($to,$data = null,array $params = null) {
        
        $leadid=$data[0]['id'];
        $em = $this->getEntityManager();
        $entity = $em->find('Base\Entity\Leads', (int)$leadid);
        $entity->setStatus(2);
        $entity->setUpdatedAt(new \DateTime);

        parent::save($entity);
          
          
        return SendmailController::sendMailOnQuote($this->_serviceManager,$to, $data, $params, 'Quote');

        
        return true;
    }

}