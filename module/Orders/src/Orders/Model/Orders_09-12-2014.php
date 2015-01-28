<?php

namespace Orders\Model;

use Zend\InputFilter\Factory as InputFactory;     // <-- Add this import
use Zend\InputFilter\InputFilter;                 // <-- Add this import
use Zend\InputFilter\InputFilterAwareInterface;   // <-- Add this import
use Zend\InputFilter\InputFilterInterface;        // <-- Add this import
use Sendmail\Controller\SendmailController;
use Doctrine\ORM\Query\ResultSetMapping;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;
use Inventory\Model\Items;
use Inventory\Model\Excursions;
use Inventory\Model\Transfers;

class Orders extends \Base\Model\BaseModel implements InputFilterAwareInterface {

    protected $inputFilter;
    protected $models = null;

    const DAYS_120_BEFORE = 1;
    const DAYS_120_90_BEFORE = 2;
    const DAYS_60_AND_LESS_BEFORE = 3;
    const RESORT_ROOM = 1;
    const EVENT_ROOM = 2;
    const CRUISE_CABIN = 3;
    const CANCELED = 0;
    const OPEN_BALANCE = 1;
    const CLOSED_BALANCE = 2;

    public function __construct($serviceManager, $targetEntity = false) {
        parent::__construct($serviceManager, $targetEntity);
    }

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

        //return array();
        //  $collection =  parent::getCollection($page);

        if (!empty($startdate) || !empty($enddate)) {

            //  $collection = parent::getCollection($page);
            
             If (!empty($startdate) && !empty($enddate)) {
                $qury = "c.createdAt >= '$startdate' AND c.createdAt <= '$enddate' AND c.isBooked=1";
            } else if (!empty($startdate) && empty($enddate)) {

                $qury = "c.createdAt >= '$startdate' AND c.isBooked=1";
            } else if (empty($startdate) && !empty($enddate)) {

                $qury = "c.createdAt <= '$enddate' AND c.isBooked=1";
            }

            $em = $this->getEntityManager();
            //$travellers = array();
            $em = $this->_serviceManager->get('doctrine.entitymanager.orm_avp');
            $qb = $em->createQueryBuilder();

            //  $collection = $em->getRepository('\Base\Entity\ReservationT')->findBy(array('reservation' => $reservationId));
            // d($collection);
            $qb->select('c')->from('\Base\Entity\Reservation', 'c')
                    ->where($qury)
                    ->orderBy('c.id', 'DESC');
                  //  ->setParameter('id', $startdate)
                  //  ->setParameter('endid', $enddate);

            $query = $qb->getQuery();
            $collection = $query->getResult();


            //  die;
        } else {

            //$collection = parent::getCollection($page);
            $em = $this->getEntityManager();
            $qb = $em->createQueryBuilder();

            $qb->select('c')->from('\Base\Entity\Reservation', 'c')
                    ->where("c.isBooked=1")
                    ->orderBy('c.id', 'DESC');
            $query = $qb->getQuery();
            $collection = $query->getResult();
        }

//          d($collection);
        //     die;
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
                'allTraveller' => $this->_getAllTravellers($item->getId())
            );
        }

        return $newCollection;
    }

    public function getCollectionDetail($page = null) {

        $collection = parent::getCollection($page);
        $newCollection = array();
        foreach ($collection as $item) {
            $newCollection[$item->getId()] = array(
                'id' => $item->getId(),
                'type' => $this->_getType($item->getType()),
                'roomId' => $this->_getItemNameDetail($item->getId(), $item->getType()),
                'hotelId' => $this->_getHotelNameDetail($item->getId(), $item->getType()),
                'travellers' => $this->_getTravellersDetail($item->getId()),
                'paymentDues' => $this->_getPaymentDuesDetail($item->getId()),
                'reservation' => $item,
                'status' => $this->_getStatus($item->getStatus()),
                'excursions' => $this->_getExcursions($item->getId()),
                'items' => $this->_getItems($item->getId()),
                'transfers' => $this->_getTransfers($item->getId()),
            );
        }

        return $newCollection;
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

    public function getItemView($id) {

       // $collection = $this->getCollection();

         $em = $this->getEntityManager();
         $qb = $em->createQueryBuilder();

         $qb->select('c')->from('\Base\Entity\Reservation', 'c')
                    ->where("c.id=".$id);
         $query = $qb->getQuery();
         $collection = $query->getResult();
        
        $newCollection = array();
        foreach ($collection as $item) {
            $newCollection[$item->getId()] = array(
                'id' => $item->getId(),
                'type' => $this->_getType($item->getType()),
                'roomName' => $this->_getItemName($item->getId(), $item->getType()),
                'hotelName' => $this->_getHotelName($item->getId(), $item->getType()),
                'travellers' => $this->_getTravellers($item->getId()),
                'paymentDues' => $this->_getPaymentDues($item->getId()),
                'reservation' => $item,
                'status' => $this->_getStatus($item->getStatus()),
                'allTraveller' => $this->_getAllTravellers($item->getId())
            );
        }

        return $newCollection[$id];
        
        //return $collection[$id];
    }

    public function getItemViewDetail($id) {

        $collection = $this->getCollectionDetail();

        return $collection[$id];
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
    
    protected function _getAllTravellers($reservationId) {

        $em = $this->getEntityManager();

        $travellers = array();

        $collection = $em->getRepository('\Base\Entity\ReservationTravellers')->findBy(array('reservation' => $reservationId));

        foreach ($collection as $traveller) {
           // $travellers[] = $traveller->getTraveller()->getName();
            $travellers[] = $traveller->getTraveller();
        }

        return $travellers;
    }

    protected function _getExcursions($reservationId) {

        $em = $this->getEntityManager();

        $excursions = array();

        $collection = $em->getRepository('\Base\Entity\ReservationExcursion')->findBy(array('reservation' => $reservationId));

        foreach ($collection as $excursion) {
            $excursions[] = $excursion->getExcursion()->getId();
        }

        return $excursions;
    }

    protected function _getItems($reservationId) {

        $em = $this->getEntityManager();

        $items = array();

        $collection = $em->getRepository('\Base\Entity\ReservationItem')->findBy(array('reservation' => $reservationId));

        foreach ($collection as $item) {
            $items[] = $item->getItem()->getId();
        }

        return $items;
    }

    protected function _getTransfers($reservationId) {

        $em = $this->getEntityManager();

        $transfers = array();

        $collection = $em->getRepository('\Base\Entity\ReservationTransfer')->findBy(array('reservation' => $reservationId));

        foreach ($collection as $transfer) {
            $transfers[] = $transfer->getTransfer()->getId();
        }

        return $transfers;
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

    protected function _getHotelName($reservationId, $type) {

        $em = $this->getEntityManager();


        switch ($type) {
            case self::RESORT_ROOM:
                $item = $em->getRepository('\Base\Entity\ReservationResortRoom')->findOneBy(array('reservation' => $reservationId));

                if ($item) {
                    $resortid = $item->getRoom()->getResortId();
                    $na = $em->getRepository('\Base\Entity\Avp\Resorts')->findOneBy(array('id' => $resortid));
                }
                $name = !is_null($na) ? $na->getTitle() : null;
                break;
            case self::EVENT_ROOM:
                $item = $em->getRepository('\Base\Entity\ReservationEventRoom')->findOneBy(array('reservation' => $reservationId));
                if ($item) {
                    $eventId = $item->getEventRoom()->getEventId();
                    $na = $em->getRepository('\Base\Entity\Avp\Events')->findOneBy(array('id' => $eventId));
                }
                $name = !is_null($na) ? $na->getTitle() : null;
                break;
            case self::CRUISE_CABIN:
                $item = $em->getRepository('\Base\Entity\ReservationCruiseCabin')->findOneBy(array('reservation' => $reservationId));
                if ($item) {
                    $cruiseId = $item->getCabin()->getCruiseId();
                    $na = $em->getRepository('\Base\Entity\Avp\Cruises')->findOneBy(array('id' => $cruiseId));
                }
                $name = !is_null($na) ? $na->getTitle() : null;
                break;
        }

        return $name;
    }

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

    public static function getDiffDatesIndex(\DateTime $dateStart, \DateTime $dateEnd) {

        $interval = (int) $dateStart->diff($dateEnd)->format('%R%a');

        if ($interval >= 120)
            return self::DAYS_120_BEFORE;

        if ($interval < 120 && $interval >= 60)
            return self::DAYS_120_90_BEFORE;

        if ($interval < 60)
            return self::DAYS_60_AND_LESS_BEFORE;
    }

    public function save($object) {

        $em = $this->getEntityManager();

        $travellers = $this->_setClientsObject($object);
        $items = $this->_setItems($object);
        $room = $this->_setSellItem($object);

        $excursions = $this->_setExcursions($object);
        $transfers = $this->_setTransfers($object);

        $reservation = $this->_setReservation($object);

        $this->_setReservationPaymentDue($reservation, $object); //set up multiple payment dues

        $this->setSessionData('Room', 'room', $room);
        $this->setSessionData('ReservationObject', 'reservationobject', $object);

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



        return $reservation;
    }

    /**
     * @param type $object
     * @return type
     * for saved draft
     */
    public function update($object, $e) {
//        d($object);
        $em = $this->getEntityManager();
        $rsm = new ResultSetMapping();
        //delete travellers data
        //d($e);
        $id = $e->getId();
        $t = $e->getType();
        $query1 = 'DELETE FROM reservation_travellers WHERE reservation_id =' . $id;
        $stmt = $em->getConnection()->prepare($query1);
        $stmt->execute();

        //delete excursions data
        $query1 = 'DELETE FROM reservation_excursion WHERE reservation_id =' . $id;
        $stmt = $em->getConnection()->prepare($query1);
        $stmt->execute();

        //delete items data
        $query1 = 'DELETE FROM reservation_item WHERE reservation_id =' . $id;
        $stmt = $em->getConnection()->prepare($query1);
        $stmt->execute();

        //delete reservation_transfer data
        $query1 = 'DELETE FROM reservation_transfer WHERE reservation_id =' . $id;
        $stmt = $em->getConnection()->prepare($query1);
        $stmt->execute();

        //delete reservation_payment_due data
        $query1 = 'DELETE FROM reservation_payment_due WHERE reservation_id =' . $id;
        $stmt = $em->getConnection()->prepare($query1);
        $stmt->execute();

        if ($t == 1):
            //delete reservation_resort_room data
            $query1 = 'DELETE FROM reservation_resort_room WHERE reservation_id =' . $id;
            $stmt = $em->getConnection()->prepare($query1);
            $stmt->execute();
        endif;

        if ($t == 2):
            //delete reservation_resort_room data
            $query1 = 'DELETE FROM reservation_event_room WHERE reservation_id =' . $id;
            $stmt = $em->getConnection()->prepare($query1);
            $stmt->execute();
        endif;

        if ($t == 3):
            //delete reservation_resort_room data
            $query1 = 'DELETE FROM reservation_cruise_cabin WHERE reservation_id =' . $id;
            $stmt = $em->getConnection()->prepare($query1);
            $stmt->execute();
        endif;

        //delete reservation data
//        $query1 = 'DELETE FROM reservation WHERE id =' .$id;
//        $stmt = $em->getConnection()->prepare($query1);
//        $stmt->execute();

        $travellers = $this->_setClientsObject($object);
        $items = $this->_setItems($object);
        $room = $this->_setSellItem($object);
        $excursions = $this->_setExcursions($object);
        $transfers = $this->_setTransfers($object);

        $reservation = $this->_setReservation($object,1);

        //d($room);

        $this->_setReservationPaymentDue($reservation, $object); //set up multiple payment dues
        //$this->_updateBookingCountOfSellItem($object, $room); //update booking count

        //added session variables on 13-08-2014
        
        $this->setSessionData('Room', 'room', $room);
        $this->setSessionData('ReservationObject', 'reservationobject', $object);
        
        
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



        return $reservation;
    }

//    protected function _setReservationCruiseCabin(\Base\Entity\Reservation $reservation, \Base\Entity\InventoryCruise $room) {
//
//        $entity = new \Base\Entity\ReservationCruiseCabin();
//
//        $entity->setReservation($reservation);
//        $entity->setCabin($room);
//
//        $em = $this->getEntityManager();
//        $em->persist($entity);
//        $em->flush();
//
//        return $entity;
//    }
//    protected function _setReservationEventRoom(\Base\Entity\Reservation $reservation, \Base\Entity\InventoryEvent $room) {
//
//        $entity = new \Base\Entity\ReservationEventRoom();
//
//        $entity->setReservation($reservation);
//        $entity->setEventRoom($room);
//
//        $em = $this->getEntityManager();
//        $em->persist($entity);
//        $em->flush();
//
//        return $entity;
//    }
//    protected function _setReservationResortRoom(\Base\Entity\Reservation $reservation, \Base\Entity\InventoryHotels $room) {
//
//        $entity = new \Base\Entity\ReservationResortRoom();
//
//        $entity->setReservation($reservation);
//        $entity->setRoom($room);
//
//        $em = $this->getEntityManager();
//        $em->persist($entity);
//        $em->flush();
//
//        return $entity;
//    }

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

    protected function _setReservationPaymentDue(\Base\Entity\Reservation $reservation, $data) {
        //d($data);die;
        $due = count($data['nextPaymentDue']);
        if ((int) $due > 0) {
            for ($i = 0; $i < $due; $i++) {
                if ($data['nextPaymentDue'][$i] > 0) {
                    $entity = new \Base\Entity\ReservationPaymentDue();
                    $entity->setReservation($reservation);
                    $entity->setPaymentDue($data['nextPaymentDue'][$i]);
                    $entity->setDueDate(isset($data['dueDate1'][$i]) ? new \DateTime($data['dueDate1'][$i]) : null);
                    $entity->setIsManual($data['depositMethod']);
                    $em = $this->getEntityManager();
                    $em->persist($entity);
                    $em->flush();
                }
            }
        }
        return true;
    }

    protected function _setReservation($data,$source=null) {

        $em = $this->getEntityManager();
//d($data);
        $reservation = new $this->_targetEntity;
        if (isset($data['id']) && (int) $data['id'] != 0) {
            $reservation = $em->find('Base\Entity\Reservation', (int) $data['id']);
        }

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

         if( $source == 1){
            $reservation->setAppliDiscount($data['discount']+$data['olddiscount']);
         }else{
             $reservation->setAppliDiscount($data['discount']);
         }
        $reservation->setTotalCost($data['totalCost']);
        $reservation->setMerchantFee($data['merchantFee']);
        $reservation->setFinalCost($data['finalCost']);
        
        if( $source == 1){
        //if($data['balansAfterDeposit'] <= 0 && $source == 1){
            if($data['refund']!=''){
                $reservation->setPaymentType(2);
            }else{
                $reservation->setPaymentType($data['paymentTypes']);
            }
        }else{
            
             $reservation->setPaymentType($data['paymentType']);
        }

        
        if($source == 1 && $reservation->getIsBooked() == 1){
            $reservation->setDepositAmoun($reservation->getDepositAmoun()+$data['depositAmount']);
        }else{
            $reservation->setDepositAmoun($data['depositAmount']);
        }
        $reservation->setDepositMethod($data['depositMethod']);
        $reservation->setBalansAfterDeposit($data['balansAfterDeposit']);
        //$reservation->setNextPaymentDue($data['nextPaymentDue']);
        //$reservation->setDueDate1(isset($data['dueDate1'])? new \DateTime($data['dueDate1']):null);
        // $reservation->setFinalPaymentDue($data['finalPaymentDue']);
        // $reservation->setDueDate2(isset($data['dueDate1'])? new \DateTime($data['dueDate2']):null);
        $reservation->setClientNotes($clientNotes);
        $reservation->setAdminNotes($adminNotes);
        if($source != 1 ){
            $reservation->setCreatedAt(new \DateTime);
        }
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
        if (empty($data['id'])) {
            $referenceNo = "VP-" . mktime();
            $reservation->setReferenceNumber($referenceNo);
        }

        if (isset($data['id']) && (int) $data['id'] != 0) {
            $reservation->setStatus($data['status']);
        }
        // d($data);
        //echo $data['addonsNetPrice'];die;
        $reservation->setRoomNetCost((int) $data['roomNetPrice']);
        $reservation->setAddonsNetCost((int) $data['addonsNetPrice']);
        
         if($data['roomCategory'] != ""){
            $reservation->setRoomId((int)$data['roomCategory']);
        }
        
        $reservation->setDiscountType((int) $data['discountType']);
        $reservation->setCurrencyCode("USD");
        if($source == 1 && $data['depositAmount'] <= 0){
            $reservation->setIsBooked(1);
        }

        if($source == 1){
            if($data['refund']!=''){
                $reservation->setIsRefund(1);
                $reservation->setRefundAmt($data['refund']);
                $reservation->setExtraAmtPaid('0');
                $reservation->setIsExtraPaid(0);
            }else if($data['toPay']!=''){
                $reservation->setIsRefund(0);
                $reservation->setRefundAmt('0');
                $reservation->setExtraAmtPaid($data['toPay']);
                $reservation->setIsExtraPaid(0);
                if($data['paymentTypes']==0){
                    $reservation->setExtraDepAmt($data['depositAmount']);
                }else{
                    $reservation->setExtraDepAmt($data['toPay']);
                }
            }
            $reservation->setIsUpdated(1);
        }
        
        $em->persist($reservation);
        $em->flush();

        return $reservation;
    }

//    protected function _setSellItem($data) {
//
//        $type = (int) $data['type'];
//
//        switch ($type) {
//            case self::RESORT_ROOM:
//                $model = 'InventoryHotels';
//                $key = 'roomCategory';
//                break;
//            case self::EVENT_ROOM:
//                $model = 'InventoryEvent';
//                $key = 'roomCategory';
//                break;
//            case self::CRUISE_CABIN:
//                $model = 'InventoryCruise';
//                $key = 'suiteName';
//                break;
//        }
//
//
//
//        $model = $this->_serviceManager->get($model);
//
//        $returnItem = $model->getItem($data[$key]);
//
//        return $returnItem;
//    }

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

    protected function _setItems($data) {

        $model = $this->_serviceManager->get('Items');

        $items = array();

        if (!empty($data['items'])):
            foreach ($data['items'] as $id) {

                $item = $model->getItem($id);

                if ($item)
                    $items[$item->getId()] = $item;
            }
        endif;

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

    protected function _setClientsObject($data) {
//d($data);
        $em = $this->getEntityManager();

        $entity = '\Base\Entity\Travellers';

        $travellers = array();

        $object = new $entity;

        if((int) $data['travellerCountry'] !=  0){
            $data['travellerCountry'] = $em->find('Base\Entity\Countries', (int) $data['travellerCountry']);
        

        //if (!is_null($data['travellerCountry']))
            $data['travellerCountry'] = $data['travellerCountry']->getCountryName();
        }else{
           $data['travellerCountry'] = ''; 
        }

        $object->setName($data['travellerName']);
        $object->setDob(new \DateTime($data['travellerDOB']));
        $object->setPhone($data['travellerPhone']);
        $object->setEmail($data['travellerEmail']);
        $object->setAddress($data['travellerAddress']);
        $object->setCity($data['travellerCity']);
        $object->setState($data['travellerState']);
        $object->setCountry($data['travellerCountry']);
        $object->setZip($data['travellerZip']);
        $object->setSex($data['sex']);

        $em->persist($object);
        $em->flush();

        $travellers[$object->getId()] = $object;

        $otherTravellers = count($data['tname']);

        if ((int) $otherTravellers > 0) {
            $j = 2;
            for ($i = 0; $i < $otherTravellers; $i++) {

                //d($data['tDob']);

                $object = new $entity;

                $object->setName($data['tname'][$i]);
                $object->setDob(new \DateTime($data['tDob'][$i]));
                $object->setPhone($data['tPhone'][$i]);
                $object->setEmail($data['tEmail'][$i]);
                $object->setSex((int) $data['tsex_' . $j]);

                $object->setAddress($data['tAddress'][$i] ? $data['tAddress'][$i] : null);

                //d($object->getDob());

                $em->persist($object);
                $em->flush();

                $j++;

                if ($object->getId())
                    $travellers[$object->getId()] = $object;
            }
        }

        return $travellers;
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

    public function cancelReservation($id) {
        $item = $this->getItem($id);
        if ($item) {
            $item->setStatus(self::CANCELED);
            parent::save($item);
        }
    }

    public function sendmail($id, $to, array $params = null) {
        $data = $this->getItemView($id);
        if ($data) {
            return SendmailController::sendMailOnReservation($this->_serviceManager, $to, $data, $params, 'Your Reservation Confirmation');
        }
        return false;
    }

    protected function _updateBookingCountOfSellItem($data, $room) {

        $em = $this->getEntityManager();

        switch ($data['type']) {
            case self::RESORT_ROOM:
                $entity = '\Base\Entity\InventoryHotels';
                $bookingUpdate = $em->find($entity, (int) $data['roomCategory']);
                // $bookingUpdate->setBookedCount($room->getBookedCount() + $data['roomRequired']);

                $em->persist($bookingUpdate);
                $em->flush();

                return $bookingUpdate;
                break;
            case self::EVENT_ROOM:
                $entity = '\Base\Entity\InventoryEvent';
                $bookingUpdate = $em->find($entity, (int) $data['roomCategory']);
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
    }

    public function getSearch($startdate, $enddate, $page = false) {

        //return array();
        //    $collection =  parent::getCollection($page);

        $em = $this->getEntityManager();
        $travellers = array();
        $em = $this->_serviceManager->get('doctrine.entitymanager.orm_avp');
        $qb = $em->createQueryBuilder();

        //  $collection = $em->getRepository('\Base\Entity\ReservationT')->findBy(array('reservation' => $reservationId));
        // d($collection);
        $qb->select('c')->from('\Base\Entity\Reservation', 'c')
                ->where('c.dateFrom BETWEEN :id AND :endid')
                ->setParameter('id', $startdate)
                ->setParameter('endid', $enddate);

        $query = $qb->getQuery();
        $results = $query->getResult();

        d($results);
        die;

        $newCollection = array();
        foreach ($results as $item) {
            //d($item->getId());
            $newCollection[$item['id']] = array(
                'id' => $item['id'],
                'type' => $this->_getType($item['Type']),
                'roomName' => $this->_getItemName($item['id'], $item['Type']),
                'hotelName' => $this->_getHotelName($item['id'], $item['Type']),
                'travellers' => $this->_getTravellers($item['id']),
                'paymentDues' => $this->_getPaymentDues($item['id']),
                'status' => $this->_getStatus($item['status']),
            );
        }


        /*    foreach ($collection as $item){
          //d($item->getId());
          $newCollection[$item->getId()] = array(
          'id'  => $item->getId(),
          'type' => $this->_getType($item->getType()),
          'roomName' => $this->_getItemName($item->getId(), $item->getType()),
          'hotelName' => $this->_getHotelName($item->getId(), $item->getType()),
          'travellers' => $this->_getTravellers($item->getId()),
          'paymentDues' => $this->_getPaymentDues($item->getId()),
          'reservation' => $item,
          'status'=> $this->_getStatus($item->getStatus()),
          );

          }
         */

        return $newCollection;
    }

    protected function _getTravellersDetail($reservationId) {

        $em = $this->getEntityManager();

        $travellers = array();

        $collection = $em->getRepository('\Base\Entity\ReservationTravellers')->findBy(array('reservation' => $reservationId));

        return $collection;
    }

    protected function _getPaymentDuesDetail($reservationId) {

        $em = $this->getEntityManager();

        $paymentDue = array();

        $collection = $em->getRepository('\Base\Entity\ReservationPaymentDue')->findBy(array('reservation' => $reservationId));


        return $collection;
    }

    protected function _getItemNameDetail($reservationId, $type) {

        $em = $this->getEntityManager();


        switch ($type) {
            case self::RESORT_ROOM:
                $item = $em->getRepository('\Base\Entity\ReservationResortRoom')->findOneBy(array('reservation' => $reservationId));
               
                $resort = 0;
                if ($item) {
                    $resort = $em->getRepository('\Base\Entity\Avp\ResortRooms')->findOneBy(array('id' => $item->getRoom()->getId()));
                }
                $id = !is_null($resort) ? $resort : null;

                break;
            case self::EVENT_ROOM:
                $item = $em->getRepository('\Base\Entity\ReservationEventRoom')->findOneBy(array('reservation' => $reservationId));
                $event = 0;
                if ($item) {
                    $event = $em->getRepository('\Base\Entity\Avp\EventRooms')->findOneBy(array('id' => $item->getEventRoom()->getId()));
                }
                $id = !is_null($event) ? $event : null;

                break;
            case self::CRUISE_CABIN:
                $item = $em->getRepository('\Base\Entity\ReservationCruiseCabin')->findOneBy(array('reservation' => $reservationId));
                //$id = !is_null($item) ? $item->getCabin()->getId() : null;
           //  d( $item->getCabin()->getId());
                $cruise = 0;
                if ($item) {
                    $cruise = $em->getRepository('\Base\Entity\Avp\CruiseCabins')->findOneBy(array('id' => $item->getCabin()->getId()));
                }
              //  d($cruise);
                $id = !is_null($cruise) ? $cruise : null;
                break;
        }

        return $id;
    }

    protected function _getHotelNameDetail($reservationId, $type) {

        $em = $this->getEntityManager();


        switch ($type) {
            case self::RESORT_ROOM:
                $item = $em->getRepository('\Base\Entity\ReservationResortRoom')->findOneBy(array('reservation' => $reservationId));
                //$id = !is_null($item) ? $item->getRoom()->getResortId() : null;
                //  d($item);
                $resort = 0;
                if ($item) {
                    $resort = $em->getRepository('\Base\Entity\Avp\Resorts')->findOneBy(array('id' => $item->getRoom()->getResortId()));
                }

                $id = !is_null($resort) ? $resort : null;

                break;
            case self::EVENT_ROOM:
                $item = $em->getRepository('\Base\Entity\ReservationEventRoom')->findOneBy(array('reservation' => $reservationId));
                $event = 0;
                if ($item) {
                    $event = $em->getRepository('\Base\Entity\Avp\Events')->findOneBy(array('id' => $item->getEventRoom()->getEventId()));
                }

                $id = !is_null($event) ? $event : null;

                break;
            case self::CRUISE_CABIN:
                $item = $em->getRepository('\Base\Entity\ReservationCruiseCabin')->findOneBy(array('reservation' => $reservationId));
              //  $id = !is_null($item) ? $item->getCabin()->getCruiseId() : null;
              //  d($item);
                $cruise = 0;
                if ($item) {
                    $cruise = $em->getRepository('\Base\Entity\Avp\Cruises')->findOneBy(array('id' => $item->getCabin()->getCruiseId()));
                }

                $id = !is_null($cruise) ? $cruise : null;
                break;
        }

        return $id;
    }

    public function updatePaymentStatus($reservation, $response, $type = null) {

        $em = $this->getEntityManager();
        $reservation = $reservation->reservation;
        $resId = $reservation->getId();
        $entity = '\Base\Entity\Reservation';

        $res = $em->find($entity, (int) $resId);

        $room = new Container('Room');
        $ReservationObject = new Container('ReservationObject');

        //  $this->_updateBookingCountOfSellItem($ReservationObject->reservationobject, $room->room); //update booking count
        $this->_savePaymentDetails($reservation, $response, $type);

        if ((int) $reservation->getPaymentType() == 1):
            $res->setStatus(self::CLOSED_BALANCE);
        endif;
        if ($response['ACK']['ACK'] == 'Success'):
            $res->setIsBooked(1);
            $res->setIsDraft(0);
            $res->setIsExtraPaid(1);
            $em->persist($res);
            $em->flush();
        else:
            $res->setIsBooked(0);
            $res->setIsDraft(0);
            $res->setIsExtraPaid(0);
            $em->persist($res);
            $em->flush();
        endif;
        return $entity;
    }

    protected function _savePaymentDetails($reservation, $response, $type) {
        $entity = new \Base\Entity\Avp\OrderInvoices();
        $em = $this->getEntityManager();

        $entity->setOrderId($reservation->getId());
        $entity->setCurrencyCode($response['ACK']['CURRENCYCODE']);
        $entity->setTransactionId($response['ACK']['TRANSACTIONID']);
        $entity->setAmountPaid($response['ACK']['AMT']);
        if ($type == 2):
            $entity->setPaymentMode('DoDirectPayment');
        elseif($type == 1):
            $entity->setPaymentMode('expresscheckout');
        else:
             $entity->setPaymentMode('other');
        endif;
        $entity->setDateAdded(new \DateTime);

        $em->persist($entity);
        $em->flush();
        
        $this->addCommision($reservation);
        $this->addUser($reservation);
    }

   /* public function addUser($data) {
        $em = $this->getEntityManager();
        $entity = new \Base\Entity\Users();

        $entity->setEmail($data['travellerEmail']);
        $entity->setFirstName($data['travellerName']);

        $roleEntity = $em->find('Base\Entity\Role', (int) 2);

        $entity->setRole($roleEntity);

        $entity->setPassword(md5($this->generateRandomString(5)));
        $em->persist($entity);
        $em->flush();
        $this->_addClient($data, $entity);
        return $entity;
    }

    protected function _addClient($data, $user) {
        $em = $this->getEntityManager();
        $entity = new \Base\Entity\Avp\Clients();
        $customerId = strtoupper(substr(str_replace(' ', '', $data['travellerName']), 0, 5)) . rand(pow(10, 4 - 1), pow(10, 4) - 1);
        $entity->setEmail($user->getEmail());
        $entity->setCountryId($data['travellerCountry']);
        $entity->setName($data['travellerName']);
        $entity->setDob(new \DateTime($data['travellerDOB']));
        $entity->setUserId($user->getId());
        $entity->setCustomerId($customerId);
        $em->persist($entity);
        $em->flush();
        return $entity;
    }
    */
    
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
    
    public function addCommision($reservation) {
        $em = $this->getEntityManager();
        $entity = new \Base\Entity\AgentCommissionEarned();

        $currentUser = $this->getSessionData('User', 'user');
        if ($currentUser->getAccountType() == 1 || $currentUser->getAccountType() == 2) {
            $reservationActivity = $em->getRepository('\Base\Entity\AgentCommissions')->findOneBy(array('userId' => $currentUser->getId(), 'resourceId' => 150));
            if (!$reservationActivity) {
                $reservationActivity = $em->getRepository('\Base\Entity\AgentCommissions')->findOneBy(array('userId' => null, 'resourceId' => 150));
            }
            if ($reservationActivity) {
               // echo "test";die;
                $commisionType = $reservationActivity->getCommissionType();
                $commisionAmount = $reservationActivity->getAmount();
                $commisionEarned = 0;
                if ($commisionType == 1) {
                    $commisionEarned = ( ($reservation->getFinalCost() * $commisionAmount) / 100);
                } else {
                    $commisionEarned = $commisionAmount;
                }
                $reservationEntity = $em->find('Base\Entity\Reservation', (int) $reservation->getId());
                $userEntity = $em->find('Base\Entity\Users', (int) $currentUser->getId());
                $entity->setAmount($commisionEarned);
                $entity->setUserId($userEntity);
                $entity->setReservationId($reservationEntity);
                $entity->setCommissionFor(1);
                $entity->setCreated(new \DateTime);
                $entity->setUpdated(new \DateTime);
                $em->persist($entity);
                $em->flush();
            }
        }

    }

    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    public function getReservationRooms($data) {
        $data = $data['data'];
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();

        $viewRender = $this->_serviceManager->get("ViewRenderer");
        $viewModel = new ViewModel();
        $group = array();

        $type = $data['type'];
        switch ($type) {
            case self::RESORT_ROOM:
                $qb->select('ih')
                        ->from('\Base\Entity\InventoryHotels', 'ih')
                        ->leftJoin('ih.roomId', 'rr');
                $qb->andWhere('ih.dateTo >= :curDate')
                        ->setParameter("curDate", date("Y-m-d"));
                //->leftJoin('ih.roomId','rr');
                if ($data['from']):
                    $qb->andWhere('ih.dateFrom <= :startDate')
                            ->setParameter("startDate", $data['from']);
                endif;

                if ($data['to']):
                    $qb->andWhere('ih.dateTo >= :endDate')
                            ->setParameter("endDate", $data['to']);
                endif;

                if ($data['numMales']):
                    $qb->andWhere('ih.malesCount >= :males')
                            ->setParameter("males", (int) $data['numMales']);
                endif;

                if ($data['numFemales']):
                    $qb->andWhere('ih.femalesCount >= :females')
                            ->setParameter("females", (int) $data['numFemales']);
                endif;

//                if ($data['singleShare']):
//                    $qb->andWhere('ih.singleShare = :singleShare')
//                            ->setParameter("singleShare", (int) $data['singleShare']);
//                endif;
                if(($data['numMales'] + $data['numFemales']) == 1 ):
                    if ($data['singleShare'] == 1):
                       $qb->andWhere('ih.singleShare = :singleShare')
                               ->setParameter("singleShare", $data['singleShare']);
                   endif;

                   if ($data['singleShare'] == 2):
                       $qb->andWhere('ih.singlePremiumOccupancy = :singlePremiumOccupancy')
                               ->setParameter("singlePremiumOccupancy", 1);
                   endif;
                endif;;

                $query = $qb->getQuery();
                // echo $query->getSql();
                $collection = $query->getResult();
                if ($collection) {
                    $result = array();
                    foreach ($collection as $col) {
                        $ids = $col->getResortId();
                        $id = $col->getRoomId()->getId();
                        //get rooms Available
                        $availability = $this->getRoomsAvailable($id,$data['from'],$data['to'],$type);
                        
                        if (isset($result[$ids])) {
                            //$result[$id][] = $col;
                            $result[$ids][$id][] = $col;
                            $result[$ids][$id]['room-avl'] = $availability;
                        } else {
                            $result[$ids][$id] = array($col);
                            $result[$ids][$id]['room-avl'] = $availability;
                        }
                    }
                } else {
                    $result = array();
                }
                //d($result);
                $viewModel->setTemplate("orders/ajax/roomsearch");
                break;
            case self::EVENT_ROOM:
                $qb->select('ie')
                        ->from('\Base\Entity\InventoryEvent', 'ie')
                        ->leftJoin('ie.roomId', 'er')
                        ->leftJoin('er.roomId', 'err');
                $qb->andWhere('ie.dateTo >= :curDate')
                        ->setParameter("curDate", date("Y-m-d"));

                if ($data['from'] && $data['to']):
                    $qb->andWhere('ie.dateFrom >= :startDate')
                            ->setParameter("startDate", $data['from']);
                    $qb->andWhere('ie.dateTo >= :startDate')
                            ->setParameter("startDate", $data['from']);
                    $qb->andWhere('ie.dateFrom <= :endDate')
                            ->setParameter("endDate", $data['to']);

//                    $qb->orWhere('ie.dateTo >= :endDate')
//                            ->setParameter("endDate", $data['to']);
//                    $qb->orWhere('ie.dateTo <= :endDate')
//                            ->setParameter("endDate", $data['to']);
                endif;

//                if ($data['to']):
//                    $qb->andWhere('ie.dateTo >= :endDate')
//                            ->setParameter("endDate", $data['to']);
//                endif;

                if ($data['numMales']):
                    $qb->andWhere('ie.malesCount >= :males')
                            ->setParameter("males", $data['numMales']);
                endif;
                
                if ($data['numFemales']):
                    $qb->andWhere('ie.femalesCount >= :females')
                            ->setParameter("females", $data['numFemales']);
                endif;
                if(($data['numMales'] + $data['numFemales']) == 1 ):
                if ($data['singleShare'] == 1):
                    $qb->andWhere('ie.singleShare = :singleShare')
                            ->setParameter("singleShare", $data['singleShare']);
                endif;
                
                if ($data['singleShare'] == 2):
                    $qb->andWhere('ie.singlePremiumOccupancy = :singlePremiumOccupancy')
                            ->setParameter("singlePremiumOccupancy", 1);
                endif;
                endif;

                $query = $qb->getQuery();
                $collection = $query->getResult();
                if ($collection) {
                    $result = array();
                    foreach ($collection as $col) {
                        $ids = $col->getEventId();
                        $id = $col->getRoomId()->getId();
                        ////get rooms availability
                        $availability = $this->getRoomsAvailable($id,$data['from'],$data['to'],$type);
                        //d($availability);
                        if (isset($result[$ids])) {
                            $result[$ids][$id]['room-avl'] = $availability;
                            $result[$ids][$id][] = $col;
                        } else {
                            $result[$ids][$id]['room-avl'] = $availability;
                            $result[$ids][$id][] = $col;
                        }
                    }
                    //d($result);
                } else {
                    $result = array();
                }
                
                $viewModel->setTemplate("orders/ajax/eventroomsearch");
                break;
            case self::CRUISE_CABIN:
                $qb->select('ic')
                        ->from('\Base\Entity\InventoryCruise', 'ic')
                        ->leftJoin('ic.suiteId', 'si');
                $qb->andWhere('ic.dateTo >= :curDate')
                        ->setParameter("curDate", date("Y-m-d"));

                if ($data['from']):
                    $qb->andWhere('ic.dateFrom <= :startDate')
                            ->setParameter("startDate", $data['from']);
                endif;

                if ($data['to']):
                    $qb->andWhere('ic.dateTo >= :endDate')
                            ->setParameter("endDate", $data['to']);
                endif;

                if ($data['numMales']):
                    $qb->andWhere('ic.malesCount >= :males')
                            ->setParameter("males", $data['numMales']);
                endif;

                if ($data['numFemales']):
                    $qb->andWhere('ic.femalesCount >= :females')
                            ->setParameter("females", $data['numFemales']);
                endif;

//                if ($data['singleShare']):
//                    $qb->andWhere('ic.singleShare = :singleShare')
//                            ->setParameter("singleShare", $data['singleShare']);
//                endif;
                 if(($data['numMales'] + $data['numFemales']) == 1 ):
                 if ($data['singleShare'] == 1):
                    $qb->andWhere('ic.singleShare = :singleShare')
                            ->setParameter("singleShare", $data['singleShare']);
                endif;
                
                if ($data['singleShare'] == 2):
                    $qb->andWhere('ic.singlePremiumOccupancy = :singlePremiumOccupancy')
                            ->setParameter("singlePremiumOccupancy", 1);
                endif;
            endif;

                $query = $qb->getQuery();
                $collection = $query->getResult();

                $result = array();
                foreach ($collection as $col) {
                    $ids = $col->getCruiseId();
                    $id = $col->getSuiteId()->getId();
                    
                    ////get rooms availability
                    $availability = $this->getRoomsAvailable($id,$data['from'],$data['to'],$type);
                    
                    if (isset($result[$ids])) {
                        $result[$ids][$id][] = $col;
                        $result[$ids][$id]['room-avl'] = $availability;
                    } else {
                        $result[$ids][$id] = array($col);
                        $result[$ids][$id]['room-avl'] = $availability;
                    }
                }

                $viewModel->setTemplate("orders/ajax/cruisecabinsearch");
                break;
        }

        $imgPath = $this->getImagePath($type);
        $viewModel->setVariable('data', $result);
        $viewModel->setVariable('imgPath', $imgPath);
        $viewModel->setVariable('searchData', $data);
        $html = $viewRender->render($viewModel);

        echo $html;
        die;
        return $collection;
    }

    public function getImagePath($type) {
        switch ($type) {
            case self::RESORT_ROOM:
                return \Base\Model\Plugins\Imagine::$imagesBaseUrl . 'resortroom/thumbnails_80x80/';
                break;
            case self::EVENT_ROOM:
                return \Base\Model\Plugins\Imagine::$imagesBaseUrl . 'resortroom/thumbnails_80x80/';
                break;
            case self::CRUISE_CABIN:
                return \Base\Model\Plugins\Imagine::$imagesBaseUrl . 'deck/thumbnails_80x80/';
                break;
        }
    }

    public function getReservationData($data) {
        $type = $data->type;
        $typeId = $data->typeId;
        $roomId = $data->id;
        // get reservation data
        switch ($type) {
            case self::RESORT_ROOM:
                $typeForAddons = 4;
                $collection = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Resorts')->findBy(array('id' => $typeId));
                foreach ($collection as $item) {

                    $newCollection[] = array(
                        'type' => $type,
                        'event' => $item,
                        'roomid' => $roomId,
                        'hotel' => $item->getTitle(), //$this->_getHotelName($item->getResortId()),
                        'inventory' => $this->_getHotelRoomsCollection($typeId, $roomId),
                        'item' => $this->getItems($typeForAddons, $typeId),
                        'excursion' => $this->getExcursions($typeForAddons, $typeId),
                        'transfers' => $this->getTransfers($typeForAddons, $typeId),
                    );
                }
                break;
            case self::EVENT_ROOM:

                $collection = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Events')->findBy(array('id' => $typeId));
                foreach ($collection as $item) {
                    $typeForAddons = 6;
                    $newCollection[] = array(
                        'type' => $type,
                        'event' => $item,
                        'roomid' => $roomId,
                        'eventroom' => $this->_getEventRoom($item->getId(), $roomId),
                        'hotel' => $this->_getHotelTitle($item->getResortId()),
                        'inventory' => $this->_getEventRoomsCollection($roomId),
                        'item' => $this->getItems($typeForAddons, $typeId),
                        'excursion' => $this->getExcursions($typeForAddons, $typeId),
                        'transfers' => $this->getTransfers($typeForAddons, $typeId),
                    );
                }


                break;
            case self::CRUISE_CABIN:
                $collection = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Cruises')->findBy(array('id' => $typeId));

                foreach ($collection as $item) {
                    $typeForAddons = 7;
                    $newCollection[] = array(
                        // 'id' => $item->getId(),
                        'type' => $type,
                        'event' => $item,
                        'roomid' => $roomId,
                        'inventory' => $this->_getCruiseCabinsCollection($roomId),
                        'item' => $this->getItems($typeForAddons, $eventid),
                        'excursion' => $this->getExcursions($typeForAddons, $eventid),
                        'transfers' => $this->getTransfers($typeForAddons, $eventid),
                    );
                }
                break;
        }
        return $newCollection;
    }

    protected function _getRoomName($roomId) {
        $em = $this->getEntityManager();
        $item = $em->getRepository('\Base\Entity\Avp\ResortRooms')->findOneBy(array('id' => $roomId));
        return $item;
    }

    protected function _getEventRoomsCollection($roomId) {
        $em = $this->getEntityManager();
        $collection = $em->getRepository('\Base\Entity\Avp\EventRooms')->findOneBy(array('id' => $roomId));
        return $collection;
    }

    protected function _getCruiseCabinsCollection($roomId) {
        $em = $this->getEntityManager();
        $collection = $em->getRepository('\Base\Entity\Avp\CruiseCabins')->findOneBy(array('id' => $roomId));

        return $collection;
    }

    protected function _getHotelRoomsCollection($resortId, $roomId) {
        // d($roomId);

        $em = $this->getEntityManager();
        $collection = $em->getRepository('\Base\Entity\Avp\ResortRooms')->findOneBy(array('resortId' => $resortId, 'id' => $roomId));
        //d($collection);
        return $collection;
    }

    private function _getCruiseRoom($eventId, $roomId) {
        $em = $this->getEntityManager();
        $item = $em->getRepository('\Base\Entity\Avp\CruiseCabins')->findOneBy(array('cruiseId' => $eventId, 'id' => $roomId));
        return $item;
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

    private function _getEventRoom($eventId, $roomId) {
        $em = $this->getEntityManager();
        $item = $em->getRepository('\Base\Entity\Avp\EventRooms')->findOneBy(array('eventId' => $eventId, 'roomId' => $roomId));
        return $item;
    }

    protected function _getHotelTitle($resortId) {
        $em = $this->getEntityManager();
        $item = $em->getRepository('\Base\Entity\Avp\Resorts')->findOneBy(array('id' => $resortId));
        $name = !is_null($item) ? $item->getTitle() : null;
        //d($name);
        return $name;
    }

    public function getRoomsAvailable($roomId = null, $start = null, $end = null, $type = null) {


        $stock = $this->findRoomsInventory($roomId, $start, $end, $type);
        // d($stock);
        if ($stock) {
            foreach ($stock['data'] as $s):
                //$book[] = $this->getRoomsCountAvailable($roomId, $s['dateFrom'], $s['dateTo'], $type);
            $book[] = $this->getRoomsCountAvailable($roomId, $start, $end, $type);
            endforeach;
        }
        if ($stock):
            $stockCount = min($stock['stock']);
            $book = min($book);

            $data = array("count" => $stockCount - $book, "data" => $stock['data']);
        else:
            $d = array("dateFrom" => "", "dateTo" => "", "grossPrice" => 0);
            $data = array("count" => 0, "data" => $d);
        endif;


        return $data;
    }

    protected function findRoomsInventory($roomId, $start, $end, $type) {

        $em = $this->getEntityManager();
        $rsm = new ResultSetMapping();

        $rsm->addScalarResult('num', 'stocks');
        $rsm->addScalarResult('grossPrice', 'grossPrice');
        $rsm->addScalarResult('netPrice', 'netPrice');
        $rsm->addScalarResult('dateFrom', 'dateFrom');
        $rsm->addScalarResult('dateTo', 'dateTo');

        $rsm->addScalarResult('males', 'males');
        $rsm->addScalarResult('females', 'females');
        $rsm->addScalarResult('tripleOccupancy', 'tripleOccupancy');
        $rsm->addScalarResult('triplePriceFemaleGross', 'triplePriceFemaleGross');
        $rsm->addScalarResult('triplePriceMaleGross', 'triplePriceMaleGross');
         $rsm->addScalarResult('triplePriceFemaleNet', 'triplePriceFemaleNet');
        $rsm->addScalarResult('triplePriceMaleNet', 'triplePriceMaleNet');

        $rsm->addScalarResult('quadOccupancy', 'quadOccupancy');
        $rsm->addScalarResult('quadPriceFemaleGross', 'quadPriceFemaleGross');
        $rsm->addScalarResult('quadPriceMaleGross', 'quadPriceMaleGross');
         $rsm->addScalarResult('quadPriceFemaleNet', 'quadPriceFemaleNet');
        $rsm->addScalarResult('quadPriceMaleNet', 'quadPriceMaleNet');

        $rsm->addScalarResult('singlePremiumOccupancy', 'singlePremiumOccupancy');
        $rsm->addScalarResult('singlePriceGross', 'singlePriceGross');
        $rsm->addScalarResult('singlePriceNet', 'singlePriceNet');
        
        $rsm->addScalarResult('pricePer', 'pricePer');

        switch ($type) {
            case self::RESORT_ROOM:
                $query = $em->createNativeQuery("SELECT number_available as num,gross_price as grossPrice,net_price as netPrice,date_from as dateFrom,date_to as dateTo,
             males_count as males,females_count as females ,triple_occupancy_allowed as tripleOccupancy,
             triple_price_female_gross as triplePriceFemaleGross,triple_price_male_gross as triplePriceMaleGross,
             triple_price_female_net as triplePriceFemaleNet,triple_price_male_net as triplePriceMaleNet,
             quad_occupancy as quadOccupancy,quad_price_female_gross as quadPriceFemaleGross,quad_price_male_gross as quadPriceMaleGross,
             quad_price_female_net as quadPriceFemaleNet,quad_price_male_net as quadPriceMaleNet,
             single_premium_occupancy as singlePremiumOccupancy,single_price_gross as singlePriceGross,single_price_net as singlePriceNet,price_per as pricePer
        FROM `inventory_hotels` 
        WHERE inventory_hotels.room_id = $roomId
        AND '$start' BETWEEN inventory_hotels.date_from
        AND inventory_hotels.date_to
        OR inventory_hotels.date_to
        BETWEEN '$start'
        AND '$end' AND inventory_hotels.room_id = $roomId
        OR '$end'
        BETWEEN inventory_hotels.date_from
        AND inventory_hotels.date_to AND inventory_hotels.room_id = $roomId
        OR inventory_hotels.date_from
        BETWEEN '$start'
        AND '$end'
        AND inventory_hotels.room_id = $roomId", $rsm);
                break;
            case self::EVENT_ROOM:
                $query = $em->createNativeQuery("SELECT total_available as num,gross_price as grossPrice,net_price as netPrice,date_from as dateFrom,date_to as dateTo,
             males_count as males,females_count as females ,triple_occupancy_allowed as tripleOccupancy,
             triple_price_female_gross as triplePriceFemaleGross,triple_price_male_gross as triplePriceMaleGross,
             triple_price_female_net as triplePriceFemaleNet,triple_price_male_net as triplePriceMaleNet,
             quad_occupancy as quadOccupancy,quad_price_female_gross as quadPriceFemaleGross,quad_price_male_gross as quadPriceMaleGross,
             quad_price_female_net as quadPriceFemaleNet,quad_price_male_net as quadPriceMaleNet,
             single_premium_occupancy as singlePremiumOccupancy,single_price_gross as singlePriceGross,single_price_net as singlePriceNet,price_per as pricePer
        FROM `inventory_event` 
        WHERE  inventory_event.room_id = $roomId
        AND '$start' BETWEEN  inventory_event.date_from
        AND  inventory_event.date_to
        OR  inventory_event.date_to
        BETWEEN '$start'
        AND '$end' AND  inventory_event.room_id = $roomId
        OR '$end'
        BETWEEN inventory_event.date_from
        AND  inventory_event.date_to AND  inventory_event.room_id = $roomId
        OR  inventory_event.date_from
        BETWEEN '$start'
        AND '$end'
        AND  inventory_event.room_id = $roomId", $rsm);
                break;
            case self::CRUISE_CABIN:
                $query = $em->createNativeQuery("SELECT total_available as num,gross_price as grossPrice,net_price as netPrice,date_from as dateFrom,date_to as dateTo,
             males_count as males,females_count as females ,triple_occupancy_allowed as tripleOccupancy,
             triple_price_female_gross as triplePriceFemaleGross,triple_price_male_gross as triplePriceMaleGross,
             triple_price_female_net as triplePriceFemaleNet,triple_price_male_net as triplePriceMaleNet,
             quad_occupancy as quadOccupancy,quad_price_female_gross as quadPriceFemaleGross,quad_price_male_gross as quadPriceMaleGross,
             quad_price_female_net as quadPriceFemaleNet,quad_price_male_net as quadPriceMaleNet,
             single_premium_occupancy as singlePremiumOccupancy,single_price_gross as singlePriceGross,single_price_net as singlePriceNet,price_per as pricePer
        FROM `inventory_cruise` 
        WHERE inventory_cruise.suite_id = $roomId
        AND '$start' BETWEEN inventory_cruise.date_from
        AND inventory_cruise.date_to
        OR inventory_cruise.date_to
        BETWEEN '$start'
        AND '$end' AND inventory_cruise.suite_id = $roomId
        OR '$end'
        BETWEEN inventory_cruise.date_from
        AND inventory_cruise.date_to AND inventory_cruise.suite_id = $roomId
        OR inventory_cruise.date_from
        BETWEEN '$start'
        AND '$end'
        AND inventory_cruise.suite_id = $roomId", $rsm);
                break;
        }

        // echo $query->getSql();die;
        $stock = $query->getArrayResult();
        //d($stock);
        foreach ($stock as $st):
            $stocks['stock'][] = $st['stocks'];
            $stocks['data'][] = array("dateFrom" => $st['dateFrom'], "dateTo" => $st["dateTo"], "grossPrice" => $st["grossPrice"], "netPrice" => $st["netPrice"],
                "males" => $st['males'], "females" => $st['females'],
                "tripleOccupancy" => $st['tripleOccupancy'],
                "triplePriceFemaleGross" => $st["triplePriceFemaleGross"],
                "triplePriceMaleGross" => $st["triplePriceMaleGross"],
                "triplePriceFemaleNet" => $st["triplePriceFemaleNet"],
                "triplePriceMaleNet" => $st["triplePriceMaleNet"],
                "quadOccupancy" => $st["quadOccupancy"],
                "quadPriceFemaleGross" => $st["quadPriceFemaleGross"],
                "quadPriceMaleGross" => $st["quadPriceMaleGross"],
                "quadPriceFemaleNet" => $st["quadPriceFemaleNet"],
                "quadPriceMaleNet" => $st["quadPriceMaleNet"],
                "singlePremiumOccupancy" => $st["singlePremiumOccupancy"],
                "single_price_gross" => $st["singlePriceGross"],
                "single_price_net" => $st["singlePriceNet"],
                "pricePer" => $st["pricePer"]
            );
        endforeach;

        return $stocks;
    }

    protected function getRoomsCountAvailable($roomId, $start, $end, $type) {

        $em = $this->getEntityManager();
        $rsm = new ResultSetMapping();

        $rsm->addScalarResult('counts', 'count');
        $rsm->addScalarResult('booked', 'booked');
        switch ($type) {
            case self::RESORT_ROOM:
                $query = $em->createNativeQuery("SELECT count( * ) as counts,sum(reservation.room_required) as booked
        FROM `reservation_resort_room` 
        LEFT JOIN `reservation` ON reservation_resort_room.reservation_id = reservation.id
        WHERE reservation_resort_room.room_id = $roomId AND reservation.is_booked = 1 AND reservation.status IN(1,2)
        AND '$start' BETWEEN reservation.date_from
        AND reservation.date_to
        OR reservation.date_to
        BETWEEN '$start'
        AND '$end' AND reservation_resort_room.room_id = $roomId AND reservation.is_booked = 1 AND reservation.status IN(1,2)
        OR '$end'
        BETWEEN reservation.date_from
        AND reservation.date_to AND reservation_resort_room.room_id = $roomId AND reservation.is_booked = 1 AND reservation.status IN(1,2)
        OR reservation.date_from
        BETWEEN '$start'
        AND '$end'
        AND reservation_resort_room.room_id = $roomId AND reservation.is_booked = 1 AND reservation.status IN(1,2)", $rsm);
                break;

            case self::EVENT_ROOM:
                $query = $em->createNativeQuery("SELECT count( * ) as counts,sum(reservation.room_required) as booked
        FROM `reservation_event_room` 
        LEFT JOIN `reservation` ON reservation_event_room.reservation_id = reservation.id
        WHERE reservation_event_room.event_room_id = $roomId AND reservation.is_booked = 1 AND reservation.status IN(1,2)
        AND '$start' BETWEEN reservation.date_from
        AND reservation.date_to
        OR reservation.date_to
        BETWEEN '$start'
        AND '$end' AND reservation_event_room.event_room_id = $roomId AND reservation.is_booked = 1 AND reservation.status IN(1,2)
        OR '$end'
        BETWEEN reservation.date_from
        AND reservation.date_to AND reservation_event_room.event_room_id = $roomId AND reservation.is_booked = 1 AND reservation.status IN(1,2)
        OR reservation.date_from
        BETWEEN '$start'
        AND '$end'
        AND reservation_event_room.event_room_id = $roomId AND reservation.is_booked = 1 AND reservation.status IN(1,2)", $rsm);
                break;

            case self::CRUISE_CABIN:
                $query = $em->createNativeQuery("SELECT count( * ) as counts,sum(reservation.room_required) as booked
        FROM `reservation_cruise_cabin` 
        LEFT JOIN `reservation` ON reservation_cruise_cabin.reservation_id = reservation.id
        WHERE reservation_cruise_cabin.cabin_id = $roomId AND reservation.is_booked = 1 AND reservation.status IN(1,2)
        AND '$start' BETWEEN reservation.date_from
        AND reservation.date_to
        OR reservation.date_to
        BETWEEN '$start'
        AND '$end' AND reservation_cruise_cabin.cabin_id = $roomId AND reservation.is_booked = 1 AND reservation.status IN(1,2)
        OR '$end'
        BETWEEN reservation.date_from
        AND reservation.date_to AND reservation_cruise_cabin.cabin_id = $roomId AND reservation.is_booked = 1 AND reservation.status IN(1,2)
        OR reservation.date_from
        BETWEEN '$start'
        AND '$end'
        AND reservation_cruise_cabin.cabin_id = $roomId AND reservation.is_booked = 1 AND reservation.status IN(1,2)", $rsm);
                break;
        }

        //d(get_class_methods($query));
        // echo $query->getSql();die;
        $count = $query->getArrayResult();
        if ($count) {
            return $count[0]['booked'];
        } else {
            return 0;
        }
    }

    public function getDepositException($post) {
        $em = $this->getEntityManager();
        $rsm = new ResultSetMapping();

        $rsm->addScalarResult('amount', 'amount');
        $rsm->addScalarResult('type', 'type');
        
        $type = (int) $post['type'];
        if($post['type'] == 2){
             $type = 6;
        }elseif($post['type'] == 1){
            $type = 4;
        }elseif($post['type'] == 3){
            $type = 7;
        }
        
        $typeId = (int) $post['typeId'];
       // $dateFrom = $post['dateFrom'];
	 $dateFrom = $post['exceptionStart'];
        $dateTo = $post['dateTo'];
//        d($post);
        switch ($type) {
            case 4:
                $query = $em->createNativeQuery("SELECT amount as amount,type as type
                FROM `inventory_deposits`
                WHERE FIND_IN_SET( '$typeId', `resort_id` )
                AND `linked_to` = 4
                AND '$dateFrom'
                BETWEEN `date_from`
                AND `date_to`
		ORDER BY id DESC", $rsm);
                
                $result = $query->getArrayResult();
                    if(empty($result)):
                         $query = $em->createNativeQuery("SELECT amount as amount,type as type
                        FROM `inventory_deposits`
                        WHERE `linked_to` = 1
                        AND '$dateFrom'
                        BETWEEN `date_from`
                        AND `date_to`
			ORDER BY id DESC", $rsm);
                    endif;
                break;

            case 6:
                $query = $em->createNativeQuery("SELECT amount as amount,type as type
                FROM `inventory_deposits`
                WHERE (FIND_IN_SET( '$typeId', `event_id` ))
                AND `linked_to` = 5
                AND '$dateFrom'
                BETWEEN `date_from`
                AND `date_to`
		ORDER BY id DESC", $rsm);
                
                $result = $query->getArrayResult();
                
                 if(empty($result)):
                       $query = $em->createNativeQuery("SELECT amount as amount,type as type
                        FROM `inventory_deposits`
                        WHERE `linked_to` = 2
                        AND '$dateFrom'
                        BETWEEN `date_from`
                        AND `date_to`
			ORDER BY id DESC", $rsm);
                 
                 $result = $query->getArrayResult();
                    endif;
                
                break;

            case 7:
                $query = $em->createNativeQuery("SELECT amount as amount,type as type
                FROM `inventory_deposits`
                WHERE FIND_IN_SET( '$typeId', `cruise_id` )
                AND `linked_to` = 6
                AND '$dateFrom'
                BETWEEN `date_from`
                AND `date_to`
		ORDER BY id DESC", $rsm);
                
                $result = $query->getArrayResult();
                
                  if(empty($result)):
                       $query = $em->createNativeQuery("SELECT amount as amount,type as type
                        FROM `inventory_deposits`
                        WHERE `linked_to` = 3
                        AND '$dateFrom'
                        BETWEEN `date_from`
                        AND `date_to`
			ORDER BY id DESC", $rsm);
                        
                  $result = $query->getArrayResult();
                    endif;
                
                break;
        }
//         echo $query->getSql();die;
        
        if (empty($result)):
            $query = $em->createNativeQuery("SELECT amount as amount,type as type
                        FROM `inventory_deposits`
                        WHERE `linked_to` = 0
                        AND '$dateFrom'
                        BETWEEN `date_from`
                        AND `date_to`
			ORDER BY id DESC", $rsm);

            $result = $query->getArrayResult();
        endif;
        
//        d($result);
        return $result;
    }

    public function getCollectionPending($startdate = null, $enddate = null, $page = false) {

        //return array();
        //  $collection =  parent::getCollection($page);

        if (!empty($startdate) || !empty($enddate)) {

           If (!empty($startdate) && !empty($enddate)) {
                $qury = "c.createdAt >= '$startdate' AND c.createdAt <= '$enddate' ";
            } else if (!empty($startdate) && empty($enddate)) {

                $qury = "c.createdAt >= '$startdate'";
            } else if (empty($startdate) && !empty($enddate)) {

                $qury = "c.createdAt <= '$enddate'";
            }

            $em = $this->getEntityManager();
            //$travellers = array();
            $em = $this->_serviceManager->get('doctrine.entitymanager.orm_avp');
            $qb = $em->createQueryBuilder();

            //  $collection = $em->getRepository('\Base\Entity\ReservationT')->findBy(array('reservation' => $reservationId));
            // d($collection);
            $qb->select('c')->from('\Base\Entity\Reservation', 'c')
                    ->where($qury)
                    ->andwhere('c.isBooked=0 AND c.status!=3 AND c.isDraft=0' )
                    ->orderBy('c.id', 'DESC');
                   // ->setParameter('id', $startdate)
                   // ->setParameter('endid', $enddate);

            $query = $qb->getQuery();
            $collection = $query->getResult();
            //d($collection);
        } else {
            $em = $this->getEntityManager();
            $qb = $em->createQueryBuilder();
            $qb->select('c')->from('\Base\Entity\Reservation', 'c')
                    ->where('c.isBooked=0 AND c.status!=3 AND c.isDraft=0')
                    ->orderBy('c.id', 'DESC');

            $query = $qb->getQuery();
            $collection = $query->getResult();
        }

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

    public function pendingdelete($id) {

        $em = $this->getEntityManager();

        $entity = $em->find('\Base\Entity\Reservation', (int) $id);
        $entity->setStatus(3);
        $em->persist($entity);
        $em->flush();
    }

    public function markComplete($id,$response) {

        $em = $this->getEntityManager();

        $entity = $em->find('\Base\Entity\Reservation', (int) $id);
        $amount = $entity->getFinalCost() - $response['ACK']['AMT'];
        $entity->setIsBooked(1);
        $entity->setDepositAmoun($response['ACK']['AMT']);
        $entity->setBalansAfterDeposit($amount);
        
        $em->persist($entity);
        $em->flush();
    }

    public function getPendingItemView($id) {

        $collection = $this->getCollectionPending();

        return $collection[$id];
    }

    public function sendmailonpending($id, $to, array $params = null) {
        $data = $this->getItemViewDetail($id);
        if ($data) {
            return SendmailController::sendMailOnReservationPending($this->_serviceManager, $to, $data, $params, 'Reservation Details');
        }
        return false;
    }
    
     public function resend($id, $to, array $params = null) {
        $data = $this->getItemViewDetail($id);
        
        if ($data) {
            return SendmailController::sendMailOnReservationPending($this->_serviceManager, $to, $data, $params, 'Reservation Details');
        }
        return false;
    }

    public function getTravellers($reservationId) {

        $em = $this->getEntityManager();

        $travellers = array();

        $collection = $em->getRepository('\Base\Entity\ReservationTravellers')->findBy(array('reservation' => $reservationId));

        return $collection;
    }
    
     public function cancelResortReservation($id) {
        $item = $this->getItem($id);
        
     //d($item);
        if ($item) {
              $item->setStatus(self::CANCELED);
              $this->cancelReservationComission($id);
              //echo "cancelled";die;
         parent::save($item);
        }
    }
    
    public function reinstateCancelledReservation($id) {
        $item = $this->getItem($id);
        
        if ($item) {
                if($item->getFinalCost()>=$item->getDepositAmoun()) {
                 $item->setStatus(self::CLOSED_BALANCE);   
                }else{
                $item->setStatus(self::OPEN_BALANCE);
                }
            $this->updateComission($id);
         parent::save($item);
        }
    }
    
     public function cancelReservationComission($id) {
        $em = $this->getEntityManager();

        $entity = $em->getRepository('\Base\Entity\Avp\AffiliateCommissions')->findBy(array('orderId' => $id));
        if(!empty($entity)){
            $entity = $entity[0];
            $entity->setStatus(2);

            $em->persist($entity);
            $em->flush();
        }
        
        
    }
    
     public function updateComission($id) {
        $em = $this->getEntityManager();

        $entity = $em->getRepository('\Base\Entity\Avp\AffiliateCommissions')->findBy(array('orderId' => $id));
        if(!empty($entity)){
            $entity = $entity[0];
            $entity->setStatus(0);

            $em->persist($entity);
            $em->flush();
        }
        
        
    }
    
    public function getCountries(){
        $em = $this->getEntityManager();
            $qb = $em->createQueryBuilder();
            $qb->select('c')->from('\Base\Entity\Countries', 'c');

            $query = $qb->getQuery();
            $collection = $query->getResult();
            
            return $collection;
    }
    
    public function createDepositDues($post){
        $start = $post['dateFrom'];
        $daysBefore = $this->dateDifference($start);
       // d($daysBefore);
        $post['days']=$daysBefore;
        $paymentsData = array();
        if((int)$post['paymentType'] == 0){
            if ($daysBefore > 120) {
                $paymentsData = $this->_before120Days($post);
            } elseif ($daysBefore <= 120 && $daysBefore >= 90) {
                $paymentsData = $this->_before90Days($post);
            } elseif ($daysBefore >= 60 && $daysBefore <= 90) {
                $paymentsData = $this->_before90after60Days($post);
            } elseif($daysBefore <= 60) {
               // $paymentsData = $this->_before60Days($post);
		$paymentsData = $this->_before90after60Days($post);
            }
        }else{
            $paymentsData = $this->_before60Days($post);
        }

        return $paymentsData;
        
    }
    
    protected function dateDifference($start){
        $now = time(); // or your date as well
        $date = strtotime($start);
        $datediff =  $date - $now;
        return  floor($datediff/(60*60*24));
    }
    
    protected function subtractDaysFromDates($start,$days){
        $date = new \DateTime($start);
          $date  = $date->sub(date_interval_create_from_date_string("$days days")); 
          return $date;
    }
    
    protected function _before60Days($post){
        $finalCost = $post['finalCost'];
        $depositAmount = $finalCost;
        $balance = $finalCost - $depositAmount;
        $numberOfDues = 0;
        $result = array("paymentArray"=>array(),"finalCost"=>$finalCost,"numberOfDues"=>$numberOfDues,"balance"=>$balance,"deposit"=>$depositAmount);
        return $result;
    }
    protected function _before120Days($post){
        $depExcAmt = $this->getDepositException($post);
         $dateStart = $post['dateFrom'];
         $finalCost = $post['finalCost'];
         
         if($depExcAmt){
             $depType = $depExcAmt[0]['type'];
             $depExcAmt = $depExcAmt[0]['amount'];
                if((int)$depType == 1){
                    $depositAmount = ($finalCost * $depExcAmt) / 100;
                    $nextPaymentDue = (($finalCost * (100 - $depExcAmt)) / 100)/2;
                    $finalPaymentDue = $nextPaymentDue;
                }else{
                   $depositAmount = $depExcAmt;
                    $nextPaymentDue = ($finalCost - $depositAmount)/2;
                    $finalPaymentDue = $nextPaymentDue;
                }
        }else{
            $depositAmount = ($finalCost * 20) / 100;
            $nextPaymentDue = ($finalCost * 40) / 100;
            $finalPaymentDue = $nextPaymentDue;
        }
            
            $balance = $finalCost - $depositAmount;
            $numberOfDues = 2;
            
        $maxNextPaymentDue = $this->subtractDaysFromDates($dateStart, 90);
        $dueNextAmount = $nextPaymentDue;
        $maxFinalPaymentDue = $this->subtractDaysFromDates($dateStart,60);
        $dueFinalAmount = $finalPaymentDue;
        
        $paymentArray[0]['maxFinalPaymentDue'] = $maxNextPaymentDue;
        $paymentArray[0]['dueAmount'] = $dueNextAmount;
        
        $paymentArray[1]['maxFinalPaymentDue'] = $maxFinalPaymentDue;
        $paymentArray[1]['dueAmount'] = $finalPaymentDue;
        
        $merchantFee = ((2.5/100)*$depositAmount);
        $result = array('paymentArray'=>$paymentArray,'merchantFee'=>$merchantFee,"numberofDues"=>$numberOfDues,"balance"=>$balance,"finalCost"=>$finalCost,"deposit"=>$depositAmount);

        return $result; 
    }
    
    protected function _before90Days($post){
        $depExcAmt = $this->getDepositException($post);
         $dateStart = $post['dateFrom'];
         $finalCost = $post['finalCost'];
         
         if($depExcAmt){
             $depType = $depExcAmt[0]['type'];
             $depExcAmt = $depExcAmt[0]['amount'];
                if((int)$depType == 1){
                    $depositAmount = ($finalCost * $depExcAmt) / 100;
                    $nextPaymentDue = (($finalCost * (100 - $depExcAmt)) / 100)/2;
                    $finalPaymentDue = $nextPaymentDue;
                }else{
                   $depositAmount = $depExcAmt;
                    $nextPaymentDue = ($finalCost - $depositAmount)/2;
                    $finalPaymentDue = $nextPaymentDue;
                }
        }else{
            $depositAmount = ($finalCost * 40) / 100;
            $nextPaymentDue = ($finalCost * 30) / 100;
            $finalPaymentDue = $nextPaymentDue;
        }
            
            $balance = $finalCost - $depositAmount;
            $numberOfDues = 2;
            
        $maxNextPaymentDue = $this->subtractDaysFromDates($dateStart, 80);
        $dueNextAmount = $nextPaymentDue;
        $maxFinalPaymentDue = $this->subtractDaysFromDates($dateStart,60);
        $dueFinalAmount = $finalPaymentDue;
        
        $paymentArray[0]['maxFinalPaymentDue'] = $maxNextPaymentDue;
        $paymentArray[0]['dueAmount'] = $dueNextAmount;
        
        $paymentArray[1]['maxFinalPaymentDue'] = $maxFinalPaymentDue;
        $paymentArray[1]['dueAmount'] = $finalPaymentDue;
        
        $merchantFee = ((2.5/100)*$depositAmount);
        $result = array('paymentArray'=>$paymentArray,'merchantFee'=>$merchantFee,"numberofDues"=>$numberOfDues,"balance"=>$balance,"finalCost"=>$finalCost,"deposit"=>$depositAmount);

        return $result; 
    }
    protected function _before90after60Days($post){
         $depExcAmt = $this->getDepositException($post);
//         d($depExcAmt);
         $dateStart = $post['dateFrom'];
         $finalCost = $post['finalCost'];
         
         if($depExcAmt){
             $depType = $depExcAmt[0]['type'];
             $depExcAmt = $depExcAmt[0]['amount'];
                if((int)$depType == 1){
                    $depositAmount = ($finalCost * $depExcAmt) / 100;
                    $finalPaymentDue = ($finalCost * (100 - $depExcAmt)) / 100;
                }else{
                   $depositAmount = $depExcAmt;
                   $finalPaymentDue = ($finalCost - $depositAmount);
                }
        }else{
            $depositAmount = ($finalCost * 50) / 100;
            $finalPaymentDue = ($finalCost * 50) / 100;
        }
            
            $balance = $finalCost - $depositAmount;
            $numberOfDues = 1;

            if ($post['days'] >= 60 && $post['days'] <= 90) {
                $maxFinalPaymentDue = $this->subtractDaysFromDates($dateStart,45);
            } elseif($post['days'] <= 60) {
		$maxFinalPaymentDue = new \DateTime;
            }
//        $maxFinalPaymentDue = $this->subtractDaysFromDates($dateStart,45);
        $dueAmount = $finalPaymentDue;
        
        $paymentArray[0]['maxFinalPaymentDue'] = $maxFinalPaymentDue;
        $paymentArray[0]['dueAmount'] = $finalPaymentDue;
        
        $merchantFee = ((2.5/100)*$depositAmount);
        $result = array('paymentArray'=>$paymentArray,'merchantFee'=>$merchantFee,"numberofDues"=>$numberOfDues,"balance"=>$balance,"finalCost"=>$finalCost,"deposit"=>$depositAmount);

        return $result;
    }

    public function updateExtraPaymentStatus(){
        $em = $this->getEntityManager();
            $qb = $em->createQueryBuilder();
            $qb->select('c')->from('\Base\Entity\Reservation', 'c')->where('c.status != 0');
//                    ->where('c.id='.$rId);

            $query = $qb->getQuery();
            $collection = $query->getResult();
            
            foreach($collection as $row){
                if($row->getIsUpdated()==1){
                    if($row->getIsExtraPaid()==0 && $row->getExtraAmtPaid()!=0.00 && $row->getRefundAmt()==0.00){
                       $newDepamt= ($row->getDepositAmoun())-($row->getExtraDepAmt());

                       $em = $this->getEntityManager();

                        $entity = $em->getRepository('\Base\Entity\Reservation')->findBy(array('id' => $row->getId()));
                        if(!empty($entity)){
                            $entity = $entity[0];
                            $entity->setDepositAmoun($newDepamt);
                            $entity->setExtraAmtPaid('0.00');
                            $entity->setExtraDepAmt('0.00');
                            $entity->setStatus('1');

                            $em->persist($entity);
                            $em->flush();
                        }
                    }
                }
            }
    }
    
    public function updateReservationStatus(){
        $em = $this->getEntityManager();
            $qb = $em->createQueryBuilder();
            $qb->select('c')->from('\Base\Entity\Reservation', 'c')->where('c.status != 0');

            $query = $qb->getQuery();
            $collection = $query->getResult();
            
            foreach($collection as $row){
                if($row->getDepositAmoun()<$row->getFinalCost()){
                    $em = $this->getEntityManager();

                    $entity = $em->getRepository('\Base\Entity\Reservation')->findBy(array('id' => $row->getId()));
                    if(!empty($entity)){
                        $entity = $entity[0];
                        $entity->setStatus('1');

                        $em->persist($entity);
                        $em->flush();
                    }
                }
            }
        
    }

  public function getDraftCollection($startdate = null, $enddate = null, $page = false) {


        if (!empty($startdate) || !empty($enddate)) {
            
             If (!empty($startdate) && !empty($enddate)) {
                $qury = "c.createdAt >= '$startdate' AND c.createdAt <= '$enddate' AND c.isDraft=1";
            } else if (!empty($startdate) && empty($enddate)) {

                $qury = "c.createdAt >= '$startdate' AND c.isDraft=1";
            } else if (empty($startdate) && !empty($enddate)) {

                $qury = "c.createdAt <= '$enddate' AND c.isDraft=1";
            }

            $em = $this->getEntityManager();

            $em = $this->_serviceManager->get('doctrine.entitymanager.orm_avp');
            $qb = $em->createQueryBuilder();

            $qb->select('c')->from('\Base\Entity\Reservation', 'c')
                    ->where($qury)
                    ->orderBy('c.id', 'DESC');

            $query = $qb->getQuery();
            $collection = $query->getResult();

        } else {

            $em = $this->getEntityManager();
            $qb = $em->createQueryBuilder();

            $qb->select('c')->from('\Base\Entity\Reservation', 'c')
                    ->where("c.isDraft=1")
                    ->orderBy('c.id', 'DESC');
            $query = $qb->getQuery();
            $collection = $query->getResult();
        }


        $newCollection = array();
        foreach ($collection as $item) {

            $newCollection[$item->getId()] = array(
                'id' => $item->getId(),
                'type' => $this->_getType($item->getType()),
                'roomName' => $this->_getItemName($item->getId(), $item->getType()),
                'hotelName' => $this->_getHotelName($item->getId(), $item->getType()),
                'travellers' => $this->_getTravellers($item->getId()),
                'paymentDues' => $this->_getPaymentDues($item->getId()),
                'reservation' => $item,
                'status' => $this->_getStatus($item->getStatus()),
                'allTraveller' => $this->_getAllTravellers($item->getId())
            );
        }

        return $newCollection;
    }
}
