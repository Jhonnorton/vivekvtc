<?php

namespace Sales\Form;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\Form\Form;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class PromosAjaxForm extends Form implements ObjectManagerAwareInterface{
	
    public function __construct(ObjectManager $objectManager, ObjectManager $avpObjectManager, $targetEntity) {
            
        $this->setObjectManager($objectManager); //git
        $this->setAvpObjectManager($avpObjectManager);
        $this->setTargetEntity($targetEntity);

        // we want to ignore the name passed
        parent::__construct('promo-ajax');

        $this->setAttribute('method', 'post');

       
        
       
        
        

        

        
        
         
        
        
        
        $this->add(array(
                        'name' => 'resorts',
                        'type' => 'DoctrineModule\Form\Element\ObjectMultiCheckbox',
                        'options' => array(
                                        'label' => 'Select Resorts',
                                        'object_manager' => $avpObjectManager,
                                        'target_class'   => 'Base\Entity\Avp\Resorts',
                                        'property'       => 'title',

                        ),           
        ));
        
        $this->add(array(
                        'name' => 'events',
                        'type' => 'DoctrineModule\Form\Element\ObjectMultiCheckbox',
                        'options' => array(
                                        'label' => 'Select Events',
                                        'object_manager' => $avpObjectManager,
                                        'target_class'   => 'Base\Entity\Avp\Events',
                                        'property'       => 'title',

                        ),           
        ));
        
        $this->add(array(
                        'name' => 'cruises',
                        'type' => 'DoctrineModule\Form\Element\ObjectMultiCheckbox',
                        'options' => array(
                                        'label' => 'Select Cruises',
                                        'object_manager' => $avpObjectManager,
                                        'target_class'   => 'Base\Entity\Avp\Cruises',
                                        'property'       => 'title',

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
        /*
        $hydrator = new DoctrineHydrator($this->getObjectManager(), get_class($this->getTargetEntity()));
        $this->setHydrator($hydrator);
        $this->bind($this->getTargetEntity());
        */
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
}


