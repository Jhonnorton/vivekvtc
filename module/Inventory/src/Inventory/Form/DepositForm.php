<?php

namespace Inventory\Form;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\Form\Form;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class DepositForm extends Form implements ObjectManagerAwareInterface {

     public function __construct(ObjectManager $objectManager, $targetEntity) {
        //d($targetEntity);
        $this->setObjectManager($objectManager);
        $this->setTargetEntity($targetEntity);

        // we want to ignore the name passed
        parent::__construct('inventory-deposit');

        $this->setAttribute('method', 'post');
       
         $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));
         
         $this->add(array(
            'name' => 'depositName',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'Name',
            ),
        ));
         
                
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'linkedTo',
             'attributes' => array(
                'id' => 'myselect',
            ),
            'options' => array(
                'label' => 'Link To',
                'value_options' => array(
                    '0' => 'ALL',
                    '1' => 'Resorts',
                    '2' => 'Events',
                    '3' => 'Cruises',
                    '4' => 'Resort Name',
                    '5' => 'Event Name',
                    '6' => 'Cruise Name',
                ),
                'empty_option' => 'Select Type'
            )
        ));
//        
//        $this->add(array(
//            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
//            'name' => 'typeId',
//            'options' => array(
//                'label' => 'Event Name',
//                'object_manager' => $this->getObjectManager(),
//                'empty_option' => 'Please Select...'
//            ),
//        ));
       $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'type',
            'options' => array(
                'label' => 'Deposit Exception',
                'value_options' => array(
                    '0' => '$',
                    '1' => '%',
                ),
                'empty_option' => 'Select Type'
            )
        ));
        $this->add(array(
            'name' => 'amount',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'Amount',
            ),
        ));

        $this->add(array(
            'name' => 'dateTo',
            'attributes' => array(
                'type' => 'date',
                'placeholder' => 'Y-m-d',
            ),
            'options' => array(
                'label' => 'Date To',
            ),
        ));
        $this->add(array(
            'name' => 'dateFrom',
            'attributes' => array(
                'type' => 'date',
                'placeholder' => 'Y-m-d',
            ),
            'options' => array(
                'label' => 'Date From',
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
