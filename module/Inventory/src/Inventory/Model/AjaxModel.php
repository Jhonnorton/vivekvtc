<?php

namespace Inventory\Model;

use Inventory\Model\Promos;

class AjaxModel extends \Base\Model\AvpModel {

    protected function getBaseRepository($targetEntity) {
        return $this->getBaseEntityManager()->getRepository($targetEntity);
    }

    public function getCruisesCollection() {
        $collection = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Cruises')->findBy(array('isDeleted'=>0,'status'=>1));
        return $collection;
    }

    public function getHotelsCollection() {
        $collection = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Resorts')->findBy(array('isDeleted'=>0,'status'=>1));
        return $collection;
    }

    public function getEventsCollection() {
        $collection = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Events')->findBy(array('isDeleted'=>0,'approved'=>1,'status'=>1));
        return $collection;
    }

    public function getEventCategoriesCollection() {
        $collection = $this->getEntityManager()->getRepository('\Base\Entity\Avp\EventCategories')->findAll();
        return $collection;
    }

    public function getEventCategoryName($id) {
        $eventCategory = $this->getEntityManager()->getRepository('\Base\Entity\Avp\EventCategories')->findOneBy(array('id' => $id));
        if ($eventCategory)
            return $eventCategory->getName();
    }

    public function getResortRoomsCollection() {
        $collection = $this->getBaseEntityManager()->getRepository('\Base\Entity\InventoryHotels')->findAll();
        return $collection;
    }

    public function getEventRoomsCollection() {
        $collection = $this->getBaseEntityManager()->getRepository('\Base\Entity\InventoryEvent')->findAll();
        return $collection;
    }

    public function getCruiseCabinsCollection() {
        $collection = $this->getBaseEntityManager()->getRepository('\Base\Entity\InventoryCruise')->findAll();
        return $collection;
    }

    public function getEventById($where) {
        $item = $this->getBaseEntityManager()->getRepository('\Base\Entity\Avp\Events')->findOneBy($where);
        return $item;
    }

    public function getCruiseById($where) {
        $item = $this->getBaseEntityManager()->getRepository('\Base\Entity\Avp\Cruises')->findOneBy($where);
        return $item;
    }

    public function getallCollection($type) {

        if ($type == 4) {
            $collection = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Resorts')->findBy(array('isDeleted'=>0,'status'=>1));
        } elseif ($type == 5) {
            $collection = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Events')->findBy(array('isDeleted'=>0,'status'=>1,'approved'=>1));
        } elseif ($type == 6) {
            $collection = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Cruises')->findBy(array('isDeleted'=>0,'status'=>1));
        }
        return $collection;
    }

    public function getallReservationCollection($id = null, $type = null) {
//          return $id;
        $em = $this->getEntityManager();
        if ($type == 1) {
            $qb1 = $em->createQueryBuilder();
            $qb1->select('er')->from('\Base\Entity\Avp\InventoryEvent', 'er')->where('er.id=' . $id);
            $query1 = $qb1->getQuery();
            $collection1 = $query1->getResult();
//            d($collection1);
            $roomId = $collection1['0']->getRoomId()->getId();
            $totalcount = $collection1['0']->getTotalAvailable();

            $qb = $em->createQueryBuilder();
            $qb->select('r, COUNT(r.roomRequired) as sumroom')->from('\Base\Entity\Avp\ReservationEventRoom', 'er')
                    ->innerJoin('\Base\Entity\Avp\Reservation', 'r', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.reservation= r.id')
                    ->where('er.eventRoom='.$roomId)
                    ->andWhere('r.isBooked = :status')
                    ->setParameter('status',1)
                    ->groupBy('r.dateFrom')
                    ->groupBy('r.dateTo');

            $query = $qb->getQuery();
            
            $collection = $query->getResult();
        } elseif($type == 2){
            $qb1 = $em->createQueryBuilder();
            $qb1->select('er')->from('\Base\Entity\Avp\InventoryCruise', 'er')->where('er.id=' . $id);
            $query1 = $qb1->getQuery();
            $collection1 = $query1->getResult();

            $roomId = $collection1['0']->getSuiteId()->getId();
//             d($roomId);
            $totalcount = $collection1['0']->getTotalAvailable();
            $qb = $em->createQueryBuilder();
//            $qb->select('er')->from('\Base\Entity\Avp\ReservationResortRoom', 'er')->where('er.room=' . $roomId);
            
             $qb->select('r, COUNT(r.roomRequired) as sumroom')->from('\Base\Entity\Avp\ReservationCruiseCabin', 'er')
                    ->innerJoin('\Base\Entity\Avp\Reservation', 'r', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.reservation= r.id')
                    ->where('er.cabin='.$roomId)
                    ->andWhere('r.isBooked = :status')
                    ->setParameter('status',1)
                    ->groupBy('r.dateFrom')
                    ->groupBy('r.dateTo');
             
            $query = $qb->getQuery();
            $collection = $query->getResult();
        
            
        }elseif($type==3){
            $qb1 = $em->createQueryBuilder();
            $qb1->select('er')->from('\Base\Entity\Avp\InventoryExcursion', 'er')->where('er.id=' . $id);
            $query1 = $qb1->getQuery();
            $collection1 = $query1->getResult();

            $totalcount = $collection1['0']->getNumberAvailable();
            $qb = $em->createQueryBuilder();
//            $qb->select('er')->from('\Base\Entity\Avp\ReservationResortRoom', 'er')->where('er.room=' . $roomId);
            
             $qb->select('r, COUNT(r.id) as sumroom')->from('\Base\Entity\Avp\ReservationExcursion', 'er')
                    ->innerJoin('\Base\Entity\Avp\Reservation', 'r', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.reservation= r.id')
                    ->where('er.excursion='.$id)
                    ->groupBy('r.dateFrom')
                    ->groupBy('r.dateTo');
             
            $query = $qb->getQuery();
            $collection = $query->getResult();
        }elseif($type==4){
            $qb1 = $em->createQueryBuilder();
            $qb1->select('er')->from('\Base\Entity\Avp\InventoryTransfer', 'er')->where('er.id=' . $id);
            $query1 = $qb1->getQuery();
            $collection1 = $query1->getResult();

            $totalcount = $collection1['0']->getNumberAvailable();
            $qb = $em->createQueryBuilder();
//            $qb->select('er')->from('\Base\Entity\Avp\ReservationResortRoom', 'er')->where('er.room=' . $roomId);
            
             $qb->select('r, COUNT(r.id) as sumroom')->from('\Base\Entity\Avp\ReservationTransfer', 'er')
                    ->innerJoin('\Base\Entity\Avp\Reservation', 'r', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.reservation= r.id')
                    ->where('er.transfer='.$id)
                    ->groupBy('r.dateFrom')
                    ->groupBy('r.dateTo');
             
            $query = $qb->getQuery();
            $collection = $query->getResult();
        }elseif($type==5){
             $qb1 = $em->createQueryBuilder();
            $qb1->select('er')->from('\Base\Entity\Avp\InventoryItem', 'er')->where('er.id=' . $id);
            $query1 = $qb1->getQuery();
            $collection1 = $query1->getResult();

            $totalcount = $collection1['0']->getNumberAvailable();
            $qb = $em->createQueryBuilder();
//            $qb->select('er')->from('\Base\Entity\Avp\ReservationResortRoom', 'er')->where('er.room=' . $roomId);
            
             $qb->select('r, COUNT(r.id) as sumroom')->from('\Base\Entity\Avp\ReservationItem', 'er')
                    ->innerJoin('\Base\Entity\Avp\Reservation', 'r', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.reservation= r.id')
                    ->where('er.item='.$id)
                    ->groupBy('r.dateFrom')
                    ->groupBy('r.dateTo');
             
            $query = $qb->getQuery();
            $collection = $query->getResult();
        }else {

            $qb1 = $em->createQueryBuilder();
            $qb1->select('er')->from('\Base\Entity\Avp\InventoryHotels', 'er')->where('er.id=' . $id);
            $query1 = $qb1->getQuery();
            $collection1 = $query1->getResult();

            $roomId = $collection1['0']->getRoomId()->getId();
//             d($roomId);
            $totalcount = $collection1['0']->getNumberAvailable();
            $qb = $em->createQueryBuilder();
//            $qb->select('er')->from('\Base\Entity\Avp\ReservationResortRoom', 'er')->where('er.room=' . $roomId);
            
             $qb->select('r, COUNT(r.roomRequired) as sumroom')->from('\Base\Entity\Avp\ReservationResortRoom', 'er')
                    ->innerJoin('\Base\Entity\Avp\Reservation', 'r', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.reservation= r.id')
                    ->where('er.room='.$roomId)
                    ->andWhere('r.isBooked = :status')
                    ->setParameter('status',1)
                    ->groupBy('r.dateFrom')
                    ->groupBy('r.dateTo');
             
            $query = $qb->getQuery();
            $collection = $query->getResult();
        }

        $array = array('collection' => $collection, 'inventory' => $totalcount);
        return $array;
    }

}