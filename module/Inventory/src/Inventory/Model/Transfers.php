<?php
namespace Inventory\Model;

use Zend\InputFilter\Factory as InputFactory;     // <-- Add this import
use Zend\InputFilter\InputFilter;                 // <-- Add this import
use Zend\InputFilter\InputFilterAwareInterface;   // <-- Add this import
use Zend\InputFilter\InputFilterInterface;        // <-- Add this import
use Zend\ServiceManager\ServiceLocatorInterface;

class Transfers extends \Base\Model\BaseModel implements InputFilterAwareInterface{
	
    protected $inputFilter;
    
//    const LINKED_TO_RESORTS = 1;
//    const LINKED_TO_EVENTS = 2;
//    const LINKED_TO_CRUISES = 3;
    
    const LINKED_TO_All = 0;
    const LINKED_TO_RESORTS = 1;
    const LINKED_TO_EVENTS = 2;
    const LINKED_TO_CRUISES = 3;
    const LINKED_TO_RESORT_NAME = 4;
    const LINKED_TO_EVENT_CATEGORY = 5;
    const LINKED_TO_EVENT_NAME = 6;
    const LINKED_TO_CRUISE_NAME = 7;

    protected $_imageOptions = array(
        //img 80x80
        array(
            'options' => array('width' => 200, 'height' => 200),
            'destination' => 'transfers/'
        ),
    );
     public function getImagePath() {
        return \Base\Model\Plugins\Imagine::$imagesBaseUrl . 'event/thumbnails_80x80/';
    }
    
    protected function saveImages($tmpName, $imgName) {
        foreach ($this->_imageOptions as $imgOption) {
            \Base\Model\Plugins\Imagine::uploadImage($tmpName, $imgName, $imgOption['options'], $imgOption['destination']);
        }
    }
    
    public function setInputFilter(InputFilterInterface $inputFilter){
        
        throw new \Exception("Not used");
    }

    public function getInputFilter(){
        
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                        'name'     => 'resortId',
                        'required' => false,
                        'filters'  => array(
                                array('name' => 'Int'),
                        ),

            )));
            
            $inputFilter->add($factory->createInput(array(
                        'name'     => 'eventId',
                        'required' => false,
                        'filters'  => array(
                                array('name' => 'Int'),
                        ),

            ))); 
            
            $inputFilter->add($factory->createInput(array(
                        'name'     => 'email',
                        'required' => false,
                        'validators' => array(
                             new \Zend\Validator\EmailAddress(),
                        ),
                        'filters'  => array(
                                array('name' => 'StringTrim'),
                        ),

            )));
            
            
            $inputFilter->add($factory->createInput(array(
                        'name'     => 'cruiseId',
                        'required' => false,
                        'filters'  => array(
                                array('name' => 'Int'),
                        ),

            ))); 
            
            $inputFilter->add($factory->createInput(array(
                        'name'     => 'hotelName',
                        'required' => false,
                        'filters'  => array(
                                            array('name' => 'StripTags'),
                                            array('name' => 'StringTrim'),
                         ),
                       

            )));

            
//            $inputFilter->add($factory->createInput(array(
//                            'name'     => 'dateFrom',
//                            'required' => true,
//                            'filters'  => array(
//                                            array('name' => 'StripTags'),
//                                            array('name' => 'StringTrim'),
//                            ),
//                            'validators' => array(
//                                                array(
//                                                    'name'    => 'Date',
//                                                    'options' => array(
//                                                                    'format' => 'Y-m-d',
//                                                    ),
//                                                ),
//                            ),
//            )));
//            
//            $inputFilter->add($factory->createInput(array(
//                            'name'     => 'dateTo',
//                            'required' => true,
//                            'filters'  => array(
//                                            array('name' => 'StripTags'),
//                                            array('name' => 'StringTrim'),
//                            ),
//                            'validators' => array(
//                                                array(
//                                                    'name'    => 'Date',
//                                                    'options' => array(
//                                                                    'format' => 'Y-m-d',
//                                                    ),
//                                                ),
//                            ),
//            )));

            $inputFilter->add($factory->createInput(array(
                            'name'     => 'netPrice',
                            'required' => true,
                            'filters'  => array(
                                    array('name' => 'Int'),
                            ),
                            'validators' => array(
                                    array(
                                            'name' => 'Float',
                                            'options' => array(
                                                                'min' => 0,
                                            ),
                                    ),
                            ),
            )));
            
            $inputFilter->add($factory->createInput(array(
                            'name'     => 'grossPrice',
                            'required' => true,
                            'filters'  => array(
                                    array('name' => 'Int'),
                            ),
                            'validators' => array(
                                    array(
                                            'name' => 'Float',
                                            'options' => array(
                                                                'min' => 0,
                                            ),
                                    ),
                            ),
            )));
            
            

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

    public function save($object,$files=null,$date=null) {
        if($object->getLinkedTo() == self::LINKED_TO_RESORT_NAME){
            $object->setEventId(NULL);
            $object->setCruiseId(NULL);
        }
        
        if($object->getLinkedTo() == self::LINKED_TO_EVENT_NAME){
            $object->setResortId(NULL);
             $object->setCruiseId(NULL);
        }
        
        if($object->getLinkedTo() == self::LINKED_TO_CRUISE_NAME){
            $object->setEventId(NULL);
            $object->setResortId(NULL);
        }
        parent::save($object);
        if(!empty($files['image']['tmp_name'])){
            $this->saveImages($files['image']['tmp_name'], $date."-". $files['image']['name']);
        }
    }
    
    protected function isValidName($form){
        if($this->checkItem(array('transferName'=>$form->getData()->getTransferName()))){
            $form->get('transferName')->setMessages(array('This transfer already exists'));
            return false;
        }
        return true;
                
    }
    
    public function isValidModel($form){
        
        return $this->isValidName($form);	            
    }
    
    public function isValidModelOnEdit($form){
        if($this->checkItem(array(
            'id'=>$form->getData()->getId(),
            'transferName'=>$form->getData()->getTransferName()))
	){
            return true;
        }
        return $this->isValidName($form);	            
    }
    
    public function getCollection($page = false){
        
        $resort = $this->_serviceManager->get('Resorts');
        $event  = $this->_serviceManager->get('Events');
        $cruise = $this->_serviceManager->get('Cruises');
        $ajax   = $this->_serviceManager->get('AjaxModel');
                       
        $collection = parent::getCollection($page);
        
        foreach($collection as $item){
            
            switch ($item->getLinkedTo()){
                
                case self::LINKED_TO_All:
                        $item->setLinkedTo('All');
                        break;
                case self::LINKED_TO_RESORTS:
                        $item->setLinkedTo('All Resorts');
                        break;
                case self::LINKED_TO_EVENTS:
                        $item->setLinkedTo('All Events');
                        break;
                case self::LINKED_TO_CRUISES:
                        $item->setLinkedTo('All Cruises');
                        break;
                case self::LINKED_TO_RESORT_NAME:
                        $obj = $resort->getItem($item->getResortId());
                        if($obj){
                            $item->setLinkedTo($obj->getTitle());
                        }else{
                            $item->setLinkedTo('Resort Name');
                        }                        
                        break;
                case self::LINKED_TO_EVENT_CATEGORY:                        
                        $obj = $ajax->getEventCategoryName($item->getEventCategoryId());
                        if($obj){
                            $item->setLinkedTo($obj);
                        }else{
                            $item->setLinkedTo('Event Category');
                        }
                        break;
                case self::LINKED_TO_EVENT_NAME:
                        $obj = $event->getItem($item->getEventId());
                        if($obj){
                            $item->setLinkedTo($obj->getTitle());
                        }else{
                            $item->setLinkedTo('Event Name');
                        }                    
                        break;
                case self::LINKED_TO_CRUISE_NAME:
                        $obj = $cruise->getItem($item->getCruiseId());
                        if($obj){
                            $item->setLinkedTo($obj->getTitle());
                        }else{
                            $item->setLinkedTo('Cruise Name');
                        }                        
                        break;
                default :
                    break;                                         
            }            
        }        
        return $collection;        
    }
    
    public static function getTransfersLinkedTo(ServiceLocatorInterface $serviceManager, $typeCode = 0, $id = 0){
        $items = array();
        $collection = array();       
        $model = $serviceManager->get('Transfers');
        if(!isset($model)) {
            return $items;
        }
        switch((int)$typeCode ){            
            case self::LINKED_TO_RESORT_NAME:                                
                $collection = $model->getItemBy(array('linkedTo'=>self::LINKED_TO_RESORT_NAME, 'resortId'=>$id));
            case self::LINKED_TO_RESORTS:
                $collection = array_merge($collection, $model->getItemBy(array('linkedTo'=>self::LINKED_TO_RESORTS)));
                break;   
            case self::LINKED_TO_EVENT_NAME:                
                $collection = $model->getItemBy(array('linkedTo'=>self::LINKED_TO_EVENT_NAME, 'eventId'=>$id));
            case self::LINKED_TO_EVENTS:
                $collection = array_merge($collection, $model->getItemBy(array('linkedTo'=>self::LINKED_TO_EVENTS)));
                break;
            case self::LINKED_TO_CRUISE_NAME:
                $collection = $model->getItemBy(array('linkedTo'=>self::LINKED_TO_CRUISE_NAME, 'cruiseId'=>$id));                
            case self::LINKED_TO_CRUISES:
                $collection = array_merge($collection, $model->getItemBy(array('linkedTo'=>self::LINKED_TO_CRUISES)));
                break;            
        }
        return array_merge($items, $collection, $model->getItemBy(array('linkedTo'=>self::LINKED_TO_All)));        
    }
    
    public function getReservationTransfers($id) {
        
        $em = $this->getEntityManager();

        $reservation = $em->getRepository('\Base\Entity\ReservationTransfer')->findBy(array('transfer' => $id));
        return $reservation;
    }
}