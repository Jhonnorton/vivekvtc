<?php

namespace Inventory\Form;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\Form\Form;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class ExcursionsForm extends Form implements ObjectManagerAwareInterface {

    public function __construct(ObjectManager $objectManager, ObjectManager $avpObjectManager, $targetEntity) {

        $this->setObjectManager($objectManager); //git
        $this->setAvpObjectManager($avpObjectManager);
        $this->setTargetEntity($targetEntity);

        // we want to ignore the name passed
        parent::__construct('inventory-excursions');

        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'excursionName',
            'options' => array(
                'label' => 'Excursion Name',
            ),
            'attributes' => array(
                'required' => 'required',
            ),
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'supplierName',
            'options' => array(
                'label' => 'Supplier Name',
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
            'type' => 'text',
            'name' => 'excursionName',
            'options' => array(
                'label' => 'Excursion Name',
            ),
            'attributes' => array(
                'required' => 'required',
            ),
        ));

        $this->add(array(
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'resortId',
            'options' => array(
                'label' => 'Hotel',
                'object_manager' => $this->getAvpObjectManager(),
                'target_class' => 'Base\Entity\Avp\Resorts',
                'property' => 'title',
            ),
            'attributes' => array(
                'class' => 'chzn-select chosen_select width-100',
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
            'name' => 'linkedTo',
            'type' => 'Zend\Form\Element\Select',
            'options' => array(
                'label' => 'Linked To',
                'value_options' => $this->getLinkedToItems(),
            ),
            'attributes' => array(
                'id' => 'linkedTo',
            ),
        ));

//        $this->add(array(
//                        'name' => 'cruiseId',                        
//        ));
//        $this->add(array(
//                        'name' => 'eventId',                        
//        ));

        /* $this->add(array(
          'name' => 'resortId',
          )); */


        $this->add(array(
            'type' => 'hidden',
            'name' => 'hotelName',
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
                'label' => 'Number Available',
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
            1 => 'All Resort',
            2 => 'All Event',
            3 => 'All Cruise',
            4 => 'Resort',
            6 => 'Event',
            7 => 'Cruise',
        );
        return $lt;
    }

}