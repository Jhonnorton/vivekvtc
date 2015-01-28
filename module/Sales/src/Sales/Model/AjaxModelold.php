<?php
namespace Sales\Model;
use Sales\Model\Promos;

class AjaxModel extends \Base\Model\AvpModel{

    protected function getBaseRepository($targetEntity){
        return $this->getBaseEntityManager()->getRepository($targetEntity);
    }
    
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
    
    public function getEventCategoriesCollection(){    	        
        $collection = $this->getEntityManager()->getRepository('\Base\Entity\Avp\EventCategories')->findAll();     
        return  $collection;       
    }
    
    public function getEventCategoryName($id){        
        $eventCategory  = $this->getEntityManager()->getRepository('\Base\Entity\Avp\EventCategories')->findOneBy(array('id' => $id));        
        if($eventCategory) return $eventCategory->getName();        
    }
    
    public function getResortRoomsCollection(){    	        
        $collection = $this->getBaseEntityManager()->getRepository('\Base\Entity\InventoryHotels')->findAll();     
        return  $collection;       
    }
    
    public function getEventRoomsCollection(){    	        
        $collection = $this->getBaseEntityManager()->getRepository('\Base\Entity\InventoryEvent')->findAll();     
        return  $collection;       
    }
    
    public function getCruiseCabinsCollection(){    	        
        $collection = $this->getBaseEntityManager()->getRepository('\Base\Entity\InventoryCruise')->findAll();     
        return  $collection;       
    }  
    
}