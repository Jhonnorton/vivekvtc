<?php

namespace Orders\Form;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\Form\Form;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class ReservationForm extends Form implements ObjectManagerAwareInterface {

    public function __construct(ObjectManager $objectManager, ObjectManager $avpObjectManager, $targetEntity) {

        $this->setObjectManager($objectManager);
        $this->setAvpObjectManager($avpObjectManager);
        $this->setTargetEntity($targetEntity);

        // we want to ignore the name passed
        parent::__construct('reservation');

        $this->setAttribute('method', 'post');


        /*
          $hydrator = new DoctrineHydrator($this->getObjectManager(), get_class($this->getTargetEntity()));
          $this->setHydrator($hydrator);
          $this->bind($this->getTargetEntity());
         */
    }
    
    
    protected function createReservationForm(){
        
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'type',
            'options' => array(
                'label' => 'Type',
                'value_options' => array(
                    '1' => 'FIT',
                    '2' => 'Group',
                    '3' => 'Cruise'
                ),
            ),
            'attributes' => array(
                'value' => '1' 
            ),
        ));
    }


    public function setObjectManager(ObjectManager $objectManager) {

        $this->objectManager = $objectManager;
        return $this;
    }

    public function getObjectManager() {

        return $this->objectManager;
    }

    public function setAvpObjectManager(ObjectManager $avpObjectManager) {

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
