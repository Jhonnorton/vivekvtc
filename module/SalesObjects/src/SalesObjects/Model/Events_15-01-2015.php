<?php
 
namespace SalesObjects\Model;

use Zend\InputFilter\Factory as InputFactory;     // <-- Add this import
use Zend\InputFilter\InputFilter;                 // <-- Add this import
use Zend\InputFilter\InputFilterAwareInterface;   // <-- Add this import
use Zend\InputFilter\InputFilterInterface;        // <-- Add this import


class Events extends \Base\Model\AvpModel implements InputFilterAwareInterface{
	
	protected $inputFilter;
        protected $_maxImageSize = 2097152;             //2*1024*1024 = 2Mb
	
        public function getImagePath(){
            return \Base\Model\Plugins\Imagine::$imagesBaseUrl.'event/thumbnails_80x80/'; 
        }
        
        protected $_imageOptions = array(
            //img 80x80
            array(
            'options' => array('width'=>80, 'height'=>80), 
            'destination' => 'event/thumbnails_80x80/'
            ),                       
            //img 150x150
            array(
            'options' => array('width'=>150, 'height'=>150), 
            'destination' => 'event/thumbnails_150x150/'
            ),
            //img 291x194
            array(
            'options' => array('width'=>291, 'height'=>194), 
            'destination' => 'event/image_291x194/'
            ),            
            //img 202x144
            array(
            'options' => array('width'=>202, 'height'=>144), 
            'destination' => 'event/image_202x144/'
            ),            
            //img 288x161
            array(
            'options' => array('width'=>288, 'height'=>161), 
            'destination' => 'event/image_288x161/'
            ),       
            //img 622x268
            array(
            'options' => array('width'=>622, 'height'=>268), 
            'destination' => 'event/image_622x268/'
            ),
            //img 701x456
            array(
            'options' => array('width'=>701, 'height'=>456), 
            'destination' => 'event/image_701x456/'
            ),            
            //img large 800x600
            array(
            'options' => array('width'=>800, 'height'=>600), 
            'destination' => 'event/large/'
            ),            
            //img
            array(
            'options' => null, 
            'destination' => 'event/'
            )           
        );        
        
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
					'name'     => 'pageHeading',
					'required' => false,
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
					'name'     => 'eventCategoryId',
					'required' => true,
                                        'filters'  => array(
						array('name' => 'Int'),
					),
						
			)));
                        
                        $inputFilter->add($factory->createInput(array(
					'name'     => 'categoryId',
					'required' => false,
                                        'filters'  => array(
						array('name' => 'Int'),
					),
						
			)));
                        
                        $inputFilter->add($factory->createInput(array(
					'name'     => 'startDate',
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
					'name'     => 'endDate',
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
					'name'     => 'minimumStayDays',
					'required' => true,
                                        'filters'  => array(
						array('name' => 'Int'),
					),
						
			)));
                       
                        
                        
			$inputFilter->add($factory->createInput(array(
					'name'     => 'overview',
					'required' => false,
					'filters'  => array(							
							array('name' => 'StringTrim'),
					),
					
			)));
                        
                        $inputFilter->add($factory->createInput(array(
					'name'     => 'image',
					'required' => false,
					'filters'  => array(							
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name'    => 'StringLength',
									'options' => array(
											'encoding' => 'UTF-8',
											'max'      => 89,
									),
							),
					),
			)));
                        
                        $inputFilter->add($factory->createInput(array(
					'name'     => 'status',
					'required' => false,
			)));
                        
                        $inputFilter->add($factory->createInput(array(
					'name'     => 'approved',
					'required' => false,
			)));
                        
                        //SEO Information
			
			$inputFilter->add($factory->createInput(array(
					'name'     => 'metaTitle',
					'required' => false,
					'filters'  => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name'    => 'StringLength',
									'options' => array(
											'encoding' => 'UTF-8',											
											'max'      => 255,
									),
							),
					),
			)));
				
			$inputFilter->add($factory->createInput(array(
					'name'     => 'metaDescription',
					'required' => false,
					'filters'  => array(
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name'    => 'StringLength',
									'options' => array(
											'encoding' => 'UTF-8',											
									),
							),
					),
			)));
			
			$inputFilter->add($factory->createInput(array(
					'name'     => 'metaKeywords',
					'required' => false,
					'filters'  => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name'    => 'StringLength',
									'options' => array(
											'encoding' => 'UTF-8',											
											'max'      => 255,
									),
							),
					),
			)));
                        
			$this->inputFilter = $inputFilter;
		}
	
		return $this->inputFilter;
	}
        
        public function getEventsCollection($sort = false){    	
                $order_by = 'ASC';
                if ($sort) {
                    $order_by = 'DESC';
                }
                $em = $this->_serviceManager->get('doctrine.entitymanager.orm_avp');
                $qb = $em->createQueryBuilder();                
                $qb->select(array('e.id AS id',
                    'e.image AS image',
                    'e.title AS title',                    
                    'e.startDate AS startDate',
                    'e.endDate AS endDate',
                    'e.status AS status',
                    'e.approved AS approved',
                    'e.resortId AS resortId',
                   // 'ec.name AS eventCategory',
                    'r.title AS resortTitle'))
                    ->from('\Base\Entity\Avp\Events', 'e')
                    ->leftJoin('\Base\Entity\Avp\Resorts', 'r', \Doctrine\ORM\Query\Expr\Join::LEFT_JOIN, 'e.resortId = r.id')     
                    ->leftJoin('\Base\Entity\Avp\EventCategories', 'ec', \Doctrine\ORM\Query\Expr\Join::LEFT_JOIN, 'e.eventCategoryId = ec.id')     
                    ->where('e.isDeleted = 0')
                    ->orderBy('e.id', $order_by);
                $query = $qb->getQuery();
                $results = $query->getResult();
                return $results;        
        }
        
        protected function isValidDates($object){
		
		$sdate = $object->getData()->getStartDate()->getTimestamp();
		$edate = $object->getData()->getEndDate()->getTimestamp();
		if($sdate >= $edate){
			$object->get('startDate')->setMessages(array('Start Date should be lesser than End Date.'));
			return false;
		}		
		return true;
	}
        
        protected function isValidTitle($object){
		if($this->checkItem(array(
                        'title'=>$object->getData()->getTitle(),
                        'resortId'=>$object->getData()->getResortId()
                    ))){
			$object->get('title')->setMessages(array('This event already exists'));
			return false;
		}
		return true;
	}
	
        public function isValidModel($object){		
		if($this->isValidTitle($object) && $this->isValidDates($object))
			return true;
		return false;
	}
	
	public function isValidModelOnEdit($object){
		if($this->checkItem(array(
				'id'=>$object->getData()->getId(),
				'title'=>$object->getData()->getTitle(),
                                'resortId'=>$object->getData()->getResortId()
                    ))
		){
			return $this->isValidDates($object);
		} else {
			if($this->isValidModel($object) && $this->isValidDates($object))
				return true;
		}
		return false;
	}
        
        public function isValidImage($form, $files){                         
            if(empty($files['image']['name']))
                return true;             
            $size = (int)$files['image']['size'];
            if($size == 0 || $this->_maxImageSize < $size){
                $form->get('image')->setMessages(array('Max size 2 Mb'));
                return false;
            }
            $types = array('image/gif', 'image/png', 'image/jpeg', 'image/pjpeg');
            if (!in_array($files['image']['type'], $types)){
                $form->get('image')->setMessages(array('Invalid file type. Upload images: *.gif, *.png, *.jpg'));
                return false;
            }
            return true;
        }
        
        protected function saveImages($tmpName, $imgName){            
            foreach($this->_imageOptions as $imgOption){                
                \Base\Model\Plugins\Imagine::uploadImage($tmpName, $imgName, $imgOption['options'], $imgOption['destination']);
            }                 
        }
        
        protected function deleteImages($imageName){
            foreach($this->_imageOptions as $imgOption){
                $file = \Base\Model\Plugins\Imagine::$srcDestination.$imgOption['destination'].$imageName;
                if(file_exists($file)){
                    unlink($file);                 
                }                
            } 
        }

        public function update($object){
                        
            $obj = $object['object'];
            $tmpImage = $object['tmpImage'];
            if($obj->getImage()!== $tmpImage){
                $this->deleteImages($tmpImage);      
                $this->save($object);
                
            }else{
                parent::save($obj);
            }            
        }
	
	public function save($object){

            $obj = $object['object'];   
			$date = getdate();         
            $obj->setImage($date[0].'-'.$obj->getImage());
            
            $event = parent::save($obj);
            //insert rooms to event rooms table as per the resort selected
            //$resortId = $obj->getResortId();
            //$this->getRooms(array("resortId"=>$resortId ,"eventId"=>$event->getId()));
            $this->saveImages($object['files']['image']['tmp_name'], $obj->getImage());
            return $event;
	}
        
//        public function delete($id){
//            
//            $em = $this->_entityManager;        
//            $entity = $em->getReference($this->_targetEntity, (int)$id);  
//		//d($entity);                      
//            //delete images
//            $this->deleteImages($entity->getImage());                        
//            //delete resort
//            $item = $em->getRepository('\Base\Entity\Avp\EventRooms')
//                    ->findBy(
//                    array(
//                        'eventId' => $id
//                    )
//            );
//            foreach($item as $row){
//                $query1 = 'DELETE FROM reservation WHERE type=2 AND room_id =' . $row->getId();
//                $stmt = $em->getConnection()->prepare($query1);
//                $stmt->execute();
//                
//                $query1 = 'DELETE FROM reservation_event_room WHERE event_room_id =' . $row->getId();
//                $stmt = $em->getConnection()->prepare($query1);
//                $stmt->execute();
//            }
//            
//            $item = $em->getRepository('\Base\Entity\Avp\EventCommissions')->findBy(array('eventId' => $id));
//            foreach($item as $row){
//                $query1 = 'DELETE FROM commissions WHERE id =' . $row->getCommissionId();
//                $stmt = $em->getConnection()->prepare($query1);
//                $stmt->execute();
//                
//                $query1 = 'DELETE FROM affiliate_commission_rel WHERE commission_id =' . $row->getCommissionId();
//                $stmt = $em->getConnection()->prepare($query1);
//                $stmt->execute();
//                
//                $query1 = 'DELETE FROM affiliate_commissions WHERE commission_id =' . $row->getCommissionId();
//                $stmt = $em->getConnection()->prepare($query1);
//                $stmt->execute();
//            }
//            
//            $query1 = 'DELETE FROM event_commissions WHERE event_id =' . $id;
//            $stmt = $em->getConnection()->prepare($query1);
//            $stmt->execute();
//            
//            $em = $this->getEntityManager();
//            
//            $query1 = 'DELETE FROM inventory_event WHERE event_id =' . $id;
//            $stmt = $em->getConnection()->prepare($query1);
//            $stmt->execute();
//            
//            $query1 = 'DELETE FROM inventory_excursion WHERE event_id =' . $id;
//            $stmt = $em->getConnection()->prepare($query1);
//            $stmt->execute();
//            
//            $query1 = 'DELETE FROM inventory_item WHERE event_id =' . $id;
//            $stmt = $em->getConnection()->prepare($query1);
//            $stmt->execute();
//            
//            $query1 = 'DELETE FROM inventory_transfer WHERE event_id =' . $id;
//            $stmt = $em->getConnection()->prepare($query1);
//            $stmt->execute();
//            
//            $query1 = 'DELETE FROM inventory_deposits WHERE event_id =' . $id;
//            $stmt = $em->getConnection()->prepare($query1);
//            $stmt->execute();
//            
////            $em = $this->getEntityManager();
////                $qb = $em->createQueryBuilder();
////                $qb->delete('Base\Entity\InventoryEvent', 'u')
////		        ->where('u.eventId=:Id')
////		        ->setParameter('Id', $id);
////		$query = $qb->getQuery();
////        	$collection = $query->getResult();
////                
////		$em = $this->getEntityManager();
////                $qb = $em->createQueryBuilder();
////                $qb->delete('Base\Entity\InventoryExcursion', 'u')
////		        ->where('u.eventId=:Id')
////		        ->setParameter('Id', $id);
////		$query = $qb->getQuery();
////        	$collection = $query->getResult();
////                
////		$em = $this->getEntityManager();
////                $qb = $em->createQueryBuilder();
////                $qb->delete('Base\Entity\InventoryItem', 'u')
////		        ->where('u.eventId=:Id')
////		        ->setParameter('Id', $id);
////		$query = $qb->getQuery();
////        	$collection = $query->getResult();
////                
////		$em = $this->getEntityManager();
////                $qb = $em->createQueryBuilder();
////                $qb->delete('Base\Entity\InventoryTransfer', 'u')
////		        ->where('u.eventId=:Id')
////		        ->setParameter('Id', $id);
////		$query = $qb->getQuery();
////        	$collection = $query->getResult();
////                
////		$em = $this->getEntityManager();
////                $qb = $em->createQueryBuilder();
////                $qb->delete('Base\Entity\InventoryDeposits', 'u')
////		        ->where('u.eventId=:Id')
////		        ->setParameter('Id', $id);
////		$query = $qb->getQuery();
////        	$collection = $query->getResult();
//                
//		$em = $this->getEntityManager();
//                $qb = $em->createQueryBuilder();
//                $qb->delete('Base\Entity\Avp\EventRooms', 'u')
//		        ->where('u.eventId=:Id')
//		        ->setParameter('Id', $id);
//		$query = $qb->getQuery();
//        	$collection = $query->getResult();
//
//		$em = $this->getEntityManager();
//                $qb = $em->createQueryBuilder();
//                $qb->delete('Base\Entity\Avp\Events', 'u')
//		        ->where('u.id=:Id')
//		        ->setParameter('Id', $id);
//		$query = $qb->getQuery();
//        	$collection = $query->getResult();
//            //$em->remove($entity);        
//            $em->flush();        
//            return true;    	
//        }
        
        public function delete($id){
            $em = $this->_entityManager;        
            $entity = $em->getReference($this->_targetEntity, (int)$id);
            
             if (!empty($entity)) {
                $entity->setIsDeleted(1);

                $em->persist($entity);
                $em->flush();
            }
            
            $item = $em->getRepository('\Base\Entity\Avp\EventRooms')
                    ->findBy(
                    array(
                        'eventId' => $id
                    )
            );
            foreach($item as $row){
                $reservationEntity = $em->getRepository('\Base\Entity\Avp\Reservation')->findBy(array('roomId'=> $row->getId(),'type'=>2));
                foreach($reservationEntity as $resEntity){
                    if (!empty($resEntity)) {
                        //d($reservationEntity[0]); 
                        $resEntity->setIsDeleted(1);

                        $em->persist($resEntity);
                        $em->flush();
                    }
                }
                
                $eEntity = $em->find('\Base\Entity\Avp\EventRooms',(int)$row->getId());

                    if (!empty($eEntity)) {
                        $eEntity->setIsDeleted(1);

                        $em->persist($eEntity);
                        $em->flush();
                    }

            }
            
                $query1 = 'DELETE FROM inventory_event WHERE event_id =' . $id;
                $stmt = $em->getConnection()->prepare($query1);
                $stmt->execute();

                $query1 = 'DELETE FROM inventory_excursion WHERE event_id =' . $id;
                $stmt = $em->getConnection()->prepare($query1);
                $stmt->execute();

                $query1 = 'DELETE FROM inventory_item WHERE event_id =' . $id;
                $stmt = $em->getConnection()->prepare($query1);
                $stmt->execute();

                $query1 = 'DELETE FROM inventory_transfer WHERE event_id =' . $id;
                $stmt = $em->getConnection()->prepare($query1);
                $stmt->execute();

                $query1 = 'DELETE FROM inventory_deposits WHERE event_id =' . $id;
                $stmt = $em->getConnection()->prepare($query1);
                $stmt->execute();
                
                $query1 = 'DELETE FROM inventory_leads WHERE event_id =' . $id;
                $stmt = $em->getConnection()->prepare($query1);
                $stmt->execute();
                
                $query1 = 'DELETE FROM leads WHERE type=2 AND typename =' . $id;
                $stmt = $em->getConnection()->prepare($query1);
                $stmt->execute();
                
                $query1 = 'DELETE FROM vouchers WHERE link_to_type=2 AND link_to_type_name  =' . $id;
                $stmt = $em->getConnection()->prepare($query1);
                $stmt->execute();

        }
        
        /*
         * get all rooms wrt resort id
         */
        public function getRooms($data) {

        $em = $this->_serviceManager->get('doctrine.entitymanager.orm_avp');
        $query = $em->createQuery('select rr.id as roomId,rr.title as roomTitle,rr.price as roomPrice from \Base\Entity\Avp\ResortRooms rr WHERE rr.resortId = '.$data["resortId"]);
        $results = $query->getResult();
        return $results;
    }
        
        /*
         * get all rooms wrt event id
         */
        public function getEventRooms(){
        $em = $this->_serviceManager->get('doctrine.entitymanager.orm_avp');
        $query = $em->createQuery('select rr.id as roomId,rr.title as roomTitle,er.price as roomPrice from \Base\Entity\Avp\EventRooms er,\Base\Entity\Avp\ResortRooms rr WHERE er.eventId = '.$data["eventId"]);
        $results = $query->getResult();
        return $results;
        }


        public function saveEventRooms($results){
        if($this->isValidEventRoomTitle($results)){
        $em = $this->_entityManager; 
        $entity = '\Base\Entity\Avp\EventRooms';

        $rooms = array();
        $object = new $entity;
            $room = $em->find('Base\Entity\Avp\ResortRooms', (int) $results['roomId']);
            $object->setRoomId($room);
            $object->setEventId($results['eventId']);
            if($results['price']==0 || $results['price']==""){
                $object->setRoomPrice(0);
            }else{
                $object->setRoomPrice($results['price']);
            }
            $object->setRoomCategory($results['roomCategory']);
            $object->setAddedOn(new \DateTime);
            $object->setStatus(1);

            $em->persist($object);
            $em->flush();
            
            //prepare data for saved rooms
            $data = array();
            $data['name'] = $object->getRoomCategory();
            $data['price'] = $object->getRoomPrice();
            
            $msg = array("msg"=>"Saved",'item'=>$data);
            return $msg;
        }else{
            $msg = array("msg"=>"This Room is already added to this event");
            return $msg;
        }
    }
    
    protected function isValidEventRoomTitle($results) {
        $em = $this->_entityManager;
        $item = $em->getRepository('\Base\Entity\Avp\EventRooms')
                ->findBy(
                array(
                    'roomCategory' => $results['roomCategory'],
                    'roomId' => $results['roomId'],
                    'eventId' => $results['eventId']
                )
        );
        if(!empty($item)){
                return false;
        }
        return true;
    }
    
     public function getUserObject($id) {
        // d($id);
        $em = $this->_entityManager;
        $item = $em->find('Base\Entity\Users', (int) $id);
        if(empty($item)){
                return false;
        }
        return $item;
    }
    
    public function getResortRooms($eventId){
        $em = $this->_entityManager;
        $event = $em->find('Base\Entity\Avp\Events', (int) $eventId);
//        d($event->getResortId());
        
        $resortRooms = $em->getRepository('\Base\Entity\Avp\ResortRooms')
                ->findBy(
                array(
                    'resortId' => $event->getResortId(),
                    'isDeleted' => 0,
                )
        );
        
        return $resortRooms;
    }
    public function getEventtRooms($eventId){
        $em = $this->_entityManager;
        $eventRooms = $em->getRepository('\Base\Entity\Avp\EventRooms')
                ->findBy(
                array(
                    'eventId' => $eventId,
                    'isDeleted' => 0
                )
        );
        
        return $eventRooms;
    }
    
    public function saveEventtRooms($data,$eventId){
        $em = $this->getEntityManager();

        $qb = $em->createQueryBuilder();

        $item = $em->getRepository('\Base\Entity\Avp\EventRooms')
                ->findBy(
                array(
                    'eventId' => $eventId
                )
        );
        
        //d($data);
        if(isset($data['roomId'])){
            foreach ($data['roomId'] as $roomId){
                foreach($item as $row){
                    if($roomId == $row->getRoomId()->getId() && $row->getIsDeleted()== 0){
                        $flag=1;
                        break;
                    }else{
                        $flag=0;
                    }

                }
                if($flag==0){
                        $inArr[]=$roomId;
                    }
            }
        }
        $i=0;
        foreach($item as $row){
            if(isset($data['roomId'])){
            foreach ($data['roomId'] as $roomId){
                if($roomId == $row->getRoomId()->getId() ){
                    $flag=1;
                    break;
                }else{
                    $flag=0;
                }
                
            }
            }else{
                $flag = 0;
            }
            if($flag==0){
                    $delArr[$i]['room_id']=$row->getRoomId()->getId();
                    $delArr[$i]['id']=$row->getId();
                    $i++;
                }
        }

        // Insert New Rooms 
       // d($inArr);
        if(!empty($inArr)){
            
         foreach($inArr as $insertId){
            $room = $em->find('Base\Entity\Avp\ResortRooms', (int) $insertId);
            $em = $this->getEntityManager();
            $entity = new \Base\Entity\Avp\EventRooms;
            
            $Insertentity = $em->getRepository('\Base\Entity\Avp\EventRooms')
               ->findBy(
                array(
                    'eventId' => $eventId,
                    'roomId' => $room
               )
        );
            if($Insertentity){
                $entity = $Insertentity[0];
            }
            
            $date = getdate();
            $entity->setRoomId($room);
            $entity->setEventId($eventId);
            $entity->setRoomPrice('0');
            $entity->setRoomPriceCad('0');
            $entity->setRoomCategory($room->getTitle());
            $entity->setAddedOn(new \DateTime);
            $entity->setStatus('1');
            $entity->setIsDeleted(0);

            $em->persist($entity);
            $em->flush();
         }
        }

        if(!empty($delArr)){
         foreach($delArr as $delId){
            $query1 = 'UPDATE reservation SET is_deleted=1  WHERE room_id =' . $delId['id'];
            $stmt = $em->getConnection()->prepare($query1);
            $stmt->execute();

//            $query1 = 'UPDATE reservation_event_room SET is_deleted=1  WHERE event_room_id =' . $delId['id'];
//            $stmt = $em->getConnection()->prepare($query1);
//            $stmt->execute();
            
            $em = $this->getEntityManager();
            $query1 = 'DELETE FROM inventory_event WHERE room_id =' . $delId['id'] . ' AND event_id ='.$eventId;
            $stmt = $em->getConnection()->prepare($query1);
            $stmt->execute();
            
//            $em = $this->getEntityManager();
//            $query1 = 'DELETE FROM event_rooms WHERE id =' . $delId['id'];
//            $stmt = $em->getConnection()->prepare($query1);
//            $stmt->execute();
            
            $em = $this->getEntityManager();
            $query1 = 'UPDATE event_rooms SET is_deleted=1 WHERE id =' . $delId['id'];
            $stmt = $em->getConnection()->prepare($query1);
            $stmt->execute();
         }
        }
//        $item = $em->getRepository('\Base\Entity\Avp\EventRooms')
//                ->findBy(
//                array(
//                    'eventId' => $eventId
//                )
//        );
//        foreach($item as $row){
//            $query1 = 'DELETE FROM reservation WHERE room_id =' . $row->getId();
//            $stmt = $em->getConnection()->prepare($query1);
//            $stmt->execute();
//
//            $query1 = 'DELETE FROM reservation_event_room WHERE event_room_id =' . $row->getId();
//            $stmt = $em->getConnection()->prepare($query1);
//            $stmt->execute();
//        }
//            
//        $qb->delete('Base\Entity\Avp\EventRooms', 'u')
//                ->where('u.eventId=:Id')
//                ->setParameter('Id', $eventId);
//        $query = $qb->getQuery();
//        $collection = $query->getResult();
//        
//        $em = $this->getEntityManager();
//        $query1 = 'DELETE FROM inventory_event WHERE event_id =' . $eventId;
//        $stmt = $em->getConnection()->prepare($query1);
//        $stmt->execute();
//        
//        foreach ($data['roomId'] as $roomId){
//            $room = $em->find('Base\Entity\Avp\ResortRooms', (int) $roomId);
//            $em = $this->getEntityManager();
//            $entity = new \Base\Entity\Avp\EventRooms;
//
//            $date = getdate();
//            $entity->setRoomId($room);
//            $entity->setEventId($eventId);
//            $entity->setRoomPrice('0');
//            $entity->setRoomPriceCad('0');
//            $entity->setRoomCategory($room->getTitle());
//            $entity->setAddedOn(new \DateTime);
//            $entity->setStatus('1');
//            $em->persist($entity);
//            $em->flush();
//        }
    }
    
    public function getTypeData($type, $id){
//        d($id);
        switch($type){
            case 1:
                $em = $this->getEntityManager();
                $data = $em->getRepository('\Base\Entity\Avp\Resorts')->findById($id);
//                $data = $em->find('Base\Entity\Avp\Resorts', (int) $id);
                break;
            case 2:
                $em = $this->getEntityManager();
                $data = $em->getRepository('\Base\Entity\Avp\Events')->findById($id);
                break;
            case 3:
                $em = $this->getEntityManager();
                $data = $em->getRepository('\Base\Entity\Avp\Cruises')->findById($id);
                break;
        }
//        d($data);
        return $data;
    }
    
    public function saveCommission($data){
        $em = $this->getEntityManager();
            $entity = new \Base\Entity\Avp\Commissions;

            $entity->setAmount($data['amount']);
            $entity->setCommissionFor($data['type']);
            $entity->setDescription('-');
            $entity->setType($data['commissionType']);
            $entity->setStatus('1');
            $entity->setDateAdded(new \DateTime);
            $entity->setUpdatedOn(new \DateTime);
            $entity->setGeneral('1');
            $em->persist($entity);
            $em->flush();
            
            $commissionId=$entity->getId();
        switch($data['type']){
            case 1:
                $em = $this->getEntityManager();
                $entity = new \Base\Entity\Avp\ResortCommissions;

                $entity->setResortId($data['typeId']);
                $entity->setCommissionId($commissionId);
                $em->persist($entity);
                $em->flush();
                break;
            case 2:
                $em = $this->getEntityManager();
                $entity = new \Base\Entity\Avp\EventCommissions;

                $entity->setEventId($data['typeId']);
                $entity->setCommissionId($commissionId);
                $em->persist($entity);
                $em->flush();
                break;
            case 3:
                $em = $this->getEntityManager();
                $entity = new \Base\Entity\Avp\CruiseCommission;

                $entity->setCruiseId($data['typeId']);
                $entity->setCommissionId($commissionId);
                $em->persist($entity);
                $em->flush();
                break;
        }
    }
    
    public function getTypeCommission($type, $id){
        $em = $this->getEntityManager();
        $data = $em->getRepository('\Base\Entity\Avp\Commissions')->findBy(array('general'=>'1'));
        foreach($data as $row){
            switch($row->getCommissionFor()){
                case 1:
                    $resortCommission = $em->getRepository('\Base\Entity\Avp\ResortCommissions')->findOneBy(array('commissionId' => $row->getId()));
                        if ($resortCommission) {
                            if ($resortCommission->getResortId() == $id) {
                                $return=$row;
                            }
                        }
                    break;
                case 2:
                    $eventCommission = $em->getRepository('\Base\Entity\Avp\EventCommissions')->findOneBy(array('commissionId' => $row->getId()));
                        if ($eventCommission) {
                            if ($eventCommission->getEventId() == $id) {
                                $return=$row;
                            }
                        }
                    break;
                case 3:
                    $cruiseCommission = $em->getRepository('\Base\Entity\Avp\CruiseCommission')->findOneBy(array('commissionId' => $row->getId()));
                        if ($cruiseCommission) {
                            if ($cruiseCommission->getCruiseId() == $id) {
                                $return=$row;
                            }
                        }
                    break;
            }
        }
        
        return $return;
    }
} 
