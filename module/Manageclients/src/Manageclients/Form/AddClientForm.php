<?php

namespace Manageclients\Form;

use Zend\Form\Form;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class AddClientForm extends Form implements ObjectManagerAwareInterface{
	
	public function __construct(ObjectManager $objectManager, $targetEntity)
	{
		$this->setObjectManager($objectManager);
		$this->setTargetEntity($targetEntity);
		
		// we want to ignore the name passed
		parent::__construct('clients');
		
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
				'name' => 'dob',
				'attributes' => array(
						'type'  => 'date',
                                                'required' => 'required',
				),
				'options' => array(
						'label' => 'DOB',
				),
		));
		
		$this->add(array(
				'name' => 'addressLine1',
				'attributes' => array(
						'type'  => 'textarea',
                                                'required' => 'required',
				),
				'options' => array(
						'label' => 'Address Line 1',
				),
		));
		
		$this->add(array(
				'name' => 'addressLine2',
				'attributes' => array(
						'type'  => 'textarea',
				),
				'options' => array(
						'label' => 'Address Line 2',
				),
		));
                
                $this->add(array(
				'name' => 'phone',
				'attributes' => array(
						'type'  => 'text',
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
						'type'  => 'text',
                                                'required' => 'required',
				),
				'options' => array(
						'label' => 'Zip',
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
