<?php

namespace Orders\Form;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\Form\Form;

class InvoiceForm extends Form implements ObjectManagerAwareInterface{
	
    public function __construct(ObjectManager $objectManager, $targetEntity)
    {
            $this->setObjectManager($objectManager); //git
            $this->setTargetEntity($targetEntity);

            // we want to ignore the name passed
            parent::__construct('orders');

            $this->setAttribute('method', 'post');

            $this->add(array(
                            'type' => 'Zend\Form\Element\Radio',
                            'name' => 'viewBy',
                            'options' => array(
                                        'label' => 'View By',
                                        'value_options' => array(
                                            'ALL INVOICES'  => 'ALL INVOICES',      
                                            'FIT'  => 'FIT',
                                            'GROUP'  => 'GROUP',                                            
                                        ),
                            ),
                            'attributes' => array(
                                    'value' => 'ALL INVOICES'
                            )
            ));

            $this->add(array(
                            'type' => 'Zend\Form\Element\Select',
                            'name' => 'groupName',
                            'options' => array(
                                            'label' => 'Group Name',
                                            'value_options' => $this->getGroupNames(),
                                            'empty_option'   => 'Select'
                            )                    
            ));

            /*
            $hydrator = new DoctrineHydrator($this->getObjectManager(), get_class($this->getTargetEntity()));
            $this->setHydrator($hydrator);
            $this->bind($this->getTargetEntity());
             */
    }

    public function getGroupNames(){
        return array(
            '1' => 'Hedo Camasutra Week',
            '2' => '...',
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
