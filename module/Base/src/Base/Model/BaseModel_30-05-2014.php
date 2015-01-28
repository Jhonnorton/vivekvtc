<?php

namespace Base\Model;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;

class BaseModel{
	
    protected $_targetEntity;
    
    protected $_serviceManager;
    
    protected $_repository;
    
    protected $_entityManager;
    
    
    
    public function __construct($serviceManager, $targetEntity = false) {
    	
    	
    	
        $this->_serviceManager = $serviceManager;
        
        //d($this->_serviceManager->get('doctrine.entitymanager.orm_avp')->getConfiguration());
        
        $this->_entityManager = $this->getEntityManager();
    	
        
    	if($targetEntity) 
    	    $this->_targetEntity = $targetEntity;
    	
     	if($this->_targetEntity && !$this->_repository) 
     	    $this->_repository = $this->getEntityManager()
     	                              ->getRepository($this->_targetEntity)
     	;
    	
    	//d($this->getEntityManager()->getConfiguration());
    }
    
    
    protected function getEntityManager() {
        
    	return $this->_serviceManager->get('Doctrine\ORM\EntityManager');
    	
    }
    
     protected function getAvpEntityManager() {
        
    	return $this->_serviceManager->get('doctrine.entitymanager.orm_avp');
    	
    }
    
    public function getEmptyInstance(){
    	
        $entity =  new $this->_targetEntity;
        
        $entity->setServiceManager($this->_serviceManager);
        
        return $entity;
        
        
    }
    
    public function getCollection($page = false){
    	
        //d($this->_repository->findAll());
        
        if(!$page) return $this->_repository->findAll();
        
        $adapter = new DoctrineAdapter(new ORMPaginator($this->_repository->createQueryBuilder('page')));
        return new Paginator($adapter);
        
    }
    
    public function getItem($id){
    	
        $item = $this->_entityManager
                    ->find($this->_targetEntity, (int)$id)
                    ;
        if(!is_null($item)) //d($this->_serviceManager);
            $item->setServiceManager($this->_serviceManager);
        
        return $item;
    }
    
    public function getItemBy(array $where, $single = false){
    	
        if(!$single){ 
            $item = $this->_repository->findBy($where);
        } else{
            $item = $this->_repository->findOneBy($where);
        }
        /*
        if(!is_null($item)){
            is_array ($item)? $item[0]->setServiceManager($this->_serviceManager) : 
                $item->setServiceManager($this->_serviceManager);
        }
         
         */
        return $item;
        
    }
    
    public function save($object){
    	
        $em = $this->_entityManager;
        
        $em->persist($object);
        
       
        
        $em->flush();
        
        return $object;
        
    }
    
    public function delete($id){
    	
        $em = $this->_entityManager;
        
        if(!is_array($id)){
        	
            $entity = $em->getReference($this->_targetEntity, (int)$id);
            
            $em->remove($entity);
            
        } else {
        	
            foreach ($id as $item){
            	
                $entity = $em->getReference($this->_targetEntity, $item);
                
                $em->remove($entity);
            }
            
        }
        
        $em->flush();
        
        return true;
        
    }
    
    public function checkItem(array $where){
    	
    	if(!is_null($this->getItemBy($where, true)))
    		return true;
    	
    	return false;
    	
    }
    
}
