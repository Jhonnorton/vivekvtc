<?php

namespace Reseller\Form;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\Form\Form;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class ResortsForm extends Form implements ObjectManagerAwareInterface{
	
	public function __construct(ObjectManager $objectManager, $targetEntity)
	{
		$this->setObjectManager($objectManager);
		$this->setTargetEntity($targetEntity);
		
		// we want to ignore the name passed
		parent::__construct('reseller');
		
		$this->setAttribute('method', 'post');
				
		$this->add(array(
				'name' => 'id',
				'attributes' => array(
						'type'  => 'hidden',
				),
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
				'name' => 'pageHeading',
				'attributes' => array(
						'type'  => 'text',						
				),
				'options' => array(
						'label' => 'Page Heading',
				),
		));
					
		$this->add(array(
				'type'    => 'DoctrineModule\Form\Element\ObjectSelect',
				'name'    => 'categoryId',
				'options' => array(
						'label'          => 'Category',
						'object_manager' => $this->getObjectManager(),
						'target_class'   => 'Base\Entity\Avp\Categorys',
						'property'       => 'name',
						'empty_option'   => 'please select category...'
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
				'name' => 'amenities',
				'attributes' => array(
						'type'  => 'textarea',						
				),
				'options' => array(
						'label' => 'Amenities',
				),
		));
		
		$this->add(array(
				'name' => 'entertainment',
				'attributes' => array(
						'type'  => 'textarea',						
				),
				'options' => array(
						'label' => 'Entertainment',
				),
		));
                
                
		$this->add(array(
				'name' => 'image',
				'attributes' => array(
						'type'  => 'file',
						'accept' => 'image/*',                                                
				),
				'options' => array(
						'label' => 'Image',
				),
		));
		
		//Popover data
		
		$this->add(array(
				'name' => 'popoverTitle',
				'attributes' => array(
						'type'  => 'text',						
				),
				'options' => array(
						'label' => 'Popover Title',
				),
		));
		
		$this->add(array(
				'name' => 'popoverContent',
				'attributes' => array(
						'type'  => 'textarea',
				),
				'options' => array(
						'label' => 'Popover Content',
				),
		));
		
		//SEO Information
		
		$this->add(array(
				'name' => 'metaTitle',
				'attributes' => array(
						'type'  => 'text',
				),
				'options' => array(
						'label' => 'Meta Title',
				),
		));
		
		$this->add(array(
				'name' => 'metaDescription',
				'attributes' => array(
						'type'  => 'textarea',
				),
				'options' => array(
						'label' => 'Meta Description',
				),
		));
		
		$this->add(array(
				'name' => 'metaKeywords',
				'attributes' => array(
						'type'  => 'text',
				),
				'options' => array(
						'label' => 'Meta Keywords',
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
