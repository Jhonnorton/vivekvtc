<?php
 
namespace Users\Model;

use Zend\InputFilter\Factory as InputFactory;     // <-- Add this import
use Zend\InputFilter\InputFilter;                 // <-- Add this import
use Zend\InputFilter\InputFilterAwareInterface;   // <-- Add this import
use Zend\InputFilter\InputFilterInterface;        // <-- Add this import

class Clients extends \Base\Model\AvpModel implements InputFilterAwareInterface{
	
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
					'name'     => 'name',
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
					'name'     => 'password',
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
											'min'      => 6,
											'max'      => 255,
									),
							),
					),
			)));
			
			$inputFilter->add($factory->createInput(array(
					'name'     => 'repassword',
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
											'min'      => 6,
											'max'      => 100,
									),
							),
					),
			)));
			
                        $inputFilter->add($factory->createInput(array(
					'name'     => 'dob',
					'required' => false,
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
					'name'     => 'addressLine1',
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
									),
							),
					),
			)));
			
			$inputFilter->add($factory->createInput(array(
					'name'     => 'addressLine2',
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
											'min'      => 1,											
									),
							),
					),
			)));
                        
                        $inputFilter->add($factory->createInput(array(
					'name'     => 'phone',
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
											'min'      => 8,
											'max'      => 100,
									),
							),
					),
			)));
                                                                                                
			$inputFilter->add($factory->createInput(array(
					'name'     => 'email',
					'required' => true,
					'filters'  => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name'    => 'EmailAddress',
									'options' => array(
											'encoding' => 'UTF-8',
											'min'      => 5,
											'max'      => 255,
									),
							),
					),
			)));
			
			$inputFilter->add($factory->createInput(array(
					'name'     => 'city',
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
											'max'      => 255,
			
									),
							),
					),
			)));
			
			$inputFilter->add($factory->createInput(array(
					'name'     => 'state',
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
											'max'      => 255,
												
									),
							),
					),
			)));
			
			$inputFilter->add($factory->createInput(array(
					'name'     => 'countryId',
					'required' => true,
					
			)));
                        
                        $inputFilter->add($factory->createInput(array(
					'name'     => 'zip',
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
											'max'      => 100,
			
									),
							),
					),
			)));
	
			$this->inputFilter = $inputFilter;
		}
	
		return $this->inputFilter;
	}
			
	protected function isValidEmail($object){
		if($this->checkItem(array('email'=>$object->getData()->getEmail()))){
			$object->get('email')->setMessages(array('Email already exists'));
			return false;
		}
		return true;
	}
		
	public function isValidModel($object){
		return $this->isValidEmail($object);
	}
	
	
	public function isValidModelOnEdit($object){
		if($this->checkItem(array(
				'id'=>$object->getData()->getId(),				
				'email'=>$object->getData()->getEmail()))
		){
			return true;
		} 
		return $this->isValidEmail($object);
	}
        
        public function save($object){
            
            if(!$this->isValidMd5($object->getPassword())){				
                $object->setPassword(md5($object->getPassword()));
            }
            
            $user = new \Base\Entity\Avp\Users();
            $arrName = explode(" ", $object->getName());  
            $firstName = $arrName[0];
            $lastName = (count($arrName) > 1)? $arrName[1] : 'Guest';
            
            $user->setFirstName($firstName);
            $user->setLastName($lastName);
            $user->setEmail($object->getEmail());
            $user->setPassword($object->getPassword());
            $user->setDOB($object->getDOB());            
            $user->setAddressLine1($object->getAddressLine1());
            $user->setAddressLine2($object->getAddressLine2());
            $user->setCity($object->getCity());
            $user->setState($object->getState());
            $user->setCountryId($object->getCountryId());
            $user->setZip($object->getZip());            
            $user->setTmpPassword($object->getPassword());
            
            $em = $this->_entityManager;                
            $em->persist($user);                              
            $em->flush(); 
            $object->setUserId($user->getId());            	
            parent::save($object);
        }
        
        public function update($object){ 
            
            if(!$this->isValidMd5($object->getPassword())){				
                $object->setPassword(md5($object->getPassword()));
            }
            
            $user = $this->getUser($object->getUserId());
            
            $arrName = explode(" ", $object->getName());  
            $firstName = $arrName[0];
            $lastName = (count($arrName) > 1)? $arrName[1] : 'Guest';
            
            $user->setFirstName($firstName);
            $user->setLastName($lastName);
            $user->setEmail($object->getEmail());
            $user->setPassword($object->getPassword());
            $user->setDOB($object->getDOB());            
            $user->setAddressLine1($object->getAddressLine1());
            $user->setAddressLine2($object->getAddressLine2());
            $user->setCity($object->getCity());
            $user->setState($object->getState());
            $user->setCountryId($object->getCountryId());
            $user->setZip($object->getZip());            
            $user->setTmpPassword($object->getPassword());
            
            $em = $this->_entityManager;                
            $em->persist($user);                              
            $em->flush(); 
            $object->setUserId($user->getId());  
            
            parent::save($object);
        }
        
        public function delete($id){
            
            $userId = $this->getItem($id)->getUserId();           
            $this->deleteUser($userId);
            parent::delete($id);
            
        }
        
	public function isValidMd5($md5){		
            return preg_match('/^[a-f0-9]{32}$/', $md5);
	}
        
        public function getUser($id){
    	
        $item = $this->_entityManager
                    ->find('\Base\Entity\Avp\Users', (int)$id)
                    ;
        if(!is_null($item)) //d($this->_serviceManager);
            $item->setServiceManager($this->_serviceManager);
        
            return $item;
        }
        
        public function getClientbyUserId($id){
       $item = $this->getItemBy(array('userId'=>$id), true);
        if(!is_null($item)) //d($this->_serviceManager);
            $item->setServiceManager($this->_serviceManager);
            return $item;
        }
        
        public function deleteUser($id){
    	
        $em = $this->_entityManager;
        
        if(!is_array($id)){
        	
            $entity = $em->getReference('\Base\Entity\Avp\Users', (int)$id);
            
            $em->remove($entity);
            
        } else {
        	
            foreach ($id as $item){
            	
                $entity = $em->getReference('\Base\Entity\Avp\Users', $item);
                
                $em->remove($entity);
            }
            
        }
        
        $em->flush();
        
        return true;
        
    }
	
} 
