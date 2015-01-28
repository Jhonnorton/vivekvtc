<?php

namespace SalesObjects\Model;

use Zend\InputFilter\Factory as InputFactory;     // <-- Add this import
use Zend\InputFilter\InputFilter;                 // <-- Add this import
use Zend\InputFilter\InputFilterAwareInterface;   // <-- Add this import
use Zend\InputFilter\InputFilterInterface;        // <-- Add this import

class Resorts extends \Base\Model\AvpModel implements InputFilterAwareInterface{
	
	protected $inputFilter;
        protected $_maxImageSize = 2097152;             //2*1024*1024 = 2Mb
        
        public function getImagePath(){
            return \Base\Model\Plugins\Imagine::$imagesBaseUrl.'resort/thumbnails_80x80/'; 
        }
        
        protected $_imageOptions = array(
            //img 80x80
            array(
            'options' => array('width'=>80, 'height'=>80), 
            'destination' => 'resort/thumbnails_80x80/'
            ),
            //img 91x65
            array(
            'options' => array('width'=>91, 'height'=>65), 
            'destination' => 'resort/thumbnails_91x65'
            ),            
            //img 150x150
            array(
            'options' => array('width'=>150, 'height'=>150), 
            'destination' => 'resort/thumbnails_150x150/'
            ),
            //img 158x106
            array(
            'options' => array('width'=>158, 'height'=>106), 
            'destination' => 'resort/thumbnails_158x106/'
            ),
            //img 202x144
            array(
            'options' => array('width'=>202, 'height'=>144), 
            'destination' => 'resort/thumbnails_202x144/'
            ),
            //img 288x196
            array(
            'options' => array('width'=>288, 'height'=>196), 
            'destination' => 'resort/thumbnails_288x196/'
            ),
            //img 288x161
            array(
            'options' => array('width'=>288, 'height'=>161), 
            'destination' => 'resort/thumbnails_288x161/'
            ),
            //img 957x381
            array(
            'options' => array('width'=>957, 'height'=>381), 
            'destination' => 'resort/slider_957x381/'
            ),
            //img 701x456
            array(
            'options' => array('width'=>701, 'height'=>456), 
            'destination' => 'resort/slider_701x456/'
            ),
            //img small 250x250
            array(
            'options' => array('width'=>250, 'height'=>250), 
            'destination' => 'resort/small/'
            ),
            //img large 800x600
            array(
            'options' => array('width'=>800, 'height'=>600), 
            'destination' => 'resort/large/'
            ),
            //img
            array(
            'options' => null, 
            'destination' => 'resort/'
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
	
			//General Information
				
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
					'name'     => 'categoryId',
					'required' => false,										
			)));
			
			$inputFilter->add($factory->createInput(array(
					'name'     => 'countryId',
					'required' => false,					
			)));
						
			$inputFilter->add($factory->createInput(array(
					'name'     => 'overview',
					'required' => true,
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
					'name'     => 'amenities',
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
					'name'     => 'entertainment',
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
						
			//Popover data
			
			$inputFilter->add($factory->createInput(array(
					'name'     => 'popoverTitle',
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
											'max'      => 64,
									),
							),
					),
			)));
			
			$inputFilter->add($factory->createInput(array(
					'name'     => 'popoverContent',
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
			
			$this->inputFilter = $inputFilter;
		}
	
		return $this->inputFilter;
	}
                
	protected function isValidTitle($form){
		if($this->checkItem(array('title'=>$form->getData()->getTitle()))){
			$form->get('title')->setMessages(array('The title already exists'));
			return false;
		}
		return true;
	}
	
	public function isValidModel($form){
            
		return $this->isValidTitle($form);
	}
	
	public function isValidModelOnEdit($form){
		if($this->checkItem(array(
				'id'=>$form->getData()->getId(),
				'title'=>$form->getData()->getTitle()))
		){
			return true;
		} 
		return $this->isValidTitle($form);
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
            //delete resort rooms
            $query = $em->createQuery('SELECT r.image AS image FROM \Base\Entity\Avp\ResortRooms r WHERE r.resortId = :id');
            $query->setParameter('id', $id);
            $result = $query->getResult();            
            $rooms = new Rooms($this->_serviceManager);
            foreach($result as $item){                
                $rooms->deleteImages($item['image']);                
            }  
            $rooms = null;

		$em = $this->getEntityManager();

		$qb = $em->createQueryBuilder();

		$qb->delete('Base\Entity\Avp\Resorts', 'u')
		        ->where('u.id=:Id')
		        ->setParameter('Id', $id);
		$query = $qb->getQuery();
        	$collection = $query->getResult();

		$em = $this->getEntityManager();

		$qb = $em->createQueryBuilder();

		$qb->delete('Base\Entity\Avp\ResortRooms', 'u')
		        ->where('u.resortId=:Id')
		        ->setParameter('Id', $id);
		$query = $qb->getQuery();
        	$collection = $query->getResult();
            //$query = $em->createQuery('DELETE FROM \Base\Entity\Avp\ResortRooms r WHERE r.resortId = :id');
            //$query->setParameter('id', $id);
            //$query->getResult();                          
            //delete resort
            //$em->remove($entity);        
            $em->flush();        
            return true;    	
        }        
}
