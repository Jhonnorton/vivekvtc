<?php

namespace SalesObjects\Model;

class ResortPromo extends \Base\Model\BaseModel {

    protected $resortModel = NULL;
    
    public function __construct($serviceManager, $targetEntity = false) {
        parent::__construct($serviceManager, $targetEntity);
        $this->resortModel = $this->_serviceManager->get('Resorts');
    }
    
    public function getResortModel(){
        
        return $this->resortModel;
        
    }
    
    public function getResortName($resortId){
        
        if(!$this->resortModel)
            throw new \Exception('Resort Model isn\'t loaded');
        
        $resort = $this->resortModel->getItem((int) $resortId);
        
        if($resort) return $resort->getTitle();
        
        return NULL;
    }
    
    
}

