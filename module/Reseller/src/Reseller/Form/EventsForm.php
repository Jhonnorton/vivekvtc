<?php

namespace Reseller\Form;

use Zend\Form\Form;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class EventsForm extends Form implements ObjectManagerAwareInterface {

    public function __construct(ObjectManager $objectManager, $targetEntity) {
        //d($targetEntity);
        $this->setObjectManager($objectManager);
        $this->setTargetEntity($targetEntity);

        // we want to ignore the name passed
        parent::__construct('reseller');

        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));



        $this->add(array(
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'resortId',
            'options' => array(
                'label' => 'Resort',
                'object_manager' => $this->getObjectManager(),
                'target_class' => 'Base\Entity\Avp\Resorts',
                'property' => 'title',
                'empty_option' => 'please select resort...'
            ),
        ));

        $this->add(array(
            'name' => 'title',
            'attributes' => array(
                'type' => 'text',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Title',
            ),
        ));


        $this->add(array(
            'name' => 'pageHeading',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'Page Heading',
            ),
        ));

        $this->add(array(
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'eventCategoryId',
            'options' => array(
                'label' => 'Event Category',
                'object_manager' => $this->getObjectManager(),
                'target_class' => 'Base\Entity\Avp\EventCategories',
                'property' => 'name',
                'empty_option' => 'please select event categoty...'
            ),
        ));

        $this->add(array(
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'categoryId',
            'options' => array(
                'label' => 'Category',
                'object_manager' => $this->getObjectManager(),
                'target_class' => 'Base\Entity\Avp\EventsCategory',
                'property' => 'name',
                'empty_option' => 'please select categoty...'
            ),
        ));

        $this->add(array(
            'name' => 'startDate',
            'attributes' => array(
                'type' => 'date',
                'placeholder' => 'Y-m-d',
            ),
            'options' => array(
                'label' => 'Start Date',
            ),
        ));

        $this->add(array(
            'name' => 'endDate',
            'attributes' => array(
                'type' => 'date',
                'placeholder' => 'Y-m-d',
            ),
            'options' => array(
                'label' => 'End Date',
            ),
        ));

        $this->add(array(
            'name' => 'minimumStayDays',
            'attributes' => array(
                'type' => 'number',
                'min' => 1,
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Minimum number of days to stay (Required on reservation)',
            ),
        ));

        $this->add(array(
            'name' => 'overview',
            'attributes' => array(
                'type' => 'textarea',
            ),
            'options' => array(
                'label' => 'Overview',
            ),
        ));

        $this->add(array(
            'name' => 'image',
            'attributes' => array(
                'type' => 'file',
                'accept' => 'image/*',
            ),
            'options' => array(
                'label' => 'Image',
            ),
        ));

        $this->add(array(
            'name' => 'bannerImage',
            'attributes' => array(
                'type' => 'file',
                'accept' => 'image/*',
            ),
            'options' => array(
                'label' => 'Banner Image',
            ),
        ));

        $this->add(array(
            'name' => 'listingImage',
            'attributes' => array(
                'type' => 'file',
                'accept' => 'image/*',
            ),
            'options' => array(
                'label' => 'Listing Image',
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'status',
            'options' => array(
                'label' => 'Status',
                'value_options' => array(
                    '1' => 'Enabled',
                    '0' => 'Disabled',
                ),
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'approved',
            'options' => array(
                'label' => 'Approval Status',
                'value_options' => array(
                    '1' => 'Approve',
                    '2' => 'Decline',
                ),
            )
        ));

        //SEO Information

        $this->add(array(
            'name' => 'metaTitle',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'Meta Title',
            ),
        ));

        $this->add(array(
            'name' => 'metaDescription',
            'attributes' => array(
                'type' => 'textarea',
            ),
            'options' => array(
                'label' => 'Meta Description',
            ),
        ));

        $this->add(array(
            'name' => 'metaKeywords',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'Meta Keywords',
            ),
        ));


        $this->add(array(
            'name' => 'description',
            'attributes' => array(
                'type' => 'textarea',
            ),
            'options' => array(
                'label' => 'Description',
            ),
        ));


        $this->add(array(
            'name' => 'time',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'Time',
            ),
        ));

        $this->add(array(
            'name' => 'roomPrice',
            'attributes' => array(
                'type' => 'number',
                'min' => 0,
            ),
            'options' => array(
                'label' => 'Price(USD)',
            ),
        ));

        $this->add(array(
            'name' => 'roomPriceCad',
            'attributes' => array(
                'type' => 'number',
                'min' => 0,
            ),
            'options' => array(
                'label' => 'Price(CAD)',
            ),
        ));

        $this->add(array(
            'name' => 'roomCategory',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'Room Category',
            ),
        ));
        
          $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'isSignatured',
            'options' => array(
                'label' => 'Signature',
                'value_options' => array(
                    '1' => 'isSignatured',
                ),
            ),
            'attributes' => array(
                'value' => '1' //set checked to '1'
            )
        ));
          
          
             $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'type',
            'options' => array(
                'label' => 'Type',
                'value_options' => array(
                    '0' => 'Featured',
                    '1' => 'Independent',
                ),
            )
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
