<?php

namespace Sales\Form;

use Zend\Form\Form;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class AddVoucherForm extends Form implements ObjectManagerAwareInterface{
	
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
				'name' => 'voucher_code',
				'attributes' => array(
						'type'  => 'hidden',
                                                'required' => 'required',
				),
				'options' => array(
						'label' => 'Voucher Code',
				),
		));
                
                $this->add(array(
				'name' => 'voucher_name',
				'attributes' => array(
						'type'  => 'text',
                                                'required' => 'required',
				),
				'options' => array(
						'label' => 'Voucher Name',
				),
		));
		
		$this->add(array(
				'name' => 'template_id',
				'attributes' => array(
						'type'  => 'number',
                                                'required' => 'required',
				),
				'options' => array(
						'label' => 'Template',
				),
		));
		
                $this->add(array(
				'type'    => 'Zend\Form\Element\Select',
				'name'    => 'type',
				'options' => array(
						'label'          => 'Type',
						'value_options'        => array(
                                                    '1'=>'Individual',
                                                    '2'=>'General',
                                                    
                                                )    
				),
                                'attributes' => array(				
                                                'required' => 'required',
                                                'id' => 'mystype',
				),
                                
		));
                
                $this->add(array(
				'name' => 'receipient_name',
				'attributes' => array(
						'type'  => 'text',
				),
				'options' => array(
						'label' => 'Receipient Name',
				),
		));
                
                
                $this->add(array(
				'name' => 'email',
				'attributes' => array(
						'type'  => 'email',
                                                
				),
				'options' => array(
						'label' => 'Email',
				),
		));		

		$this->add(array(
				'type'    => 'Zend\Form\Element\Select',
				'name'    => 'link_to_type',
				'options' => array(
						'label'          => 'Link',
						'empty_option'   => 'please select...',
                                                'value_options'        => array(
                                                    '0'=>'All',
                                                    '1'=>'Resorts',
                                                    '2'=>'Events',
                                                    '3'=>'Cruises',
                                                    
                                                )    
				),
                                'attributes' => array(				
                                                'required' => 'required',
                                                'id' => 'myselect',
				),
                                
		));
		

		$this->add(array(
				'name' => 'discount',
				'attributes' => array(
						'type'  => 'text',
                                                'required' => 'required',
				),
				'options' => array(
						'label' => 'Discount',
				),
		));
		
		$this->add(array(
				'name' => 'number_of_use',
				'attributes' => array(
						'type'  => 'number',
                                                
				),
				'options' => array(
						'label' => 'Number Of Use',
				),
		));
		
                
                $this->add(array(
				'name' => 'is_unlimited',
				'attributes' => array(
						'type' => 'Zend\Form\Element\Checkbox',
                                                
				),
				'options' => array(
						'label' => 'Is Unlimited',
				),
		));
//                $form->add(array(
//             'type' => 'Zend\Form\Element\Checkbox',
//             'name' => 'checkbox',
//             'options' => array(
//                     'label' => 'A checkbox',
//                     'use_hidden_element' => true,
//                     'checked_value' => 'good',
//                     'unchecked_value' => 'bad'
//             )
//     ));
                
                $this->add(array(
				'name' => 'details',
				'attributes' => array(
						'type'  => 'textarea',
				),
				'options' => array(
						'label' => 'Details',
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
                
                $this->add(array(
				'name' => 'from_date',
				'attributes' => array(
						'type'  => 'date',
                                                'required' => 'required',    
				),
				'options' => array(
						'label' => 'Valid From',
				),
		));
                
                $this->add(array(
				'name' => 'to_date',
				'attributes' => array(
						'type'  => 'date',
                                                'required' => 'required',    
				),
				'options' => array(
						'label' => 'Valid Upto',
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
