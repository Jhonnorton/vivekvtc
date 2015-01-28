<?php

namespace Inventory\Form;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\Form\Form;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class AddResortRoomForm extends Form implements ObjectManagerAwareInterface {

    public function __construct(ObjectManager $objectManager, ObjectManager $avpObjectManager, $targetEntity) {

        $this->setObjectManager($objectManager); //git
        $this->setAvpObjectManager($avpObjectManager);
        $this->setTargetEntity($targetEntity);

        // we want to ignore the name passed
        parent::__construct('tour-location-resort-rooms');

        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));

//         $this->add(array(
//                        'type' => 'text',
//                        'name' => 'name',
//                        'options' => array(
//                                        'label' => 'Room Name',
//                        ),
//                        'attributes' => array(
//                                        'required' => 'required',
//
//                        ),
//        ));

        $this->add(array(
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'resortId',
            'options' => array(
                'label' => 'Hotel',
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
//        if(is_object($targetEntity)):
//        $this->add(array(
//                        'type'    => 'DoctrineModule\Form\Element\ObjectSelect',
//                        'name'    => 'roomId',
//                        'options' => array(
//                                        'label'          => 'Room Category',
//                                        'object_manager' => $this->getAvpObjectManager(),
//                                        'target_class'   => 'Base\Entity\Avp\ResortRooms',
//                                        'property'       => 'title',
//                                        'empty_option'   => 'please select room...',
//                                        'is_method'      => true,
//							            'find_method'    => array(
//							                'name'   => 'findBy',
//							                'params' => array(
//							                    'criteria' => array('resortId' => is_object($targetEntity)?$targetEntity->getResortId():0),
//							
//							                ),
//							            ),
//                        ),
//                        'attributes' => array(
//                                        'required' => 'required',
//
//                        ),
//        ));  
//		else:
//		$this->add(array(
//                        'name' => 'roomId',
//                        'attributes' => array(
//                                        'type'  => 'hidden',
//                                        'value' => 0
//						)
//        ));
//		endif;   

        $this->add(array(
            'name' => 'roomId',
            'type' => 'Zend\Form\Element\Number',
            'options' => array(
                'label' => 'Room Category',
            //'value_options' => $this->getEventRooms($this->_eventId),
            //'empty_option'  => 'please select room...'
            ),
            'attributes' => array(
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
                'id' => 'noa',
            ),
            'options' => array(
                'label' => 'Stock',
            ),
        ));

        $this->add(array(
            'name' => 'dateFrom',
            'attributes' => array(
                'type' => 'date',
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
                'type' => 'date',
                'placeholder' => 'Y-m-d',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Date To',
            ),
        ));

        //fields added according to new mockups smart

        $this->add(array(
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'pricePer',
            'options' => array(
                'label' => 'Price Per',
                'value_options' => array(
                    '1' => 'Person',
                    '2' => 'Room'
                ),
            ),
            'attributes' => array(
                'value' => '1'
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'tripleOccupancyAllowed',
            'options' => array(
                'label' => 'Triple Occupancy Allowed',
                'value_options' => array(
                    '1' => 'Yes',
                    '0' => 'No'
                ),
            ),
            'attributes' => array(
                'value' => '0'
            ),
        ));

        $this->add(array(
            'name' => 'extraPriceNet',
            'attributes' => array(
                'type' => 'number',
                'min' => 0.00,
                'value' => 0.00,
            //'required' => 'required',
            ),
            'options' => array(
                'label' => 'Third Person Net',
            ),
        ));

        $this->add(array(
            'name' => 'extraPriceGross',
            'attributes' => array(
                'type' => 'number',
                'min' => 0.00,
                'value' => 0.00,
            // 'required' => 'required',
            ),
            'options' => array(
                'label' => 'Third Person Gross',
            ),
        ));

        $this->add(array(
            'name' => 'femalesCount',
            'attributes' => array(
                'type' => 'number',
                'min' => 0,
                'value' => 0,
            //'required' => 'required',
            ),
            'options' => array(
                'label' => 'Number of Females',
            ),
        ));


        $this->add(array(
            'name' => 'malesCount',
            'attributes' => array(
                'type' => 'number',
                'min' => 0,
                'value' => 0
            ),
            'options' => array(
                'label' => 'Number of Males',
            ),
        ));


        $this->add(array(
            'name' => 'netPrice',
            'attributes' => array(
                'type' => 'number',
                'min' => 0.00,
                'value' => 0.00,
                'required' => 'required',
                'id' => 'netPrice'
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
            'name' => 'notes',
            'attributes' => array(
                'type' => 'textarea',
                'rows' => 3,
            ),
            'options' => array(
                'label' => 'Notes',
            ),
        ));

        $this->add(array(
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'promo',
            'options' => array(
                'label' => 'Promo Code',
                'object_manager' => $this->getObjectManager(),
                'target_class' => 'Base\Entity\InventoryPromo',
                'property' => 'promoCode',
                'empty_option' => 'please select promo code...'
            ),
            'attributes' => array(
                'class' => 'chzn-select chosen_select width-100',
            ),
        ));



        $this->add(array(
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'board',
            'options' => array(
                'label' => 'Board',
                'value_options' => array(
                    '1' => 'All Inclusive',
                    '2' => 'Breakfast Included',
                    '3' => 'Room Only'
                ),
            ),
            'attributes' => array(
                'value' => '0'
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'doubleOccupancyRate',
            'options' => array(
                'label' => 'doubleOccupancyRate',
                'value_options' => array(
                    '1' => 'Yes',
                    '0' => 'No'
                ),
            ),
            'attributes' => array(
                'value' => '0'
            ),
        ));

        $this->add(array(
            'name' => 'triplePriceFemaleNet',
            'attributes' => array(
                'type' => 'number',
                'min' => 0.00,
                'value' => 0.00,
            //'required' => 'required',
            ),
            'options' => array(
                'label' => 'Cost Per Female For Triple',
            ),
        ));

        $this->add(array(
            'name' => 'triplePriceFemaleGross',
            'attributes' => array(
                'type' => 'number',
                'min' => 0.00,
                'value' => 0.00,
            // 'required' => 'required',
            ),
            'options' => array(
                'label' => 'Price Per Female For Triple',
            ),
        ));



        $this->add(array(
            'name' => 'triplePriceMaleNet',
            'attributes' => array(
                'type' => 'number',
                'min' => 0.00,
                'value' => 0.00,
            //'required' => 'required',
            ),
            'options' => array(
                'label' => 'Price Per Male For Triple',
            ),
        ));

        $this->add(array(
            'name' => 'triplePriceMaleGross',
            'attributes' => array(
                'type' => 'number',
                'min' => 0.00,
                'value' => 0.00,
            // 'required' => 'required',
            ),
            'options' => array(
                'label' => 'Price Per Male For Triple',
            ),
        ));

        $this->add(array(
            'name' => 'quadPriceFemaleNet',
            'attributes' => array(
                'type' => 'number',
                'min' => 0.00,
                'value' => 0.00,
            //'required' => 'required',
            ),
            'options' => array(
                'label' => 'Price Per Female For Quad',
            ),
        ));

        $this->add(array(
            'name' => 'quadPriceFemaleGross',
            'attributes' => array(
                'type' => 'number',
                'min' => 0.00,
                'value' => 0.00,
            // 'required' => 'required',
            ),
            'options' => array(
                'label' => 'Price Per Female For Quad',
            ),
        ));


        $this->add(array(
            'name' => 'quadPriceMaleNet',
            'attributes' => array(
                'type' => 'number',
                'min' => 0.00,
                'value' => 0.00,
            //'required' => 'required',
            ),
            'options' => array(
                'label' => 'Price Per Male For Quad',
            ),
        ));

        $this->add(array(
            'name' => 'quadPriceMaleGross',
            'attributes' => array(
                'type' => 'number',
                'min' => 0.00,
                'value' => 0.00,
            // 'required' => 'required',
            ),
            'options' => array(
                'label' => 'Price Per Male For Quad',
            ),
        ));


        $this->add(array(
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'quadOccupancy',
            'options' => array(
                'label' => 'Does this room allow Quad Occupancy',
                'value_options' => array(
                    '1' => 'Yes',
                    '0' => 'No'
                ),
            ),
            'attributes' => array(
                'value' => '0'
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'singlePremiumOccupancy',
            'options' => array(
                'label' => 'Is there a Premium  for single Occupancy',
                'value_options' => array(
                    '1' => 'Yes',
                    '0' => 'No'
                ),
            ),
            'attributes' => array(
                'value' => '0'
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'singleShare',
            'options' => array(
                'label' => 'Allow single to Share',
                'value_options' => array(
                    '1' => 'Yes',
                    '0' => 'No'
                ),
            ),
            'attributes' => array(
                'value' => '0'
            ),
        ));

        $this->add(array(
            'name' => 'singlePriceGross',
            'attributes' => array(
                'type' => 'number',
                'min' => 0.00,
                'value' => 0.00,
            // 'required' => 'required',
            ),
            'options' => array(
                'label' => 'Single Gross Price',
            ),
        ));

        $this->add(array(
            'name' => 'singlePriceNet',
            'attributes' => array(
                'type' => 'number',
                'min' => 0.00,
                'value' => 0.00,
            //'required' => 'required',
            ),
            'options' => array(
                'label' => 'Single Net Price',
            ),
        ));


        $this->add(array(
            'name' => 'title',
            'attributes' => array(
                'type' => 'text',
                //'required' => 'required',
            ),
            'options' => array(
                'label' => 'Title',
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
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'tripleFemaleNa',
            'options' => array(
                'label' => 'N/A',
                'value_options' => array(
                    '1' => 'N/A',
                ),
            ),
            'attributes' => array(
                'value' => '1' //set checked to '1'
            )
        ));
        
         $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'tripleMaleNa',
            'options' => array(
                'label' => 'N/A',
                'value_options' => array(
                    '1' => 'N/A',
                ),
            ),
            'attributes' => array(
                'value' => '1' //set checked to '1'
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
