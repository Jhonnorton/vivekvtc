<?php

namespace SalesObjects\Model;

use Zend\InputFilter\Factory as InputFactory;     // <-- Add this import
use Zend\InputFilter\InputFilter;                 // <-- Add this import
use Zend\InputFilter\InputFilterAwareInterface;   // <-- Add this import
use Zend\InputFilter\InputFilterInterface;        // <-- Add this import

class Rooms extends \Base\Model\AvpModel implements InputFilterAwareInterface{
	
	protected $inputFilter;
        protected $_maxImageSize = 2097152;             //2*1024*1024 = 2Mb
	
        public function getImagePath(){
            return \Base\Model\Plugins\Imagine::$imagesBaseUrl.'resortroom/thumbnails_80x80/'; 
        }
        
        protected $_imageOptions = array(
            //img 80x80
            array(
            'options' => array('width'=>80, 'height'=>80), 
            'destination' => 'resortroom/thumbnails_80x80/'
            ),                       
            //img 150x150
            array(
            'options' => array('width'=>150, 'height'=>150), 
            'destination' => 'resortroom/thumbnails_150x150/'
            ),
            //img 150x93
            array(
            'options' => array('width'=>150, 'height'=>93), 
            'destination' => 'resortroom/thumbnails_150x93/'
            ),            
            //img small 250x250
            array(
            'options' => array('width'=>250, 'height'=>250), 
            'destination' => 'resortroom/small/'
            ),
            //img large 800x600
            array(
            'options' => array('width'=>800, 'height'=>600), 
            'destination' => 'resortroom/large/'
            ),
            //img
            array(
            'options' => null, 
            'destination' => 'resortroom/'
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
					'required' => false,
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
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name'    => 'StringLength',
									'options' => array(
											'encoding' => 'UTF-8',
											'min'      => 2,
												
									),
							),
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
											'max'      => 39,
									),
							),
					),
			)));

			$this->inputFilter = $inputFilter;
		}
	
		return $this->inputFilter;
	}
	
	public function isValidModel($object){
	
		if($this->checkItem(array(
				'title'=>$object->getData()->getTitle(),
				'resortId'=>$object->getData()->getResortId(),
		))){
			$object->get('title')->setMessages(array('The room already exists'));
			$object->get('resortId')->setMessages(array('The room already exists'));			
                        return false;
		}
		return true;
                
	}
	
	public function isValidModelOnEdit($object){
		
                if($this->checkItem(array(
				'id'=>$object->getData()->getId(),
				'title'=>$object->getData()->getTitle(),
				'resortId'=>$object->getData()->getResortId()))
		){
			return true;
		} else {
			return $this->isValidModel($object);
		}
	}
        
        public function getRoomsCollection($sort = false){    	
            $order_by = 'ASC';
            if ($sort) {
                $order_by = 'DESC';
            }
            $em = $this->_serviceManager->get('doctrine.entitymanager.orm_avp');
            $query = $em->createQuery('SELECT rr.id AS roomId, rr.title AS roomTitle, rr.image AS roomImage, rr.price As roomPrice, rr.inStock As roomInStock,  r.title AS resortTitle, r.id AS resortId'.
                    ' FROM \Base\Entity\Avp\ResortRooms rr, \Base\Entity\Avp\Resorts r'.
                    ' WHERE rr.resortId=r.id AND r.isDeleted=0 AND rr.isDeleted=0 ORDER BY rr.id '.$order_by);            
            $results = $query->getResult();
            return $results;        
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
        
        public function deleteImages($imageName){
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
            parent::save($obj);              
            $this->saveImages($object['files']['image']['tmp_name'], $obj->getImage());            
	}
        
        public function delete($id){
            
//            $em = $this->_entityManager;        
//            
//            $query1 = 'DELETE FROM reservation WHERE type=1 AND room_id =' . $id;
//            $stmt = $em->getConnection()->prepare($query1);
//            $stmt->execute();
//
//            $query1 = 'DELETE FROM reservation_resort_room WHERE room_id =' . $id;
//            $stmt = $em->getConnection()->prepare($query1);
//            $stmt->execute();
////            
////            $room = $em->find('Base\Entity\Avp\ResortRooms', (int) $id);
////            $item = $em->getRepository('\Base\Entity\Avp\ResortCommissions')->findBy(array('resortId' => $room->getResortId()));
////            foreach($item as $row){
////                $query1 = 'DELETE FROM commissions WHERE id =' . $row->getCommissionId();
////                $stmt = $em->getConnection()->prepare($query1);
////                $stmt->execute();
////                
////                $query1 = 'DELETE FROM affiliate_commission_rel WHERE commission_id =' . $row->getCommissionId();
////                $stmt = $em->getConnection()->prepare($query1);
////                $stmt->execute();
////                
////                $query1 = 'DELETE FROM affiliate_commissions WHERE commission_id =' . $row->getCommissionId();
////                $stmt = $em->getConnection()->prepare($query1);
////                $stmt->execute();
////            }
//                
//            $entity = $em->getReference($this->_targetEntity, (int)$id);                        
//            //delete images
//            $this->deleteImages($entity->getImage());                        
//            //delete resort
//            $em->remove($entity);        
//            $em->flush();        
//            return true;    	
            
            $em = $this->_entityManager;        
            $entity = $em->getReference($this->_targetEntity, (int)$id);
            
             if (!empty($entity)) {
                $entity->setIsDeleted(1);

                $em->persist($entity);
                $em->flush();
            }
            
            //deleting inventory resort rooms
            
            $query1 = 'DELETE FROM inventory_hotels WHERE room_id =' . $id;
            $stmt = $em->getConnection()->prepare($query1);
            $stmt->execute();
            
            //deleting resort rooms reservations
            
             $reservationEntity = $em->getRepository('\Base\Entity\Avp\Reservation')->findBy(array('roomId'=> $id,'type'=>1));

                if($reservationEntity):
                    foreach($reservationEntity as $resEntity){
                           if (!empty($resEntity)) {
                               $resEntity->setIsDeleted(1);

                               $em->persist($resEntity);
                               $em->flush();
                           }
                       }
                endif;
                
             // deleting event rooms associated with this room
                $em = $this->_serviceManager->get('doctrine.entitymanager.orm_avp');
                $qb = $em->createQueryBuilder();

                  $qb->select('er')
                        ->from('\Base\Entity\Avp\EventRooms', 'er')
                        ->leftJoin('er.roomId', 'rr')
                        ->andWhere('rr.id =:id')
                        ->setParameter('id',$id);
                  $query = $qb->getQuery();
                  $collection = $query->getResult();
                  //d($collection);
                  foreach($collection as $row){
                      
                   $entity = $em->find('\Base\Entity\Avp\EventRooms', (int)$row->getId());
            
                    if (!empty($entity)) {
                       $entity->setIsDeleted(1);

                       $em->persist($entity);
                       $em->flush();
                   }
                    //delete event rooms reservations  
                    $reservationEntity = $em->getRepository('\Base\Entity\Avp\Reservation')->findBy(array('roomId'=> $row->getId(),'type'=>2));
                    if($reservationEntity):
                        foreach($reservationEntity as $resEntity){
                            if (!empty($resEntity)) {
                                $resEntity->setIsDeleted(1);

                                $em->persist($resEntity);
                                $em->flush();
                            }
                        }
                    endif;
                    
                    //deleting inventory event rooms
                    
                        $ids = $row->getId();
                        d($ids);
                        $query1 = 'DELETE FROM inventory_event WHERE room_id =' . $ids;
                        $stmt = $em->getConnection()->prepare($query1);
                        $stmt->execute();
   
                }

        }  
	
}