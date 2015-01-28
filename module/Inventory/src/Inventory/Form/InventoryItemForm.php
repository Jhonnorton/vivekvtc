<?php

namespace Inventory\Form;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\Form\Form;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class InventoryItemForm extends Form implements ObjectManagerAwareInterface {

    public function __construct(ObjectManager $objectManager, ObjectManager $avpObjectManager, $targetEntity) {

        $this->setObjectManager($objectManager); //git
        $this->setAvpObjectManager($avpObjectManager);
        $this->setTargetEntity($targetEntity);

        // we want to ignore the name passed
        parent::__construct('inventory-items');

        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));

//        $this->add(array(
//            'name' => 'cruiseId',
//        ));
//
//        $this->add(array(
//            'name' => 'eventId',
//        ));
//
//        $this->add(array(
//            'name' => 'eventCategoryId',
//        ));
//
//        $this->add(array(
//            'name' => 'resortId',
//        ));
        
        $this->add(array(
                        'type'    => 'DoctrineModule\Form\Element\ObjectSelect',
                        'name'    => 'resortId',
                        'options' => array(
                                        'label'          => 'Hotel',
                                        'object_manager' => $this->getAvpObjectManager(),
                                        'target_class'   => 'Base\Entity\Avp\Resorts',
                                        'property'       => 'title',
                        ),
                        'attributes' => array(

                        ),
        ));
        
        $this->add(array(
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'cruiseId',
            'options' => array(
                'label' => 'Cruise',
                'object_manager' => $this->getAvpObjectManager(),
                'target_class' => 'Base\Entity\Avp\Cruises',
                'property' => 'title',
            ),
            'attributes' => array(
                'id' => 'cruises',
            ),
        ));

        $this->add(array(
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'eventId',
            'options' => array(
                'label' => 'Event',
                'object_manager' => $this->getAvpObjectManager(),
                'target_class' => 'Base\Entity\Avp\Events',
                'property' => 'title',
            ),
            'attributes' => array(
                'id' => 'events',
            ),
        ));

        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type' => 'text',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Item Name',
            ),
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'supplierName',
            'options' => array(
                'label' => 'Supplier',
            ),
            'attributes' => array(
                'required' => 'required',
            ),
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'email',
            'options' => array(
                'label' => 'Email',
            ),
            'attributes' => array(
                'required' => 'required',
            ),
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'phone',
            'options' => array(
                'label' => 'Supplier Phone',
            ),
            'attributes' => array(
                'required' => 'required',
            ),
        ));

        $this->add(array(
            'name' => 'linkedTo',
            'type' => 'Zend\Form\Element\Select',
            'options' => array(
                'label' => 'Linked To',
                'value_options' => $this->getLinkedToItems(),
            ),
            'attributes' => array(
                'id' => 'linkedTo',
                'required' => 'required',
            ),
        ));

        $this->add(array(
            'name' => 'numberAvailable',
            'attributes' => array(
                'type' => 'number',
                'min' => 0,
                'value' => 0,
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Stock',
            ),
        ));

        $this->add(array(
            'name' => 'netPrice',
            'attributes' => array(
                'type' => 'number',
                'min' => 0.00,
                'value' => 0.00,
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Net Price',
            ),
        ));

        $this->add(array(
            'name' => 'grossPrice',
            'attributes' => array(
                'type' => 'number',
                'min' => 0.00,
                'value' => 0.00,
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Gross Price',
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
        
        $this->add(array(
            'type' => 'textarea',
            'name' => 'notes',
            'options' => array(
                'label' => 'Notes',
            ),
            'attributes' => array(
            ),
        ));
        $this->add(array(
            'type' => 'file',
            'name' => 'image',
            'options' => array(
                'label' => 'Image',
            ),
            'attributes' => array(
            ),
        ));

        $hydrator = new DoctrineHydrator($this->getObjectManager(), get_class($this->getTargetEntity()));
        $this->setHydrator($hydrator);
        $this->bind($this->getTargetEntity());
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

    protected function getLinkedToItems() {
        $lt = array(
            0 => 'ALL',
            1 => 'All Resorts',
            2 => 'All Events',
            3 => 'All Cruises',
            4 => 'Resort',
            6 => 'Event',
            7 => 'Cruise',
        );
        return $lt;
    }
    
//    protected function getLinkedToItems() {
//        $lt = array(
//            0 => 'ALL',
//            1 => 'Resort',
//            2 => 'Event',
//            3 => 'Cruise',
//            4 => 'Resort Name',
//            5 => 'Event Category',
//            6 => 'Event Name',
//            7 => 'Cruise Name',
//        );
//        return $lt;
//    }

}
