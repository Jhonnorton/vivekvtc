<?php
 
namespace Sendmail\Model\Plugin;

class SendMailModel extends \Base\Model\BaseModel{
    
    const ENTITY = '\Base\Entity\EmailDetails';
	
    public function __construct($serviceManager, $targetEntity = false) {
                
        parent::__construct($serviceManager, $targetEntity? 
                $targetEntity : SendMailModel::ENTITY);
    }
    
    public function getSendmailItem(array $where){        
        
        $item = $this->getItemBy($where, true); 
        if(!isset($item)) {
            return null;
        }
        return self::entityToArray($item);                        
    } 
    
    //only public properties
    public static function objectToArray($data){
        
        $array = array();
        if (is_array($data) || is_object($data)){
            foreach ($data as $key => $value) {
                $array[$key] = $value;
            }
        }
        return $array;
    }
    
    public static function entityToArray($entity) {
        
        $reflectionClass = new \ReflectionClass(get_class($entity));        
        $parentClass = $reflectionClass->getParentClass();
        $parentProperties = array();
        if($parentClass){
            foreach ($parentClass->getProperties() as $property) {            
               $parentProperties[] = $property->getName();
            }
        }                     
        $array = array();               
        foreach ($reflectionClass->getProperties() as $property) {            
            if(!in_array($property->getName(), $parentProperties)){
                $property->setAccessible(true);
                $array[$property->getName()] = $property->getValue($entity);
                $property->setAccessible(false);            
            }            
        }      
        return $array;
    }
} 