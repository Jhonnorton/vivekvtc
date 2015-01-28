<?php

namespace Sendmail\Form;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\Form\Form;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

use Sendmail\Model\Plugin\SendMailHelper; 

class AddSendmailForm extends Form implements ObjectManagerAwareInterface{
	
	public function __construct(ObjectManager $objectManager, $targetEntity)
	{
		$this->setObjectManager($objectManager);
		$this->setTargetEntity($targetEntity);
		
		// we want to ignore the name passed
		parent::__construct('sendmails');
		
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
				),
				'options' => array(
						'label' => 'Name',
				),
		));
		$this->add(array(
				'name' => 'header',
				'attributes' => array(
						'type'  => 'textarea',
				),
				'options' => array(
						'label' => 'Header',
				),
		));
		
		$this->add(array(
				'name' => 'footer',
				'attributes' => array(
						'type'  => 'textarea',
				),
				'options' => array(
						'label' => 'Footer',
				),
		));
		
		$this->add(array(
				'name' => 'message',
				'attributes' => array(
						'type'  => 'textarea',
				),
				'options' => array(
						'label' => 'Message',
				),
		));
                
                $this->add(array(
                        'type' => 'Zend\Form\Element\Select',
                        'name' => 'template',
                        'options' => array(
                                        'label' => 'Template',
                                        'value_options' => $this->getTemplates(),                                        
                        ),                    
                ));
                
                $this->add(array(
                                'type' => 'Zend\Form\Element\Select',
                                'name' => 'action',
                                'options' => array(
                                    'label' => 'Action',
                                    'value_options' => \Sendmail\Model\Plugin\SendMailHelper::getActions(),                                    
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
        
        public function getTemplates() {
            $templates = array();
            $dir = \Sendmail\Model\Plugin\SendMailHelper::PATH_TO_TEMPLATE;
            if(is_dir($dir)){            
                foreach (scandir($dir) as $filename) {
                    if(is_file($dir.$filename)){
                        $templates[$dir.$filename] = basename($dir.$filename, ".phtml");
                    }                         
                }
            }          
            return $templates;
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