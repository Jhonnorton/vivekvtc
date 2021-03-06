<?php
namespace Leads\Model;
use Inventory\Model\Promos;
use Inventory\Model\Items;
use Inventory\Model\Excursions;
use Inventory\Model\Transfers;

class AjaxModel extends \Base\Model\AvpModel{

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
    
    public function getHotelRoomsCollection($where){
        $collection = $this->getBaseEntityManager()->getRepository('\Base\Entity\InventoryHotels')->findBy($where);                    
        return $collection;       
    }
    
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

}