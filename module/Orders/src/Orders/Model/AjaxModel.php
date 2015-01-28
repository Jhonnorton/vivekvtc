<?php
namespace Orders\Model;
use Inventory\Model\Promos;
use Inventory\Model\Items;
use Inventory\Model\Excursions;
use Inventory\Model\Transfers;

class AjaxModel extends \Base\Model\AvpModel{

    public function getCruisesCollection(){    	        
        $collection = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Cruises')->findBy(array('isDeleted'=>0,'status'=>1));     
        return  $collection;       
    }
    
    public function getHotelsCollection(){    	        
        $collection = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Resorts')->findBy(array('isDeleted'=>0,'status'=>1));     
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
        $item = $this->getBaseEntityManager()->getRepository('\Base\Entity\InventoryHotels')->findOneBy($where);     
        return $item;       
    }
     
    public function getEventRoom($where){
        $item = $this->getBaseEntityManager()->getRepository('\Base\Entity\InventoryEvent')->findOneBy($where);     
        return $item;       
    }
    
    public function getEventRoomFromEventRoom($where){
        $item = $this->getBaseEntityManager()->getRepository('\Base\Entity\Avp\EventRooms')->findOneBy($where);     
        return $item;       
    }
    
    public function getCruiseCabin($where){
        $item = $this->getBaseEntityManager()->getRepository('\Base\Entity\InventoryCruise')->findOneBy($where);     
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
            ->setParameter('startDate',new \DateTime)
            ->andWhere('e.isDeleted =:deleted')
            ->setParameter('deleted',0)
            ->andWhere('e.status =:status')
            ->setParameter('status',1)
            ->andWhere('e.approved =:approved')
            ->setParameter('approved',1);

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
    
     //ajax
    public function getRoomsByEventIdCollection($id){
        
        $em = $this->_serviceManager->get('doctrine.entitymanager.orm_avp');
        $qb = $em->createQueryBuilder();  
        $qb->select('er')->from('\Base\Entity\Avp\EventRooms', 'er')
            ->where('er.eventId = :id')
            ->setParameter('id', (int)$id)
            ->andWhere('er.isDeleted = :deleted')
            ->setParameter('deleted', 0);    
        $query = $qb->getQuery();
        $results = $query->getResult();  
        return $results;
    }
    
     //ajax
    public function getRoomsByResortIdCollection($id){
        
        $em = $this->_serviceManager->get('doctrine.entitymanager.orm_avp');
        $qb = $em->createQueryBuilder();  
        $qb->select(array(
            'rr.id AS id',                        
            'rr.title AS roomCategory'
            ))->from('\Base\Entity\Avp\ResortRooms', 'rr')
            ->where('rr.resortId = :id')
            ->setParameter('id', (int)$id)
            ->andWhere('rr.isDeleted = :deleted')
            ->setParameter('deleted', 0); ;    
        $query = $qb->getQuery();
        $results = $query->getResult();     
        return $results;
    }
    
     //ajax
    public function getCabinsByCruiseIdCollection($id){
        
        $em = $this->_serviceManager->get('doctrine.entitymanager.orm_avp');
        $qb = $em->createQueryBuilder();  
        $qb->select(array(
            'c.id AS id',                        
            'c.deckName AS suiteName'
            ))->from('\Base\Entity\Avp\CruiseCabins', 'c')
            ->where('c.cruiseId = :id')
            ->setParameter('id', (int)$id)
            ->andWhere('c.isDeleted = :deleted')
            ->setParameter('deleted', 0); ;    
        $query = $qb->getQuery();
        $results = $query->getResult();     
        return $results;
    }

    public function checkOccupancy($post,$count){
       $where='(ih.dateFrom <='.$post['start'].' OR ih.dateTo >=' .$post['start'].') AND (ih.dateFrom <=' .$post['end'].' OR ih.dateTo >='.$post['end'].')';
       switch($post['type']){
           case 1:
               $em = $this->getEntityManager();
                $qb = $em->createQueryBuilder();
                $qb->select('ih')
                    ->from('\Base\Entity\InventoryHotels', 'ih')
                    ->where('ih.resortId = '.$post['typeId'])
                    ->andWhere('ih.roomId = '.$post['roomId'])
                    ->andWhere($where);
                $query = $qb->getQuery();
                $collection = $query->getResult();
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
               $em = $this->getEntityManager();
                $qb = $em->createQueryBuilder();
                $qb->select('ih')
                    ->from('\Base\Entity\InventoryCruise', 'ih')
                    ->where('ih.cruiseId = '.$post['typeId'])
                    ->andWhere('ih.suiteId = '.$post['roomId'])
                    ->andWhere($where);
                $query = $qb->getQuery();
                $collection = $query->getResult();
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
