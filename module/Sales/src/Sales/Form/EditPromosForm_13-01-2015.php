<?php

namespace Sales\Form;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\Form\Form;
use Sales\Model\Promos as PROMO;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class EditPromosForm extends Form implements ObjectManagerAwareInterface{	
    
    public function getEntity($typeCode){
        
        $entity = NULL;
        switch((int)$typeCode){            
            case self::LINKED_TO_ALL:
            case self::LINKED_TO_RESORTS:
            case self::LINKED_TO_EVENTS:
            case self::LINKED_TO_CRUISES:
                $entity = NULL;
                break;
            case self::LINKED_TO_CRUISE_NAME:                
                $entity = '\Base\Entity\Avp\Cruises'; 
                break;
            case self::LINKED_TO_RESORT_NAME:
                $entity = '\Base\Entity\Avp\Resorts';                
                break;
            case self::LINKED_TO_EVENT_CATEGORY:                
                $entity = '\Base\Entity\Avp\EventCategories';
                break;
            case self::LINKED_TO_EVENT_NAME:                                 
                $entity = '\Base\Entity\Avp\Events';
                break;
            case self::LINKED_TO_ROOM_CATEGORY:                
                $entity = '\Base\Entity\InventoryHotels';
                break;
            case self::LINKED_TO_EVENT_ROOM:                
                $entity = '\Base\Entity\InventoryEvent';
                break;
            case self::LINKED_TO_CABIN_NAME:                
                $entity = '\Base\Entity\InventoryCruise';
                break;                 
        }                
        return $entity;       
    } 
    
    public function __construct(ObjectManager $objectManager, ObjectManager $avpObjectManager, $targetEntity) {
            
        $this->setObjectManager($objectManager); //git
        $this->setAvpObjectManager($avpObjectManager);
        $this->setTargetEntity($targetEntity);

        // we want to ignore the name passed
        parent::__construct('inventory-promos');

        $this->setAttribute('method', 'post');

        $this->add(array(
                        'name' => 'id',
                        'attributes' => array(
                                        'id'=>'promoId',
                                        'type'  => 'hidden',                            
                        ),
        ));
        
        $this->add(array(
                        'name' => 'promoNames',
                        'attributes' => array(
                                        'type'  => 'text',
                                        'required' => 'required',
                        ),
                        'options' => array(
                                        'label' => 'Promo Name',
                        ),
        ));
        
        $this->add(array(
                        'type' => 'Zend\Form\Element\Select',
                        'name' => 'isActive',
                        'options' => array(
                                        'label' => 'Active',
                                        'value_options' => array(
                                               '1' => 'Activate',
                                               '0' => 'Deactivate',
                                        ),
                        ),
                        'attributes' => array(                                        
                                        'required' => 'required',                                        
                        ),
     	));
        
        $this->add(array(
                        'name'    => 'linkedTo',
                        'type'    => 'Zend\Form\Element\Select',
                        'options' => array(
                                        'label'         => 'Linked To',
                                        'value_options' => $this->getLinkedToValues(),                                        
                        ),
                        'attributes' => array(
                                        'id'      => 'linkedTo',
                                        'required' => 'required',                                        
                        ),   
        ));

        $this->add(array(
                        'name' => 'dateFrom',
                        'attributes' => array(
                                        'type'  => 'date',
                                        'placeholder' => 'Y-m-d',
                                        'required' => 'required',
                        ),
                        'options' => array(
                                        'label' => 'Date From',
                        ),
        ));

        $this->add(array(
                        'name' => 'dateTo',
                        'attributes' => array(
                                        'type'  => 'date',
                                        'placeholder' => 'Y-m-d',
                                        'required' => 'required',
                        ),
                        'options' => array(
                                        'label' => 'Date To',
                        ),
        ));
        
         $this->add(array(
                        'type' => 'Zend\Form\Element\Select',
                        'name' => 'discountType',
                        'options' => array(
                                        'label' => 'Discount Type',
                                        'value_options' => array(
                                               '1' => '%',
                                               '0' => '$',
                                        ),
                        ),
                        'attributes' => array(
                                        'required' => 'required',
                        ),
     	));
        
        $this->add(array(
                        'name' => 'discount',
                        'attributes' => array(
                                        'type'  => 'number',
                                        'min' => 0.00,
                                        'value' => 0.00,
                                        'required' => 'required',

                        ),
                        'options' => array(
                                        'label' => 'Discount',
                        ),
        ));
        
        $this->add(array(
                        'name' => 'image',
                        'attributes' => array(
                                        'type'  => 'file',
                                        'accept' => 'image/*',
                                        //'required' => 'required',
                        ),
                        'options' => array(
                                        'label' => 'Image',
                        ),
        ));

        $this->add(array(
                        'name' => 'description',
                        'attributes' => array(
                                        'type'  => 'textarea',                                                
                                        'rows' => 4,
                        ),
                        'options' => array(
                                        'label' => 'Description',
                        ),
        )); 
        
        $this->add(array(
                        'name' => 'promoCode',
                        'attributes' => array(
                                        'type'  => 'text',
                                        'required' => 'required',
                        ),
                        'options' => array(
                                        'label' => 'Promo Code',
                        ),
        ));
        
            $this->add(array(
            'name' => 'numberAvailable',
            'attributes' => array(
                'type' => 'number',
                'min' => 0,
                'value' => 0,
               // 'required' => 'required',
            ),
            'options' => array(
                'label' => 'Number Of Use',
            ),
        ));
        
           $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type' => 'text',
                'value' => $targetEntity->getName(),
                //'required' => 'required',
            ),
            'options' => array(
                'label' => 'Name',
            ),
        ));

        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'type' => 'email',
                 'value'=>$targetEntity->getEmail(),
                //'required' => 'required',
            ),
            'options' => array(
                'label' => 'Email',
            ),
        ));
        
        
        
        
        
        
        $this->add(array(
                        'name' => 'submit',
                        'attributes' => array(
                                        'type'  => 'submit',
                                        'value' => 'Submit',
                                        'id' => 'submitbutton',
                        ),
        ));
        
        $hydrator = new DoctrineHydrator($this->getObjectManager(), get_class($this->getTargetEntity()));
        $this->setHydrator($hydrator);
        $this->bind($this->getTargetEntity());        
    }
    
    public function initIds($targetEntity){
        
        //d($targetEntity);
        //d('here in initids');
        
        switch($targetEntity->getLinkedTo()){            
            case PROMO::LINKED_TO_ALL:
            case PROMO::LINKED_TO_RESORTS:
            case PROMO::LINKED_TO_EVENTS:
            case PROMO::LINKED_TO_CRUISES:
                $this->add(array(
                        'name' => 'ids',
                        'attributes' => array(
                                        'type'  => 'hidden',                                                                                        
                        ),                        
                ));
                break;
            case PROMO::LINKED_TO_CRUISE_NAME:                                
                $this->add(array(
                    'type'    => 'DoctrineModule\Form\Element\ObjectMultiCheckbox',
                    'name'    => 'ids',
                    'options' => array(
                                    'label'          => 'Cruises',
                                    'object_manager' => $this->getAvpObjectManager(),
                                    'target_class'   => '\Base\Entity\Avp\Cruises',
                                    'property'       => 'title',

                    ),
                    'attributes' => array(                                         
                                    'value' => $this->getCheckedObjects($targetEntity),  
                    ),
                ));
                break;
            case PROMO::LINKED_TO_RESORT_NAME:
                $entity = '\Base\Entity\Avp\Resorts';   
                $this->add(array(
                    'type'    => 'DoctrineModule\Form\Element\ObjectMultiCheckbox',
                    'name'    => 'ids',
                    'options' => array(
                                    'label'          => 'Resorts',
                                    'object_manager' => $this->getAvpObjectManager(),
                                    'target_class'   => '\Base\Entity\Avp\Resorts',
                                    'property'       => 'title',

                    ),
                    'attributes' => array(                                                                            
                                    'value' => $this->getCheckedObjects($targetEntity),  
                    ),
                ));
                break;
            case PROMO::LINKED_TO_EVENT_CATEGORY:                                   
                $this->add(array(
                    'type'    => 'DoctrineModule\Form\Element\ObjectMultiCheckbox',
                    'name'    => 'ids',
                    'options' => array(
                                    'label'          => 'Event Categories',
                                    'object_manager' => $this->getAvpObjectManager(),
                                    'target_class'   => '\Base\Entity\Avp\EventCategories',
                                    'property'       => 'name',

                    ),
                    'attributes' => array(                                        
                                    'value' => $this->getCheckedObjects($targetEntity),  
                    ),
                ));
                break;
            case PROMO::LINKED_TO_EVENT_NAME:                                                 
                $this->add(array(
                    'type'    => 'DoctrineModule\Form\Element\ObjectMultiCheckbox',
                    'name'    => 'ids',
                    'options' => array(
                                    'label'          => 'Events',
                                    'object_manager' => $this->getAvpObjectManager(),
                                    'target_class'   => '\Base\Entity\Avp\Events',
                                    'property'       => 'title',

                    ),
                    'attributes' => array(                                        
                                    'value' => $this->getCheckedObjects($targetEntity),  
                    ),
                ));
                break;
            case PROMO::LINKED_TO_ROOM_CATEGORY:                                
                $this->add(array(
                    'type'    => 'DoctrineModule\Form\Element\ObjectMultiCheckbox',
                    'name'    => 'ids',
                    'options' => array(
                                    'label'          => 'Resort Rooms',
                                    'object_manager' => $this->getObjectManager(),
                                    'target_class'   => '\Base\Entity\InventoryHotels',
                                    'property'       => 'roomCategory',

                    ),
                    'attributes' => array(                                        
                                    'value' => $this->getCheckedObjects($targetEntity),  
                    ),
                ));
                break;
            case PROMO::LINKED_TO_EVENT_ROOM:                                
                $this->add(array(
                    'type'    => 'DoctrineModule\Form\Element\ObjectMultiCheckbox',
                    'name'    => 'ids',
                    'options' => array(
                                    'label'          => 'Event Rooms',
                                    'object_manager' => $this->getObjectManager(),
                                    'target_class'   => '\Base\Entity\InventoryEvent',
                                    'property'       => 'roomCategory',

                    ),
                    'attributes' => array(                                        
                                    'value' => $this->getCheckedObjects($targetEntity),  
                    ),
                ));
                break;
            case PROMO::LINKED_TO_CABIN_NAME:                                
                $this->add(array(
                    'type'    => 'DoctrineModule\Form\Element\ObjectMultiCheckbox',
                    'name'    => 'ids',
                    'options' => array(
                                    'label'          => 'Event Rooms',
                                    'object_manager' => $this->getObjectManager(),
                                    'target_class'   => '\Base\Entity\InventoryCruise',
                                    'property'       => 'suiteName',

                    ),
                    'attributes' => array(                                        
                                    'value' => $this->getCheckedObjects($targetEntity),  
                    ),
                ));
                break;                 
        }
    }

    public function setObjectManager(ObjectManager $objectManager) {

        $this->objectManager = $objectManager;
        return $this;
    }

    public function getObjectManager() {

        return $this->objectManager;
    }
    
    public function setAvpObjectManager(ObjectManager $avpObjectManager){
        
        $this->avpObjectManager = $avpObjectManager;
        return $this;
        
    }
    
    public function getAvpObjectManager() {

        return $this->avpObjectManager;
    }

    protected function getTargetEntity() {

        return $this->targetEntity;
    }

    protected function setTargetEntity($targetEntity) {

        if (!is_object($targetEntity)) {

            $this->targetEntity = new $targetEntity();
        } else {

            $this->targetEntity = $targetEntity;
        }
    }
    
    protected function getLinkedToValues(){
        $lt = array();
		$linkedTo = PROMO::linkedTo();
        for($i = 0;$i < 11; $i++){
           $lt[$i] =  $linkedTo[$i]['name'];
        }
        return $lt;
    }    
    
    protected function getCheckedObjects($promo = null){	
        
      //  echo 'in get checked';
      
        $checked = array();
        if(is_null($promo)){
            return $checked;
        }       
	$linkedTo = PROMO::linkedTo(); 
      //d($linkedTo);
        
        
    //    d($promo->getLinkedTo());
        
        $model = $linkedTo[$promo->getLinkedTo()]['linkedTo']['model'];
        
        //d($model);
        
        if(!isset($model))            {
            return $checked;        
        }
        $collection = $model->getItemBy(array('promo' => $promo));                       
        switch($promo->getLinkedTo()){            
            case PROMO::LINKED_TO_ALL:
            case PROMO::LINKED_TO_RESORTS:
            case PROMO::LINKED_TO_EVENTS:
            case PROMO::LINKED_TO_CRUISES:
                $checked = array();
                break;
            case PROMO::LINKED_TO_CRUISE_NAME:                
                foreach ($collection as $item){
                    $checked[] = $item->getCruiseId();
                }
                break;
            case PROMO::LINKED_TO_RESORT_NAME:
                foreach ($collection as $item){
                    $checked[] = $item->getResortId();
                }               
                break;
            case PROMO::LINKED_TO_EVENT_CATEGORY:                
                foreach ($collection as $item){
                    $checked[] = $item->getEventCategoryId();
                }
                break;
            case PROMO::LINKED_TO_EVENT_NAME:                                 
                foreach ($collection as $item){
                    $checked[] = $item->getEventId();
                }
                break;
            case PROMO::LINKED_TO_ROOM_CATEGORY:                
                foreach ($collection as $item){
                    $checked[] = $item->getRoom()->getId();
                }
                break;
            case PROMO::LINKED_TO_EVENT_ROOM:                
                foreach ($collection as $item){
                    $checked[] = $item->getEventRoom()->getId();
                }
                break;
            case PROMO::LINKED_TO_CABIN_NAME:                
                foreach ($collection as $item){
                    $checked[] = $item->getCabin()->getId();
                }
                break;                 
        }                
        return $checked;   
    }
}
