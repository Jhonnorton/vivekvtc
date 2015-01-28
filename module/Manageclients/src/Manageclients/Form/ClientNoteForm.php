<?php

namespace Manageclients\Form;

use Zend\Form\Form;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class ClientNoteForm extends Form implements ObjectManagerAwareInterface{
	
	public function __construct(ObjectManager $objectManager, $targetEntity)
	{
		$this->setObjectManager($objectManager);
		$this->setTargetEntity($targetEntity);
		
		// we want to ignore the name passed
		parent::__construct('clients');
		
		$this->setAttribute('method', 'post');
                $this->add(array(
				'name' => 'travellerId',
				'attributes' => array(
						'type'  => 'hidden',
				),
		));
		$this->add(array(
				'name' => 'subject',
				'attributes' => array(
						'type'  => 'text',
                                                'required' => 'required',
				),
				'options' => array(
						'label' => 'Subject',
				),
		));
                
                $this->add(array(
				'name' => 'message',
				'attributes' => array(
						'type'  => 'textarea',
                                                'required' => 'required',
				),
				'options' => array(
						'label' => 'Message',
				),
		));
                
                $this->add(array(
				'name' => 'reminderDate',
				'attributes' => array(
						'type'  => 'date',
                                                'required' => 'required',
				),
				'options' => array(
						'label' => 'Reminder Date',
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
