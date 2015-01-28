<?php
 
namespace SalesObjects\Model;

use Zend\InputFilter\Factory as InputFactory;     // <-- Add this import
use Zend\InputFilter\InputFilter;                 // <-- Add this import
use Zend\InputFilter\InputFilterAwareInterface;   // <-- Add this import
use Zend\InputFilter\InputFilterInterface;        // <-- Add this import


class Cabins extends \Base\Model\AvpModel implements InputFilterAwareInterface{
	
	protected $inputFilter;
        protected $_maxImageSize = 2097152;             //2*1024*1024 = 2Mb


        public function getImagePath(){
            return \Base\Model\Plugins\Imagine::$imagesBaseUrl.'deck/thumbnails_80x80/'; 
        }
        
        protected $_imageOptions = array(
            //img 80x80
            array(
            'options' => array('width'=>80, 'height'=>80), 
            'destination' => 'deck/thumbnails_80x80/'
            ),                       
            //img 150x150
            array(
            'options' => array('width'=>150, 'height'=>150), 
            'destination' => 'deck/thumbnails_150x150/'
            ),                     
            //img small 250x250
            array(
            'options' => array('width'=>250, 'height'=>250), 
            'destination' => 'deck/small/'
            ),
            //img large 800x600
            array(
            'options' => array('width'=>800, 'height'=>600), 
            'destination' => 'deck/large/'
            ),
            //img
            array(
            'options' => null, 
            'destination' => 'deck/'
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
					'name'     => 'cruiseId',
					'required' => true,
                                        'filters'  => array(
						array('name' => 'Int'),
					),
						
			)));
                        
			$inputFilter->add($factory->createInput(array(
					'name'     => 'deckNumber',
					'required' => true,
					'filters'  => array(
						array('name' => 'Int'),
					),
			)));
                        
                        $inputFilter->add($factory->createInput(array(
					'name'     => 'deckName',
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
					
			)));
			
			$inputFilter->add($factory->createInput(array(
					'name'     => 'deckImageUrl',
					'required' => false,
					'filters'  => array(
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name'    => 'StringLength',
									'options' => array(
											'encoding' => 'UTF-8',
											'max'      => 244,
									),
							),
					),
			)));                                                
                        
			$this->inputFilter = $inputFilter;
		}
	
		return $this->inputFilter;
	}
        
         public function getCabinsCollection($sort = false){    	
                $order_by = 'ASC';
                if ($sort) {
                    $order_by = 'DESC';
                }
                $em = $this->_serviceManager->get('doctrine.entitymanager.orm_avp');
                $qb = $em->createQueryBuilder();                
                $qb->select(array('c.id AS id',
                    'c.deckImageUrl AS image', 
                    'c.deckNumber AS deckNumber', 
                    'c.deckName AS deckName', 
                    'c.description AS description', 
                    'c.cruiseId AS cruiseId',
                    'c.price As price', 
                    'c.inStock As inStock',
                    'cr.title AS cruiseTitle'))
                    ->from('\Base\Entity\Avp\CruiseCabins', 'c')
                    ->leftJoin('\Base\Entity\Avp\Cruises', 'cr', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'c.cruiseId = cr.id') 
                    ->where('cr.isDeleted =:deleted')
                    ->setParameter('deleted',0)
                    ->andWhere('c.isDeleted =:deleted')
                    ->setParameter('deleted',0)
                    ->orderBy('c.id', $order_by);
                $query = $qb->getQuery();
                $results = $query->getResult();
                return $results;        
        }
	
	public function isValidModel($object){
				
		if($this->checkItem(array(
				'deckName'=>$object->getData()->getDeckName(),
				'cruiseId'=>$object->getData()->getCruiseId(),
		))){
			$object->get('deckName')->setMessages(array('This cabin already exists'));			
			return false;
		}
		return true;
	}
	
	public function isValidModelOnEdit($object){
		if($this->checkItem(array(
				'id'=>$object->getData()->getId(),
				'deckName'=>$object->getData()->getDeckName(),
				'cruiseId'=>$object->getData()->getCruiseId()))
		){
			return true;
		} else {
			return $this->isValidModel($object);
		}
	}	
        
        public function isValidImage($form, $files){                         
            if(empty($files['deckImageUrl']['name']))
                return true;             
            $size = (int)$files['deckImageUrl']['size'];
            if($size == 0 || $this->_maxImageSize < $size){
                $form->get('deckImageUrl')->setMessages(array('Max size 2 Mb'));
                return false;
            }
            $types = array('image/gif', 'image/png', 'image/jpeg', 'image/pjpeg');
            if (!in_array($files['deckImageUrl']['type'], $types)){
                $form->get('deckImageUrl')->setMessages(array('Invalid file type. Upload images: *.gif, *.png, *.jpg'));
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
            if($obj->getDeckImageUrl()!== $tmpImage){
                $this->deleteImages($tmpImage);      
                $this->save($object);
                
            }else{
                parent::save($obj);
            }            
        }
	
	public function save($object){

            $obj = $object['object'];    
			$date = getdate();        
            $obj->setDeckImageUrl($date[0].'-'.$obj->getDeckImageUrl());            
            parent::save($obj);              
            $this->saveImages($object['files']['deckImageUrl']['tmp_name'], $obj->getDeckImageUrl());            
	}
        
        public function delete($id){
            
//            $em = $this->_entityManager;        
//            $entity = $em->getReference($this->_targetEntity, (int)$id);                        
//            //delete images
//            $this->deleteImages($entity->getDeckImageUrl());                        
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
            
            //deleting inventory cruise rooms
            
            $query1 = 'DELETE FROM inventory_cruise WHERE suite_id =' . $id;
            $stmt = $em->getConnection()->prepare($query1);
            $stmt->execute();
            
            //deleting cabins reservations
            
             $reservationEntity = $em->getRepository('\Base\Entity\Avp\Reservation')->findBy(array('roomId'=> $id,'type'=>3));

                if($reservationEntity):
                    foreach($reservationEntity as $resEntity){
                           if (!empty($resEntity)) {
                               $resEntity->setIsDeleted(1);

                               $em->persist($resEntity);
                               $em->flush();
                           }
                       }
                endif;
        }
} 
