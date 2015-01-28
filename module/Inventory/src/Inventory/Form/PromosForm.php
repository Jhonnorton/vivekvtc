<?php

namespace Inventory\Form;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\Form\Form;
use Inventory\Model\Promos as PROMO;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class PromosForm extends Form implements ObjectManagerAwareInterface{
	
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
}
