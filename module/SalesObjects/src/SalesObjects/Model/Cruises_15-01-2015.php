<?php
 
namespace SalesObjects\Model;

use Zend\InputFilter\Factory as InputFactory;     // <-- Add this import
use Zend\InputFilter\InputFilter;                 // <-- Add this import
use Zend\InputFilter\InputFilterAwareInterface;   // <-- Add this import
use Zend\InputFilter\InputFilterInterface;        // <-- Add this import


class Cruises extends \Base\Model\AvpModel implements InputFilterAwareInterface{
	
	protected $inputFilter;
        protected $_maxImageSize = 2097152;             //2*1024*1024 = 2Mb
	
        public function getImagePath(){
            return \Base\Model\Plugins\Imagine::$imagesBaseUrl.'cruise/thumbnails_80x80/'; 
        }
        
        protected $_imageOptions = array(
            //img 80x80
            array(
            'options' => array('width'=>80, 'height'=>80), 
            'destination' => 'cruise/thumbnails_80x80/'
            ),                       
            //img 150x150
            array(
            'options' => array('width'=>150, 'height'=>150), 
            'destination' => 'cruise/thumbnails_150x150/'
            ),
            //img 158x106
            array(
            'options' => array('width'=>158, 'height'=>106), 
            'destination' => 'cruise/thumbnails_158x106/'
            ),
            //img 202x144
            array(
            'options' => array('width'=>202, 'height'=>144), 
            'destination' => 'cruise/thumbnails_202x144/'
            ),
            //img 288x196
            array(
            'options' => array('width'=>288, 'height'=>196), 
            'destination' => 'cruise/thumbnails_288x196/'
            ),
            //img 288x161
            array(
            'options' => array('width'=>288, 'height'=>161), 
            'destination' => 'cruise/thumbnails_288x161/'
            ),
            //img 701x456
            array(
            'options' => array('width'=>701, 'height'=>456), 
            'destination' => 'cruise/image_701x456/'
            ),
            //img 957x381
            array(
            'options' => array('width'=>957, 'height'=>381), 
            'destination' => 'cruise/slider_957x381/'
            ),                       
            //img small 250x250
            array(
            'options' => array('width'=>250, 'height'=>250), 
            'destination' => 'cruise/small/'
            ),
            //img large 800x600
            array(
            'options' => array('width'=>800, 'height'=>600), 
            'destination' => 'cruise/large/'
            ),
            //img 701x456
            array(
            'options' => array('width'=>701, 'height'=>456), 
            'destination' => 'cruise/slider_701x456/'
            ),
            //img
            array(
            'options' => null, 
            'destination' => 'cruise/'
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
											'max'      => 255,
									),
							),
					),
			)));
			
			$inputFilter->add($factory->createInput(array(
					'name'     => 'overview',
					'required' => false,
					'filters'  => array(							
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name'    => 'StringLength',
									'options' => array(
											'encoding' => 'UTF-8',
											'min'      => 0,
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
                        
                        $inputFilter->add($factory->createInput(array(
					'name'     => 'tourStartDate',
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
					'name'     => 'tourEndDate',
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
											'max'      => 244,
									),
							),
					),
			)));
						
			$inputFilter->add($factory->createInput(array(
					'name'     => 'categoryId',
					'required' => false,										
			)));
			
			$inputFilter->add($factory->createInput(array(
					'name'     => 'countryId',
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
											'min'      => 2,
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
											'min'      => 2,
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
											'min'      => 2,
											'max'      => 255,
									),
							),
					),
			)));
                                                
			$inputFilter->add($factory->createInput(array(
					'name'     => 'status',
					'required' => true,
			)));
																		
	
			$this->inputFilter = $inputFilter;
		}
	
		return $this->inputFilter;
	}
	
	protected function isValidDates($object){
		
		$sdate = $object->getData()->getTourStartDate()->getTimestamp();
		$edate = $object->getData()->getTourEndDate()->getTimestamp();
		if($sdate >= $edate){
			$object->get('tourStartDate')->setMessages(array('Tour Start Date should be lesser than End Date.'));
			return false;
		}		
		return true;
	}
	
	protected function isValidTitle($object){
		if($this->checkItem(array('title'=>$object->getData()->getTitle()))){
			$object->get('title')->setMessages(array('This cruise already exists'));
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
				'title'=>$object->getData()->getTitle()))
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
        
        public function getCollection($sort = false){    	
           $order_by = 'ASC';
                if ($sort) {
                    $order_by = 'DESC';
                }
                $em = $this->_serviceManager->get('doctrine.entitymanager.orm_avp');
                $qb = $em->createQueryBuilder();                
                $qb->select('c')
                    ->from('\Base\Entity\Avp\Cruises', 'c')
                    ->where('c.isDeleted = 0')
                    ->orderBy('c.id', $order_by);
                $query = $qb->getQuery();
                $results = $query->getResult();
                return $results;     
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
            parent::save($obj);              
            $this->saveImages($object['files']['image']['tmp_name'], $obj->getImage());
            
	}
	
//        public function delete($id){
//    	            
//            $em = $this->_entityManager;        
//            $entity = $em->getReference($this->_targetEntity, (int)$id);      
//            
//            
//            $item = $em->getRepository('\Base\Entity\Avp\CruiseCabins')
//                    ->findBy(
//                    array(
//                        'cruiseId' => $id
//                    )
//            );
//            foreach($item as $row){
//                $query1 = 'DELETE FROM reservation WHERE type=3 AND room_id =' . $row->getId();
//                $stmt = $em->getConnection()->prepare($query1);
//                $stmt->execute();
//                
//                $query1 = 'DELETE FROM reservation_cruise_cabin WHERE cabin_id =' . $row->getId();
//                $stmt = $em->getConnection()->prepare($query1);
//                $stmt->execute();
//            }
//            
//            $item = $em->getRepository('\Base\Entity\Avp\CruiseCommission')->findBy(array('cruiseId' => $id));
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
//            
//            //delete images
//            $this->deleteImages($entity->getImage());
//            
//            $query = $em->createQuery('SELECT c.deckImageUrl AS image FROM \Base\Entity\Avp\CruiseCabins c WHERE c.cruiseId = :id');
//            $query->setParameter('id', $id);
//            $result = $query->getResult();  
//            //delete all cruise cabins
//            $cabins= new Cabins($this->_serviceManager);
//            foreach($result as $item){                
//                $cabins->deleteImages($item['image']);                
//            }  
//            $cabins = null;
//            //delete all cruise cabins
//            
//            $em = $this->getEntityManager();
//            
//            $query1 = 'DELETE FROM inventory_cruise WHERE cruise_id =' . $id;
//            $stmt = $em->getConnection()->prepare($query1);
//            $stmt->execute();
//            
//            $query1 = 'DELETE FROM inventory_excursion WHERE cruise_id =' . $id;
//            $stmt = $em->getConnection()->prepare($query1);
//            $stmt->execute();
//            
//            $query1 = 'DELETE FROM inventory_item WHERE cruise_id =' . $id;
//            $stmt = $em->getConnection()->prepare($query1);
//            $stmt->execute();
//            
//            $query1 = 'DELETE FROM inventory_transfer WHERE cruise_id =' . $id;
//            $stmt = $em->getConnection()->prepare($query1);
//            $stmt->execute();
//            
//            $query1 = 'DELETE FROM inventory_deposits WHERE cruise_id =' . $id;
//            $stmt = $em->getConnection()->prepare($query1);
//            $stmt->execute();
//            
//            $em = $this->getEntityManager();
//                $qb = $em->createQueryBuilder();
//                $qb->delete('Base\Entity\Avp\CruiseCabins', 'u')
//		        ->where('u.cruiseId=:Id')
//		        ->setParameter('Id', $id);
//		$query = $qb->getQuery();
//        	$collection = $query->getResult();
//                
//            $em = $this->getEntityManager();
//                $qb = $em->createQueryBuilder();
//                $qb->delete('Base\Entity\Avp\CruisePorts', 'u')
//		        ->where('u.cruiseId=:Id')
//		        ->setParameter('Id', $id);
//		$query = $qb->getQuery();
//        	$collection = $query->getResult();
//                
//                $em = $this->getEntityManager();
//                $qb = $em->createQueryBuilder();
//                $qb->delete('Base\Entity\Avp\Cruises', 'u')
//		        ->where('u.id=:Id')
//		        ->setParameter('Id', $id);
//		$query = $qb->getQuery();
//        	$collection = $query->getResult();
//                
////            $query = $em->createQuery('DELETE FROM \Base\Entity\Avp\CruiseCabins c WHERE c.cruiseId = :id');
////            $query->setParameter('id', $id);
////            $query->getResult();      
////            //delete all cruise ports
////            $query = $em->createQuery('DELETE FROM \Base\Entity\Avp\CruisePorts p WHERE p.cruiseId = :id');
////            $query->setParameter('id', $id);
////            $query->getResult();             
////            //delete cruise
////            $em->remove($entity);        
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
            
            $item = $em->getRepository('\Base\Entity\Avp\CruiseCabins')
                    ->findBy(
                    array(
                        'cruiseId' => $id
                    )
            );
            foreach($item as $row){
                $reservationEntity = $em->getRepository('\Base\Entity\Avp\Reservation')->findBy(array('roomId'=> $row->getId(),'type'=>3));
                foreach($reservationEntity as $resEntity){
                    if (!empty($resEntity)) {
                        //d($reservationEntity[0]); 
                        $resEntity->setIsDeleted(1);

                        $em->persist($resEntity);
                        $em->flush();
                    }
                }
            }
            
                $query1 = 'DELETE FROM inventory_cruise WHERE cruise_id =' . $id;
                $stmt = $em->getConnection()->prepare($query1);
                $stmt->execute();

                $query1 = 'DELETE FROM inventory_excursion WHERE cruise_id =' . $id;
                $stmt = $em->getConnection()->prepare($query1);
                $stmt->execute();

                $query1 = 'DELETE FROM inventory_item WHERE cruise_id =' . $id;
                $stmt = $em->getConnection()->prepare($query1);
                $stmt->execute();

                $query1 = 'DELETE FROM inventory_transfer WHERE cruise_id =' . $id;
                $stmt = $em->getConnection()->prepare($query1);
                $stmt->execute();

                $query1 = 'DELETE FROM inventory_deposits WHERE cruise_id =' . $id;
                $stmt = $em->getConnection()->prepare($query1);
                $stmt->execute();
                
                $query1 = 'DELETE FROM inventory_leads WHERE cruise_id =' . $id;
                $stmt = $em->getConnection()->prepare($query1);
                $stmt->execute();
                
                $query1 = 'DELETE FROM leads WHERE type=3 AND typename =' . $id;
                $stmt = $em->getConnection()->prepare($query1);
                $stmt->execute();
                
                $query1 = 'DELETE FROM vouchers WHERE link_to_type=3 AND link_to_type_name  =' . $id;
                $stmt = $em->getConnection()->prepare($query1);
                $stmt->execute();

        }
} 
