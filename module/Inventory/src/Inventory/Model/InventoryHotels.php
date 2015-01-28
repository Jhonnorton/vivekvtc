<?php

namespace Inventory\Model;

use Zend\InputFilter\Factory as InputFactory;     // <-- Add this import
use Zend\InputFilter\InputFilter;                 // <-- Add this import
use Zend\InputFilter\InputFilterAwareInterface;   // <-- Add this import
use Zend\InputFilter\InputFilterInterface;        // <-- Add this import

class InventoryHotels extends \Base\Model\BaseModel implements InputFilterAwareInterface{
	
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
                        'name'     => 'resortId',
                        'required' => true,
                        'filters'  => array(
                                array('name' => 'Int'),
                        ),

            )));
            
            $inputFilter->add($factory->createInput(array(
                        'name'     => 'roomId',
                        'required' => true,
                        'filters'  => array(
                                array('name' => 'Int'),
                        ),                         
            )));

            $inputFilter->add($factory->createInput(array(
                            'name'     => 'numberAvailable',
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
    public function getRoomsByResortIdCollection($id){
        
        $em = $this->_serviceManager->get('doctrine.entitymanager.orm_avp');
        $qb = $em->createQueryBuilder();  
        $qb->select(array(
            'rr.id AS id',                        
            'rr.title AS roomCategory'
            ))->from('\Base\Entity\Avp\ResortRooms', 'rr')
            ->where('rr.resortId = :id')
            ->setParameter('id', (int)$id)
            ->andWhere('rr.isDeleted = :deleted')
            ->setParameter('deleted', 0);    
        $query = $qb->getQuery();
        $results = $query->getResult();     
        return $results;
    }
    
    public function save($object) {   
        $em = $this->_serviceManager->get('doctrine.entitymanager.orm_avp');
        $qb = $em->createQueryBuilder();  
        $qb->select(array(              
            'rr.title AS roomCategory',             
            'r.title AS hotelName',  
            ))->from('\Base\Entity\Avp\ResortRooms', 'rr')
            ->innerJoin('\Base\Entity\Avp\Resorts', 'r', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'rr.resortId = r.id')            
            ->where('rr.id = :id')
            ->setParameter('id', $object->getRoomId()->getId())
            ->setMaxResults(1);    
        $query = $qb->getQuery();
        $item = $query->getResult();		

        if(isset($item)){        	
            $object->setRoomCategory($item[0]['roomCategory']);
            $object->setHotelName($item[0]['hotelName']);                        
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
    
     //ajax
    public function getRoomDetailsByIdCollection($id){
        
        $em = $this->_serviceManager->get('doctrine.entitymanager.orm_avp');
        $qb = $em->createQueryBuilder();  
        $qb->select(array(
            'rr.id AS id',                        
            'rr.title AS roomCategory',
            'rr.inStock AS stock',
            'rr.price AS price'
            ))->from('\Base\Entity\Avp\ResortRooms', 'rr')
            ->where('rr.id = :id')
            ->setParameter('id', (int)$id);    
        $query = $qb->getQuery();
        $results = $query->getResult(); 
        return $results;
    }
    
    function getRoomsBookedCount($data){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('count(rrr.id) AS bookedCount,rrr,ih,r')
            ->from('\Base\Entity\ReservationResortRoom', 'rrr')
            ->leftJoin('rrr.room', 'ih')
            ->leftJoin('rrr.reservation', 'r')
            ->where('ih = :roomId')
            ->setParameter('roomId',$data->getId())
            ->andWhere('r.dateFrom >= :dateFrom')
            ->setParameter('dateFrom', $data->getDateFrom());
        $query = $qb->getQuery();
        $results = $query->getArrayResult();
        return $results;
    }
}