<?php

namespace Inventory\Model;

use Zend\InputFilter\Factory as InputFactory;     // <-- Add this import
use Zend\InputFilter\InputFilter;                 // <-- Add this import
use Zend\InputFilter\InputFilterAwareInterface;   // <-- Add this import
use Zend\InputFilter\InputFilterInterface;        // <-- Add this import

class InventoryCruise extends \Base\Model\BaseModel implements InputFilterAwareInterface{
	
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
                        'name'     => 'suiteId',
                        'required' => true,
                        'filters'  => array(
                                array('name' => 'Int'),
                        ), 
                        'validators' => array(
                                    array(
                                            'name' => 'Int',
                                            'options' => array(
                                                                'min' => 1,
                                            ),
                                    ),
                            ),

            )));

            $inputFilter->add($factory->createInput(array(
                            'name'     => 'totalAvailable',
                            'required' => true,
                            'filters'  => array(
                                    array('name' => 'Int'),
                            ),
            )));
            
            $inputFilter->add($factory->createInput(array(
                            'name'     => 'dateFrom',
                            'required' => true,
                            'filters'  => array(
                                            array('name' => 'StripTags'),
                                            array('name' => 'StringTrim'),
                            ),
                            'validators' => array(
                                                array(
                                                    'name'    => 'Date',
                                                    'options' => array(
                                                                    'format' => 'Y-m-d',
                                                    ),
                                                ),
                            ),
            )));
            
            $inputFilter->add($factory->createInput(array(
                            'name'     => 'dateTo',
                            'required' => true,
                            'filters'  => array(
                                            array('name' => 'StripTags'),
                                            array('name' => 'StringTrim'),
                            ),
                            'validators' => array(
                                                array(
                                                    'name'    => 'Date',
                                                    'options' => array(
                                                                    'format' => 'Y-m-d',
                                                    ),
                                                ),
                            ),
            )));

            $inputFilter->add($factory->createInput(array(
                            'name'     => 'netPrice',
                            'required' => true,
                            'filters'  => array(
                                    array('name' => 'Int'),
                            ),
                            'validators' => array(
                                    array(
                                            'name' => 'Float',
                                            'options' => array(
                                                                'min' => 0,
                                            ),
                                    ),
                            ),
            )));
            
            $inputFilter->add($factory->createInput(array(
                            'name'     => 'grossPrice',
                            'required' => true,
                            'filters'  => array(
                                    array('name' => 'Int'),
                            ),
                            'validators' => array(
                                    array(
                                            'name' => 'Float',
                                            'options' => array(
                                                                'min' => 0,
                                            ),
                                    ),
                            ),
            )));
            
            $inputFilter->add($factory->createInput(array(
                            'name'     => 'notes',
                            'required' => false,
                            'filters'  => array(
                                            array('name' => 'StripTags'),
                                            array('name' => 'StringTrim'),
                            ),

            )));
            
            $inputFilter->add($factory->createInput(array(
                        'name'     => 'promo',
                        'required' => false,
                            'filters'  => array(
                                            array('name' => 'StripTags'),
                                            array('name' => 'StringTrim'),
                            ),

            )));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

    //ajax
    public function getCabinsByCruiseIdCollection($id){
        
        $em = $this->_serviceManager->get('doctrine.entitymanager.orm_avp');
        $qb = $em->createQueryBuilder();  
        $qb->select(array(
            'c.id AS id',                        
            'c.deckName AS suiteName'
            ))->from('\Base\Entity\Avp\CruiseCabins', 'c')
            ->where('c.cruiseId = :id')
            ->setParameter('id', (int)$id)
            ->andWhere('c.isDeleted = :deleted')
            ->setParameter('deleted', 0);    
        $query = $qb->getQuery();
        $results = $query->getResult();     
        return $results;
    }
    
    public function save($object) {   
        $em = $this->_serviceManager->get('doctrine.entitymanager.orm_avp');
        $qb = $em->createQueryBuilder();  
        $qb->select(array(              
            'cr.title AS cruiseName',
            'c.deckNumber AS deckNumber', 
            'c.deckName AS suiteName',  
            ))->from('\Base\Entity\Avp\CruiseCabins', 'c')
            ->innerJoin('\Base\Entity\Avp\Cruises', 'cr', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'c.cruiseId = cr.id')            
            ->where('c.id = :id')
            ->setParameter('id', $object->getSuiteId())
            ->setMaxResults(1);    
        $query = $qb->getQuery();
        $item = $query->getResult();
        if(isset($item)){
            $object->setCruiseName($item[0]['cruiseName']);
            $object->setSuiteName($item[0]['suiteName']);
            //$object->setDeckNumber($item[0]['deckNumber']);            
        }        
        parent::save($object);
    }
    
    protected function isValidDates($form){
		
        $sdate = $form->getData()->getDateFrom()->getTimestamp();
        $edate = $form->getData()->getDateTo()->getTimestamp();
        if($sdate > $edate){
                $form->get('dateFrom')->setMessages(array('Date From should be lesser than Date To'));
                return false;
        }		
        return true;
    }
    
    public function isValidModel($form){
        
        return $this->isValidDates($form);	            
    }
    
    public function isValidModelOnEdit($form){
        
        return $this->isValidDates($form);	            
    }
    
    protected function isValidSuite($form){    
        
        if($form->getData()->getSuiteId() == 0){
            $form->get('suiteId')->setMessages(array('Please select suite...'));
            return false;
        }
        return true;
    }
    
    //ajax
    public function getCabinDetailByIdCollection($id){
        
        $em = $this->_serviceManager->get('doctrine.entitymanager.orm_avp');
        $qb = $em->createQueryBuilder();  
        $qb->select(array(
            'c.id AS id',                        
            'c.deckName AS suiteName',
            'c.inStock AS stock',
            'c.price AS price',
            'c.deckNumber AS deckNumber'
            ))->from('\Base\Entity\Avp\CruiseCabins', 'c')
            ->where('c.id = :id')
            ->setParameter('id', (int)$id);    
        $query = $qb->getQuery();
        $results = $query->getResult(); 
    
        return $results;
    }
    
    function getCabinsBookedCount($data){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('count(rcc.id) AS bookedCount,rcc,ic,r')
            ->from('\Base\Entity\ReservationCruiseCabin', 'rcc')
            ->leftJoin('rcc.cabin', 'ic')
            ->leftJoin('rcc.reservation', 'r')
            ->where('ic = :cabinId')
            ->setParameter('cabinId',$data->getId())
            ->andWhere('r.dateFrom >= :dateFrom')
            ->setParameter('dateFrom', $data->getDateFrom());
        $query = $qb->getQuery();
        $results = $query->getArrayResult();
        return $results;
    }
}