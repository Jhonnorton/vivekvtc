<?php

namespace Sales\Form;

use Zend\Form\Form;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class AddReceiptForm extends Form implements ObjectManagerAwareInterface{
	
	public function __construct(ObjectManager $objectManager, $targetEntity)
	{
		$this->setObjectManager($objectManager);
		$this->setTargetEntity($targetEntity);
		
		// we want to ignore the name passed
		parent::__construct('sales');
		
		$this->setAttribute('method', 'post');
		$this->add(array(
				'name' => 'id',
				'attributes' => array(
						'type'  => 'hidden',
				),
		));
               
		$this->add(array(
				'name' => 'name',
				'attributes' => array(
						'type'  => 'text',
                                                'required' => 'required',
				),
				'options' => array(
						'label' => 'Name',
				),
		));
                
                $this->add(array(
				'name' => 'suite',
				'attributes' => array(
						'type'  => 'text',
                                                'required' => 'required',
				),
				'options' => array(
						'label' => 'Suite',
				),
		));
		
		$this->add(array(
				'name' => 'date',
				'attributes' => array(
						'type'  => 'date',
                                                'required' => 'required',
				),
				'options' => array(
						'label' => 'Date',
				),
		));
		
                $this->add(array(
				'name' => 'address',
				'attributes' => array(
						'type'  => 'textarea',
				),
				'options' => array(
						'label' => 'Address',
				),
		));
                
                $this->add(array(
				'name' => 'phone',
				'attributes' => array(
						'type'  => 'number',
                                                'required' => 'required',
				),
				'options' => array(
						'label' => 'Phone',
				),
		));
                
                $this->add(array(
				'name' => 'email',
				'attributes' => array(
						'type'  => 'email',
                                                'required' => 'required',
				),
				'options' => array(
						'label' => 'Email',
				),
		));		

		$this->add(array(
				'name' => 'city',
				'attributes' => array(
						'type'  => 'text',
                                                'required' => 'required',
				),
				'options' => array(
						'label' => 'City',
				),
		));
		

		$this->add(array(
				'name' => 'state',
				'attributes' => array(
						'type'  => 'text',
                                                'required' => 'required',
				),
				'options' => array(
						'label' => 'State',
				),
		));
		
		$this->add(array(
				'type'    => 'DoctrineModule\Form\Element\ObjectSelect',
				'name'    => 'countryId',
				'options' => array(
						'label'          => 'Country',
						'object_manager' => $this->getObjectManager(),
						'target_class'   => 'Base\Entity\Avp\Countries',
						'property'       => 'name',
						'empty_option'   => 'please select country...'
				),
                                'attributes' => array(				
                                                'required' => 'required',
				),
                                
		));			
                
                $this->add(array(
				'name' => 'zip',
				'attributes' => array(
						'type'  => 'number',
                                                'required' => 'required',
				),
				'options' => array(
						'label' => 'Zip',
				),
		));
		
                
                $this->add(array(
				'name' => 'total_received',
				'attributes' => array(
						'type'  => 'number',
                                                'required' => 'required',
				),
				'options' => array(
						'label' => 'Total Received',
				),
		));
                
                $this->add(array(
				'type'    => 'Zend\Form\Element\Select',
				'name'    => 'for_type',
				'options' => array(
						'label'          => 'For',
						'empty_option'   => 'please select...',
                                                'value_options'        => array(
                                                    '1'=>'Resorts',
                                                    '2'=>'Events',
                                                    '3'=>'Cruises',
                                                    '4'=>'Items',
                                                    '5'=>'Excursions',
                                                    '6'=>'Transfer',
                                                )    
				),
                                'attributes' => array(				
                                                'required' => 'required',
                                                'id' => 'myselect',
				),
                                
		));
                
                $this->add(array(
				'name' => 'description',
				'attributes' => array(
						'type'  => 'textarea',
				),
				'options' => array(
						'label' => 'Description',
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
                
                $this->add(array(
				'name' => 'send',
				'attributes' => array(
						'type'  => 'submit',
						'value' => 'Send',
						'id' => 'sendbutton',
				),
		));
		
		$hydrator = new DoctrineHydrator($this->getObjectManager(), get_class($this->getTargetEntity()));
		$this->setHydrator($hydrator);
		$this->bind($this->getTargetEntity());
		
	}
	
	public function setObjectManager(ObjectManager $objectManager)
	{
		$this->objectManager = $objectManager;
	
		return $this;
	}
	
	public function getObjectManager()
	{
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
