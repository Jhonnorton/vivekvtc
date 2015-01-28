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
    
    public function getReservationByIdCollection($id){    	        
        $collection = $this->getEntityManager()->getRepository('\Base\Entity\Reservation')->findOneBy(array('id'=>$id));     
        return  $collection;       
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

    public function getReservation($eventid = null, $roomid = null, $type = null, $sort = false, $currency = null) {
        $em = $this->getEntityManager();

        $currency = 'USD';
        $from = 'USD';
        $to = $currency;
        $url = 'http://finance.yahoo.com/d/quotes.csv?f=l1d1t1&s=' . $from . $to . '=X';

        // d($url);
        $handle = fopen($url, 'r');

        if ($handle) {
            $result = fgetcsv($handle);
            fclose($handle);
        }

      
        $type = 1;
        $roomid = 16;//14; //55->resort;//15->CRUISE;//44->event;
        $eventid = 20; //37->resort;//7->CRUISE; //64->event;
        //$typeForAddons = 6;
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
                        'room' => $this->_getRoomName($roomid),
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

    public function save($object) {
//d($object);
        $em = $this->getEntityManager();
        $items = $this->_setItems($object);

        $travellers = $this->_setClientsObject($object);
        $room = $this->_setSellItem($object);
        $excursions = $this->_setExcursions($object);
        $transfers = $this->_setTransfers($object);

        $room = $this->_setSellItem($object);

        $reservation = $this->_setReservation($object);
        //  d('success');
        //      die;

        $this->_setReservationPaymentDue($reservation, $object); //set up multiple payment dues

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

        if (!empty($data['nextPaymentDue'])) {

            //  d('here');  
            $due = count($data['nextPaymentDue']);
            if ((int) $due > 0) {
                for ($i = 0; $i < $due; $i++) {
                    if ($data['nextPaymentDue'][$i]) {
                        $entity = new \Base\Entity\ReservationPaymentDue();
                        $entity->setReservation($reservation);
                        $entity->setPaymentDue($data['nextPaymentDue'][$i]);
                        $entity->setDueDate(isset($data['dueDate1'][$i]) ? new \DateTime($data['dueDate1'][$i]) : null);
                        $em = $this->getEntityManager();
                        $em->persist($entity);
                        $em->flush();
                    }
                }
            }
        }
        $entity1 = new \Base\Entity\ReservationPaymentDue();
        $entity1->setReservation($reservation);
        $entity1->setPaymentDue($data['finalPaymentDue']);
        $entity1->setDueDate(isset($data['dueDate2']) ? new \DateTime($data['dueDate2']) : null);
        $em = $this->getEntityManager();

        $em->persist($entity1);
        $em->flush();
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

    protected function _setSellItem($data) {

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
        $object->setAddress($data['travellerAddress']);
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

    protected function _setReservation($data) {

        $em = $this->getEntityManager();

        $reservation = new $this->_targetEntity;

        $flight = isset($data['flight']) ? $data['flight'] : null;

        $clientNotes = isset($data['clientNotes']) ? $data['clientNotes'] : null;
        $adminNotes = isset($data['adminNotes']) ? $data['adminNotes'] : null;

        $reservation->setType($data['type']);
        $reservation->setDateFrom(new \DateTime($data['travelFrom']));
        $reservation->setDateTo(new \DateTime($data['travelTo']));

        if ($flight) {
            $reservation->setFlight($flight);
            $reservation->setDepartureFrom($data['flightGoingAway']);
            $reservation->setDepartureTo($data['flightReturnHome']);
            $reservation->setReturnFrom((isset($data['returnFrom'])) ? $data['returnFrom'] : null);
            $reservation->setReturnTo((isset($data['returnTo'])) ? $data['returnTo'] : null);
            $reservation->setFlightTotalCost($data['flightTotalCost']);
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

        $referenceNo = "VP-" . mktime();
        $reservation->setReferenceNumber($referenceNo);
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

    protected function _setReservationCruiseCabin(\Base\Entity\Reservation $reservation, \Base\Entity\InventoryCruise $room) {

        $entity = new \Base\Entity\ReservationCruiseCabin();

        $entity->setReservation($reservation);
        $entity->setCabin($room);

        $em = $this->getEntityManager();
        $em->persist($entity);
        $em->flush();

        return $entity;
    }

    protected function _setReservationEventRoom(\Base\Entity\Reservation $reservation, \Base\Entity\InventoryEvent $room) {

        $entity = new \Base\Entity\ReservationEventRoom();

        $entity->setReservation($reservation);
        $entity->setEventRoom($room);

        $em = $this->getEntityManager();
        $em->persist($entity);
        $em->flush();
        //d($entity);
        return $entity;
    }

    protected function _setReservationResortRoom(\Base\Entity\Reservation $reservation, \Base\Entity\InventoryHotels $room) {

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

        $this->_updateBookingCountOfSellItem($ReservationObject->reservationobject, $room->room); //update booking count
        $this->_savePaymentDetails($reservation, $response);

        if ($reservation->gePaymentType == 1):
            $res->setStatus(2);
            $em->persist($res);
            $em->flush();
        endif;
        return $entity;
    }

    public function updatePaymentDoDirectStatus($reservation, $response) {

        //  d($reservation);
        $em = $this->getEntityManager();
        // $reservation = $reservation->reservation;

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
        return $entity;
    }

    protected function _savePaymentDetails($reservation, $response) {
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
                ->setParameter('endid', $datebefore7days);

        $query = $qb->getQuery();
        $results = $query->getResult();

//       d($results);
        return $results;
    }

    public function updateDuePaymentStatus($reservation, $response, $allvalue = null) {

        $reservation = $this->_setReservationDue($reservation,$response);
        // d('success');
        $this->_saveDuePaymentDetails($reservation,$response);

        $em = $this->getEntityManager();
        $entity = '\Base\Entity\ReservationPaymentDue';
       
        $paymentdueid = $allvalue['collection'][0]->getId();
        //d($paymentdue);
        $this->_setPaymentDue($paymentdueid, $reservation);


        //   d('success');
    }

    protected function _setReservationDue($data, $response) {

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

    protected function _setPaymentDue($id, $reservation) {

        // d('here');


        $em = $this->getEntityManager();

        $entity = new $this->_targetEntity;


        if (isset($id) && (int) $id != 0) {
            $entity = $em->find('\Base\Entity\ReservationPaymentDue', (int) $id);
        }

        $entity->setPaymentDue(0);
        $entity->setStatus(1);
        $em->persist($entity);
        $em->flush();

       // d('success');

        return true;
    }

   
      protected function _saveDuePaymentDetails($reservation,$response){


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

    public function getPaymentduesnew($page = null) {

        //   $collection = parent::getCollection($page);
        $em = $this->getEntityManager();
        $collection = $em->getRepository('\Base\Entity\ReservationPaymentDue')->findBy(array('status'=>0));
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
       protected function _getTravellersDetail($reservationId) {

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

    
     public function getCountry($id = 0){ 
         
        $em = $this->getEntityManager(); 
        $country = $em->find('Base\Entity\Countries', (int)$id);                
        if($country){
            
          //  d($country->getIso2());
            return $country->getIso2();        
        }
        return '';
    }
    
    
    
     public function updatePaymentStatusForExpress($reservation, $response,$paymentdue) {

        $em = $this->getEntityManager();
      
          //  d('2112');
        $id = $reservation->reservation;
        $reservation=$this->getReservationByIdCollection($id);
        
        $reservation = $this->_setReservationDue($reservation,$response);
        
        $em = $this->getEntityManager();
        $entity = '\Base\Entity\ReservationPaymentDue';
       
        $paymentdueid = $paymentdue->payment;
        //d($paymentdue);
        $this->_setPaymentDue($paymentdueid, $reservation);
        
        $this->_saveDuePaymentDetails($reservation,$response);
        
        d('Thank You');
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
        return $entity;*/
    }
    
    public function sendmailreminder($to,$id,array $params = null) {
       // $data = $this->getItemView($id);
       // if ($data) {
            return SendmailController::sendMailOnReminder($this->_serviceManager, $to, $id, $params, ' Payment Reminder for Res no. ');
       // }
        return false;
    }
    
     public function getRoomsAvailable($roomId = null,$start=null,$end=null) {
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
        
        $stock = $this->findRoomsInventory($roomId ,$start,$end);
        if($stock):
            $stockCount = min($stock['stock']);
            $data = array("count"=>$stockCount - $count[0]['booked'],"data"=>$stock['data']);
            else:
                $d =  array("dateFrom"=>"","dateTo"=>"","grossPrice"=>0);
                $data = array("count"=> 0,"data"=> $d);
        endif;


        return  $data;
    }

    
    
    
}