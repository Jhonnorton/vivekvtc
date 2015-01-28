<?php

namespace Front\Model;

use Inventory\Model\Items;
use Inventory\Model\Excursions;
use Inventory\Model\Transfers;
use Zend\Session\Container;
use Sendmail\Controller\SendmailController;

class Front extends \Base\Model\BaseModel {

    public $id;
    public $artist;
    public $title;

    const RESORT_ROOM = 1;
    const EVENT_ROOM = 2;
    const CRUISE_CABIN = 3;
    const LINKED_TO_All = 0;
    const LINKED_TO_RESORTS = 1;
    const LINKED_TO_EVENTS = 2;
    const LINKED_TO_CRUISES = 3;
    const LINKED_TO_RESORT_NAME = 4;
    const LINKED_TO_EVENT_CATEGORY = 5;
    const LINKED_TO_EVENT_NAME = 6;
    const LINKED_TO_CRUISE_NAME = 7;
    const CANCELED = 0;
    const OPEN_BALANCE = 1;
    const CLOSED_BALANCE = 2;

    /*   public function getReservation()
      {




      // echo "modal"; die;
      }
     */

    public function getReservationByIdCollection($id) {
        $collection = $this->getEntityManager()->getRepository('\Base\Entity\Reservation')->findOneBy(array('id' => $id));
        return $collection;
    }

    public function getExcursions($typeCode, $id) {
        $em = $this->getEntityManager();
        $collection = Excursions::getExcursionsLinkedTo($this->_serviceManager, (int) $typeCode, (int) $id);
        return $collection;
    }

    public function getTransfers($typeCode, $id) {
        $em = $this->getEntityManager();
        $collection = Transfers::getTransfersLinkedTo($this->_serviceManager, (int) $typeCode, (int) $id);
        return $collection;
    }

    public function getItems($typeCode, $id) {
        $em = $this->getEntityManager();
        $collection = Items::getItemsLinkedTo($this->_serviceManager, (int) $typeCode, (int) $id);
        return $collection;
    }

    public function getReservation($data) {
        $em = $this->getEntityManager();
        
        

        $currency = $data->currency;
        $from = 'USD';
        $to = $currency;
        $url = 'http://finance.yahoo.com/d/quotes.csv?f=l1d1t1&s=' . $from . $to . '=X';

        // d($url);
        $handle = fopen($url, 'r');

        if ($handle) {
            $result = fgetcsv($handle);
            fclose($handle);
        }


        // $type = 1;
        // $roomid = 16;//14; //55->resort;//15->CRUISE;//44->event;
        // $eventid = 20; //37->resort;//7->CRUISE; //64->event;
        //$typeForAddons = 6;
        //d($data);
        $leadid = $data->leadid;
        $type = $data->type;
        $eventid = $data->typeId;
        $roomid = $data->id;

        //d($leadid);
        if ($leadid) {

            $em = $this->getEntityManager();
            $entity = $em->find('Base\Entity\Leads', (int) $leadid);
            $entity->setStatus(3);
            $entity->setUpdatedAt(new \DateTime);
           // $em = $this->getEntityManager();
            $em->persist($entity);
            $em->flush();
      }
        switch ($type) {
            case self::RESORT_ROOM:

                $collection = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Resorts')->findBy(array('id' => $eventid));

                foreach ($collection as $item) {
                    $typeForAddons = 4;
                    $newCollection[] = array(
                        'type' => $type,
                        'event' => $item,
                        'roomid' => $roomid,
                        //'eventroom' => $this->_getEventRoom($item->getId(), $roomid),
                        'hotel' => $item->getTitle(), //$this->_getHotelName($item->getResortId()),
                        'room' => $this->_getRoomName($roomid),
                        'rooms' => $this->_getAllRooms(1,$eventid),
                        'inventory' => $this->_getHotelRoomsCollection($eventid, $roomid),
                        'item' => $this->getItems($typeForAddons, $eventid),
                        'excursion' => $this->getExcursions($typeForAddons, $eventid),
                        'transfers' => $this->getTransfers($typeForAddons, $eventid),
                        'currencyexchange' => $result[0],
                        'currencytype' => $to,
                    );
                }
                // d($newCollection);
                break;
            case self::EVENT_ROOM:

                $collection = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Events')->findBy(array('id' => $eventid));
                foreach ($collection as $item) {
                    $typeForAddons = 6;
                    $newCollection[] = array(
                        'type' => $type,
                        'event' => $item,
                        'roomid' => $roomid,
                        'eventroom' => $this->_getEventRoom($item->getId(), $roomid),
                        'hotel' => $this->_getHotelName($item->getResortId()),
                        'room' => $this->_getEventRoomName($roomid),
                        'rooms' => $this->_getAllRooms(2,$eventid),
                        'inventory' => $this->_getEventRoomsCollection($item->getId(), $roomid, $item->getResortId()),
                        'item' => $this->getItems($typeForAddons, $eventid),
                        'excursion' => $this->getExcursions($typeForAddons, $eventid),
                        'transfers' => $this->getTransfers($typeForAddons, $eventid),
                        'currencyexchange' => $result[0],
                        'currencytype' => $to,
                    );
                }


                break;
            case self::CRUISE_CABIN:


                $collection = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Cruises')->findBy(array('id' => $eventid));

                //d($collection);

                foreach ($collection as $item) {
                    $typeForAddons = 7;
                    $newCollection[] = array(
                        // 'id' => $item->getId(),
                        'type' => $type,
                        'event' => $item,
                        'roomid' => $roomid,
                        'eventroom' => $this->_getCruiseRoom($item->getId(), $roomid),
                        /* 'hotel' => $this->_getHotelName($item->getResortId()),
                          'room' => $this->_getRoomName($roomid), */
                        'rooms' => $this->_getAllRooms(3,$eventid),
                        'inventory' => $this->_getCruiseCabinsCollection($item->getId(), $roomid),
                        'item' => $this->getItems($typeForAddons, $eventid),
                        'excursion' => $this->getExcursions($typeForAddons, $eventid),
                        'transfers' => $this->getTransfers($typeForAddons, $eventid),
                        'currencyexchange' => $result[0],
                        'currencytype' => $to,
                    );
                }
                //   d($newCollection);
                // $item = $em->getRepository('\Base\Entity\ReservationCruiseCabin')->findOneBy(array('reservation' => $reservationId));
                // $name = !is_null($item) ? $item->getCabin()->getSuiteName() : null;
                break;


            // d($newCollection);
        }
        //  d($newCollection);
        return $newCollection;
    }
    
    protected function _getAllRooms($type, $typeid){
        switch($type){
            case 1:
                $collection = $this->getEntityManager()->getRepository('\Base\Entity\Avp\ResortRooms')->findBy(array('resortId' => $typeid));
                break;
            case 2:
                $collection = $this->getEntityManager()->getRepository('\Base\Entity\Avp\EventRooms')->findBy(array('eventId' => $typeid));
                break;
            case 3:
                $collection = $this->getEntityManager()->getRepository('\Base\Entity\Avp\CruiseCabins')->findBy(array('cruiseId' => $typeid));
                break;
        }
        return $collection;
    }

    private function _getEventRoom($eventId, $roomId) {
        $em = $this->getEntityManager();

        //  $name = !is_null($item) ? $item->getRoom()->getHotelName() : null;
        $item = $em->getRepository('\Base\Entity\Avp\EventRooms')->findOneBy(array('eventId' => $eventId, 'roomId' => $roomId));
        // d($item);
        return $item;
    }

    private function _getCruiseRoom($eventId, $roomId) {
        $em = $this->getEntityManager();

        //  $name = !is_null($item) ? $item->getRoom()->getHotelName() : null;
        $item = $em->getRepository('\Base\Entity\Avp\CruiseCabins')->findOneBy(array('cruiseId' => $eventId, 'id' => $roomId));
        // d($item);
        return $item;
    }

    protected function _getHotelName($resortId) {
        $em = $this->getEntityManager();
        $item = $em->getRepository('\Base\Entity\Avp\Resorts')->findOneBy(array('id' => $resortId));
        $name = !is_null($item) ? $item->getTitle() : null;
        //d($name);
        return $name;
    }

    protected function _getRoomName($roomId) {
        $em = $this->getEntityManager();
        $item = $em->getRepository('\Base\Entity\Avp\ResortRooms')->findOneBy(array('id' => $roomId));

        /*        foreach ($item as $room) {

          //$paymentDue['nextDueAmount'] = $dues->getPaymentDue();
          //$paymentDue['DueDate'] = $dues->getDueDate();
          $rooms[] = array('title' => $item->geTitle(), 'DueDate' => $dues->getDueDate());
          }
         */
        //  $name = !is_null($item) ? $item->getTitle() : null;
        // d($item);
        return $item;
    }

    protected function _getEventRoomName($roomId) {
        $em = $this->getEntityManager();
        $collection = $em->getRepository('\Base\Entity\Avp\EventRooms')->findOneBy(array('id' => $roomId));
        return $collection;
    }
    protected function _getEventRoomsCollection($eventId, $roomId, $resortId) {
        $em = $this->getEntityManager();
        $collection = $em->getRepository('\Base\Entity\InventoryEvent')->findOneBy(array('eventId' => $eventId, 'roomId' => $roomId, 'resortId' => $resortId));
        //d($collection);
        return $collection;
    }

    protected function _getCruiseCabinsCollection($eventId, $roomId) {
        $em = $this->getEntityManager();
        $collection = $em->getRepository('\Base\Entity\InventoryCruise')->findOneBy(array('cruiseId' => $eventId, 'suiteId' => $roomId));

        return $collection;
    }

    protected function _getHotelRoomsCollection($resortId, $roomId) {
        // d($roomId);

        $em = $this->getEntityManager();
        $collection = $em->getRepository('\Base\Entity\InventoryHotels')->findOneBy(array('resortId' => $resortId, 'roomId' => $roomId));
        //d($collection);
        return $collection;
    }

    public function save($object,$affiliateId) {

        $em = $this->getEntityManager();
        $items = $this->_setItems($object);

        $travellers = $this->_setClientsObject($object);
        $room = $this->_setSellItem($object);
        $excursions = $this->_setExcursions($object);
        $transfers = $this->_setTransfers($object);

        $room = $this->_setSellItem($object);

        $reservation = $this->_setReservation($object,$affiliateId);
        //  d('success');
        //      die;
        if($affiliateId!=''){
            $object['Reservation']=$reservation->getId();
            $this->_calculateAffiliateCommission($object,$affiliateId);
        }
         if ($object['paymentType'] == 0)://if payment type is deposit
            $this->_setReservationPaymentDue($reservation, $object); //set up multiple payment dues
        endif;
        

        $this->setSessionData('Room', 'room', $room);
        $this->setSessionData('ReservationObject', 'reservationobject', $object);


        /*     if($object['submit'] != 'draft'){
          $this->_updateBookingCountOfSellItem($object, $room); //update booking count
          }
         */

        //  d($room);
        if (!empty($travellers)) {
            foreach ($travellers as $traveller) {
                $this->_setReservationTravellers($reservation, $traveller);
            }
            
        }

        if (!empty($items)) {
            foreach ($items as $item) {
                $this->_setReservationItem($reservation, $item);
            }
        }
        if (!empty($excursions)) {
            foreach ($excursions as $excursion) {
                $this->_setReservationExcursion($reservation, $excursion);
            }
        }
        if (!empty($transfers)) {
            foreach ($transfers as $transfer) {
                $this->_setReservationTransfer($reservation, $transfer);
            }
        }

        switch ($reservation->getType()) {
            case self::RESORT_ROOM:
                $this->_setReservationResortRoom($reservation, $room);
                break;
            case self::EVENT_ROOM:
                $this->_setReservationEventRoom($reservation, $room);
                break;
            case self::CRUISE_CABIN:
                $this->_setReservationCruiseCabin($reservation, $room);
                break;
        }

        //  d("success");



        return $reservation;
    }

    protected function _setReservationPaymentDue(\Base\Entity\Reservation $reservation, $data) {
        //d($data);die;
//        d($data['nextPaymentDue'][0]);
        if (!empty($data['nextPaymentDue'])) {

            //  d('here');  
            $due = count($data['nextPaymentDue']);
//            d($due);
            if ((int) $due > 0) {
                for ($i = 0; $i < $due; $i++) {
                    if ($data['nextPaymentDue'][$i]) {
                        $entity = new \Base\Entity\ReservationPaymentDue();
                        $entity->setReservation($reservation);
//                        $entity->setPaymentDue($data['nextPaymentDue'][$i]);
                        $entity->setPaymentDue(isset($data['nextPaymentDue'][$i]) ? $data['nextPaymentDue'][$i] : 0.00);
                        $entity->setDueDate(isset($data['dueDate1'][$i]) ? new \DateTime($data['dueDate1'][$i]) : null);
                        $em = $this->getEntityManager();
                        $em->persist($entity);
                        $em->flush();
                    }
                }
            }
        }
//        $entity1 = new \Base\Entity\ReservationPaymentDue();
//        $entity1->setReservation($reservation);
//        $entity1->setPaymentDue($data['finalPaymentDue']);
//        $entity1->setDueDate(isset($data['dueDate2']) ? new \DateTime($data['dueDate2']) : null);
//        $em = $this->getEntityManager();
//
//        $em->persist($entity1);
//        $em->flush();
        return true;
    }

    protected function _setItems($data) {

        //   d($data['items']);
        $model = $this->_serviceManager->get('Items');

        $items = array();

        if (!empty($data['items'])):
            foreach ($data['items'] as $id) {

                $item = $model->getItem($id);
                //    d($item);
                if ($item)
                    $items[$item->getId()] = $item;
            }
        endif;
        // d($items);
        return $items;
    }

    protected function _setExcursions($data) {

        $model = $this->_serviceManager->get('Excursions');

        $items = array();

        if (!empty($data['excursions'])):
            foreach ($data['excursions'] as $id) {

                $item = $model->getItem($id);

                if ($item)
                    $items[$item->getId()] = $item;
            };
        endif;
        return $items;
    }

    protected function _setTransfers($data) {

        $model = $this->_serviceManager->get('Transfers');

        $items = array();

        if (!empty($data['transfers'])):
            foreach ($data['transfers'] as $id) {

                $item = $model->getItem($id);

                if ($item)
                    $items[$item->getId()] = $item;
            };
        endif;
        return $items;
    }

    /*   protected function _setSellItem($data) {

      // d($data);

      $type = (int) $data['type'];

      switch ($type) {
      case self::RESORT_ROOM:
      $model = 'InventoryHotels';
      $key = 'roomCategory';
      break;
      case self::EVENT_ROOM:
      $model = 'InventoryEvent';
      $key = 'roomCategory';
      break;
      case self::CRUISE_CABIN:
      $model = 'InventoryCruise';
      $key = 'suiteName';
      break;
      }



      $model = $this->_serviceManager->get($model);

      //   $returnItem = $model->getItem($data[$key]);

      $returnItem = $model->getItem($data['inventortyid']);

      //  d($returnItem);
      return $returnItem;
      }
     */

    protected function _setSellItem($data) {
//d($data);
        $type = (int) $data['type'];

        switch ($type) {
            case self::RESORT_ROOM:
                $model = 'ResortRooms';
                $key = 'roomCategory';
                $entity = '\Base\Entity\Avp\ResortRooms';
                break;
            case self::EVENT_ROOM:
                $model = 'InventoryEvent';
                $key = 'roomCategory';
                $entity = '\Base\Entity\Avp\EventRooms';
                break;
            case self::CRUISE_CABIN:
                $model = 'InventoryCruise';
                $key = 'roomCategory';
                $entity = '\Base\Entity\Avp\CruiseCabins';
                break;
        }
//echo $data[$key];die;
        $returnItem = $this->getEntityManager()->getRepository($entity)->find($data[$key]);

        //$model = $this->_serviceManager->get($model);
//        $returnItem = $model->getItem($data[$key]);
        //$returnItem = $model->getItem(56);

        return $returnItem;
    }

    protected function _setClientsObject($data) {

        $em = $this->getEntityManager();

        $entity = '\Base\Entity\Travellers';

        $travellers = array();

        $object = new $entity;

        $data['travellerCountry'] = $em->find('Base\Entity\Countries', (int) $data['travellerCountry']);

        if (!is_null($data['travellerCountry']))
            $data['travellerCountry'] = $data['travellerCountry']->getCountryName();

        $object->setName($data['travellerName']);
        $object->setDob(new \DateTime($data['travellerDOB']));
        $object->setPhone($data['travellerPhone']);
        $object->setEmail($data['travellerEmail']);
        $object->setAddress($data['suitename']." ".$data['streetname']);
        $object->setCity($data['travellerCity']);
        $object->setState($data['travellerState']);
        $object->setCountry($data['travellerCountry']);
        $object->setZip($data['travellerZip']);

        $em->persist($object);
        $em->flush();

        $travellers[$object->getId()] = $object;

        $otherTravellers = count($data['tname']);

        if ((int) $otherTravellers > 0) {

            for ($i = 0; $i < $otherTravellers; $i++) {

                //d($data['tDob']);

                $object = new $entity;

                $object->setName($data['tname'][$i]);
                $object->setDob(new \DateTime($data['tDob'][$i]));
                $object->setPhone($data['tPhone'][$i]);
                $object->setEmail($data['tEmail'][$i]);

                $object->setAddress($data['tAddress'][$i] ? $data['tAddress'][$i] : null);

                //d($object->getDob());

                $em->persist($object);
                $em->flush();



                if ($object->getId())
                    $travellers[$object->getId()] = $object;
            }
        }

        return $travellers;
    }

    protected function _setReservation($data,$affiliateId) {

        $em = $this->getEntityManager();

        $reservation = new $this->_targetEntity;

        $flight = isset($data['flight']) ? $data['flight'] : null;

        $clientNotes = isset($data['clientNotes']) ? $data['clientNotes'] : null;
        $adminNotes = isset($data['adminNotes']) ? $data['adminNotes'] : null;

        $reservation->setType($data['type']);
        if($affiliateId!=''){
            $affiliate=$em->find('Base\Entity\Avp\Affiliates', (int) $affiliateId);
            $reservation->setAffiliateId($affiliate);
        }
        $reservation->setDateFrom(new \DateTime($data['travelFrom']));
        $reservation->setDateTo(new \DateTime($data['travelTo']));

        if ($flight) {
//            $reservation->setFlight($flight);
//            $reservation->setDepartureFrom($data['flightGoingAway']);
//            $reservation->setDepartureTo($data['flightReturnHome']);
//            $reservation->setReturnFrom((isset($data['returnFrom'])) ? $data['returnFrom'] : null);
//            $reservation->setReturnTo((isset($data['returnTo'])) ? $data['returnTo'] : null);
//            $reservation->setFlightTotalCost($data['flightTotalCost']);
            $reservation->setAirportName($data['flightGoingAway']);
        }

        $reservation->setAppliDiscount($data['discount']);
        $reservation->setTotalCost($data['totalCost']);
        $reservation->setMerchantFee($data['merchantFee']);
        $reservation->setFinalCost($data['finalCost']);
        $reservation->setPaymentType($data['paymentType']);
        $reservation->setDepositAmoun($data['depositAmount']);
        $reservation->setDepositMethod($data['depositMethod']);
        $reservation->setBalansAfterDeposit($data['balansAfterDeposit']);
        //$reservation->setNextPaymentDue($data['nextPaymentDue']);
        //$reservation->setDueDate1(isset($data['dueDate1'])? new \DateTime($data['dueDate1']):null);
        // $reservation->setFinalPaymentDue($data['finalPaymentDue']);
        // $reservation->setDueDate2(isset($data['dueDate1'])? new \DateTime($data['dueDate2']):null);
        $reservation->setClientNotes($clientNotes);
        $reservation->setAdminNotes($adminNotes);
        $reservation->setCreatedAt(new \DateTime);
        $reservation->setUpdatedAt(new \DateTime);
        $reservation->setNoOfDays($data['noOfDays']);
        $reservation->setRoomRate($data['roomRate']);
        $reservation->setRoomRequired($data['roomRequired']);
        $reservation->setNoOfPersons($data['noOfPersons']);
        $flight = isset($data['flight']) ? $data['flight'] : 0;
        $reservation->setFlight($flight);
        $reservation->setTransferCost($data['transfersCost']);
        $reservation->setExcursionCost($data['excursionsCost']);
        $reservation->setItemCost($data['itemsCost']);
        if ($data['submit'] == "draft") {
            $reservation->setIsDraft(1);
        }
        
         if($data['roomCategory'] != ""){
            $reservation->setRoomId((int)$data['roomCategory']);
        }

        $referenceNo = "VP-" . mktime();
        $reservation->setReferenceNumber($referenceNo);
        
        $reservation->setRoomNetCost((int) $data['roomNetPrice']);
        $reservation->setAddonsNetCost((int) $data['addonsNetPrice']);

         if($data['currencytype'] != ""){
            $reservation->setCurrencyCode($data['currencytype']);
        }
        
        $em->persist($reservation);
        $em->flush();

        return $reservation;
    }

    protected function _setReservationTravellers(\Base\Entity\Reservation $reservation, \Base\Entity\Travellers $traveller) {

        $entity = new \Base\Entity\ReservationTravellers();

        $entity->setReservation($reservation);
        $entity->setTraveller($traveller);

        $em = $this->getEntityManager();
        $em->persist($entity);
        $em->flush();

        return $entity;
    }

    /*   protected function _setReservationCruiseCabin(\Base\Entity\Reservation $reservation, \Base\Entity\InventoryCruise $room) {

      $entity = new \Base\Entity\ReservationCruiseCabin();

      $entity->setReservation($reservation);
      $entity->setCabin($room);

      $em = $this->getEntityManager();
      $em->persist($entity);
      $em->flush();

      return $entity;
      } */

    /* protected function _setReservationEventRoom(\Base\Entity\Reservation $reservation, \Base\Entity\InventoryEvent $room) {

      $entity = new \Base\Entity\ReservationEventRoom();

      $entity->setReservation($reservation);
      $entity->setEventRoom($room);

      $em = $this->getEntityManager();
      $em->persist($entity);
      $em->flush();
      //d($entity);
      return $entity;
      } */

    protected function _setReservationCruiseCabin(\Base\Entity\Reservation $reservation, \Base\Entity\Avp\CruiseCabins $room) {

        $entity = new \Base\Entity\ReservationCruiseCabin();

        $entity->setReservation($reservation);
        $entity->setCabin($room);


        $em = $this->getEntityManager();
        $em->persist($entity);
        $em->flush();

        return $entity;
    }

    protected function _setReservationEventRoom(\Base\Entity\Reservation $reservation, \Base\Entity\Avp\EventRooms $room) {

        $entity = new \Base\Entity\ReservationEventRoom();

        $entity->setReservation($reservation);
        $entity->setEventRoom($room);

        $em = $this->getEntityManager();
        $em->persist($entity);
        $em->flush();

        return $entity;
    }

    /*   protected function _setReservationResortRoom(\Base\Entity\Reservation $reservation, \Base\Entity\InventoryHotels $room) {

      $entity = new \Base\Entity\ReservationResortRoom();

      $entity->setReservation($reservation);
      $entity->setRoom($room);

      $em = $this->getEntityManager();
      $em->persist($entity);
      $em->flush();

      return $entity;
      } */

    protected function _setReservationResortRoom(\Base\Entity\Reservation $reservation, \Base\Entity\Avp\ResortRooms $room) {

        $entity = new \Base\Entity\ReservationResortRoom();

        $entity->setReservation($reservation);
        $entity->setRoom($room);

        $em = $this->getEntityManager();
        $em->persist($entity);
        $em->flush();

        return $entity;
    }

    protected function _setReservationItem(\Base\Entity\Reservation $reservation, \Base\Entity\InventoryItem $item) {

        $entity = new \Base\Entity\ReservationItem();

        $entity->setReservation($reservation);
        $entity->setItem($item);

        $em = $this->getEntityManager();
        $em->persist($entity);
        $em->flush();

        return $entity;
    }

    protected function _setReservationExcursion(\Base\Entity\Reservation $reservation, \Base\Entity\InventoryExcursion $excursion) {

        $entity = new \Base\Entity\ReservationExcursion();

        $entity->setReservation($reservation);
        $entity->setExcursion($excursion);

        $em = $this->getEntityManager();
        $em->persist($entity);
        $em->flush();

        return $entity;
    }

    protected function _setReservationTransfer(\Base\Entity\Reservation $reservation, \Base\Entity\InventoryTransfer $transfer) {

        $entity = new \Base\Entity\ReservationTransfer();

        $entity->setReservation($reservation);
        $entity->setTransfer($transfer);

        $em = $this->getEntityManager();
        $em->persist($entity);
        $em->flush();

        return $entity;
    }

    /*   // public function updatePaymentStatus($reservation,$response){
      public function updatePaymentStatus($reservation){
      $em = $this->getEntityManager();
      $reservation = $reservation->reservation;

      //d($reservation);

      $resId = $reservation->getId();
      // $resId = $reservation['id'];
      $entity =  '\Base\Entity\Reservation';

      $res = $em->find($entity, (int) $resId);

      // d($res);

      $room = new Container('Room');

      //d($room->room);
      $ReservationObject = new Container('ReservationObject');

      $this->_updateBookingCountOfSellItem($ReservationObject->reservationobject, $room->room); //update booking count
      $this->_savePaymentDetails($reservation,$response);

      if($reservation->gePaymentType == 1):
      $res->setStatus(2);
      $em->persist($res);
      $em->flush();
      endif;
      return $entity;
      }

      protected function _savePaymentDetails($reservation,$response){
      $entity = new \Base\Entity\Avp\OrderInvoices();
      $em = $this->getEntityManager();

      $entity->setOrderId($reservation->getId());
      $entity->setCurrencyCode($response['ACK']['CURRENCYCODE']);
      $entity->setTransactionId($response['ACK']['TRANSACTIONID']);
      $entity->setAmountPaid($response['ACK']['AMT']);
      $entity->setPaymentMode('expresscheckout');
      $entity->setDateAdded(new \DateTime);

      $em->persist($entity);
      $em->flush();

      }

      protected function _updateBookingCountOfSellItem($data, $room) {

      $em = $this->getEntityManager();

      switch ($data['type']) {
      case self::RESORT_ROOM:
      $entity = '\Base\Entity\InventoryHotels';
      $bookingUpdate = $em->find($entity, (int) $data['roomCategory']);

      //d($bookingUpdate);
      $bookingUpdate->setBookedCount($room->getBookedCount() + $data['roomRequired']);

      $em->persist($bookingUpdate);
      $em->flush();

      return $bookingUpdate;
      break;
      case self::EVENT_ROOM:
      //d($data);
      $entity = '\Base\Entity\InventoryEvent';
      $bookingUpdate = $em->find($entity, (int) $data['roomCategory']);
      //$bookingUpdate = $em->$entity->findBy(array('id' => $data['inventortyid']));
      //

      $bookingUpdate->setBookedCount($room->getBookedCount() + $data['roomRequired']);

      $em->persist($bookingUpdate);
      $em->flush();

      return $bookingUpdate;
      break;
      case self::CRUISE_CABIN:
      $entity = '\Base\Entity\InventoryCruise';
      $bookingUpdate = $em->find($entity, (int) $data['suiteName']);
      $bookingUpdate->setBookedCount($room->getBookedCount() + $data['roomRequired']);

      $em->persist($bookingUpdate);
      $em->flush();

      return $bookingUpdate;
      break;
      }
      } */

    protected function _updateBookingCountOfSellItem($data, $room) {

        $em = $this->getEntityManager();

        switch ($data['type']) {
            case self::RESORT_ROOM:
                $entity = '\Base\Entity\InventoryHotels';
                $bookingUpdate = $em->find($entity, (int) $data['inventortyid']);
                $bookingUpdate->setBookedCount($room->getBookedCount() + $data['roomRequired']);

                $em->persist($bookingUpdate);
                $em->flush();

                return $bookingUpdate;
                break;
            case self::EVENT_ROOM:
                $entity = '\Base\Entity\InventoryEvent';
                $bookingUpdate = $em->find($entity, (int) $data['inventortyid']);
                $bookingUpdate->setBookedCount($room->getBookedCount() + $data['roomRequired']);

                $em->persist($bookingUpdate);
                $em->flush();

                return $bookingUpdate;
                break;
            case self::CRUISE_CABIN:
                $entity = '\Base\Entity\InventoryCruise';
                $bookingUpdate = $em->find($entity, (int) $data['inventortyid']);
                $bookingUpdate->setBookedCount($room->getBookedCount() + $data['roomRequired']);

                $em->persist($bookingUpdate);
                $em->flush();

                return $bookingUpdate;
                break;
        }
    }

    public function updatePaymentStatus($reservation, $response) {

        $em = $this->getEntityManager();
        $reservation = $reservation->reservation;

        $resId = $reservation->getId();
        $entity = '\Base\Entity\Reservation';

        $res = $em->find($entity, (int) $resId);

        $room = new Container('Room');
        $ReservationObject = new Container('ReservationObject');

        // d($ReservationObject->reservationobject);
        //  $this->_updateBookingCountOfSellItem($ReservationObject->reservationobject, $room->room); //update booking count
        $this->_savePaymentDetails($reservation, $response);

        if ($reservation->getPaymentType() == 1):
            $res->setStatus(2);
        endif;
        
        if ($response['ACK']['ACK'] == 'Success'):
            $res->setIsBooked(1);
            $res->setIsDraft(0);
            $em->persist($res);
            $em->flush();
        else:
            $res->setIsBooked(0);
            $res->setIsDraft(0);
            $em->persist($res);
            $em->flush();
        endif;
        
        return $entity;
    }

    public function updatePaymentDoDirectStatus($reservation, $response,$type) {

        //  d($reservation);
        $em = $this->getEntityManager();
        // $reservation = $reservation->reservation;

        $resId = $reservation->getId();
        $entity = '\Base\Entity\Reservation';

        $res = $em->find($entity, (int) $resId);

        $room = new Container('Room');
        $ReservationObject = new Container('ReservationObject');

        // d($ReservationObject->reservationobject);

        //$this->_updateBookingCountOfSellItem($ReservationObject->reservationobject, $room->room); //update booking count
        $this->_savePaymentDetails($reservation, $response,$type);

        if ($reservation->getPaymentType() == 1):
            $res->setStatus(2);
        endif;
        
        if ($response['ACK']['ACK'] == 'Success'):
            $res->setIsBooked(1);
            $res->setIsDraft(0);
            $em->persist($res);
            $em->flush();
        else:
            $res->setIsBooked(0);
            $res->setIsDraft(0);
            $em->persist($res);
            $em->flush();
        endif;
        return $entity;
    }

    protected function _savePaymentDetails($reservation, $response,$type=null) {
        $entity = new \Base\Entity\Avp\OrderInvoices();
        $em = $this->getEntityManager();

        $entity->setOrderId($reservation->getId());
        $entity->setCurrencyCode($response['ACK']['CURRENCYCODE']);
        $entity->setTransactionId($response['ACK']['TRANSACTIONID']);
        $entity->setAmountPaid($response['ACK']['AMT']);

//        if (!empty($response['ACK']['CVV2MATCH'])) {
        if($type == 2){
            $entity->setPaymentMode('DoDirectPayment');
        } else {

            $entity->setPaymentMode('expresscheckout');
        }
        $entity->setDateAdded(new \DateTime);
        
        $em->persist($entity);
        $em->flush();
        
        $this->addUser($reservation);
    }
    
    public function addUser($data) {
        $em = $this->getEntityManager();
        
        
        $qb = $em->createQueryBuilder();
        $qb->select('rt')->from('\Base\Entity\ReservationTravellers', 'rt')
                ->where('rt.reservation= :reservation')
                ->setParameter('reservation', $data->getId());


        $query = $qb->getQuery();
        $results = $query->getResult();
        
        foreach($results as $rows):
            $travellers[] = $rows->getTraveller();
        endforeach;
        $i = 0;
        foreach ($travellers as $d):
            if ($i == 0):
                $entity = new \Base\Entity\Users();
                $entity->setEmail($d->getEmail());
                $entity->setFirstName($d->getName());

                $roleEntity = $em->find('Base\Entity\Role', (int) 2);

                $entity->setRole($roleEntity);

                $entity->setPassword(md5($this->generateRandomString(5)));
                $entity->setRoleName('Guest');
                //$entity->setJoinedOn('2014-09-04');
               //$entity->setLastUpdated('2014-09-04');
                $em->persist($entity);
                $em->flush();
            endif;
            $i++;
        endforeach;
        $this->_addClient($travellers,$entity,$data);
        return $entity;
    }

    protected function _addClient($data, $user,$reservation) {
        $em = $this->getEntityManager();
        $i = 0;
        $parentId = null;
        foreach ($data as $d):
            $entity = new \Base\Entity\Avp\Clients();
            $customerId = strtoupper(substr(str_replace(' ', '', $d->getName()), 0, 5)) . rand(pow(10, 4 - 1), pow(10, 4) - 1);
            $entity->setEmail($d->getEmail());
            //$entity->setCountryId($entity->getCountry());
            $entity->setName($d->getName());
            $entity->setDob($d->getDob());
            if($i == 0):
                $entity->setUserId($user->getId());
            endif;
            $entity->setCustomerId($customerId);
            $entity->setOrderId($reservation->getId());
            
            if($i != 0):
                $entity->setParentId($parentId);
            endif;
            $em->persist($entity);
            $em->flush();
            $parentId = $entity->getId();
            $i++;
        endforeach;
       
        return $entity;
    }

    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    public function getPaymentdues($reservationId) {
        //   d('here');
        $em = $this->getEntityManager();

        $paymentDue = array();



//        $datebefore7days = date('Y-m-d', strtotime('7 days'));
//        $datetoday = date('Y-m-d');
//
//        $dateafter7days = date('Y-m-d', strtotime('-7 days'));

        $qb = $em->createQueryBuilder();
        $qb->select('c')->from('\Base\Entity\ReservationPaymentDue', 'c')
                ->where('c.reservation= :reservation')
                ->setParameter('reservation', $reservationId);
//                ->andWhere('c.dueDate BETWEEN :id AND :endid')
//                ->setParameter('id', $dateafter7days)
//                ->setParameter('endid', $datebefore7days);

        $query = $qb->getQuery();
        $results = $query->getResult();
        
//        $qb1 = $em->createQueryBuilder();
//        if($results[0]->getReservation()->getType()==1){
//           $qb1->select('c')->from('\Base\Entity\ReservationResortRoom', 'c')
//                    ->where('c.id='.$results[0]->getReservation()->getId());
//        }elseif($results[0]->getReservation()->getType()==2){
//            $qb1->select('c')->from('\Base\Entity\ReservationEventRoom', 'c')
//                    ->where('c.id='.$results[0]->getReservation()->getId());
//        }else{
//            $qb1->select('c')->from('\Base\Entity\ReservationCruiseCabin', 'c')
//                    ->where('c.id='.$results[0]->getReservation()->getId());
//        }
//        $query1 = $qb1->getQuery();
//        $results1 = $query1->getResult();
//
//       d($results1);
        return $results;
    }

    public function updateDuePaymentStatus($reservation, $response, $allvalue = null) {

        $reservation = $this->_setReservationDue($reservation, $response);
        // d('success');
        $this->_saveDuePaymentDetails($reservation, $response);

        $em = $this->getEntityManager();
        $entity = '\Base\Entity\ReservationPaymentDue';

        $paymentdueid = $allvalue['collection'][0]->getId();
        //d($paymentdue);
        $this->_setPaymentDue($paymentdueid, $reservation, $response);


        //   d('success');
    }

    protected function _setReservationDue($data, $response) {

//        d($data);
        $id = $data->getId();

        $response = $response['ACK']['AMT'];

        $depositeAmount = $data->getdepositAmoun() + $response;

        $balansAfterDeposit = $data->getfinalCost() - $depositeAmount;


        //   d($balansAfterDeposit);

        $em = $this->getEntityManager();

        $reservation = new $this->_targetEntity;


        if (isset($id) && (int) $id != 0) {
            $reservation = $em->find('Base\Entity\Reservation', (int) $id);
        }

        $reservation->setDepositAmoun($depositeAmount);
        $reservation->setBalansAfterDeposit($balansAfterDeposit);


        $reservation->setUpdatedAt(new \DateTime);

        $em->persist($reservation);
        $em->flush();
        //    d('success');
        return $reservation;
    }

    protected function _setPaymentDue($id, \Base\Entity\Reservation $reservation, $response) {

//         d($response['ACK']['AMT']);
//        $reservationId=$reservation->getId();
        
//        $em = $this->getEntityManager();
//        $q = $em->createQuery('delete from \Base\Entity\ReservationPaymentDue r where r.reservation='.$reservation->getId());
//        $deleted = $q->execute();
//
//        
//        $qb = $em->createQueryBuilder();
//        $qb->select('c')->from('\Base\Entity\Reservation', 'c')
//                ->where('c.id='.$reservation->getId());
//
//        $query = $qb->getQuery();
//        $results = $query->getResult();
////        d($results[0]->getBalansAfterDeposit());
//        $remainingcost=$results[0]->getBalansAfterDeposit();
//        $remainingcost1=$remainingcost/2;
////        echo "Balance ".$results[0]->getBalansAfterDeposit();
////        echo " Paid Amt ".$response['ACK']['AMT'];
////        echo "totaldep ".$remainingcost;
////        echo " dep ".$remainingcost1;
//        if($remainingcost1>200){
//            for($i=0;$i<2;$i++){
//                if($i==0){
//                    $date=date('Y-m-d',strtotime('+7'));
//                }elseif($i==1){
//                    $date=date('Y-m-d',strtotime('+14'));
//                }
//                $entity = new \Base\Entity\ReservationPaymentDue();
//                $em = $this->getEntityManager();
//                $entity->setReservation($reservation);
//                $entity->setPaymentDue($remainingcost1);
//                $entity->setDueDate(new \DateTime($date));
//                $entity->setStatus(0);
//                $em->persist($entity);
//                $em->flush();
//            }
//        }else{
////             echo "totaldep ".$remainingcost; die;
//                $date=date('Y-m-d',strtotime('+7'));
//                $entity = new \Base\Entity\ReservationPaymentDue();
//                $em = $this->getEntityManager();
//                $entity->setReservation($reservation);
//                $entity->setPaymentDue($remainingcost);
//                $entity->setDueDate(new \DateTime($date));
//                if($remainingcost==0 || $remainingcost==0.00){
//                    $entity->setStatus(1);
//                }else{
//                    $entity->setStatus(0);
//                }
//                $em->persist($entity);
//                $em->flush();
//        }
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('c')->from('\Base\Entity\ReservationPaymentDue', 'c')
                ->where('c.reservation='.$reservation->getId());

        $query = $qb->getQuery();
        $data = $query->getResult();
        
        $due = count($data);
        $newdue = $due - 1;

//        d($data);
        if ((int) $due > 0) {
            if ($due == 1) {
                $dueamount = $reservation->getBalansAfterDeposit();
            } else {

                $dueamount = ($reservation->getBalansAfterDeposit()) / $newdue;
            }
            for ($i = 0; $i < $due; $i++) {
                
                $id = $data[$i]->getId();

                if (isset($id) && (int) $id != 0) {
                    $entity = $em->find('\Base\Entity\ReservationPaymentDue', (int) $id);
                }
                
                if($i == 0){
                    $em->remove($entity);
                    $em->flush();
                }else{

                $entity->setPaymentDue($dueamount);
                if($dueamount<1){
                    $entity->setStatus(1);
                }
                $em->persist($entity);
                $em->flush();
                }
                
                if($due == 1){
                     $em = $this->getEntityManager();
                      $ent = $em->find('\Base\Entity\Reservation', (int) $reservation->getId());
                      $ent->setStatus(2);
                      $ent->setUpdatedAt(new \DateTime);
                      $ent->setPaymentType(1);
                      $em->persist($ent);
                      $em->flush();
                }
            }
        }
        
//        d('Done ');
//  
//        $em = $this->getEntityManager();
//
//        $entity = new $this->_targetEntity;
//
//
//        if (isset($id) && (int) $id != 0) {
//            $entity = $em->find('\Base\Entity\ReservationPaymentDue', (int) $id);
//        }
//
//        $entity->setPaymentDue(0);
//        $entity->setStatus(1);
//        $em->persist($entity);
//        $em->flush();

        // d('success');

        return true;
    }

    protected function _saveDuePaymentDetails($reservation, $response) {


        //  $type=2;
        $entity = new \Base\Entity\Avp\OrderInvoices();
        $em = $this->getEntityManager();

        $entity->setOrderId($reservation->getId());
        $entity->setCurrencyCode($response['ACK']['CURRENCYCODE']);
        $entity->setTransactionId($response['ACK']['TRANSACTIONID']);
        $entity->setAmountPaid($response['ACK']['AMT']);
        if (!empty($response['ACK']['CVV2MATCH'])) {
            $entity->setPaymentMode('DoDirect');
        } else {

            $entity->setPaymentMode('expresscheckout');
        }
        $entity->setDateAdded(new \DateTime);

        $em->persist($entity);
        $em->flush();
        //  d('success');
    }

    public function getTravellers($reservationId) {

        $em = $this->getEntityManager();

        $travellers = array();

        $collection = $em->getRepository('\Base\Entity\ReservationTravellers')->findBy(array('reservation' => $reservationId));

        //d($collection[0]->getTraveller()->getemail());

        return $collection;
    }

    public function sendmailnew($to, $subject, $message, $cc, array $params = null) {

        //echo "sendmailnew"; die;

        return SendmailController::sendMailOnLead($this->_serviceManager, $to, $subject, $message, $cc);

        return true;
    }
    
    public function sendmail($id, $to, array $params = null) {
        
        $data = $this->getItemView($id);
//        d($data);
        if ($data) {
            
            return SendmailController::sendMailOnReservation($this->_serviceManager, $to, $data, $params, 'Reservation Confirmation');
        }
        return false;
    }
    
     public function getItemView($id) {

        $collection = $this->getCollection();
//        d($collection);
        return $collection[$id];
    }
    
     public function getCollection($page=null) {
         
          $collection = parent::getCollection($page);
         // d($collection);
          $newCollection = array();
        foreach ($collection as $item) {
            //d($item->getId());
            $newCollection[$item->getId()] = array(
                'id' => $item->getId(),
                'type' => $this->_getType($item->getType()),
                'roomName' => $this->_getItemName($item->getId(), $item->getType()),
                'hotelName' => $this->_getHotelName($item->getId(), $item->getType()),
                'travellers' => $this->_getTravellers($item->getId()),
                'paymentDues' => $this->_getPaymentDues($item->getId()),
                'reservation' => $item,
                'status' => $this->_getStatus($item->getStatus()),
            );
        }
        return $newCollection;
     }
     
     //add new functions for email
     
      protected function _getType($type) {

        switch ($type) {
            case self::RESORT_ROOM:
                $type = 'FIT';
                break;
            case self::EVENT_ROOM:
                $type = 'Group';
                break;
            case self::CRUISE_CABIN:
                $type = 'Cruise';
                break;
        }

        return $type;
    }
    
    protected function _getItemName($reservationId, $type) {

        $em = $this->getEntityManager();


        switch ($type) {
            case self::RESORT_ROOM:
                $item = $em->getRepository('\Base\Entity\ReservationResortRoom')->findOneBy(array('reservation' => $reservationId));
                $name = !is_null($item) ? $item->getRoom()->getTitle() : null;
                break;
            case self::EVENT_ROOM:
                $item = $em->getRepository('\Base\Entity\ReservationEventRoom')->findOneBy(array('reservation' => $reservationId));
                $name = !is_null($item) ? $item->getEventRoom()->getRoomCategory() : null;

                break;
            case self::CRUISE_CABIN:
                $item = $em->getRepository('\Base\Entity\ReservationCruiseCabin')->findOneBy(array('reservation' => $reservationId));
                $name = !is_null($item) ? $item->getCabin()->getDeckName() : null;
                break;
        }

        return $name;
    }

    protected function _getTravellers($reservationId) {

        $em = $this->getEntityManager();

        $travellers = array();

        $collection = $em->getRepository('\Base\Entity\ReservationTravellers')->findBy(array('reservation' => $reservationId));

        foreach ($collection as $traveller) {
            $travellers[] = $traveller->getTraveller()->getName();
        }

        return $travellers;
    }
    
    protected function _getPaymentDues($reservationId) {

        $em = $this->getEntityManager();

        $paymentDue = array();

        $collection = $em->getRepository('\Base\Entity\ReservationPaymentDue')->findBy(array('reservation' => $reservationId));
        $i = 0;
        foreach ($collection as $dues) {

            //$paymentDue['nextDueAmount'] = $dues->getPaymentDue();
            //$paymentDue['DueDate'] = $dues->getDueDate();
            $paymentDue[] = array('nextDueAmount' => $dues->getPaymentDue(), 'DueDate' => $dues->getDueDate());
        }

        return $paymentDue;
    }
    
    private function _getStatus($statudId) {
        switch ($statudId) {
            case self::CANCELED:
                return 'Canceled';
            case self::OPEN_BALANCE:
                return 'Open Balance';
            case self::CLOSED_BALANCE:
                return 'Closed Balance';
            default :
                return '';
        }
    }

    public function getPaymentduesnew($page = null) {

        //   $collection = parent::getCollection($page);
        $em = $this->getEntityManager();
        $collection = $em->getRepository('\Base\Entity\ReservationPaymentDue')->findBy(array('status' => 0));
        // d($collection[0]->getReservation()->getId());
        // d($collection);
        $newCollection = array();
        foreach ($collection as $item) {
            $newCollection[$item->getId()] = array(
                'travellers' => $this->_getTravellersDetail($item->getReservation()->getId()),
                'paymentDues' => $item,
                'reservationId' => $item->getReservation()->getId(),
            );
        }
        //d($newCollection);

        return $newCollection;
    }

    public function _getTravellersDetail($reservationId) {

        $em = $this->getEntityManager();

        $travellers = array();

        $collection = $em->getRepository('\Base\Entity\ReservationTravellers')->findBy(array('reservation' => $reservationId));

        return $collection;
    }

    public function cancelReservations($id) {

        //d($id);

        $em = $this->getEntityManager();

        $reservation = new $this->_targetEntity;


        if (isset($id) && (int) $id != 0) {
            $reservation = $em->find('Base\Entity\Reservation', (int) $id);
        }

        $reservation->setStatus(self::CANCELED);

        $reservation->setUpdatedAt(new \DateTime);

        $em->persist($reservation);
        $em->flush();

        //d($id);


        return true;
    }
    
    

    public function sendmasail($id, $to, array $params = null) {
        $data = $this->getItemView($id);
        if ($data) {
            return SendmailController::sendMailOnReservation($this->_serviceManager, $to, $data, $params, 'Reservation Preview');
        }
        return false;
    }

    public function sendmailfortoday($to, array $params = null) {

        //d($params);
        //echo "sendmailnew"; die;

        return SendmailController::sendMailOnDue($this->_serviceManager, $to, $params);

        return true;
    }

    public function getCountry($id = 0) {

        $em = $this->getEntityManager();
        $country = $em->find('Base\Entity\Countries', (int) $id);
        if ($country) {

            //  d($country->getIso2());
            return $country->getIso2();
        }
        return '';
    }

    public function updatePaymentStatusForExpress($reservationId, $response, $paymentdue) {

        $em = $this->getEntityManager();

        //  d('2112');
//        $id = $reservation->reservation;
        $res = $this->getReservationByIdCollection($reservationId);

        $reservation = $this->_setReservationDue($res, $response);

        $em = $this->getEntityManager();
        $entity = '\Base\Entity\ReservationPaymentDue';

        $paymentdueid = $paymentdue->payment;
        //d($paymentdue);
        $this->_setPaymentDue($paymentdueid, $reservation, $response);

        $this->_saveDuePaymentDetails($reservation, $response);

        return true;
        /*  $reservation = $reservation->reservation;

          $resId = $reservation->getId();
          $entity = '\Base\Entity\Reservation';

          $res = $em->find($entity, (int) $resId);

          $room = new Container('Room');
          $ReservationObject = new Container('ReservationObject');

          // d($ReservationObject->reservationobject);

          $this->_updateBookingCountOfSellItem($ReservationObject->reservationobject, $room->room); //update booking count
          $this->_savePaymentDetails($reservation, $response);

          if ($reservation->gePaymentType == 1):
          $res->setStatus(2);
          $em->persist($res);
          $em->flush();
          endif;
          return $entity; */
    }

    public function sendmailreminder($to, $id, array $params = null) {
        // $data = $this->getItemView($id);
        // if ($data) {
        return SendmailController::sendMailOnReminder($this->_serviceManager, $to, $id, $params, ' Payment Reminder for Res no. ');
        // }
        return false;
    }

    public function getRoomsAvailable($roomId = null, $start = null, $end = null) {
        $em = $this->getEntityManager();
        $rsm = new ResultSetMapping();

        $rsm->addScalarResult('counts', 'count');
        $rsm->addScalarResult('booked', 'booked');

        $query = $em->createNativeQuery("SELECT count( * ) as counts,sum(reservation.room_required) as booked
        FROM `reservation_resort_room` 
        LEFT JOIN `reservation` ON reservation_resort_room.reservation_id = reservation.id
        WHERE reservation_resort_room.room_id = $roomId
        AND '$start' BETWEEN reservation.date_from
        AND reservation.date_to
        OR reservation.date_to
        BETWEEN '$start'
        AND '$end' AND reservation_resort_room.room_id = $roomId
        OR '$end'
        BETWEEN reservation.date_from
        AND reservation.date_to AND reservation_resort_room.room_id = $roomId
        OR reservation.date_from
        BETWEEN '$start'
        AND '$end'
        AND reservation_resort_room.room_id = $roomId", $rsm);

        //d(get_class_methods($query));

        $count = $query->getArrayResult();

        $stock = $this->findRoomsInventory($roomId, $start, $end);
        if ($stock):
            $stockCount = min($stock['stock']);
            $data = array("count" => $stockCount - $count[0]['booked'], "data" => $stock['data']);
        else:
            $d = array("dateFrom" => "", "dateTo" => "", "grossPrice" => 0);
            $data = array("count" => 0, "data" => $d);
        endif;


        return $data;
    }
    
    public function getTravellerData($reservationId){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('c')->from('\Base\Entity\ReservationTravellers', 'c')
                ->where('c.reservation='.$reservationId);

        $query = $qb->getQuery();
        $results = $query->getResult();
//        d($results);
        return $results;
    }
    
    public function getOrderFor($reservationId){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('c')->from('\Base\Entity\Reservation', 'c')
                ->where('c.id='.$reservationId);

        $query = $qb->getQuery();
        $result = $query->getResult();
        
        if($result[0]->getType()==1){
            $em = $this->getEntityManager();
            $qb = $em->createQueryBuilder();
            $qb->select('c')->from('\Base\Entity\ReservationResortRoom', 'c')
                    ->where('c.reservation='.$reservationId);

            $query = $qb->getQuery();
            $result = $query->getResult();
//            d();
            $qb1 = $em->createQueryBuilder();
            $qb1->select('c')->from('\Base\Entity\Avp\Resorts', 'c')
                    ->where('c.id='.$result[0]->getRoom()->getResortId()->getId());

            $query1 = $qb1->getQuery();
            $results = $query1->getResult();
            
            return $results[0]->getTitle();
            
        }elseif($result[0]->getType()==2){
            $em = $this->getEntityManager();
            $qb = $em->createQueryBuilder();
            $qb->select('c')->from('\Base\Entity\ReservationEventRoom', 'c')
                    ->where('c.reservation='.$reservationId);

            $query = $qb->getQuery();
            $result = $query->getResult();
            
            $qb1 = $em->createQueryBuilder();
            $qb1->select('c')->from('\Base\Entity\Avp\Events', 'c')
                    ->where('c.id='.$result[0]->getEventRoom()->getEventId());

            $query1 = $qb1->getQuery();
            $results = $query1->getResult();
            
            return $results[0]->getTitle();
        }else{
            $em = $this->getEntityManager();
            $qb = $em->createQueryBuilder();
            $qb->select('c')->from('\Base\Entity\ReservationCruiseCabin', 'c')
                    ->where('c.reservation='.$reservationId);

            $query = $qb->getQuery();
            $result = $query->getResult();
            
            $qb1 = $em->createQueryBuilder();
            $qb1->select('c')->from('\Base\Entity\Avp\Cruises', 'c')
                    ->where('c.id='.$result[0]->getCabin()->getCruiseId());

            $query1 = $qb1->getQuery();
            $results = $query1->getResult();
            
            return $results[0]->getTitle();
        }
    }
    
    public function getLeads($leadId){
        $em = $this->getEntityManager();
        $item = $em->getRepository('\Base\Entity\Leads')->findOneBy(array('id' => $leadId));
        
        return $item;
    }
    public function getInventoryLead($leadId){
        $em = $this->getEntityManager();
        $item = $em->getRepository('\Base\Entity\InventoryLeads')->findOneBy(array('id' => $leadId,'isReserved'=>0));
        
//        $qb = $em->createQueryBuilder();
//        $qb->select('c')->from('\Base\Entity\InventoryLeads', 'c')
//                    ->where('c.id='.$leadId)
//                    ->where('c.isReserved=0');
//
//        $query = $qb->getQuery();
//        $item = $query->getResult();
            
        return $item;
    }
    public function getInventoryRooms($leadId){
        $em = $this->getEntityManager();
        $item = $em->getRepository('\Base\Entity\InventoryLeadRooms')->findBy(array('inventoryLeadId' => $leadId));
        
//        $qb = $em->createQueryBuilder();
//        $qb->select('c')->from('\Base\Entity\InventoryLeads', 'c')
//                    ->where('c.leadId='.$leadId);
//
//        $query = $qb->getQuery();
//        $item = $query->getResult();
            
        return $item;
    }
    public function getInventoryAddons($leadId){
        $em = $this->getEntityManager();
        $item = $em->getRepository('\Base\Entity\InventoryLeadAddOns')->findBy(array('inventoryLeadId' => $leadId));
        
//        $qb = $em->createQueryBuilder();
//        $qb->select('c')->from('\Base\Entity\InventoryLeads', 'c')
//                    ->where('c.leadId='.$leadId);
//
//        $query = $qb->getQuery();
//        $item = $query->getResult();
            
        return $item;
    }
    
    public function saveReservation($post,$addons){
//        d($post);
        
        
        $entity = new \Base\Entity\Reservation();
        $em = $this->getEntityManager();

        $entity->setType($post['type']);
        $entity->setTotalCost($post['totalcost']);
        $entity->setFinalCost($post['finalCost']);
        $entity->setPaymentType('1');
        $entity->setBalansAfterDeposit('0');
        $entity->setDateFrom(new \DateTime($post['travelFrom']));
        $entity->setDateTo(new \DateTime($post['travelTo']));
        $entity->setNoOfDays($post['days']);
        $entity->setRoomRequired($post['roomRequired']);
        $entity->setRoomRate($post['roomprice']);
        $entity->setStatus('1');
        $entity->setNoOfPersons($post['noOfpersons']);
        $addonnetCost=0;
        foreach($addons as $addon){
            if($addon->getExcursion()){
                if($post['excursion'.$addon->getExcursion()->getId()]==1){
                    $entity->setExcursionCost($post['excursionPrice'.$addon->getExcursion()->getId()]);
                    $addonnetCost+=$post['excursionNetPrice'.$addon->getExcursion()->getId()];
    //                $excursion=$this->_setReservationExcursion($entity,$addon->getExcursion());
                }
            }
            
            if($addon->getItem()){
                if($post['item'.$addon->getItem()->getId()]==1){
                    $entity->setItemCost($post['itemPrice'.$addon->getItem()->getId()]);
                    $addonnetCost+=$post['itemNetPrice'.$addon->getItem()->getId()];
    //                $item=$this->_setReservationItem($entity,$addon->getItem());
                }
            }
            if($addon->getTransfer()){
                if($post['transfer'.$addon->getTransfer()->getId()]==1){
                    $entity->setTransferCost($post['transferPrice'.$addon->getTransfer()->getId()]);
                    $addonnetCost+=$post['transferNetPrice'.$addon->getTransfer()->getId()];
    //                $transfer=$this->_setReservationTransfer($entity,$addon->getTransfer());
                }
            }
            
        }
        $referenceNo = "VP-" . mktime();
        $entity->setReferenceNumber($referenceNo);
        $entity->setIsBooked('0');
        $entity->setRoomNetCost($post['roomprice']);
        $entity->setAddonsNetCost($addonnetCost);
        $entity->setCreatedAt(new \DateTime);
        $entity->setUpdatedAt(new \DateTime);

        $em->persist($entity);
        $em->flush();

        if($post['type']==1){
           $room = $em->find('Base\Entity\Avp\ResortRooms', (int) $post['roomid']);
           $resortroom=$this->_setReservationResortRoom($entity,$room);
        }elseif($post['type']==2){
            $room = $em->find('Base\Entity\Avp\EventRooms', (int) $post['roomid']);
           $eventroom=$this->_setReservationEventRoom($entity,$room);
        }else{
            $room = $em->find('Base\Entity\Avp\CruiseCabins', (int) $post['roomid']);
            $cruiseroom=$this->_setReservationCruiseCabin($entity,$room);
        }
        
        foreach($addons as $addon){
            if($addon->getExcursion()){
                if($post['excursion'.$addon->getExcursion()->getId()]==1){
                    $excursion=$this->_setReservationExcursion($entity,$addon->getExcursion());
                }
            }
            if($addon->getItem()){
                if($post['item'.$addon->getItem()->getId()]==1){
                    $item=$this->_setReservationItem($entity,$addon->getItem());
                }
            }
            if($addon->getTransfer()){
                if($post['transfer'.$addon->getTransfer()->getId()]==1){
                    $transfer=$this->_setReservationTransfer($entity,$addon->getTransfer());
                }
            }
            
        }
        
        $i=0;
        $j=1;
        foreach($post['travellername'] as $name){
            
             $traveller = new \Base\Entity\Travellers();
             $em = $this->getEntityManager();

             $traveller->setName($name);
             $traveller->setDob(new \DateTime($post['travellerdob'][$i]));
             $traveller->setPhone($post['travellerphone'][$i]);
             $traveller->setEmail($post['travelleremail'][$i]);
             $traveller->setSex($post['travellersex'.$j]);
             
             $em->persist($traveller);
             $em->flush();
             
             $this->_setReservationTravellers($entity, $traveller);
                
            
            $i++;
            $j++;
        }
//        d($traveller);
        
        return $entity;  
    }
    
    public function updateReservationStatus($reservation){
        //d($reservation);
        $em = $this->getEntityManager();

//        $reservations = new $this->_targetEntity;
//
//
        $id = $reservation->getId();
        //echo $id;
        if (isset($id) && (int) $id != 0) {
            $reservation = $em->find('Base\Entity\Reservation', (int)$id);
        }
        //echo $reservation->getReferenceNumber();die;
        $reservation->setIsBooked('1');
        $reservation->setUpdatedAt(new \DateTime);

        $em->persist($reservation);
        $em->flush();
        
        return true;
    }
    public function updateInventoryleadStatus($inventorylead, $lead){
        
        $em = $this->getEntityManager();

//        $reservations = new $this->_targetEntity;
//
//
        $id=$inventorylead->getId();
        if (isset($id) && (int) $id != 0) {
            $inventorylead = $em->find('Base\Entity\InventoryLeads', (int) $id);
        }

        $inventorylead->setIsReserved('1');
//        d($inventorylead);
        
        $em->persist($inventorylead);
        $em->flush();
        
        $em = $this->getEntityManager();
        $lid=$lead->getId();
        if (isset($lid) && (int) $lid != 0) {
            $lead = $em->find('Base\Entity\Leads', (int) $lid);
        }

        $lead->setStatus('3');
        $em->persist($lead);
        $em->flush();
        
        return true;
    }
    
    public function saveTraveller($lead,$reservation){
        $entity = new \Base\Entity\Travellers();
        $em = $this->getEntityManager();

        $entity->setName($lead->getName());
        $entity->setPhone($lead->getPhone());
        $entity->setEmail($lead->getEmail());
        $entity->setEmail($lead->getEmail());
        
        $em->persist($entity);
        $em->flush();
        
        $this->_setReservationTravellers($reservation, $entity);
        return true;
    }
    public function saveInvoice($response,$reservation,$mode){
//        d($response);
        $entity = new \Base\Entity\OrderInvoices();
        $em = $this->getEntityManager();

        $entity->setOrderId($reservation->getId());
        $entity->setCurrencyCode($response['ACK']['CURRENCYCODE']);
        $entity->setTransactionId($response['ACK']['TRANSACTIONID']);
        $entity->setAmountPaid($response['ACK']['AMT']);
        $entity->setPaymentMode($mode);
        $entity->setDateAdded(new \DateTime);
        
        $em->persist($entity);
        $em->flush();
        
        return true;
    }
    
    public function sendquotemail($id, $to, array $params = null) {
        
        $data = $this->getItemView($id);
//        d($data);
        if ($data) {
            
            return SendmailController::sendMailOnQuoteReservation($this->_serviceManager, $to, $data, $params, 'Reservation Preview');
        }
        return false;
    }
    
    public function getPromoDiscount($post){

        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('ip')
            ->from('\Base\Entity\InventoryPromo', 'ip')
            ->where('ip.isActive = :active')
            ->setParameter('active',1)
            ->andWhere('ip.promoCode = :code')
            ->setParameter('code',$post->code)
            ->andWhere('ip.dateFrom <= :from')
            ->setParameter('from',$post->dateFrom)
             ->andWhere('ip.dateTo >= :to')
            ->setParameter('to',$post->dateTo);
        $query = $qb->getQuery();

        $collection = $query->getResult();
        return $collection;
    }
    
   public function getTravellerNotes($session){
        $date=date('Y-m-d');
//        d($date);
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('ip')
            ->from('\Base\Entity\TravellerNotes', 'ip')
            ->where("ip.reminderDate LIKE '".$date."%'");
        $query = $qb->getQuery();

        $collection = $query->getResult();
        
        foreach($collection as $note){
            $clientData=$this->_clientDetails($note->getTravellerID());
            $name=$clientData->getName();
            $message=$note->getmessage();
            $subject=$note->getSubject();
            $to=$session->getEmail();
            $cc=$clientData->getEmail();
            
            echo $cc."<br>";
            SendmailController::sendMailOnLead($this->_serviceManager, $to, $subject, $message, $cc);
            echo "check mail <br>";
        }
        return true;
    }
    
    protected function _clientDetails($clientId){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('ip')
            ->from('\Base\Entity\Avp\Clients', 'ip')
            ->where("ip.id=".$clientId);
        $query = $qb->getQuery();

        $collection = $query->getResult();
//        d($collection['0']);
        return $collection['0'];
    }
    
     public function getLeadReminder($session){
          $date=date('Y-m-d');
//        d($date);
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('ip')
            ->from('\Base\Entity\Leads', 'ip')
            ->where("ip.reminderDate LIKE '".$date."%'");
        $query = $qb->getQuery();

        $collection = $query->getResult();
        
        foreach($collection as $note){
            
            $message=$note->getMessageReminder();
            $subject=$note->getSubjectReminder();
            $to=$session->getEmail();
            $cc=$note->getEmail();
            
            echo $cc."<br>";
            SendmailController::sendMailOnLead($this->_serviceManager, $to, $subject, $message, $cc);
            echo "check mail <br>";
        }
        return true;
     }
     
      public function _getRoomDetails($roomId,$type) {
        $em = $this->getEntityManager();
        $details= array();
        switch ($type) {
            case self::RESORT_ROOM:
                $collection = $em->getRepository('\Base\Entity\Avp\ResortRooms')->findOneBy(array('id' => $roomId));
                $details['id'] = $collection->getId();
                $details['title'] = $collection->getTitle();
                $details['description'] = $collection->getDescription();
                $details['image'] = $collection->getImage();
                break;
            case self::EVENT_ROOM:
                $collection = $em->getRepository('\Base\Entity\Avp\EventRooms')->findOneBy(array('id' => $roomId));
                $details['id'] = $collection->getId();
                $details['title'] = $collection->getRoomCategory();
                $details['description'] = $collection->getRoomId()->getDescription();
                $details['image'] = $collection->getRoomId()->getImage();
                break;
            case self::CRUISE_CABIN:
                $collection = $em->getRepository('\Base\Entity\Avp\CruiseCabins')->findOneBy(array('id' => $roomId));
                $details['id'] = $collection->getId();
                $details['title'] = $collection->getDeckName();
                $details['description'] = $collection->getDescription();
                $details['image'] = $collection->getDeckImageUrl();
                break;
        }
        
        return $details;
    }
    
    protected function _calculateAffiliateCommission($object,$affiliateId){
        $typeId=$object['dataTypeId'];
        $type=$object['type'];
//        d($object);
        
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('ip')
            ->from('\Base\Entity\Avp\AffiliateCommissionRel', 'ip')
            ->where("ip.affiliateId=".$affiliateId);
        $query = $qb->getQuery();

        $collection = $query->getResult();
        
        if ($collection) {
            foreach ($collection as $rel) {
                $commission = $em->getRepository('\Base\Entity\Avp\Commissions')->findOneBy(array('id' => $rel->getCommissionId()));

                switch ($commission->getCommissionFor()) {
                    case 1:
                        $resortCommission = $em->getRepository('\Base\Entity\Avp\ResortCommissions')->findOneBy(array('commissionId' => $rel->getCommissionId()));
                        if ($resortCommission) {
                            if ($resortCommission->getResortId() == $typeId) {
                                if ($commission->getType() == "fixed") {
                                    $amount = $commission->getAmount();
                                    $commissionId = $rel->getCommissionId();
                                } else {
                                    $amount = ($commission->getAmount() / 100) * $object['finalCost'];
                                    $commissionId = $rel->getCommissionId();
                                }
                            }
                        }
                        break;
                    case 2:
                        $eventCommission = $em->getRepository('\Base\Entity\Avp\EventCommissions')->findOneBy(array('commissionId' => $rel->getCommissionId()));
                        if ($eventCommission) {
                            if ($eventCommission->getEventId() == $typeId) {
                                if ($commission->getType() == "fixed") {
                                    $amount = $commission->getAmount();
                                    $commissionId = $rel->getCommissionId();
                                } else {
                                    $amount = ($commission->getAmount() / 100) * $object['finalCost'];
                                    $commissionId = $rel->getCommissionId();
                                }
                            }
                        }
                        break;
                }
            }
        } else {
            $commission = $em->getRepository('\Base\Entity\Avp\Commissions')->findOneBy(array('general' => '1'));
            foreach($commission as $row){
              switch ($commission->getCommissionFor()) {
                  case 1:
                      $resortCommission = $em->getRepository('\Base\Entity\Avp\ResortCommissions')->findOneBy(array('commissionId' => $row->getId()));
                        if ($resortCommission) {
                            if ($resortCommission->getResortId() == $typeId) {
                                if ($row->getType() == "fixed") {
                                    $amount = $row->getAmount();
                                    $commissionId = $row->getId();
                                } else {
                                    $amount = ($row->getAmount() / 100) * $object['finalCost'];
                                    $commissionId = $row->getId();
                                }
                            }
                        }
                      break;
                  case 2:
                       $eventCommission = $em->getRepository('\Base\Entity\Avp\EventCommissions')->findOneBy(array('commissionId' => $row->getId()));
                        if ($eventCommission) {
                            if ($eventCommission->getEventId() == $typeId) {
                                if ($row->getType() == "fixed") {
                                    $amount = $row->getAmount();
                                    $commissionId = $row->getId();
                                } else {
                                    $amount = ($row->getAmount() / 100) * $object['finalCost'];
                                    $commissionId = $row->getId();
                                }
                            }
                        }
                      break;
              }  
            }
        }
        if(!empty($amount)){
            $entity = new \Base\Entity\Avp\AffiliateCommissions();
            $em = $this->getEntityManager();

            $entity->setAffiliateId($affiliateId);
            $entity->setCommissionFor($type);
            $entity->setCommissionId($commissionId);
            $entity->setOrderId($object['Reservation']);
            $entity->setAmount($amount);
            $entity->setDueDate(new \DateTime);

            $em->persist($entity);
            $em->flush();
        }
        
//        d('Success');
    }
    
    public function getTerms(){
        $em = $this->getEntityManager();
        $collection = $em->getRepository('\Base\Entity\Avp\Pages')->findOneBy(array('slug' => "terms-of-booking"));
        
        return $collection;
    }
    
    public function getRoomData($data){
       $male=$data['males']; 
       $female=$data['females']; 
       $type=$data['type']; 
       $typeId=$data['typeId']; 
       $roomId=$data['roomId']; 
       $start_date=$data['start'];
       $end_date=$data['end'];
       $currency=$data['currency'];
       //$share=(int)$data['share'];
       $share = $data['share'];
//       $totalperson=$male+$female;
       $where='(ih.dateFrom <='.$start_date.' OR ih.dateTo >=' .$start_date.') AND (ih.dateFrom <=' .$end_date.' OR ih.dateTo >='.$end_date.')';
       switch($type){
           case 1:
               $em = $this->getEntityManager();
                $qb = $em->createQueryBuilder();
                $qb->select('ih')
                    ->from('\Base\Entity\InventoryHotels', 'ih')
                    ->where('ih.resortId = '.$typeId)
                    ->andWhere('ih.roomId = '.$roomId)
                    ->andWhere($where);
                $query = $qb->getQuery();
                $collection = $query->getResult();
               break;
           case 2:
                $em = $this->getEntityManager();
                $qb = $em->createQueryBuilder();
                $qb->select('ih')
                    ->from('\Base\Entity\InventoryEvent', 'ih')
                    ->where('ih.eventId = '.$typeId)
                    ->andWhere('ih.roomId = '.$roomId)
                    ->andWhere($where);
                $query = $qb->getQuery();
                $collection = $query->getResult();
                
               break;
           case 3:
               $em = $this->getEntityManager();
                $qb = $em->createQueryBuilder();
                $qb->select('ih')
                    ->from('\Base\Entity\InventoryCruise', 'ih')
                    ->where('ih.cruiseId = '.$typeId)
                    ->andWhere('ih.suiteId = '.$roomId)
                    ->andWhere($where);
                $query = $qb->getQuery();
                $collection = $query->getResult();
               break;
       }
       
       if(!empty($collection)){
        $num=0;
        $room_cost=0;
        $totalavail=0;
        $totalperson=$male+$female;
        $doubleOccPrice=0;
        foreach($collection as $room_pr){
           // $totalavail+=$room_pr->getTotalAvailable();
            $doubleOccPrice+=$room_pr->getGrossPrice();
            $doubleOccNetPrice+=$room_pr->getNetPrice();
            if($totalperson==1){
                if($share==1){
                    if($room_pr->getSingleShare()==1){
                        $fnl_price=$doubleOccPrice;  
                        $fnl_price_net=$doubleOccNetPrice;  
                    }else{
                        $fnl_price=0;
                        $fnl_price_net=0;
                    }
                }else{
                    if($room_pr->getSinglePremiumOccupancy()==1){
                        $fnl_price=$room_pr->getSinglePriceGross();
                        $fnl_price_net=$room_pr->getSinglePriceNet();
                    }else{
                        $fnl_price=0;
                        $fnl_price_net=0;
                    }
                }
            }
            if($room_pr->getPricePer()==1){ //Per Person

                if($totalperson==2){
                    $fnl_price=$doubleOccPrice*2;
                    $fnl_price_net=$doubleOccNetPrice*2;
                }elseif($totalperson==3){
                    
                    $fnl_price=$doubleOccPrice*2;
                    $fnl_price_net=$doubleOccNetPrice*2;
                    if($room_pr->getTripleOccupancyAllowed()==1){
                        if($male>1){
                            if($room_pr->getTriplePriceMaleGross()!=0){
                                $fnl_price+=$room_pr->getTriplePriceMaleGross();
                                $fnl_price_net+=$room_pr->getTriplePriceMaleNet();
                            }else{
                                $fnl_price=0;
                                $fnl_price_net=0;
                                $msg="Triple Occupancy Male Not Allowed.";
                            }
                        }else{
                            if($room_pr->getTriplePriceFemaleGross()!=0){
                                $fnl_price+=$room_pr->getTriplePriceFemaleGross();
                                $fnl_price_net+=$room_pr->getTriplePriceFemaleNet();
                            }else{
                                $fnl_price=0;
                                $fnl_price_net=0;
                                $msg="Triple Occupancy Female Not Allowed.";
                            }
                        }
                    }else{
                        $fnl_price=0;
                        $fnl_price_net=0;
                        $msg='Triple Occupancy Not Allowed';
                    }
                }elseif($totalperson==4){

                    if($room_pr->getQuadOccupancy()==1){

                        if(($male==2 && $female==2)){
                            if($room_pr->getQuadPriceMaleGross()!=0 && $room_pr->getQuadPriceFemaleGross()!=0){
                                $fnl_price=($doubleOccPrice*2)+$room_pr->getQuadPriceMaleGross()+$room_pr->getQuadPriceFemaleGross();
                                $fnl_price_net=($doubleOccNetPrice*2)+$room_pr->getQuadPriceMaleNet()+$room_pr->getQuadPriceFemaleNet();
                            }else{
                                $fnl_price=0;
                                $fnl_price_net=0;
                                $msg="Quad Occupancy Female or Male Not Allowed.";
                            }
                        }elseif($male>2){
                            if($room_pr->getQuadPriceMaleGross()!=0){
                                $fnl_price=($doubleOccPrice*2)+($room_pr->getQuadPriceMaleGross()*2);
                                $fnl_price_net=($doubleOccNetPrice*2)+($room_pr->getQuadPriceMaleNet()*2);
                            }else{
                                $fnl_price=0;
                                $fnl_price_net=0;
                                $msg="Quad Occupancy Male Not Allowed.";
                            }
                        }elseif($female>2){
                            if($room_pr->getQuadPriceFemaleGross()!=0){
                                $fnl_price=($doubleOccPrice*2)+($room_pr->getQuadPriceFemaleGross()*2);
                                $fnl_price_net=($doubleOccNetPrice*2)+($room_pr->getQuadPriceFemaleNet()*2);
                            }else{
                                $fnl_price=0;
                                $fnl_price_net=0;
                                $msg="Quad Occupancy Female Not Allowed.";
                            }
                        }
                    }else{
                        $fnl_price=0;
                        $fnl_price_net=0;
                        $msg="Quad Occupancy Not Allowed.";
                    }
                }
            }else{
                $show="room";
                if($totalperson==2){
                    $fnl_price=$doubleOccPrice;
                    $fnl_price_net=$doubleOccNetPrice;
                }elseif($totalperson==3){
                    $fnl_price=$doubleOccPrice;
                    $fnl_price_net=$doubleOccNetPrice;
                    if($room_pr->getTripleOccupancyAllowed()==1){
                        if($male>1){
                            if($room_pr->getTriplePriceMaleGross()!=0){  
                                $fnl_price+=$room_pr->getTriplePriceMaleGross();
                                $fnl_price_net+=$room_pr->getTriplePriceMaleNet();
                        }else{
                            $fnl_price=0;
                            $fnl_price_net=0;
                            $msg="Triple Occupancy Male Not Allowed.";
                        }
                        }else{
                            if($room_pr->getTriplePriceFemaleGross()!=0){  
                                $fnl_price+=$room_pr->getTriplePriceFemaleGross();
                                $fnl_price_net+=$room_pr->getTriplePriceFemaleNet();
                            }else{
                             $fnl_price=0;
                             $fnl_price_net=0;
                             $msg="Triple Occupancy Female Not Allowed.";
                            }
                        }
                    }else{
                        $fnl_price=0;
                        $fnl_price_net=0;
                        $msg="Triple Occupancy Not Allowed.";
                    }
                }elseif($totalperson==4){
                    if($room_pr->getQuadOccupancy()==1){
                     /*if(isset($cur_chng['currency_code'])&& !empty($cur_chng['currency_code'])){
                         $mod_qpricem = $room_pr['quad_price_male_gross']*$cur_chng['currency_value'];
                         $mod_qpricef = $room_pr['quad_price_female_gross']*$cur_chng['currency_value'];
                         $qpricem=number_format((float)$mod_qpricem, 2, '.', '');
                         $qpricef=number_format((float)$mod_qpricef, 2, '.', '');
                     }else{
                         $qpricem=$room_pr['quad_price_male_gross'];
                         $qpricef=$room_pr['quad_price_female_gross'];
                     }*/
                    if(($male==2 && $female==2)){
                        if($room_pr->getQuadPriceMaleGross()!=0 && $room_pr->getQuadPriceFemaleGross()!=0){
                            $fnl_price=$doubleOccPrice+$room_pr->getQuadPriceMaleGross()+$room_pr->getQuadPriceFemaleGross();
                            $fnl_price_net=$doubleOccNetPrice+$room_pr->getQuadPriceMaleNet()+$room_pr->getQuadPriceMaleNet();
                        }else{
                          $fnl_price=0;
                          $fnl_price_net=0;
                          $msg="Quad Occupancy Male or Female Not Allowed.";
                      }
                    }elseif($male>2){
                        if($room_pr->getQuadPriceMaleGross()!=0){
                            $fnl_price=$doubleOccPrice+($room_pr->getQuadPriceMaleGross()*2);
                            $fnl_price_net=$doubleOccNetPrice+($room_pr->getQuadPriceMaleNet()*2);
                        }else{
                          $fnl_price=0;
                          $fnl_price_net=0;
                          $msg="Quad Occupancy Male Not Allowed.";
                      }
                    }elseif($female>2){
                        if($room_pr->getQuadPriceFemaleGross()!=0){
                            $fnl_price=$doubleOccPrice+($room_pr->getQuadPriceFemaleGross()*2);
                            $fnl_price_net=$doubleOccNetPrice+($room_pr->getQuadPriceFemaleNet()*2);
                        }else{
                          $fnl_price=0;
                          $fnl_price_net=0;
                          $msg="Quad Occupancy Female Not Allowed.";
                      }
                    }
                }else{
                    $fnl_price=0;
                    $fnl_price_net=0;
                    $msg="Quad Occupancy Not Allowed.";
                }
            }
        }
        $totalmales+=$room_pr->getMalesCount();
        $totalfemales+=$room_pr->getFemalesCount();
        
        $num++;
        }
         $fnl_price=$fnl_price/$num;
         $fnl_price_net=$fnl_price_net/$num;
         //$finalMales=$totalmales/$num;
         //$finalFemales=$totalfemales/$num;
         if($currency!="USD"){
             $from = 'USD';
            $to = $currency;
            $url = 'http://finance.yahoo.com/d/quotes.csv?f=l1d1t1&s='.$from.$to.'=X';
            $handle = fopen($url, 'r');

            if ($handle) {
                $result = fgetcsv($handle);
                fclose($handle);
            }
            if(!empty($result[0])){
                $currency_info=array('currency_code'=>$currency,'currency_value'=>$result[0]);
                $fnl_price=$fnl_price*$result[0];
                $fnl_price=number_format((float)$fnl_price, 2, '.', '');
                $fnl_price_net=$fnl_price_net*$result[0];
                $fnl_price_net=number_format((float)$fnl_price_net, 2, '.', '');
            }
         }
         if($male>$totalmales){
            $finalPrice=array('msg'=>'Sorry Males occupancy reached','price'=>'0','netprice'=>'0','currency'=>$currency);
         }elseif($female>$totalfemales){
            $finalPrice=array('msg'=>'Sorry Females occupancy reached','price'=>'0','netprice'=>'0','currency'=>$currency);
         }else{
            $finalPrice=array('msg'=>isset($msg)?$msg:'','price'=>$fnl_price,'netprice'=>$fnl_price_net,'currency'=>$currency);
         }
       }else{
           $finalPrice=array('msg'=>isset($msg)?$msg:'','price'=>0,'netprice'=>0,'currency'=>$currency);
       }
       //echo "sdfasd";
       return $finalPrice;
    }
    
    
    public function checkOccupancy($post,$count){
       $where='(ih.dateFrom <='.$post['start'].' OR ih.dateTo >=' .$post['start'].') AND (ih.dateFrom <=' .$post['end'].' OR ih.dateTo >='.$post['end'].')';
       switch($post['type']){
           case 1:
               break;
           case 2:
                $em = $this->getEntityManager();
                $qb = $em->createQueryBuilder();
                $qb->select('ih')
                    ->from('\Base\Entity\InventoryEvent', 'ih')
                    ->where('ih.eventId = '.$post['typeId'])
                    ->andWhere('ih.roomId = '.$post['roomId'])
                    ->andWhere($where);
                $query = $qb->getQuery();
                $collection = $query->getResult();
                
               break;
           case 3:
               break;
       }
       
       if(!empty($collection)){
           if($count==3){
               if($collection['0']->getTripleOccupancyAllowed()==1){
                   return 1; 
               }else{
                   return 2;
               }
           }elseif($count==4){
               if($collection['0']->getQuadOccupancy()==1){
                   return 1; 
               }else{
                   return 3;
               }
           }
       }
    }
}


