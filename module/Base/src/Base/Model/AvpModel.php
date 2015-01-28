<?php

namespace Base\Model;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;

class AvpModel extends BaseModel{
	
    protected $_targetEntity;
    
    protected $_serviceManager;
    
    protected $_repository;
    
    protected $_entityManager;
    
    
    protected function getEntityManager() {
        
    	return $this->_serviceManager->get('doctrine.entitymanager.orm_avp');
    	
    }    
    
    protected function getBaseEntityManager() {
        
    	return parent::getEntityManager();    	
    }
    
    public function getItem($id){
        $item = $this->_entityManager
                    ->find($this->_targetEntity, (int)$id)
                    ;
        if(!is_null($item)) //d($this->_serviceManager);
            $item->setServiceManager($this->_serviceManager);
        
        return $item;
    }
}
