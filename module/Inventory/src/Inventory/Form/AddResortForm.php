<?php

namespace Inventory\Form;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\Form\Form;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class AddResortForm extends Form implements ObjectManagerAwareInterface {

    public function __construct(ObjectManager $objectManager, ObjectManager $avpObjectManager, $targetEntity) {

        $this->setObjectManager($objectManager); //git
        $this->setAvpObjectManager($avpObjectManager);
        $this->setTargetEntity($targetEntity);
 // we want to ignore the name passed
        parent::__construct('tourresorts');

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
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'resortId',
            'options' => array(
                'label' => 'Resort',
                'object_manager' => $this->getAvpObjectManager(),
                'target_class' => 'Base\Entity\Avp\Resorts',
                'property' => 'title',
                'empty_option' => 'please select hotel...'
            ),
            'attributes' => array(
                'id' => 'hotels',
                'required' => 'required',
            ),
        ));
        
       $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'addedToVp',
            'options' => array(
                'label' => 'Add Resort To Vp',
                'value_options' => array(
                    '1' => 'VP',
                ),
            ),
            'attributes' => array(
                'value' => '1' //set checked to '1'
            )
        ));
        
        
        $this->add(array(
				'name' => 'title',
				'attributes' => array(
						'type'  => 'text',
						'required' => 'required',
				),
				'options' => array(
						'label' => 'Title',
				),
		));
		
        
        $this->add(array(
				'name' => 'overview',
				'attributes' => array(
						'type'  => 'textarea',	                                                
				),
				'options' => array(
						'label' => 'Overview',
				),
		));

        $this->add(array(
				'name' => 'image',
				'attributes' => array(
						'type'  => 'file',
						//'accept' => 'image/*',                                                
				),
				'options' => array(
						'label' => 'Image',
				),
		));
        
         $this->add(array(
            'name' => 'rating',
            'attributes' => array(
                'type' => 'number',
                'min' => 0,
                'value' => 0,
                
            ),
            'options' => array(
                'label' => 'Rating',
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

}
