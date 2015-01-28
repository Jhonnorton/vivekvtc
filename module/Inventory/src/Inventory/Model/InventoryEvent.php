<?php

namespace Inventory\Model;

use Zend\InputFilter\Factory as InputFactory;     // <-- Add this import
use Zend\InputFilter\InputFilter;                 // <-- Add this import
use Zend\InputFilter\InputFilterAwareInterface;   // <-- Add this import
use Zend\InputFilter\InputFilterInterface;        // <-- Add this import

class InventoryEvent extends \Base\Model\BaseModel implements InputFilterAwareInterface{
	
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
                        'name'     => 'eventId',
                        'required' => true,
                        'filters'  => array(
                                array('name' => 'Int'),
                        ),

            )));       
			/*
			$inputFilter->add($factory->createInput(array(
                        'name'     => 'roomId',
                        'required' => true,
                        'filters'  => array(
                                array('name' => 'Int'),
                        ),

            )));                  
*/
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
    public function getRoomsByEventIdCollection($id){
        
        $em = $this->_serviceManager->get('doctrine.entitymanager.orm_avp');
        $qb = $em->createQueryBuilder();  
        $qb->select('er')->from('\Base\Entity\Avp\EventRooms', 'er')
            ->where('er.eventId = :id')
            ->setParameter('id', (int)$id)
            ->andWhere('er.isDeleted= :deleted')
            ->setParameter('deleted', 0);    
        $query = $qb->getQuery();
        $results = $query->getResult();  
        return $results;
    }
    
    public function save($object) { 
        $em = $this->_serviceManager->get('doctrine.entitymanager.orm_avp');
        $qb = $em->createQueryBuilder();
        //echo $object->getRoomId()->getId();die;
        $query = $em->createQuery('SELECT ee FROM Base\Entity\Avp\EventRooms ee WHERE ee.id = '.(int)$object->getRoomId()->getId());
        $eventRooms = $query->getResult();

        $qb->select(array(   
            'er.roomCategory AS roomCategory', 
            'er.eventId AS eventId',
            'e.title AS eventName', 
            'e.resortId AS resortId',                          
            'r.title AS hotelName',  
            ))->from('\Base\Entity\Avp\EventRooms', 'er')
            ->innerJoin('\Base\Entity\Avp\Events', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.eventId = e.id')            
            ->innerJoin('\Base\Entity\Avp\Resorts', 'r', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'e.resortId = r.id')            
            ->where('er.eventId = :id AND er.roomId = :roomId')
            ->setParameter('id', $object->getEventId())
            ->setParameter('roomId', $eventRooms[0]->getRoomId()->getId());                
        $query = $qb->getQuery();
        $item = $query->getResult();     
        if(isset($item)){
            $object->setRoomCategory($item[0]['roomCategory']);
            $object->setHotelName($item[0]['hotelName']);  
            $object->setResortId($item[0]['resortId']); 
            $object->setEventName($item[0]['eventName']);                        
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

    public function getEventRoomsCollection($order_by = false){    	
        
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();                
        $qb->select(array('er.id AS id',            
            'er.roomCategory AS roomCategory',               
            'er.roomPrice AS roomPrice',
            'er.roomPriceCad AS roomPriceCad',            
            'e.title AS eventName',
            'e.startDate AS dateFrom',
            'e.endDate AS dateTo',
            'rr.inStock AS inStock',            
            'r.id AS resortId',
            'r.title AS resortTitle'))
            ->from('\Base\Entity\Avp\EventRooms', 'er')
            ->innerJoin('\Base\Entity\Avp\Events', 'e', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.eventId = e.id')                      
            ->innerJoin('\Base\Entity\Avp\ResortRooms', 'rr', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'er.roomId = rr.id')                      
            ->innerJoin('\Base\Entity\Avp\Resorts', 'r', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'rr.resortId = r.id')                      
            ->orderBy('er.id', $order_by ? 'DESC' : 'ASC');
        $query = $qb->getQuery();
        $results = $query->getResult();                
        return $results;        
    }
    
        function getRoomsBookedCount($data){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('count(rer.id) AS bookedCount,rer,ie,r')
            ->from('\Base\Entity\ReservationEventRoom', 'rer')
            ->leftJoin('rer.eventRoom', 'ie')
            ->leftJoin('rer.reservation', 'r')
            ->where('ie = :roomId')
            ->setParameter('roomId',$data->getId())
            ->andWhere('r.dateFrom >= :dateFrom')
            ->setParameter('dateFrom', $data->getDateFrom());
        $query = $qb->getQuery();
        $results = $query->getArrayResult();

        return $results;
        
    }

}