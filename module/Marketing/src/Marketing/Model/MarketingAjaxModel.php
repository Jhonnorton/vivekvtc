<?php
namespace Leads\Model;
use Inventory\Model\Promos;
use Inventory\Model\Items;
use Inventory\Model\Excursions;
use Inventory\Model\Transfers;

class MarketingAjaxModel extends \Base\Model\AvpModel{
    
       public function getCruisesCollection(){    	        
        $collection = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Cruises')->findAll();     
        return  $collection;       
    }
    
    public function getHotelsCollection(){    	        
        $collection = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Resorts')->findAll();     
        return  $collection;       
    }
            
    public function getEventsCollection(){    	        
        $collection = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Events')->findAll();     
        return  $collection;       
    }
    
//    public function getHotelRoomsCollection($where){
//        $collection = $this->getBaseEntityManager()->getRepository('\Base\Entity\Avp\ResortRooms')->findBy($where);                    
//        return $collection;       
//    }
    
    public function getEventRoomsCollection($where){
        $collection = $this->getBaseEntityManager()->getRepository('\Base\Entity\InventoryEvent')->findBy($where);     
        return $collection;       
    }
    
    public function getCruiseCabinsCollection($where){
        $collection = $this->getBaseEntityManager()->getRepository('\Base\Entity\InventoryCruise')->findBy($where, array('deckNumber' => 'ASC'));     
        return $collection;       
    }
        
    public function getHotelRoom($where){
        $item = $this->getBaseEntityManager()->getRepository('\Base\Entity\Avp\ResortRooms')->findOneBy($where);     
        return $item;       
    }
     
    public function getEventRoom($where){
        $item = $this->getBaseEntityManager()->getRepository('\Base\Entity\Avp\EventRooms')->findOneBy($where);     
        return $item;       
    }
    
    public function getEventRoomFromEventRoom($where){
        $item = $this->getBaseEntityManager()->getRepository('\Base\Entity\Avp\EventRooms')->findOneBy($where);     
        return $item;       
    }
    
    public function getCruiseCabin($where){
        $item = $this->getBaseEntityManager()->getRepository('\Base\Entity\Avp\CruiseCabins')->findOneBy($where);     
        return $item;       
    }
    
    public function getDiscountToResort($id){
        
		$linkedTo =Promos::linkedTo(); 
        $item = $linkedTo[Promos::LINKED_TO_ROOM_CATEGORY]['linkedTo']['model']->getItemBy(array('roomId'=>$id));        
    }
    
    public function getPromos($typeCode, $id = 0){
        $linkedTo =Promos::linkedTo(); 	
        return $linkedTo[Promos::LINKED_TO_ROOM_CATEGORY]['linkedTo']['model']->getItemBy(array('roomId'=>$id));        
    }
    
    public function getItems($typeCode, $id = 0){                        
        $collection = Items::getItemsLinkedTo($this->_serviceManager, (int)$typeCode, (int)$id);        
        return $collection;                
    }   
    
    public function getCountry($id = 0){                                           
        $country = $this->getBaseEntityManager()->find('Base\Entity\Countries', (int)$id);                
        if($country){
            return $country->getCountryName();        
        }
        return '';
    }
    
    public function getClientDetails($where){
        $item = $this->getBaseEntityManager()->getRepository('\Base\Entity\Avp\Clients')->findOneBy($where);     
        return $item;       
    }
    
    public function getExcursions($typeCode, $id = 0){                        
        $collection = Excursions::getExcursionsLinkedTo($this->_serviceManager, (int)$typeCode, (int)$id);        
        return $collection;                
    }
    
    public function getTransfers($typeCode, $id = 0){                        
        $collection = Transfers::getTransfersLinkedTo($this->_serviceManager, (int)$typeCode, (int)$id);        
        return $collection;                
    }
    
    public function getEventById($where){
        $item = $this->getBaseEntityManager()->getRepository('\Base\Entity\Avp\Events')->findOneBy($where);     
        return $item;       
    }
    
    public function getCruiseById($where){
        $item = $this->getBaseEntityManager()->getRepository('\Base\Entity\Avp\Cruises')->findOneBy($where);     
        return $item;       
    }
    
     public function getHotelRoomsCustomCollection($where){
        $em = $this->getBaseEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('ih')
            ->from('\Base\Entity\InventoryHotels', 'ih')
            ->where('ih.resortId = :resortId')
            ->setParameter('resortId',$where['resortId'])
            ->andWhere('ih.dateTo >= :dateTo')
            ->setParameter('dateTo',new \DateTime);
        $query = $qb->getQuery();
        $collection = $query->getResult();
        return $collection;
    }
    
    public function getCruiseCabinsCustomCollection($where){
        $em = $this->getBaseEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('ic')
            ->from('\Base\Entity\InventoryCruise', 'ic')
            ->where('ic.cruiseId = :cruiseId')
            ->setParameter('cruiseId',$where['cruiseId'])
            ->andWhere('ic.dateTo >= :dateTo')
            ->setParameter('dateTo',new \DateTime);
        $query = $qb->getQuery();
        $collection = $query->getResult();
        return $collection;
    }
    
     public function getEventRoomsCustomCollection($where){
        $em = $this->getBaseEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('ie')
            ->from('\Base\Entity\InventoryEvent', 'ie')
            ->where('ie.eventId = :eventId')
            ->setParameter('eventId',$where['eventId'])
            ->andWhere('ie.dateFrom >= :dateFrom')
            ->setParameter('dateFrom',new \DateTime);
        $query = $qb->getQuery();
        $collection = $query->getResult();
        return $collection;
    }
    
    public function getEventRoomDetailByInventory($id){

        $query = $this->getBaseEntityManager()->createQuery('SELECT ie FROM Base\Entity\InventoryEvent ie WHERE ie.roomId = '.(int)$id);
        $item = $query->getResult();
        return $item;       
    }
    
    public function getResortRoomDetailByInventory($id,$dateFrom,$dateTo){
       $em = $this->getBaseEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('ih')
            ->from('\Base\Entity\InventoryHotels', 'ih')
            ->where('ih.roomId = :roomId')
            ->setParameter('roomId',$id)
            ->andWhere('ih.dateTo BETWEEN :startDate AND :endDate')
            ->setParameter('startDate',$dateFrom)
            ->setParameter('endDate',$dateTo);

        $query = $qb->getQuery();
       // echo $query->getSql();die;
        $collection = $query->getResult();
        return $collection;
        
       // $query = $this->getBaseEntityManager()->createQuery('SELECT ie FROM Base\Entity\InventoryHotels ie WHERE ie.roomId = '.(int)$id . 'AND ie.dateFrom >='.$dateFrom . 'AND ie.dateTo <= '.$dateTo );
        //$item = $query->getResult();
        //return $item;       
    }
    
     public function getHotelRoomsCollection($where){
        $em = $this->getBaseEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('ih')
            ->from('\Base\Entity\InventoryHotels', 'ih')   
            ->where('ih.resortId = :resortId')
            ->setParameter('resortId',$where['resortId'])
            ->andWhere('ih.dateFrom <= :dateFrom')
            ->setParameter('dateFrom',$where['dateFrom'])
            ->andWhere('ih.dateTo >= :dateTo')
            ->setParameter('dateTo',$where['dateTo']);

        $query = $qb->getQuery();
        $collection = $query->getResult();
        return $collection;
    }
    
    
    public function getFilteredEventsCollection(){    	        
       $em = $this->getBaseEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('e')
            ->from('\Base\Entity\Avp\Events', 'e')   
            ->andWhere('e.startDate >= :startDate')
            ->setParameter('startDate',new \DateTime);

        $query = $qb->getQuery();
        $collection = $query->getResult();
        return $collection;
    }
    
    public function getAllClients($pattern){    	        
       $em = $this->getBaseEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('c.customerId')
            ->from('\Base\Entity\Avp\Clients', 'c')
            ->where('c.customerId LIKE :word')
            ->setParameter('word', '%'.$pattern.'%');  


        $query = $qb->getQuery();
        $collection = $query->getScalarResult();
       
        $final_array = array();
        foreach ($collection as $val) {
            foreach ($val as $val2) {
                $final_array[] = $val2;
            }
        }

        return $final_array;
    }

}
