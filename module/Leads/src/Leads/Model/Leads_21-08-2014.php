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

    public function isValidImage($form, $files) {
        if (empty($files['image']['name']))
            return true;
        $size = (int) $files['image']['size'];
        if ($size == 0 || $this->_maxImageSize < $size) {
            $form->get('image')->setMessages(array('Max size 2 Mb'));
            return false;
        }
        $types = array('image/gif', 'image/png', 'image/jpeg', 'image/pjpeg');
        if (!in_array($files['image']['type'], $types)) {
            $form->get('image')->setMessages(array('Invalid file type. Upload images: *.gif, *.png, *.jpg'));
            return false;
        }
        return true;
    }

    protected function saveImages($tmpName, $imgName) {
        foreach ($this->_imageOptions as $imgOption) {
            \Base\Model\Plugins\Imagine::uploadImage($tmpName, $imgName, $imgOption['options'], $imgOption['destination']);
        }
    }

    protected function deleteImages($imageName) {
        foreach ($this->_imageOptions as $imgOption) {
            $file = \Base\Model\Plugins\Imagine::$srcDestination . $imgOption['destination'] . $imageName;
            if (file_exists($file)) {
                unlink($file);
            }
        }
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
                'roomName' => $this->_getItemName($item->getRoomId(), $item->getType()),
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
                'roomName' => $this->_getItemName($item->getRoomId(), $item->getType()),
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
                'roomName' => $this->_getItemName($item->getRoomId(), $item->getType()),
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
                'roomName' => $this->_getItemName($item->getRoomId(), $item->getType()),
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

    protected function _getItemName($roomId, $type) {

        $em = $this->getEntityManager();
//d($type);
        //d($roomId);
        switch ($type) {
            case self::RESORT_ROOM:
                $item = $em->getRepository('\Base\Entity\Avp\ResortRooms')->findOneBy(array('id' => $roomId));
                //  d($item);
                $name = !is_null($item) ? $item->getTitle() : null;
                break;
            case self::EVENT_ROOM:
                $item = $em->getRepository('\Base\Entity\Avp\EventRooms')->findOneBy(array('id' => $roomId));
                //d($item->getRoomId()->getTitle());

                $name = !is_null($item) ? $item->getRoomCategory() : null;

                break;
            case self::CRUISE_CABIN:
                $item = $em->getRepository('\Base\Entity\Avp\CruiseCabins')->findOneBy(array('id' => $roomId));
                $name = !is_null($item) ? $item->getDeckName() : null;
                //  d($item);
                break;
        }

        return $name;
    }

    protected function _getHotelName($resortid, $type) {

        $em = $this->getEntityManager();


        switch ($type) {
            case self::RESORT_ROOM:


                $na = $em->getRepository('\Base\Entity\Avp\Resorts')->findOneBy(array('id' => $resortid));

                $name = !is_null($na) ? $na->getTitle() : null;
                break;
            case self::EVENT_ROOM:

                $eventId = $resortid;
                $na = $em->getRepository('\Base\Entity\Avp\Events')->findOneBy(array('id' => $eventId));

                $name = !is_null($na) ? $na->getTitle() : null;
                break;
            case self::CRUISE_CABIN:

                $cruiseId = $resortid;
                $na = $em->getRepository('\Base\Entity\Avp\Cruises')->findOneBy(array('id' => $cruiseId));

                $name = !is_null($na) ? $na->getTitle() : null;
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

            //  $item = $em->getRepository('\Base\Entity\InventoryHotels')->findOneBy(array('id' => $object['roomCategory']));
            //  d($item);
            $entity->setRoomId($object['roomCategory']);
            $entity->setTypename($object['resortId']);
        } else if (!empty($object['eventId']) && !empty($object['roomCategory'])) {

            $em = $this->getEntityManager();

            // $item = $em->getRepository('\Base\Entity\InventoryEvent')->findOneBy(array('id' => $object['roomCategory']));
//d($item);
            //d($item->getRoomId()->getId());
            $entity->setRoomId($object['roomCategory']);
            // $entity->setRoomId($object['roomCategory']);
            $entity->setTypename($object['eventId']);
        } else if (!empty($object['cruiseId']) && !empty($object['suiteName'])) {
            $em = $this->getEntityManager();
            //  $item = $em->getRepository('\Base\Entity\InventoryCruise')->findOneBy(array('id' => $object['suiteName']));
            // d($item);
            $entity->setRoomId($object['suiteName']);
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

    public function sendquote($to, $clientname, $data = null, array $params = null, $message) {

        $leadid = $data[0]['id'];
        $em = $this->getEntityManager();
        $entity = $em->find('Base\Entity\Leads', (int) $leadid);
        $entity->setStatus(2);
        $entity->setUpdatedAt(new \DateTime);

        parent::save($entity);

//        d($params);
        return SendmailController::sendMailOnQuote($this->_serviceManager, $to, $clientname, $data, $params, $message, 'Quote Request Response');


        return true;
    }

    public function getRoomDetail($data) {

        $em = $this->getEntityManager();
        //d($data);
        $type = $data['leads']['typeid'];
        $roomId = $data['leads']['roomid'];
        switch ($type) {
            case self::RESORT_ROOM:
                $item = $em->getRepository('\Base\Entity\Avp\ResortRooms')->findOneBy(array('id' => $roomId));
                //   $name = !is_null($item) ? $item->getRoomCategory() : null;
                break;
            case self::EVENT_ROOM:
                $item = $em->getRepository('\Base\Entity\Avp\EventRooms')->findOneBy(array('id' => $roomId));
                //d($item->getRoomId()->getTitle());
                // $name = !is_null($item) ? $item->getRoomCategory() : null;

                break;
            case self::CRUISE_CABIN:
                $item = $em->getRepository('\Base\Entity\Avp\CruiseCabins')->findOneBy(array('id' => $roomId));
                // $name = !is_null($item) ? $item->getSuiteName() : null;
                break;
        }

        return $item;
    }

    public function getRooms($data) {
        //d($data);
        $em = $this->getEntityManager();
        $where = $data['leads']['Typename'];
        $type = $data['leads']['typeid'];
        //d($type);
        /* switch ($type) {
          case self::RESORT_ROOM:
          $item = $em->getRepository('\Base\Entity\Avp\ResortRooms')->findBy($where);
          break;
          case self::EVENT_ROOM:
          $item = $em->getRepository('\Base\Entity\Avp\EventRooms')->findOneBy(array('eventId' => $where));
          d($item);
          break;
          case self::CRUISE_CABIN:
          $item = $em->getRepository('\Base\Entity\Avp\CruiseCabins')->findBy($where);
          break;
          }
         */
        switch ($type) {
            ;
            case self::RESORT_ROOM:
                $item = $em->getRepository('\Base\Entity\Avp\ResortRooms')->findBy(array('resortId' => $where));
                // d($item);
                break;
            case self::EVENT_ROOM:

                $item = $em->getRepository('\Base\Entity\Avp\EventRooms')->findBy(array('eventId' => $where));

                break;
            case self::CRUISE_CABIN:
                $item = $em->getRepository('\Base\Entity\Avp\CruiseCabins')->findBy(array('cruiseId' => $where));
                // $name = !is_null($item) ? $item->getSuiteName() : null;
                break;
        }

        return $item;
    }

    public function quotesave($object) {
        //    d($object['files']);
        $files = $object['files'];
        $object = $object['object'];

        // d($files);     

        $em = $this->getEntityManager();
        $entity = new \Base\Entity\InventoryLeads;
        $leadid = $this->getEntityManager()->getRepository('\Base\Entity\Leads')->findOneBy(array('id' => $object['id']));
        $entity->setLeadId($leadid);

        $type = $object['type'];
        //  d($type);
        $entity->setType($type);
        switch ((int) $type) {

            case 1:
                $resortid = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Resorts')->findOneBy(array('id' => $object['dataTypeId']));
                $entity->setResortId($resortid);
                break;
            case 2:
                $eventid = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Events')->findOneBy(array('id' => $object['dataTypeId']));
                $entity->setEventId($eventid);
                break;
            case 3:
                $cruiseid = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Cruises')->findOneBy(array('id' => $object['dataTypeId']));
                $entity->setCruiseId($cruiseid);
                break;
        }

        $entity->setAccomodationDetails($object['accomodationDetails']);
        $entity->setNotes($object['notes']);
        $entity->setTravelFrom(new \DateTime($object['dateFrom']));
        $entity->setTravelTo(new \DateTime($object['dateTo']));

        $entity->setCreatedAt(new \DateTime);
        // $entity->setModified(new \DateTime);

        $em->persist($entity);
        $em->flush();



        $inventoryLeadId = $entity; //$this->getEntityManager()->getRepository('\Base\Entity\InventoryLeads')->findOneBy(array('id' => 1));

        $type = $object['type'];
        switch ((int) $type) {

            case 1:

                $rooms = count($object['roomCategory']);
                if ((int) $rooms > 0) {
                    for ($i = 0; $i < $rooms; $i++) {
                        if ($object['roomCategory'][$i]) {
                            $em = $this->getEntityManager();
                            $entity1 = new \Base\Entity\InventoryLeadRooms();
                            $entity1->setInventoryLeadId($inventoryLeadId);
                            $entity1->setType($type);
                            $resortRoom = $this->getEntityManager()->getRepository('\Base\Entity\Avp\ResortRooms')->findOneBy(array('id' => $object['roomCategory'][$i]));
                            $entity1->setResortRoomId($resortRoom);
                            $entity1->setPricePer($object['paymentType_' . $i]);
                            $entity1->setCost($object['cost'][$i]);
                            $date = getdate();
                            //d();
                            // d($files);
                            $entity1->setImage($date[0] . '-' . $files['image'][$i]['name']);

                            $entity1->setDescription($object['description'][$i]);
                            // $entity1->setDueDate(isset($data['dueDate1'][$i]) ? new \DateTime($data['dueDate1'][$i]) : null);

                            $entity1->setCreatedAt(new \DateTime);

                            $em->persist($entity1);
                            $em->flush();
                        }
                    }
                }


                break;
            case 2:
//d($object);
                $rooms = count($object['roomCategory']);
                if ((int) $rooms > 0) {
                    for ($i = 0; $i < $rooms; $i++) {
                        if ($object['roomCategory'][$i]) {
                            $em = $this->getEntityManager();
                            $entity1 = new \Base\Entity\InventoryLeadRooms();
                            $entity1->setInventoryLeadId($inventoryLeadId);
                            $entity1->setType($type);
                            $eventRoom = $this->getEntityManager()->getRepository('\Base\Entity\Avp\EventRooms')->findOneBy(array('id' => $object['roomCategory'][$i]));
                            //    d($eventRoom);
                            $entity1->setEventRoomId($eventRoom);


                            $entity1->setPricePer($object['paymentType_' . $i]);
                            $entity1->setCost($object['cost'][$i]);

                            $date = getdate();
                            $entity1->setImage($date[0] . '-' . $files['image'][$i]['name']);

                            $entity1->setDescription($object['description'][$i]);
                            // $entity1->setDueDate(isset($data['dueDate1'][$i]) ? new \DateTime($data['dueDate1'][$i]) : null);

                            $entity1->setCreatedAt(new \DateTime);

                            $em->persist($entity1);
                            $em->flush();
                        }
                    }
                }

                break;
            case 3:
                // d($object);
                $rooms = count($object['suiteName']);
                if ((int) $rooms > 0) {
                    for ($i = 0; $i < $rooms; $i++) {
                        if ($object['suiteName'][$i]) {
                            $em = $this->getEntityManager();
                            $entity1 = new \Base\Entity\InventoryLeadRooms();
                            $entity1->setInventoryLeadId($inventoryLeadId);
                            $entity1->setType($type);
                            $cruiseRoom = $this->getEntityManager()->getRepository('\Base\Entity\Avp\CruiseCabins')->findOneBy(array('id' => $object['suiteName'][$i]));
                            $entity1->setCruiseCabinId($cruiseRoom);
                            $entity1->setPricePer($object['paymentType_' . $i]);
                            $entity1->setCost($object['cost'][$i]);

                            $date = getdate();
                            $entity1->setImage($date[0] . '-' . $files['image'][$i]['name']);

                            $entity1->setDescription($object['description'][$i]);
                            // $entity1->setDueDate(isset($data['dueDate1'][$i]) ? new \DateTime($data['dueDate1'][$i]) : null);

                            $entity1->setCreatedAt(new \DateTime);

                            $em->persist($entity1);
                            $em->flush();
                        }
                    }
                }

                break;
        }




        if (!empty($object['items']) || !empty($object['excursions']) || !empty($object['transfers'])) {

            $countitem = count($object['items']);
            $countexcursion = count($object['excursions']);
            $counttransfers = count($object['transfers']);
            $countmax = max($countitem, $countexcursion, $counttransfers);
            // d($object);

            if ((int) $countmax > 0) {
                for ($i = 0; $i < $countmax; $i++) {

                    $em = $this->getEntityManager();
                    $entity2 = new \Base\Entity\InventoryLeadAddOns();
                    $entity2->setInventoryLeadId($inventoryLeadId);



                    if ($object['items'][$i]) {
                        $items = $this->getEntityManager()->getRepository('\Base\Entity\InventoryItem')->findOneBy(array('id' => $object['items'][$i]));
                        $entity2->setItem($items);
                    }

                    if ($object['excursions'][$i]) {
                        $excursions = $this->getEntityManager()->getRepository('\Base\Entity\InventoryExcursion')->findOneBy(array('id' => $object['excursions'][$i]));
                        $entity2->setExcursion($excursions);
                    }

                    if ($object['transfers'][$i]) {
                        $transfers = $this->getEntityManager()->getRepository('\Base\Entity\InventoryTransfer')->findOneBy(array('id' => $object['transfers'][$i]));
                        $entity2->setTransfer($transfers);
                    }



                    $entity2->setCreatedAt(new \DateTime);
                }
                // die;
            }
        }
        //d('success');
        return true;
    }

}