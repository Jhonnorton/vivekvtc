<?php

namespace Inventory\Form;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\Form\Form;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class LocationForm extends Form implements ObjectManagerAwareInterface {

    public function __construct(ObjectManager $objectManager, $targetEntity) {
        //d($targetEntity);
        $this->setObjectManager($objectManager);
        $this->setTargetEntity($targetEntity);

        // we want to ignore the name passed
        parent::__construct('tours');

        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));


        $this->add(array(
            'name' => 'fromDate',
            'attributes' => array(
                'type' => 'date',
                'placeholder' => 'Y-m-d',
            ),
            'options' => array(
                'label' => 'From Date',
            ),
        ));

        $this->add(array(
            'name' => 'toDate',
            'attributes' => array(
                'type' => 'date',
                'placeholder' => 'Y-m-d',
            ),
            'options' => array(
                'label' => 'To Date',
            ),
        ));
        
        
        $this->add(array(
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'countryId',
            'options' => array(
                'label' => 'Country',
                'object_manager' => $this->getObjectManager(),
                'target_class' => 'Base\Entity\Countries',
                'property' => 'countryName',
                'empty_option' => 'please select country...'
            ),
        ));

         $this->add(array(
            'name' => 'city',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'City',
            ),
        ));

       $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Submit',
                'id' => 'submitbutton',
            ),
        ));

        $hydrator = new DoctrineHydrator($this->getObjectManager(), get_class($this->getTargetEntity()));
        $this->setHydrator($hydrator);
        $this->bind($this->getTargetEntity());
    }

    public function setObjectManager(ObjectManager $objectManager) {
        $this->objectManager = $objectManager;
        // d($this->objectManager);
        return $this;
    }

    public function getObjectManager() {
        return $this->objectManager;
    }

    protected function getTargetEntity() {
        //d($this->targetEntity);
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
