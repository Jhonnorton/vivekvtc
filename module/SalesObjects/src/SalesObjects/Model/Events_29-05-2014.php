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
                    'ec.name AS eventCategory',
                    'r.title AS resortTitle'))
                    ->from('\Base\Entity\Avp\Events', 'e')
                    ->leftJoin('\Base\Entity\Avp\Resorts', 'r', \Doctrine\ORM\Query\Expr\Join::LEFT_JOIN, 'e.resortId = r.id')     
                    ->innerJoin('\Base\Entity\Avp\EventCategories', 'ec', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN, 'e.eventCategoryId = ec.id')     
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
            parent::save($obj);              
            $this->saveImages($object['files']['image']['tmp_name'], $obj->getImage());
            
	}
        
        public function delete($id){
            
            $em = $this->_entityManager;        
            $entity = $em->getReference($this->_targetEntity, (int)$id);                        
            //delete images
            $this->deleteImages($entity->getImage());                        
            //delete resort
            $em->remove($entity);        
            $em->flush();        
            return true;    	
        }
} 
