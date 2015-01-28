<?php

namespace Reports\Model;

use Zend\InputFilter\Factory as InputFactory;     // <-- Add this import
use Zend\InputFilter\InputFilter;                 // <-- Add this import
use Zend\InputFilter\InputFilterAwareInterface;   // <-- Add this import
use Zend\InputFilter\InputFilterInterface;        // <-- Add this import
use Zend\View\Model\ViewModel;
use Sendmail\Controller\SendmailController;

class Reports extends \Base\Model\BaseModel implements InputFilterAwareInterface {

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

    public function getCollection($type = null,$typeId=null, $startdate = null, $enddate = null, $page = false) {

        // d('heer');

//        if (!empty($startdate) || !empty($enddate)) {


            If (!empty($startdate) && !empty($enddate)) {
                $qury1 = "er.dateAdded >= '$startdate' AND er.dateAdded <= '$enddate' ";
            } else if (!empty($startdate) && empty($enddate)) {

                $qury1 = "er.dateAdded >= '$startdate'";
            } else if (empty($startdate) && !empty($enddate)) {

                $qury1 = "er.dateAdded <= '$enddate'";
            }

           if (!empty($type) && !empty($qury1)) {

                $qury = $qury1 . " AND e.type='$type' AND e.isBooked=1";
            }elseif(!empty($type)){
                $qury = "e.type='$type' AND e.isBooked=1";
            }

            $em = $this->getEntityManager();
            $qb = $em->createQueryBuilder();
            /*$qb->select('e')->from('\Base\Entity\Avp\OrderInvoices', 'er')
                    ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id')
                    ->Where($qury);*/

            if(!empty($qury)){
                if($type==2){
                    $qb->select('e')->from('\Base\Entity\Avp\OrderInvoices', 'er')
                    ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id')
                    ->innerJoin('\Base\Entity\ReservationEventRoom', 'rer', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'rer.reservation = e.id')
                    ->innerJoin('\Base\Entity\Avp\EventRooms', 'err', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'rer.eventRoom = err.id')
                    ->innerJoin('\Base\Entity\Avp\Events', 'r', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'err.eventId = r.id')
                     ->Where($qury." AND r.id='$typeId'");
//                    ->Where("r.id='$typeId'");
                }elseif($type==1){
                    $qb->select('e')->from('\Base\Entity\Avp\OrderInvoices', 'er')
                    ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id')
                    ->innerJoin('\Base\Entity\ReservationResortRoom', 'rer', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'rer.reservation = e.id')
                    ->innerJoin('\Base\Entity\Avp\ResortRooms', 'err', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'rer.room = err.id')
                    ->innerJoin('\Base\Entity\Avp\Resorts', 'r', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'err.resortId = r.id')
                     ->Where($qury." AND r.id='$typeId'");
//                    ->Where("r.id='$typeId'");
                }else{
                    $qb->select('e')->from('\Base\Entity\Avp\OrderInvoices', 'er')
                    ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id')
                    ->innerJoin('\Base\Entity\ReservationCruiseCabin', 'rer', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'rer.reservation = e.id')
                    ->innerJoin('\Base\Entity\Avp\CruiseCabins', 'err', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'rer.cabin = err.id')
                    ->innerJoin('\Base\Entity\Avp\Cruises', 'r', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'err.cruiseId = r.id')
                     ->Where($qury." AND r.id='$typeId'");
//                    ->Where("r.id='$typeId'");
                }
            }else{
                $qb->select('e')->from('\Base\Entity\Avp\OrderInvoices', 'er')
                    ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id');
            }
            
            $query = $qb->getQuery();
            $collection = $query->getResult();
       /* } elseif (!empty($type) && empty($startdate) && empty($enddate)) {

            $em = $this->getEntityManager();
            $qb = $em->createQueryBuilder();
            $qb->select('e')->from('\Base\Entity\Avp\OrderInvoices', 'er')
                    ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id')
                    ->where('e.type=:type')
                    ->setParameter('type', $type);


            $query = $qb->getQuery();
            $collection = $query->getResult();
        } else {
            $em = $this->getEntityManager();
            $qb = $em->createQueryBuilder();
            $qb->select('e')->from('\Base\Entity\Avp\OrderInvoices', 'er')
                    ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id');
            $query = $qb->getQuery();
            $collection = $query->getResult();
        }*/

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
        // d($newCollection);
        return $newCollection;
    }

    public function getreservationCollection($type = null,$typeId=null ,$startdate = null, $enddate = null, $page = false) {

        // d('heer');

       // if (!empty($startdate) || !empty($enddate)) {


            If (!empty($startdate) && !empty($enddate)) {
                $qury1 = "e.createdAt >= '$startdate' AND er.createdAt <= '$enddate' ";
            } else if (!empty($startdate) && empty($enddate)) {

                $qury1 = "e.createdAt >= '$startdate'";
            } else if (empty($startdate) && !empty($enddate)) {

                $qury1 = "e.createdAt <= '$enddate'";
            }

            if (!empty($type) && !empty($qury1)) {

                $qury = $qury1 . " AND e.type='$type' AND e.isBooked=1";
            }elseif(!empty($type)){
                $qury = "e.type='$type' AND e.isBooked=1";
            }

            $em = $this->getEntityManager();
            $qb = $em->createQueryBuilder();
            /*$qb->select('e')->from('\Base\Entity\Reservation', 'e')
                    //  ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id')
                    ->Where($qury);*/
             if(!empty($qury)){
                if($type==2){
                    $qb->select('e')->from('\Base\Entity\Reservation', 'e')
                    ->innerJoin('\Base\Entity\ReservationEventRoom', 'rer', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'rer.reservation = e.id')
                    ->innerJoin('\Base\Entity\Avp\EventRooms', 'err', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'rer.eventRoom = err.id')
                    ->innerJoin('\Base\Entity\Avp\Events', 'r', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'err.eventId = r.id')
                     ->Where($qury." AND r.id='$typeId'");
//                    ->Where("r.id='$typeId'");
                }elseif($type==1){
                    $qb->select('e')->from('\Base\Entity\Reservation', 'e')
                    ->innerJoin('\Base\Entity\ReservationResortRoom', 'rer', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'rer.reservation = e.id')
                    ->innerJoin('\Base\Entity\Avp\ResortRooms', 'err', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'rer.room = err.id')
                    ->innerJoin('\Base\Entity\Avp\Resorts', 'r', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'err.resortId = r.id')
                     ->Where($qury." AND r.id='$typeId'");
//                    ->Where("r.id='$typeId'");
                }else{
                    $qb->select('e')->from('\Base\Entity\Reservation', 'e')
                    ->innerJoin('\Base\Entity\ReservationCruiseCabin', 'rer', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'rer.reservation = e.id')
                    ->innerJoin('\Base\Entity\Avp\CruiseCabins', 'err', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'rer.cabin = err.id')
                    ->innerJoin('\Base\Entity\Avp\Cruises', 'r', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'err.cruiseId = r.id')
                     ->Where($qury." AND r.id='$typeId'");
//                    ->Where("r.id='$typeId'");
                }
            }else{
                $qb->select('e')->from('\Base\Entity\Reservation', 'e')->Where('e.isBooked=1');
            }
            $query = $qb->getQuery();
            $collection = $query->getResult();
        /*} elseif (!empty($type) && empty($startdate) && empty($enddate)) {

            $em = $this->getEntityManager();
            $qb = $em->createQueryBuilder();
            $qb->select('e')->from('\Base\Entity\Reservation', 'e')
                    //->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id')
                    ->where('e.type=:type')
                    ->setParameter('type', $type);


            $query = $qb->getQuery();
            $collection = $query->getResult();
        } else {
            $em = $this->getEntityManager();
            $qb = $em->createQueryBuilder();
            $qb->select('e')->from('\Base\Entity\Reservation', 'e');
            //    ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id');
            $query = $qb->getQuery();
            $collection = $query->getResult();
        }*/

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
        // d($newCollection);
        return $newCollection;
    }

    public function getroomnightreservationCollection($type = null,$typeId=null, $startdate = null, $enddate = null, $page = false) {

//        if (!empty($startdate) || !empty($enddate)) {


            If (!empty($startdate) && !empty($enddate)) {
                $qury1 = "e.dateFrom >= '$startdate' AND e.dateFrom <= '$enddate' ";
            } else if (!empty($startdate) && empty($enddate)) {

                $qury1 = "e.dateFrom >= '$startdate'";
            } else if (empty($startdate) && !empty($enddate)) {

                $qury1 = "e.dateFrom <= '$enddate'";
            }

            if (!empty($type) && !empty($qury1)) {

                $qury = $qury1 . " AND e.type='$type' AND e.isBooked=1";
            }elseif(!empty($type)){
                $qury = "e.type='$type' AND e.isBooked=1";
            }

            $em = $this->getEntityManager();
            $qb = $em->createQueryBuilder();
            if(!empty($qury)){
                if($type==2){
                    $qb->select('e')->from('\Base\Entity\Avp\OrderInvoices', 'er')
                    ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id')
                    ->innerJoin('\Base\Entity\ReservationEventRoom', 'rer', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'rer.reservation = e.id')
                    ->innerJoin('\Base\Entity\Avp\EventRooms', 'err', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'rer.eventRoom = err.id')
                    ->innerJoin('\Base\Entity\Avp\Events', 'r', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'err.eventId = r.id')
                     ->Where($qury." AND r.id='$typeId'");
//                    ->Where("r.id='$typeId'");
                }elseif($type==1){
                    $qb->select('e')->from('\Base\Entity\Avp\OrderInvoices', 'er')
                    ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id')
                    ->innerJoin('\Base\Entity\ReservationResortRoom', 'rer', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'rer.reservation = e.id')
                    ->innerJoin('\Base\Entity\Avp\ResortRooms', 'err', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'rer.room = err.id')
                    ->innerJoin('\Base\Entity\Avp\Resorts', 'r', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'err.resortId = r.id')
                     ->Where($qury." AND r.id='$typeId'");
//                    ->Where("r.id='$typeId'");
                }else{
                    $qb->select('e')->from('\Base\Entity\Avp\OrderInvoices', 'er')
                    ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id')
                    ->innerJoin('\Base\Entity\ReservationCruiseCabin', 'rer', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'rer.reservation = e.id')
                    ->innerJoin('\Base\Entity\Avp\CruiseCabins', 'err', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'rer.cabin = err.id')
                    ->innerJoin('\Base\Entity\Avp\Cruises', 'r', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'err.cruiseId = r.id')
                     ->Where($qury." AND r.id='$typeId'");
//                    ->Where("r.id='$typeId'");
                }
            }else{
                $qb->select('e')->from('\Base\Entity\Avp\OrderInvoices', 'er')
                    ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id');
            }

            $query = $qb->getQuery();
            $collection = $query->getResult();
        /*} elseif (!empty($type) && empty($startdate) && empty($enddate)) {

            $em = $this->getEntityManager();
            $qb = $em->createQueryBuilder();
            $qb->select('e')->from('\Base\Entity\Avp\OrderInvoices', 'er')
                    ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id')
                    ->where('e.type=:type')
                    ->setParameter('type', $type);


            $query = $qb->getQuery();
            $collection = $query->getResult();
        } else {
            $em = $this->getEntityManager();
            $qb = $em->createQueryBuilder();
            $qb->select('e')->from('\Base\Entity\Avp\OrderInvoices', 'er')
                    ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id');
            $query = $qb->getQuery();
            $collection = $query->getResult();
        }*/

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
        // d($newCollection);
        return $newCollection;
    }

    public function getroomingCollection($type = null,$typeId=null, $startdate = null, $enddate = null, $country = false) {

//        if (!empty($startdate) || !empty($enddate)) {


            If (!empty($startdate) && !empty($enddate)) {
                $qury1 = "e.dateFrom >= '$startdate' AND e.dateFrom <= '$enddate' ";
            } else if (!empty($startdate) && empty($enddate)) {

                $qury1 = "e.dateFrom >= '$startdate'";
            } else if (empty($startdate) && !empty($enddate)) {

                $qury1 = "e.dateFrom <= '$enddate'";
            }

            if (!empty($type) && !empty($qury1) && !empty($country)) {

                $qury = $qury1 . " AND e.type='$type' AND r.countryId='$country' AND e.isBooked=1";
            }elseif(!empty($type) && !empty($country)){
                $qury = "e.type='$type' AND r.countryId='$country' AND e.isBooked=1";
            }elseif(!empty($type)){
                $qury = "e.type='$type' AND e.isBooked=1";
            }

            $em = $this->getEntityManager();
            $qb = $em->createQueryBuilder();
            /*$qb->select('e')->from('\Base\Entity\Avp\OrderInvoices', 'er')
                    ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id')
                    ->Where($qury);*/
            if(!empty($qury)){
                if($type==2){
                    $qb->select('e')->from('\Base\Entity\Avp\OrderInvoices', 'er')
                    ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id')
                    ->innerJoin('\Base\Entity\ReservationEventRoom', 'rer', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'rer.reservation = e.id')
                    ->innerJoin('\Base\Entity\Avp\EventRooms', 'err', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'rer.eventRoom = err.id')
                    ->innerJoin('\Base\Entity\Avp\Events', 'ev', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'err.eventId = ev.id')
                    ->innerJoin('\Base\Entity\Avp\Resorts', 'r', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'ev.resortId = r.id')
                    ->Where($qury." AND ev.id='$typeId'");
//                    ->Where("r.id='$typeId'");
                }elseif($type==1){
                    $qb->select('e')->from('\Base\Entity\Avp\OrderInvoices', 'er')
                    ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id')
                    ->innerJoin('\Base\Entity\ReservationResortRoom', 'rer', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'rer.reservation = e.id')
                    ->innerJoin('\Base\Entity\Avp\ResortRooms', 'err', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'rer.room = err.id')
                    ->innerJoin('\Base\Entity\Avp\Resorts', 'r', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'err.resortId = r.id')
                     ->Where($qury." AND r.id='$typeId'");
//                    ->Where("r.id='$typeId'");
                }else{
                    $qb->select('e')->from('\Base\Entity\Avp\OrderInvoices', 'er')
                    ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id')
                    ->innerJoin('\Base\Entity\ReservationCruiseCabin', 'rer', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'rer.reservation = e.id')
                    ->innerJoin('\Base\Entity\Avp\CruiseCabins', 'err', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'rer.cabin = err.id')
                    ->innerJoin('\Base\Entity\Avp\Cruises', 'r', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'err.cruiseId = r.id')
                     ->Where($qury." AND r.id='$typeId'");
//                    ->Where("r.id='$typeId'");
                }
            }else{
                $qb->select('e')->from('\Base\Entity\Avp\OrderInvoices', 'er')
                    ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id');
            }
            $query = $qb->getQuery();
            $collection = $query->getResult();
       /* } elseif (!empty($type) && empty($startdate) && empty($enddate)) {

            $em = $this->getEntityManager();
            $qb = $em->createQueryBuilder();
            $qb->select('e')->from('\Base\Entity\Avp\OrderInvoices', 'er')
                    ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id')
                    ->where('e.type=:type')
                    ->setParameter('type', $type);


            $query = $qb->getQuery();
            $collection = $query->getResult();
        } else {
            $em = $this->getEntityManager();
            $qb = $em->createQueryBuilder();
            $qb->select('e')->from('\Base\Entity\Avp\OrderInvoices', 'er')
                    ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id');
            $query = $qb->getQuery();
            $collection = $query->getResult();
        }*/

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
        // d($newCollection);
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

    protected function _getPaymentInvoice($reservationId) {

        $em = $this->getEntityManager();

        //  $paymentDue = array();

        $collection = $em->getRepository('\Base\Entity\Avp\OrderInvoices')->findBy(array('orderId' => $reservationId));


        return $collection;
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

    protected function _getTravellers($reservationId) {

        $em = $this->getEntityManager();

        $travellers = array();

        $collection = $em->getRepository('\Base\Entity\ReservationTravellers')->findBy(array('reservation' => $reservationId));

        foreach ($collection as $traveller) {
            $travellers[] = $traveller->getTraveller()->getName();
        }

        return $travellers;
    }

    protected function _getCommission($orderId) {
       $em = $this->getEntityManager();

        $commissions = array();

        $collection = $em->getRepository('\Base\Entity\Avp\AffiliateCommissions')->findBy(array('orderId' => $orderId));

        foreach ($collection as $commission) {
            $commissions[] =array('type'=> $commission->getType(),'amount'=>$commission->getAmount());
        }

        return $commissions; 
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

    public function getcommissionCollection($type = null, $typeId=null,$startdate = null, $enddate = null, $spcname = null, $page = false) {

//        if (!empty($startdate) || !empty($enddate)) {


            If (!empty($startdate) && !empty($enddate)) {
                $qury1 = "e.createdAt >= '$startdate' AND e.createdAt <= '$enddate' ";
            } else if (!empty($startdate) && empty($enddate)) {

                $qury1 = "e.createdAt >= '$startdate'";
            } else if (empty($startdate) && !empty($enddate)) {

                $qury1 = "e.createdAt <= '$enddate'";
            }

           if (!empty($type) && !empty($qury1)) {

                $qury = $qury1 . " AND e.type='$type' AND e.isBooked=1";
            }elseif(!empty($type)){
                $qury = "e.type='$type' AND e.isBooked=1";
            }

            $em = $this->getEntityManager();
            $qb = $em->createQueryBuilder();
            /*$qb->select('e')->from('\Base\Entity\Avp\AffiliateCommissions', 'er')
                    ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.affiliateId= e.affiliateId')
                    ->Where($qury);*/

            if(!empty($qury)){
                if($type==2){
                    $qb->select('e')->from('\Base\Entity\Avp\AffiliateCommissions', 'er')
                    ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id')
                    ->innerJoin('\Base\Entity\ReservationEventRoom', 'rer', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'rer.reservation = e.id')
                    ->innerJoin('\Base\Entity\Avp\EventRooms', 'err', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'rer.eventRoom = err.id')
                    ->innerJoin('\Base\Entity\Avp\Events', 'r', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'err.eventId = r.id')
                     ->Where($qury." AND r.id='$typeId'");
//                    ->Where("r.id='$typeId'");
                }elseif($type==1){
                    $qb->select('e')->from('\Base\Entity\Avp\AffiliateCommissions', 'er')
                    ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id')
                    ->innerJoin('\Base\Entity\ReservationResortRoom', 'rer', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'rer.reservation = e.id')
                    ->innerJoin('\Base\Entity\Avp\ResortRooms', 'err', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'rer.room = err.id')
                    ->innerJoin('\Base\Entity\Avp\Resorts', 'r', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'err.resortId = r.id')
                     ->Where($qury." AND r.id='$typeId'");
//                    ->Where("r.id='$typeId'");
                }else{
                    $qb->select('e')->from('\Base\Entity\Avp\AffiliateCommissions', 'er')
                    ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id')
                    ->innerJoin('\Base\Entity\ReservationCruiseCabin', 'rer', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'rer.reservation = e.id')
                    ->innerJoin('\Base\Entity\Avp\CruiseCabins', 'err', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'rer.cabin = err.id')
                    ->innerJoin('\Base\Entity\Avp\Cruises', 'r', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'err.cruiseId = r.id')
                     ->Where($qury." AND r.id='$typeId'");
//                    ->Where("r.id='$typeId'");
                }
            }else{
                $qb->select('e')->from('\Base\Entity\Avp\AffiliateCommissions', 'er')
                    ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.orderId = e.id');
            }
            
            $query = $qb->getQuery();
            $collection = $query->getResult();
        /*} elseif (!empty($type) && empty($startdate) && empty($enddate)) {

            $em = $this->getEntityManager();
            $qb = $em->createQueryBuilder();
            $qb->select('e')->from('\Base\Entity\Avp\AffiliateCommissions', 'er')
                    ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.affiliateId= e.affiliateId')
                    ->where('e.type=:type')
                    ->setParameter('type', $type);


            $query = $qb->getQuery();
            $collection = $query->getResult();
        } else {
            $em = $this->getEntityManager();
            $qb = $em->createQueryBuilder();
            $qb->select('e')->from('\Base\Entity\Avp\AffiliateCommissions', 'er')
                    ->innerJoin('\Base\Entity\Reservation', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.affiliateId= e.affiliateId');
            $query = $qb->getQuery();
            $collection = $query->getResult();
        }*/



        //  d($collection);
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
                'commission' => $this->_getCommission($item->getId()),
            );
        }
//        d($newCollection);
        return $newCollection;
    }
    
    public function getagentrole(){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('er')->from('\Base\Entity\Role', 'er')->where('er.isActive=1');
        
        $query = $qb->getQuery();
        $collection = $query->getResult();
        return $collection;
    }
    
    public function getActivity($userid=null, $startdate=null, $enddate=null){
         If (!empty($startdate) && !empty($enddate)) {
                $qury = "er.dateAdded >= '$startdate' AND er.dateAdded <= '$enddate' AND er.userId='$userid'";
            } else if (!empty($startdate) && empty($enddate)) {

                $qury = "er.dateAdded >= '$startdate' AND er.userId='$userid'";
            } else if (empty($startdate) && !empty($enddate)) {

                $qury = "er.dateAdded <= '$enddate' AND er.userId='$userid'";
            }else{
                $qury="er.userId='$userid'";
            }

           
//            d($qury);
            $em = $this->getEntityManager();
            $qb = $em->createQueryBuilder();
            $qb->select('er')->from('\Base\Entity\Activity', 'er')
                    ->Where($qury);

            $query = $qb->getQuery();
            $collection = $query->getResult();
//            d($collection);
            return $collection;
    }
    
    public function getprofitCollection($type=null, $typeId=null,$startdate=null, $enddate=null){
        
         If (!empty($startdate) && !empty($enddate)) {
                $qury1 = "e.createdAt >= '$startdate' AND e.createdAt <= '$enddate' ";
            } else if (!empty($startdate) && empty($enddate)) {

                $qury1 = "e.createdAt >= '$startdate'";
            } else if (empty($startdate) && !empty($enddate)) {

                $qury1 = "e.createdAt <= '$enddate'";
            }

            if (!empty($type) && !empty($qury1)) {

                $qury = $qury1 . " AND e.type='$type' AND e.isBooked=1";
            }elseif(!empty($type)){
                $qury = "e.type='$type' AND e.isBooked=1";
            }
            
        $em = $this->getEntityManager();
            $qb = $em->createQueryBuilder();
            /*$qb->select('r')->from('\Base\Entity\Reservation', 'r')
                    ->innerJoin('\Base\Entity\ReservationEventRoom', 'rer', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'rer.reservation = r.id')
                    ->innerJoin('\Base\Entity\Avp\EventRooms', 'er', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'rer.eventRoom = er.id')
                    ->innerJoin('\Base\Entity\Avp\Events', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.eventId = e.id')
                    ->Where("r.type='$type'")
                    ->Where("e.id='$typeId'");*/

            if(!empty($qury)){
                if($type==2){
                    $qb->select('e')->from('\Base\Entity\Reservation', 'e')
                    ->innerJoin('\Base\Entity\ReservationEventRoom', 'rer', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'rer.reservation = e.id')
                    ->innerJoin('\Base\Entity\Avp\EventRooms', 'err', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'rer.eventRoom = err.id')
                    ->innerJoin('\Base\Entity\Avp\Events', 'r', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'err.eventId = r.id')
                     ->Where($qury." AND r.id='$typeId'");
//                    ->Where("r.id='$typeId'");
                }elseif($type==1){
                    $qb->select('e')->from('\Base\Entity\Reservation', 'e')
                    ->innerJoin('\Base\Entity\ReservationResortRoom', 'rer', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'rer.reservation = e.id')
                    ->innerJoin('\Base\Entity\Avp\ResortRooms', 'err', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'rer.room = err.id')
                    ->innerJoin('\Base\Entity\Avp\Resorts', 'r', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'err.resortId = r.id')
                     ->Where($qury." AND r.id='$typeId'");
//                    ->Where("r.id='$typeId'");
                }else{
                    $qb->select('e')->from('\Base\Entity\Reservation', 'e')
                    ->innerJoin('\Base\Entity\ReservationCruiseCabin', 'rer', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'rer.reservation = e.id')
                    ->innerJoin('\Base\Entity\Avp\CruiseCabins', 'err', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'rer.cabin = err.id')
                    ->innerJoin('\Base\Entity\Avp\Cruises', 'r', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'err.cruiseId = r.id')
                     ->Where($qury." AND r.id='$typeId'");
//                    ->Where("r.id='$typeId'");
                }
            }else{
                $qb->select('e')->from('\Base\Entity\Reservation', 'e')->Where('e.isBooked=1');
            }
            
            $query = $qb->getQuery();
            $collection = $query->getResult();
//            d($collection);
            $newCollection = array();
        foreach ($collection as $item) {
            //d($item->getId());
            $newCollection[$item->getId()] = array(
                'id' => $item->getId(),
                'type' => $this->_getType($item->getType()),
                'roomName' => $this->_getItemName($item->getId(), $item->getType()),
                'hotelName' => $this->_getHotelName($item->getId(), $item->getType()),
                'reservation' => $item,
            );
        }
//        d($newCollection);
        return $newCollection;
    }

    public function getResortCountries(){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('c')->from('\Base\Entity\Avp\Resorts', 'r')
                ->innerJoin('\Base\Entity\Avp\Countries', 'c', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'r.countryId = c.id');
        
        $query = $qb->getQuery();
        $collection = $query->getResult();
        return $collection;
    }
}