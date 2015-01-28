<?php
 
namespace SalesObjects\Model;

use Zend\InputFilter\Factory as InputFactory;     // <-- Add this import
use Zend\InputFilter\InputFilter;                 // <-- Add this import
use Zend\InputFilter\InputFilterAwareInterface;   // <-- Add this import
use Zend\InputFilter\InputFilterInterface;        // <-- Add this import


class Ports extends \Base\Model\AvpModel implements InputFilterAwareInterface{
	
	protected $inputFilter;
	
	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception("Not used");
	}
	
	public function getInputFilter()
	{
		if (!$this->inputFilter) {
			$inputFilter = new InputFilter();
			$factory     = new InputFactory();
			
                        $inputFilter->add($factory->createInput(array(
					'name'     => 'cruiseId',
					'required' => true,
                                        'filters'  => array(
						array('name' => 'Int'),
					),
						
			)));
                        
			$inputFilter->add($factory->createInput(array(
					'name'     => 'title',
					'required' => true,
					'filters'  => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name'    => 'StringLength',
									'options' => array(
											'encoding' => 'UTF-8',
											'min'      => 2,
											'max'      => 255,
									),
							),
					),
			)));
			
			$inputFilter->add($factory->createInput(array(
					'name'     => 'description',
					'required' => false,
					'filters'  => array(							
							array('name' => 'StringTrim'),
					),					
			)));
			
                        $inputFilter->add($factory->createInput(array(
					'name'     => 'thingsToDo',
					'required' => false,
					'filters'  => array(							
							array('name' => 'StringTrim'),
					),					
			)));
                        
                        $inputFilter->add($factory->createInput(array(
					'name'     => 'dontMiss',
					'required' => false,
					'filters'  => array(							
							array('name' => 'StringTrim'),
					),					
			)));

                        $this->inputFilter = $inputFilter;
		}
	
		return $this->inputFilter;
	}
        
        public function getPortsCollection($sort = false){    	
                $order_by = 'ASC';
                if ($sort) {
                    $order_by = 'DESC';
                }
                $em = $this->_serviceManager->get('doctrine.entitymanager.orm_avp');
                $qb = $em->createQueryBuilder();                
                $qb->select(array('p.id AS id',
                    'p.title AS title', 
                    'p.description AS description', 
                    'p.thingsToDo AS thingsToDo',                    
                    'p.dontMiss AS dontMiss',
                    'p.cruiseId AS cruiseId',
                    'cr.title AS cruiseTitle'))
                    ->from('\Base\Entity\Avp\CruisePorts', 'p')
                    ->leftJoin('\Base\Entity\Avp\Cruises', 'cr', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'p.cruiseId = cr.id')            
                    ->where('cr.isDeleted =:deleted')
                    ->setParameter('deleted',0)
                    ->orderBy('p.id', $order_by);
                $query = $qb->getQuery();
                $results = $query->getResult();
                return $results;        
        }
	
        public function isValidModel($object){
	
		if($this->checkItem(array(
				'title'=>$object->getData()->getTitle(),
				'cruiseId'=>$object->getData()->getCruiseId(),
		))){
                    $object->get('title')->setMessages(array('This port already exists'));			
			return false;
		}                
		return true;
	}
	
	public function isValidModelOnEdit($object){
		if($this->checkItem(array(
				'id'=>$object->getData()->getId(),
				'title'=>$object->getData()->getTitle(),
				'cruiseId'=>$object->getData()->getCruiseId()))
		){
			return true;
		} else {
			return $this->isValidModel($object);
		}
	}
} 
