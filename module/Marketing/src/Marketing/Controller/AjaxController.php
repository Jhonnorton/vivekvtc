<?php

namespace Marketing\Controller;

use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Inventory\Model\Promos;
use Zend\View\Model\JsonModel;
use Inventory\Model\Items;
use Sendmail\Controller\SendmailController;

class AjaxController extends AbstractActionController {

    protected $_entity = false; 
    public $model;
    
    const RESORT_ROOMS = 1;
    const EVENT_ROOMS = 2;
    const CRUISE_CABINS = 3;
    
    public function onDispatch(MvcEvent $e){
        
        Promos::initServiceManager($this->getServiceLocator());
        
        $e->getViewModel()->setVariable('modulename', 'Marketing');                
        $this->layout('layout/ajax');
        return parent::onDispatch($e);			
    }

   
    protected function getModel($model) {
        return $this->getServiceLocator()->get($model);
    }
    
    protected function getConfig($type, $id){
        $data = null;
        
        $this->model = $this->getModel('MarketingAjaxModel');
        
        switch ((int)$type){
            
            case self::RESORT_ROOMS:
                    $data = $this->model->getHotelRoom(array('id'=>(int)$id));
                    break;
            case self::EVENT_ROOMS:
                    $data = $this->model->getEventRoom(array('id'=>(int)$id)); 
                    break;
            case self::CRUISE_CABINS:
                    $data = $this->model->getCruiseCabin(array('id'=>(int)$id));
                    break; 
        }        
        return $data;
        
    }

    protected function getItems($type, $id){     
        $typeCode = 0;
        switch ((int)$type){            
            case self::RESORT_ROOMS:
                $typeCode = Items::LINKED_TO_RESORT_NAME;
                break;
            case self::EVENT_ROOMS:
                $typeCode = Items::LINKED_TO_EVENT_NAME;
                break;
            case self::CRUISE_CABINS:
                $typeCode = Items::LINKED_TO_CRUISE_NAME;
        }    
        if($typeCode){                            
            return $this->model->getItems($typeCode, $id);  
        }
        return null;
        
    }
    
    public function playVideoAction(){
        $this->model = $this->getModel('Documents');
            $video = $this->model->getVideoDetails($this->params()->fromRoute('vid', 0));                        
            $data = array(
                'video' => $video,                                 
                
            );
            
            return new ViewModel($data);    
    }
 
}