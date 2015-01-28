<?php

namespace Orders\Form;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\Form\Form;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class AddInvoiceForm extends Form implements ObjectManagerAwareInterface{
	
	public function __construct(ObjectManager $objectManager, $targetEntity)
	{
		$this->setObjectManager($objectManager); //git
		$this->setTargetEntity($targetEntity);
		
		// we want to ignore the name passed
		parent::__construct('invoice');
		
		$this->setAttribute('method', 'post');
		
                $this->add(array(
				'name' => 'id',
				'attributes' => array(
						'type'  => 'hidden',
				),
		));
                
                $this->add(array(
				'type' => 'Zend\Form\Element\Select',
				'name' => 'reservationId',
				'attributes' => array(
						'required' => 'required',
				),
                                'options' => array(
						'label' => 'Reservation Name',
						'value_options' => $this->getReservations(),						
                                                'empty_option'   => 'Select'
                                )
				
		));
                //Extra Items
                $this->add(array(
				'type' => 'Zend\Form\Element\Select',
				'name' => 'itemCategoryId',
				'attributes' => array(
						'required' => 'required',
				),
                                'options' => array(
						'label' => 'Item Category',
						'value_options' => $this->getItemCategoris(),						
                                                'empty_option'   => 'Select'
                                )
				
		));
                
                $this->add(array(
				'type' => 'Zend\Form\Element\Select',
				'name' => 'itemId',
				'attributes' => array(
						'required' => 'required',
				),
                                'options' => array(
						'label' => 'Item',
						'value_options' => $this->getItems(),						
                                                'empty_option'   => 'Select'
                                )
				
		));
                
                $this->add(array(
				'name' => 'rate',
				'attributes' => array(
						'type'  => 'number', 
                                                'required' => 'required',
                                                'min' => 0,                                                       
				),
				'options' => array(
						'label' => 'Rate',
				),
		));
                
                $this->add(array(
				'name' => 'quantity',
				'attributes' => array(
						'type'  => 'number', 
                                                'required' => 'required',
                                                'min' => 0,                                                       
				),
				'options' => array(
						'label' => 'Quantity',
				),
		));
                
                $this->add(array(
				'name' => 'itemsButtom',
				'attributes' => array(
						'type'  => 'button',                                                                                     
						'value' => 'Add',
						'id' => 'addbutton',
                                                'onclick' =>"return alert('In progress')",
                                    
				),				
		));
                                
                //Billing Details
                
                $this->add(array(
				'name' => 'accomodationCost',
				'attributes' => array(
						'type'  => 'number', 
                                                'min' => 0,    
                                                'value' => '0.00',
                                                'readonly' => true,
				),
				'options' => array(
						'label' => 'Accomodation Cost',
				),
		));
                
                $this->add(array(
				'name' => 'transferCost',
				'attributes' => array(
						'type'  => 'number', 
                                                'min' => 0,   
                                                'value' => '0.00',
                                                'readonly' => true,
				),
				'options' => array(
						'label' => 'Transfer Cost',
				),
		));
                
                $this->add(array(
				'name' => 'flightCost',
				'attributes' => array(
						'type'  => 'number', 
                                                'min' => 0,   
                                                'value' => '0.00',
                                                'readonly' => true,
				),
				'options' => array(
						'label' => 'Flight Cost',
				),
		));
                
                $this->add(array(
				'name' => 'tripInsuranceCost',
				'attributes' => array(
						'type'  => 'number', 
                                                'min' => 0,   
                                                'value' => '0.00',
                                                'readonly' => true,
				),
				'options' => array(
						'label' => 'Trip Insurance Cost',
				),
		));
                
                $this->add(array(
				'name' => 'extraItemCost',
				'attributes' => array(
						'type'  => 'number', 
                                                'min' => 0,   
                                                'value' => '0.00',
                                                'readonly' => true,
				),
				'options' => array(
						'label' => 'Extra Item Cost',
				),
		));
                
                $this->add(array(
				'name' => 'discountAmount',
				'attributes' => array(
						'type'  => 'number', 
                                                'min' => 0,   
                                                'value' => '0.00',
                                                'readonly' => true,
				),
				'options' => array(
						'label' => 'Discount Amount',
				),
		));
                
                $this->add(array(
				'name' => 'merchantFee',
				'attributes' => array(
						'type'  => 'number', 
                                                'min' => 0,   
                                                'value' => '0.00',
                                                'readonly' => true,
				),
				'options' => array(
						'label' => 'Merchant Fee',
				),
		));
                
                $this->add(array(
				'name' => 'amountDue',
				'attributes' => array(
						'type'  => 'number', 
                                                'min' => 0,   
                                                'value' => '0.00',
                                                'readonly' => true,
				),
				'options' => array(
						'label' => 'Amount Due',
				),
		));
                
                $this->add(array(
				'name' => 'totalAmount',
				'attributes' => array(
						'type'  => 'number', 
                                                'min' => 0,   
                                                'value' => '0.00',
                                                'readonly' => true,
				),
				'options' => array(
						'label' => 'Total Amount',
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
        
        public function getItemCategoris() {
            return array(
                1=>'Category1',
                2=>'Category2',                
            );
        }
        
        public function getItems() {
            return array(
                1=>'Item1',
                2=>'Item2',                
                3=>'Item3', 
            );
        }
        
        public function getReservations(){
            return array(
                2=>'John Weitz (Rezervation No - 222)',
                5=>'Abraham Jacob (Rezervation No - 76)',
                8=>'...'
            );
        }
	
	public function setObjectManager(ObjectManager $objectManager){
		
                $this->objectManager = $objectManager;	
		return $this;
	}
	
	public function getObjectManager(){
            
		return $this->objectManager;
	}
	
	protected function getTargetEntity(){
		
		return $this->targetEntity;		
	}
	
	protected function setTargetEntity($targetEntity){
		
		if(!is_object($targetEntity)){
                    
			$this->targetEntity = new $targetEntity();			
		} else {
			
			$this->targetEntity = $targetEntity;			
		}
	}                	
}
