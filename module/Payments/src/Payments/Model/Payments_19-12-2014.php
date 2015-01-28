<?php

namespace Payments\Model;

use Zend\InputFilter\Factory as InputFactory;     // <-- Add this import
use Zend\InputFilter\InputFilter;                 // <-- Add this import
use Zend\InputFilter\InputFilterAwareInterface;   // <-- Add this import
use Zend\InputFilter\InputFilterInterface;        // <-- Add this import
use Sendmail\Controller\SendmailController;

class Payments extends \Base\Model\BaseModel implements InputFilterAwareInterface {

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

    public function getCollection($paymenttype = null, $startdate = null, $enddate = null, $page = false) {



        if (!empty($startdate) || !empty($enddate)) {


            If (!empty($startdate) && !empty($enddate)) {
                $qury = "er.dateAdded >= '$startdate' AND er.dateAdded <= '$enddate' ";
            } else if (!empty($startdate) && empty($enddate)) {

                $qury = "er.dateAdded >= '$startdate'";
            } else if (empty($startdate) && !empty($enddate)) {

                $qury = "er.dateAdded <= '$enddate'";
            }

            if (!empty($paymenttype)) {
                if ($paymenttype == 2) {

                    $paymenttype = 0;
                }

                $qury = $qury . " AND e.paymentType='$paymenttype'";
            }

            $em = $this->getEntityManager();
            $qb = $em->createQueryBuilder();
            $qb->select('e')->from('\Base\Entity\Avp\OrderInvoices', 'er')
                    ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id')
                    ->Where($qury)
                    ->orderBy('er.id','DESC');
            //  ->andwhere('e.paymentType=:type')
            // ->setParameter('type', $paymenttype);

            $query = $qb->getQuery();
            $collection = $query->getResult();
        } elseif (!empty($paymenttype) && empty($startdate) && empty($enddate)) {
            if ($paymenttype == 2) {

                $paymenttype = 0;
            }

            $em = $this->getEntityManager();
            $qb = $em->createQueryBuilder();
            $qb->select('e')->from('\Base\Entity\Avp\OrderInvoices', 'er')
                    ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id')
                    ->where('e.paymentType=:type')
                    ->setParameter('type', $paymenttype)
                    ->orderBy('er.id','DESC');


            $query = $qb->getQuery();
            $collection = $query->getResult();
        } else {
            $em = $this->getEntityManager();
            $qb = $em->createQueryBuilder();
            $qb->select('e')->from('\Base\Entity\Avp\OrderInvoices', 'er')
                    ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id')
                    ->orderBy('er.id','DESC');
            $query = $qb->getQuery();
            $collection = $query->getResult();
        }
        /*

          if (!empty($paymenttype)) {

          if ($paymenttype == 2) {

          $paymenttype = 0;
          }

          $em = $this->getEntityManager();
          $qb = $em->createQueryBuilder();
          $qb->select('e')->from('\Base\Entity\Avp\OrderInvoices', 'er')
          ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id')
          ->where('e.paymentType=:type')
          ->setParameter('type', $paymenttype);


          $query = $qb->getQuery();
          $collection = $query->getResult();

          //  d($collection);
          }

         */


        //   d($collection);
        $newCollection = array();
        foreach ($collection as $item) {
            //d($item->getId());
            $newCollection[$item->getId()] = array(
                'id' => $item->getId(),
                'type' => $this->_getType($item->getType()),
                'roomName' =>$this->_getItemName($item->getId(), $item->getType()),
                'hotelName' => $this->_getHotelName($item->getId(), $item->getType()),
                'travellers' => $this->_getTravellers($item->getId()),
                'paymentDues' => $this->_getPaymentDues($item->getId()),
                'reservation' => $item,
                'status' => $this->_getStatus($item->getStatus()),
                'invoice' => $this->_getPaymentInvoice($item->getId()),
            );
        }
        //   d($newCollection);
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
                'hotelId' => 'Hedonism I', //$this->_getHotelNameDetail($item->getId(), $item->getType()),
                'travellers' => $this->_getTravellersDetail($item->getId()),
                'paymentDues' => $this->_getPaymentDuesDetail($item->getId()),
                'reservation' => $item,
                'status' => $this->_getStatus($item->getStatus()),
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

        $collection = $this->getCollection();

        return $collection[$id];
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

    protected function _getPaymentDues($reservationId) {

        $em = $this->getEntityManager();

        $paymentDue = array();

        $collection = $em->getRepository('\Base\Entity\ReservationPaymentDue')->findBy(array('reservation' => $reservationId), array('id' => 'ASC'));
        $i = 0;
        foreach ($collection as $dues) {

            //$paymentDue['nextDueAmount'] = $dues->getPaymentDue();
            //$paymentDue['DueDate'] = $dues->getDueDate();
            $paymentDue[] = array('nextDueAmount' => $dues->getPaymentDue(), 'DueDate' => $dues->getDueDate(), 'status' => $dues->getStatus());
        }
        // d($paymentDue);
        return $paymentDue;
    }

    protected function _getItemName($reservationId, $type) {

        $em = $this->getEntityManager();


        switch ($type) {
            case self::RESORT_ROOM:
                $item = $em->getRepository('\Base\Entity\ReservationResortRoom')->findOneBy(array('reservation' => $reservationId));
                $name = !is_null($item) ? $item->getRoom()->getTitle() : null;

                // d($item1);
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
 
                if($item){
                    $resortid = $item->getRoom()->getResortId();
                    $na = $em->getRepository('\Base\Entity\Avp\Resorts')->findOneBy(array('id' => $resortid));
                }
                $name = !is_null($na) ? $na->getTitle() : null;
                break;
            case self::EVENT_ROOM:
                $item = $em->getRepository('\Base\Entity\ReservationEventRoom')->findOneBy(array('reservation' => $reservationId));
                if($item){
                     $eventId = $item->getEventRoom()->getEventId();
                     $na = $em->getRepository('\Base\Entity\Avp\Events')->findOneBy(array('id' => $eventId));
                }
                $name = !is_null($na) ? $na->getTitle() : null;
                break;
            case self::CRUISE_CABIN:
                $item = $em->getRepository('\Base\Entity\ReservationCruiseCabin')->findOneBy(array('reservation' => $reservationId));
                if($item){
                    $cruiseId = $item->getCabin()->getCruiseId();
                    $na = $em->getRepository('\Base\Entity\Avp\Cruises')->findOneBy(array('id' => $cruiseId));
                }
                 $name = !is_null($na) ? $na->getTitle() : null;
                break;
        }
        //d($item->getEventRoom()->getEventId()); //->getResortId());
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

    public static function getDiffDatesIndex(\DateTime $dateStart, \DateTime $dateEnd) {

        $interval = (int) $dateStart->diff($dateEnd)->format('%R%a');

        if ($interval >= 120)
            return self::DAYS_120_BEFORE;

        if ($interval < 120 && $interval >= 60)
            return self::DAYS_120_90_BEFORE;

        if ($interval < 60)
            return self::DAYS_60_AND_LESS_BEFORE;
    }

    public function save($data) {
        //    d($data);
        $em = $this->getEntityManager();
        $entity = '\Base\Entity\ReservationPaymentDue';

        foreach ($data['dueid'] as $id) {
            $data['paymentDue'] = $em->find('\Base\Entity\ReservationPaymentDue', (int) $id);
        }

        $rid = $data['paymentDue']->getreservation()->getId();
        $query1 = 'DELETE FROM reservation_payment_due WHERE reservation_id =' . $rid;
        $stmt = $em->getConnection()->prepare($query1);
        $stmt->execute();
        $reservation = $em->find('\Base\Entity\Reservation', (int) $rid);

        $due = count($data['nextPaymentDue']);
        if ((int) $due > 0) {
            for ($i = 0; $i < $due; $i++) {
                $entity = new \Base\Entity\ReservationPaymentDue();
                $entity->setReservation($reservation);
                $entity->setPaymentDue($data['nextPaymentDue'][$i]);
                $entity->setDueDate(isset($data['dueDate1'][$i]) ? new \DateTime($data['dueDate1'][$i]) : null);
                $em = $this->getEntityManager();
                $em->persist($entity);
                $em->flush();
            }
        }
        return true;
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

    protected function _setReservationPaymentDue(\Base\Entity\Reservation $reservation, $data) {
        //d($data);die;
        $due = count($data['nextPaymentDue']);

        d($due);
        if ((int) $due > 0) {
            for ($i = 0; $i < $due; $i++) {
                $entity = new \Base\Entity\ReservationPaymentDue();
                $entity->setReservation($reservation);
                $entity->setPaymentDue($data['nextPaymentDue'][$i]);
                $entity->setDueDate(isset($data['dueDate1'][$i]) ? new \DateTime($data['dueDate1'][$i]) : null);
                $em = $this->getEntityManager();
                $em->persist($entity);
                $em->flush();
            }
        }
        return true;
    }

    /* protected function _setReservation($data) {

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
      $reservation->setFlight($data['flight']);

      $em->persist($reservation);
      $em->flush();

      return $reservation;
      }

      protected function _setSellItem($data) {

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

      $returnItem = $model->getItem($data[$key]);

      return $returnItem;
      } */

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

        $em = $this->getEntityManager();

        $entity = '\Base\Entity\Travellers';

        $travellers = array();

        $object = new $entity;

        $data['travellerCountry'] = $em->find('Base\Entity\Countries', (int) $data['travellerCountry']);

        if (!is_null($data['travellerCountry']))
            $data['travellerCountry'] = $data['travellerCountry']->getCountryName();

        $object->setName($data['travellerName']);
        $object->setDob($data['travellerDob']);
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

    protected function _setReservationTravellers(\Base\Entity\Reservation $reservation, \Base\Entity\Travellers $traveller) {

        $entity = new \Base\Entity\ReservationTravellers();

        $entity->setReservation($reservation);
        $entity->setTraveller($traveller);

        $em = $this->getEntityManager();
        $em->persist($entity);
        $em->flush();

        return $entity;
    }

 

    public function sendmail($id, $to, array $params = null) {
        $data = $this->getItemView($id);
        //d($data);
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
                $bookingUpdate->setBookedCount($room->getBookedCount() + $data['roomRequired']);

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
                $id = !is_null($item) ? $item->getRoom()->getId() : null;
                break;
            case self::EVENT_ROOM:
                $item = $em->getRepository('\Base\Entity\ReservationEventRoom')->findOneBy(array('reservation' => $reservationId));
                $id = !is_null($item) ? $item->getEventRoom()->getId() : null;

                break;
            case self::CRUISE_CABIN:
                $item = $em->getRepository('\Base\Entity\ReservationCruiseCabin')->findOneBy(array('reservation' => $reservationId));
                $id = !is_null($item) ? $item->getCabin()->getId() : null;
                break;
        }

        return $id;
    }

    protected function _getHotelNameDetail($reservationId, $type) {

        $em = $this->getEntityManager();


        switch ($type) {
            case self::RESORT_ROOM:
                $item = $em->getRepository('\Base\Entity\ReservationResortRoom')->findOneBy(array('reservation' => $reservationId));
                $id = !is_null($item) ? $item->getRoom()->getResortId() : null;
                break;
            case self::EVENT_ROOM:
                $item = $em->getRepository('\Base\Entity\ReservationEventRoom')->findOneBy(array('reservation' => $reservationId));
                $id = !is_null($item) ? $item->getEventRoom()->getEventId() : null;

                break;
            case self::CRUISE_CABIN:
                $item = $em->getRepository('\Base\Entity\ReservationCruiseCabin')->findOneBy(array('reservation' => $reservationId));
                $id = !is_null($item) ? $item->getCabin()->getCruiseId() : null;
                break;
        }

        return $id;
    }

    public function getViewReservation($id, $page = null) {
        //echo "in modle payment"; die;
        // d($id);
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from('\Base\Entity\Avp\OrderInvoices', 'er')
                ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id')
                ->where('e.id = :resortId')
                ->setParameter('resortId', $id['id']);

        $query = $qb->getQuery();
        $collection = $query->getResult();

        $newCollection = array();
        foreach ($collection as $item) {
            $newCollection[] = array(
                'id' => $item->getId(),
                'type' => $this->_getType($item->getType()),
                'roomId' => $this->_getItemNameDetail($item->getId(), $item->getType()),
                'hotelId' => $this->_getHotelNameDetail($item->getId(), $item->getType()),
                'hotelName' => $this->_getHotelName($item->getId(), $item->getType()),
                'travellers' => $this->_getTravellersDetail($item->getId()),
                'paymentDues' => $this->_getPaymentDuesDetail($item->getId()),
                'reservation' => $item,
                'status' => $this->_getStatus($item->getStatus()),
                'invoice' => $this->_getPaymentInvoice($item->getId()),
            );
        }
        // d($newCollection);
        return $newCollection;
    }

    public function getViewInvoice($id, $page = null) {
        //echo "in modle payment"; die;
        // d($id);
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('e')->from('\Base\Entity\Avp\OrderInvoices', 'er')
                ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id')
                ->where('e.id = :resortId')
                ->setParameter('resortId', $id);

        $query = $qb->getQuery();
        $collection = $query->getResult();

        $newCollection = array();
        foreach ($collection as $item) {
            $newCollection[] = array(
                'id' => $item->getId(),
                'type' => $this->_getType($item->getType()),
                'roomId' => $this->_getItemNameDetail($item->getId(), $item->getType()),
                'hotelId' => $this->_getHotelNameDetail($item->getId(), $item->getType()),
                'hotelName' => $this->_getHotelName($item->getId(), $item->getType()),
                'travellers' => $this->_getTravellersDetail($item->getId()),
                'paymentDues' => $this->_getPaymentDuesDetail($item->getId()),
                'reservation' => $item,
                'status' => $this->_getStatus($item->getStatus()),
                'invoice' => $this->_getPaymentInvoice($item->getId()),
            );
        }
        // d($newCollection);
        return $newCollection;
    }

    protected function _getPaymentInvoice($reservationId) {

        $em = $this->getEntityManager();

        //  $paymentDue = array();

        $collection = $em->getRepository('\Base\Entity\Avp\OrderInvoices')->findBy(array('orderId' => $reservationId));


        return $collection;
    }

    public function getResort($paymenttype = null, $startdate = null, $enddate = null, $page = false) {

        if (!empty($startdate) || !empty($enddate)) {

            If (!empty($startdate) && !empty($enddate)) {
                $qury = "er.dateAdded >= '$startdate' AND er.dateAdded <= '$enddate' ";
            } else if (!empty($startdate) && empty($enddate)) {

                $qury = "er.dateAdded >= '$startdate'";
            } else if (empty($startdate) && !empty($enddate)) {

                $qury = "er.dateAdded <= '$enddate'";
            }

            if (!empty($paymenttype)) {
                if ($paymenttype == 2) {

                    $paymenttype = 0;
                }

                $qury = $qury . " AND e.paymentType='$paymenttype'";
            }

            $em = $this->getEntityManager();
            $qb = $em->createQueryBuilder();
            $qb->select('e')->from('\Base\Entity\Avp\OrderInvoices', 'er')
                    ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id')
                    ->Where($qury . 'AND e.type=1');
            $query = $qb->getQuery();
            $collection = $query->getResult();
            //           d($collection);
        } elseif (!empty($paymenttype) && empty($startdate) && empty($enddate)) {
            if ($paymenttype == 2) {

                $paymenttype = 0;
            }

            $em = $this->getEntityManager();
            $qb = $em->createQueryBuilder();
            $qb->select('e')->from('\Base\Entity\Avp\OrderInvoices', 'er')
                    ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id')
                    ->where('e.paymentType=:type AND e.type=1')
                    ->setParameter('type', $paymenttype);


            $query = $qb->getQuery();
            $collection = $query->getResult();
        } else {
            $em = $this->getEntityManager();
            $qb = $em->createQueryBuilder();
            $qb->select('e')->from('\Base\Entity\Avp\OrderInvoices', 'er')
                    ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id')
                    ->Where('e.type=1');
            $query = $qb->getQuery();
            $collection = $query->getResult();
        }

        //   d($collection);
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
                'invoice' => $this->_getPaymentInvoice($item->getId()),
            );
        }
        //   d($newCollection);
        return $newCollection;
    }

    public function getCruise($paymenttype = null, $startdate = null, $enddate = null, $page = false) {

        if (!empty($startdate) || !empty($enddate)) {

            If (!empty($startdate) && !empty($enddate)) {
                $qury = "er.dateAdded >= '$startdate' AND er.dateAdded <= '$enddate' ";
            } else if (!empty($startdate) && empty($enddate)) {

                $qury = "er.dateAdded >= '$startdate'";
            } else if (empty($startdate) && !empty($enddate)) {

                $qury = "er.dateAdded <= '$enddate'";
            }

            if (!empty($paymenttype)) {
                if ($paymenttype == 2) {

                    $paymenttype = 0;
                }

                $qury = $qury . " AND e.paymentType='$paymenttype'";
            }



            $em = $this->getEntityManager();
            $qb = $em->createQueryBuilder();
            $qb->select('e')->from('\Base\Entity\Avp\OrderInvoices', 'er')
                    ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id')
                    ->Where($qury . 'AND e.type=3');
            $query = $qb->getQuery();
            $collection = $query->getResult();
            //           d($collection);
        } elseif (!empty($paymenttype) && empty($startdate) && empty($enddate)) {
            if ($paymenttype == 2) {

                $paymenttype = 0;
            }


            $em = $this->getEntityManager();
            $qb = $em->createQueryBuilder();
            $qb->select('e')->from('\Base\Entity\Avp\OrderInvoices', 'er')
                    ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id')
                    ->where('e.paymentType=:type AND e.type=3')
                    ->setParameter('type', $paymenttype);

            $query = $qb->getQuery();
            $collection = $query->getResult();
        } else {
            $em = $this->getEntityManager();
            $qb = $em->createQueryBuilder();
            $qb->select('e')->from('\Base\Entity\Avp\OrderInvoices', 'er')
                    ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id')
                    ->Where('e.type=3');
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
                'invoice' => $this->_getPaymentInvoice($item->getId()),
            );
        }
        //   d($newCollection);
        return $newCollection;
    }

    public function getEventPayment($paymenttype = null, $startdate = null, $enddate = null, $page = false) {

        if (!empty($startdate) || !empty($enddate)) {

            If (!empty($startdate) && !empty($enddate)) {
                $qury = "er.dateAdded >= '$startdate' AND er.dateAdded <= '$enddate' ";
            } else if (!empty($startdate) && empty($enddate)) {

                $qury = "er.dateAdded >= '$startdate'";
            } else if (empty($startdate) && !empty($enddate)) {

                $qury = "er.dateAdded <= '$enddate'";
            }

            if (!empty($paymenttype)) {
                if ($paymenttype == 2) {

                    $paymenttype = 0;
                }

                $qury = $qury . " AND e.paymentType='$paymenttype'";
            }


            $em = $this->getEntityManager();
            $qb = $em->createQueryBuilder();
            $qb->select('e')->from('\Base\Entity\Avp\OrderInvoices', 'er')
                    ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id')
                    ->Where($qury . 'AND e.type=2');
            $query = $qb->getQuery();
            $collection = $query->getResult();
            //           d($collection);
        } elseif (!empty($paymenttype) && empty($startdate) && empty($enddate)) {
            if ($paymenttype == 2) {

                $paymenttype = 0;
            }
            $em = $this->getEntityManager();
            $qb = $em->createQueryBuilder();
            $qb->select('e')->from('\Base\Entity\Avp\OrderInvoices', 'er')
                    ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id')
                    ->where('e.paymentType=:type AND e.type=2')
                    ->setParameter('type', $paymenttype);


            $query = $qb->getQuery();
            $collection = $query->getResult();
        } else {
            $em = $this->getEntityManager();
            $qb = $em->createQueryBuilder();
            $qb->select('e')->from('\Base\Entity\Avp\OrderInvoices', 'er')
                    ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id')
                    ->Where('e.type=2');
            $query = $qb->getQuery();
            $collection = $query->getResult();
        }


        //   d($collection);
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
                'invoice' => $this->_getPaymentInvoice($item->getId()),
            );
        }
        //   d($newCollection);
        return $newCollection;
    }

    public function updatePaymentStatus($reservation, $response, $allvalue = null,$source = null) {


        
        $reservation = $this->_setReservation($reservation, $response,$source);
        
        $this->_savePaymentDetails($reservation, $response);

        $em = $this->getEntityManager();
        $entity = '\Base\Entity\ReservationPaymentDue';

        // d($allvalue['collection']['paymentDues']);
        $paymentdue = $allvalue['collection']['paymentDues'];
        //d($paymentdue);
        $this->_setPaymentDue($paymentdue, $reservation);
//        d($reservation->getId());
        
        $to=$allvalue['collection']['travellers']['0']->getTraveller()->getEmail();
        $this->sendmail($reservation->getId(),$to);
        //   d('success');
    }
    public function updatePaymentStatusDirect($reservation, $response, $allvalue = null) {


       // d($response);
        $reservation = $this->_setReservation($reservation, $response,null,1);

        $this->_savePaymentDetails($reservation, $response);

        $em = $this->getEntityManager();
        $entity = '\Base\Entity\ReservationPaymentDue';

        // d($allvalue['collection']['paymentDues']);
        $paymentdue = $allvalue['collection']['paymentDues'];

        $this->_setPaymentDue($paymentdue, $reservation);

        $to=$allvalue['collection']['travellers']['0']->getTraveller()->getEmail();
        $this->sendmail($reservation->getId(),$to);

        //   d('success');
    }

    protected function _setPaymentDue($data,\Base\Entity\Reservation $reservation) {
     /*   
        $em = $this->getEntityManager();
        $q = $em->createQuery('delete from \Base\Entity\ReservationPaymentDue r where r.reservation='.$reservation->getId());
        $deleted = $q->execute();

        
        $qb = $em->createQueryBuilder();
        $qb->select('c')->from('\Base\Entity\Reservation', 'c')
                ->where('c.id='.$reservation->getId());

        $query = $qb->getQuery();
        $results = $query->getResult();
//        d($results[0]->getBalansAfterDeposit());
        $remainingcost=$results[0]->getBalansAfterDeposit();
        $remainingcost1=$remainingcost/2;
//        echo "Balance ".$results[0]->getBalansAfterDeposit();
//        echo " Paid Amt ".$response['ACK']['AMT'];
//        echo "totaldep ".$remainingcost;
//        echo " dep ".$remainingcost1;
        if($remainingcost1>200){
            for($i=0;$i<2;$i++){
                if($i==0){
                    $date=date('Y-m-d',strtotime('+7'));
                }elseif($i==1){
                    $date=date('Y-m-d',strtotime('+14'));
                }
                $entity = new \Base\Entity\ReservationPaymentDue();
                $em = $this->getEntityManager();
                $entity->setReservation($reservation);
                $entity->setPaymentDue($remainingcost1);
                $entity->setDueDate(new \DateTime($date));
                $entity->setStatus(0);
                $em->persist($entity);
                $em->flush();
            }
        }else{
//             echo "totaldep ".$remainingcost; die;
                $date=date('Y-m-d',strtotime(date('Y-m-d').'+7'));
                $entity = new \Base\Entity\ReservationPaymentDue();
                $em = $this->getEntityManager();
                $entity->setReservation($reservation);
                $entity->setPaymentDue($remainingcost);
                $entity->setDueDate(new \DateTime($date));
                if($remainingcost==0 || $remainingcost==0.00){
                    $entity->setStatus(1);
                }else{
                    $entity->setStatus(0);
                }
                $em->persist($entity);
                $em->flush();
        }*/
        $due = count($data);
//        d($data);
        if ((int) $due > 0) {
            if ($due == 1) {
                $dueamount = $reservation->getBalansAfterDeposit();
            } else {

                $dueamount = ($reservation->getBalansAfterDeposit()) / $due;
            }
            for ($i = 0; $i < $due; $i++) {

                $em = $this->getEntityManager();
                $id = $data[$i]->getId();

                if (isset($id) && (int) $id != 0) {
                    $entity = $em->find('\Base\Entity\ReservationPaymentDue', (int) $id);
                }

                $entity->setPaymentDue($dueamount);
                if($dueamount<1){
                    $entity->setStatus(1);
                }
                $em->persist($entity);
                $em->flush();
            }
        }

        return true;
    }

    protected function _savePaymentDetails($reservation, $response) {


        $type = 2;
        $entity = new \Base\Entity\Avp\OrderInvoices();
        $em = $this->getEntityManager();
//d($response);
        $entity->setOrderId($reservation->getId());
        $entity->setCurrencyCode($response['ACK']['CURRENCYCODE']);
        $entity->setTransactionId($response['ACK']['TRANSACTIONID']);
        $entity->setAmountPaid($response['ACK']['AMT']);
//        if ($type == 1):
//            $entity->setPaymentMode('expresscheckout');
//        else:
//            $entity->setPaymentMode('DoDirectPayment');
//        endif;
        
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
    }

    protected function _setReservation($data, $response,$source=null,$section=null) {

        //d($data); 
        //d($data->getId());

        $id = $data->getId();

        $response = $response['ACK']['AMT'];

        $depositeAmount = $data->getdepositAmoun() + $response;

        $balansAfterDeposit = $data->getfinalCost() - $depositeAmount;
        
        $isPending = $data->getIsBooked();

        if($isPending == 0):
            $depositeAmount = $response;

            $balansAfterDeposit = $data->getfinalCost() - $depositeAmount;
        endif;
        //   d($balansAfterDeposit);
        
        if($section == 1):
            $merchantFee = 0;//added this when apply payment is done for pending reservation
        endif;

        $em = $this->getEntityManager();

        $reservation = new $this->_targetEntity;


        if (isset($id) && (int) $id != 0) {
            $reservation = $em->find('Base\Entity\Reservation', (int) $id);
        }

        $reservation->setDepositAmoun($depositeAmount);
        $reservation->setBalansAfterDeposit($balansAfterDeposit);
        $reservation->setMerchantFee($merchantFee);    
//         if($source == 1):
              $reservation->setIsBooked(1);
         if($balansAfterDeposit <= 0):
              $reservation->setStatus(2);
         endif;
//         endif;
        
        
        $reservation->setUpdatedAt(new \DateTime);

        $em->persist($reservation);
        $em->flush();

        return $reservation;
    }

    public function updateReservationPaymentStatus($data, $object, $allvalue) {

        // d($object);
        $id = $data->getId();
        //d($id);
        //  d($data->getdepositAmoun());

        $paymentdue = $allvalue['collection']['paymentDues'];

     //  d($data);
        $response = $object['totalCost'];
//d($response);
        $depositeAmount = $data->getdepositAmoun() + $response;
//d($depositeAmount);
        $balansAfterDeposit = $data->getfinalCost() - $depositeAmount;


       // d($balansAfterDeposit);

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

        $this->_setPaymentDue($paymentdue, $reservation);
        return $reservation;
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

    public function getPaymentdues($page = null) {

        //   $collection = parent::getCollection($page);
        $em = $this->getEntityManager();
        $collection = $em->getRepository('\Base\Entity\ReservationPaymentDue')->findAll();
        // d($collection[0]->getReservation()->getId());

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

    public function sendmailinvoice($to, array $data = null) {
        
       // echo "sendmailnew"; die;

        return SendmailController::sendMailOnInvoice($this->_serviceManager, $to, $data);

        return true;
    }

      public function cancelReservation($id) {
        //  d($id);
        $item = $this->getItem($id);
        
       //d($item);
        if ($item) {
            $em = $this->getEntityManager();

            $entity = $em->find('Base\Entity\Reservation', (int) $id);
            $entity->setStatus(self::CANCELED);
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

}