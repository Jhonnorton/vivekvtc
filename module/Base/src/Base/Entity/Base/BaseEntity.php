<?php

namespace Base\Entity\Base;

use DoctrineORMModule\Form\Annotation\AnnotationBuilder;
use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;

class BaseEntity {
	
	protected static $serviceManager = null;
	
	public function setServiceManager($sm)
	{
		if ( self::$serviceManager == null )
			self::$serviceManager = $sm;
	}
	
	public function getServiceManager(){
		return self::$serviceManager;
	}
	
	public function getEntityManager() {
		return self::$serviceManager->get('Doctrine\ORM\EntityManager');
	}
	
	public function getForm()
	{
		$entityManager = $this->getEntityManager();
		$builder = new AnnotationBuilder( $entityManager );
		$form = $builder->createForm( $this );
		//
		$form->setHydrator(new DoctrineEntity( $entityManager, get_class($this) ) );
		$form->bind( $this );
				
    	return $form;
	}
	
	public function getCollection(){
            
	    return get_object_vars($this);
	    
	}
        
        public function toArray($object = null){
            
            if(!$object) $object  = $this;
            
            $collection = get_object_vars($object);
            
            foreach ($collection as $key => $item){
                
                if($item instanceof \DateTime) $collection[$key] = $item->format('Y-m-d');
                
            }
            
            return $collection;
            
        }
        
        public function toJson(){
            
            return json_encode($this->toArray());
            
        }


        public function setCollection($collection){
		
	    foreach($collection as $method => $value){
	    	
	        $this->__set(ucfirst($method), $value);
	        
	    }
	    
	    return $this;
	    
	}
	
	public function save(){
		
	    $collection = $this->getCollection();
	    
	    try{
	    	$this->bindObjectVars($collection);
	    } catch(\Exception $e){
	    	
	        echo 'Exeption: '.$e->getMessage().'<br/>\n';
	       // echo 'Trace: '.$e->getTraceAsString().'<br/>\n';
	        
	    }
	    
	    $em = $this->getEntityManager();
	    
	    $em->persist($this);
	    $em->flush();
	    
	    return $this;
	    
	}
	
	protected function bindObjectVars(array $collection, $ignored = false){
		
	    if(!$ignored || !is_array($ignored)){
	    	
	        $ignored = isset($this->ignored) ? $this->ignored : array();
	        
	    }
	    
	    if(count($ignored) > 0){
	    	
	        foreach ($collection as $property => $value){
	        	
	            if(!array_search($property, $ignored)){
	            	
	                if(is_null($value) || $value = '' ){
	                
	                    throw new \Exception("$property is requaired!");
	                    break;
	                }
	                
	            }
	            
	            $this->__set($property, $value);
	            
	        }
	        
	    }
	    
	    return $this;
	}
	
	public function __set($name,$value){
		
	    $setterMethod='set'.$name;
	
		if(method_exists($this,$setterMethod)){
			$this->$setterMethod($value);
		}elseif(property_exists($this,$name)){
			$backtrace=debug_backtrace();
			 
			trigger_error(
			sprintf('Cannot access protected property %s::$%s in <b>%s</b> on line <b>%s</b>',$this->getClass(),$name,$backtrace[0]['file'],$backtrace[0]['line'])
			,E_USER_ERROR);
		}else{
			$backtrace=debug_backtrace();
			 
			trigger_error(
			sprintf('<b>Notice</b>: Undefined property: <b>%s</b>::$<b>%s</b> in <b>%s</b> on line <b>%s</b>',$this->getClass(),$name,$backtrace[0]['file'],$backtrace[0]['line'])
			,E_USER_ERROR);
		}
	}
	
}