<?php
 
namespace Users\Model;

use Zend\InputFilter\Factory as InputFactory;     // <-- Add this import
use Zend\InputFilter\InputFilter;                 // <-- Add this import
use Zend\InputFilter\InputFilterAwareInterface;   // <-- Add this import
use Zend\InputFilter\InputFilterInterface;        // <-- Add this import
use Sendmail\Model\Plugin\SendMailHelper;
use Sendmail\Model\Plugin\SendMailModel;


class Users extends \Base\Model\BaseModel implements InputFilterAwareInterface{
	
	protected $inputFilter;
        
         protected $_imageOptions = array(
            //img 80x80
            array(
            'options' => array('width'=>80, 'height'=>80), 
            'destination' => 'userimage/thumbnails_80x80/'
            ),                       
            //img 150x150
            array(
            'options' => array('width'=>150, 'height'=>150), 
            'destination' => 'userimage/thumbnails_150x150/'
            ),
            //img 701x456
            array(
            'options' => array('width'=>150, 'height'=>93), 
            'destination' => 'userimage/thumbnails_150x93/'
            ),            
            //img large 800x600
            array(
            'options' => array('width'=>800, 'height'=>600), 
            'destination' => 'userimage/large/'
            ),           
            //img
            array(
            'options' => null, 
            'destination' => 'userimage/'
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
					'name'     => 'login',
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
											'min'      => 4,
											'max'      => 64,
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
											'max'      => 100,
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
											'max'      => 64,
									),
							),
					),
			)));
			
			$inputFilter->add($factory->createInput(array(
					'name'     => 'firstName',
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
					'name'     => 'lastName',
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
					'name'     => 'phone',
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
											'min'      => 8,
											'max'      => 64,
									),
							),
					),
			)));
			
			$inputFilter->add($factory->createInput(array(
					'name'     => 'address',
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
	
			$this->inputFilter = $inputFilter;
		}
	
		return $this->inputFilter;
	}
	
	public function save($object){
            
                $obj = $object['object'];
                $file = $object['files'];
                $date = getdate();

		if(!$this->isValidMd5($obj->getPassword())){
			
			$obj->setPassword(md5($obj->getPassword()));
			
		}
                $obj->setImage($date[0].'-'.$file['image']['name']);
		parent::save($obj);

                if($file['image']['name']):
                    $this->saveImages($file['image']['tmp_name'], $date[0].'-'.$file['image']['name']);
                endif;
		
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
	
	public function isValidMd5($md5)
	{
		return preg_match('/^[a-f0-9]{32}$/', $md5);
	}
	
	//Validators for Users (login, email, phone) on addAction and editAction
	
	protected function isValidLogin($object){
		if($this->checkItem(array('login'=>$object->getData()->getLogin()))){
			$object->get('login')->setMessages(array('User with this login already exists'));
			return false;
		}
		return true;
	}
	
	protected function isValidEmail($object){
		if($this->checkItem(array('email'=>$object->getData()->getEmail()))){
			$object->get('email')->setMessages(array('User with this email already exists'));
			return false;
		}
		return true;
	}
	
	protected function isValidPhone($object){

		if(!$object->getData()->getPhone())
			return true;
		if($this->checkItem(array('phone'=>$object->getData()->getPhone()))){
			$object->get('phone')->setMessages(array('User with this phone already exists'));
			return false;
		}
		return true;

	}
	
	public function isValidModel($object){
		if($this->isValidLogin($object) &&  $this->isValidEmail($object)
		&& $this->isValidPhone($object))
			return true;
		return false;
            return true;
	}
		
	
	public function isValidModelOnEdit($object){
		if($this->checkItem(array(
				'id'=>$object->getData()->getId(),
				'login'=>$object->getData()->getLogin(),
				'email'=>$object->getData()->getEmail(),
				'phone'=>$object->getData()->getPhone()))
		){
			return true;
		} else {
			if(!$this->checkItem(array(
					'login'=>$object->getData()->getLogin(),
					'id'=>$object->getData()->getId()))
			){
				if(!$this->isValidLogin($object))
					return false;
			}
			if(!$this->checkItem(array(
					'email'=>$object->getData()->getEmail(),
					'id'=>$object->getData()->getId()))
			){
				if(!$this->isValidEmail($object))
					return false;
			}
			if(!$this->checkItem(array(
					'phone'=>$object->getData()->getPhone(),
					'id'=>$object->getData()->getId()))
			){
				if(!$this->isValidPhone($object))
					return false;
			}
		}
		return true;
	}
	
        public function sendMailOnAdd(\Base\Entity\Users $user, array $data){
            $sendmailHelper = new SendMailHelper($this->_serviceManager);
            $where = array(                  
                'action'=> SendMailHelper::ADD_USER,
            );            
            $emailData = array(
                'title' => 'Registration on Reservation Manager',
                'data' => array_merge($data, SendMailModel::entityToArray($user)),
            );                        
            $isSend = $sendmailHelper->sendEmail(SendMailHelper::FROM, 
                    $user->getEmail(), $emailData['title'], $emailData, $where);            
            return $isSend;
        }
        
        public function sendMailOnEdit(\Base\Entity\Users $user, array $data){
            $sendmailHelper = new SendMailHelper($this->_serviceManager);
            $where = array(                  
                'action'=> SendMailHelper::EDIT_USER,
            );            
            $emailData = array(
                'title' => 'Update profile on Reservation Manager',
                'data' => array_merge($data, SendMailModel::entityToArray($user)),
            );                        
            $isSend = $sendmailHelper->sendEmail(SendMailHelper::FROM, 
                    $user->getEmail(), $emailData['title'], $emailData, $where);            
            return $isSend;
        }
        
          public function getCollection() {
            $em = $this->getEntityManager();
            $qb = $em->createQueryBuilder();
            $qb->select('u')->from('\Base\Entity\Users', 'u')
                    ->groupBy('u.email');


            $query = $qb->getQuery();
            $results = $query->getResult();

            return $results;
    }
} 
