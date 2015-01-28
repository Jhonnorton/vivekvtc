<?php
namespace Leads\Model;
use Inventory\Model\Promos;
use Inventory\Model\Items;
use Inventory\Model\Excursions;
use Inventory\Model\Transfers;

class LeadsAjaxModel extends \Base\Model\AvpModel{
    
       public function getCruisesCollection(){    	        
        $collection = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Cruises')->findBy(array('isDeleted'=>0,'status'=>1));      
        return  $collection;       
    }
    
    public function getHotelsCollection(){    	        
        $collection = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Resorts')->findBy(array('isDeleted'=>0,'status'=>1));     
        return  $collection;       
    }
            
    public function getEventsCollection(){    	        
        $collection = $this->getEntityManager()->getRepository('\Base\Entity\Avp\Events')->findBy(array('isDeleted'=>0,'approved'=>1,'status'=>1));     
        return  $collection;       
    }
    

    public function getHotelRoom($where){
        $item = $this->getBaseEntityManager()->getRepository('\Base\Entity\Avp\ResortRooms')->findBy($where);     
        return $item;       
    }
     
    public function getEventRoom($where){
        $item = $this->getBaseEntityManager()->getRepository('\Base\Entity\Avp\EventRooms')->findBy($where);     
        return $item;       
    }
    
    
    public function getCruiseCabin($where){
        $item = $this->getBaseEntityManager()->getRepository('\Base\Entity\Avp\CruiseCabins')->findBy($where);     
        return $item;       
    }
    
    
     public function getHotelinRoom($where){
        $item = $this->getBaseEntityManager()->getRepository('\Base\Entity\InventoryHotels')->findOneBy($where);     
        return $item;       
    }
     
    public function getEventinRoom($where){
        $item = $this->getBaseEntityManager()->getRepository('\Base\Entity\InventoryEvent')->findOneBy($where);     
        return $item;       
    }
    
    
    public function getCruiseinCabin($where){
        $item = $this->getBaseEntityManager()->getRepository('\Base\Entity\InventoryCruise')->findOneBy($where);     
        return $item;       
    }
    
     public function itemsAction() {                         
        $data = $this->request->getPost();
        $typeCode = isset($data['typeCode'])?(int)$data['typeCode'] : 0;        
        $id = isset($data['id'])?(int)$data['id'] : 0;                   
        $this->model = $this->getModel('OrdersAjaxModel');        
        $collection = $this->model->getItems($typeCode, $id);        
        $data = array(
            'collection' => $collection,             
        );         
        return new ViewModel($data);        
    }
    
    public function getExcursions($typeCode, $id = 0){                        
        $collection = Excursions::getExcursionsLinkedTo($this->_serviceManager, (int)$typeCode, (int)$id);        
        return $collection;                
    }
    
    public function getTransfers($typeCode, $id = 0){                        
        $collection = Transfers::getTransfersLinkedTo($this->_serviceManager, (int)$typeCode, (int)$id);        
        return $collection;                
    }
   

}
