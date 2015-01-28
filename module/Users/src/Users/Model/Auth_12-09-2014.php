<?php

namespace Users\Model;

use Sendmail\Model\Plugin\SendMailHelper;
use Sendmail\Model\Plugin\SendMailModel;

class Auth extends \Base\Model\BaseModel{

	public function isValidEmail($email){			
		
		if($this->checkItem(array('email'=>$email))){
			return true;
		}
		return false;		
	}
	
	public function getUserByEmail($email){
	
		$user = $this->getItemBy(array('email'=>$email), true);
	
		if(!is_null($user)){			
			$psw = $this->randomPassword();				
			$user->setPassword($psw);			
			return $user;
		}
		return null;		
	}
	
	private function randomPassword()
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$n = strlen($characters)-1;
		$randstring = '';
		for ($i = 0; $i < 15; $i++) {
			$randstring.= $characters[rand(0, $n)];
		}
		return $randstring;
	}

	public function save($object){
	                      
            if(!$this->isValidMd5($object->getPassword())){				
                    $object->setPassword(md5($object->getPassword()));			
            }	
            parent::save($object);            
	}
	
	public function isValidMd5($md5)
	{
            return preg_match('/^[a-f0-9]{32}$/', $md5);
	}
        
        public function sendMail(\Base\Entity\Users $user, array $data){
                    
            $sendmailHelper = new SendMailHelper($this->_serviceManager);
            $where = array(                  
                'action'=> SendMailHelper::RESTORE_PASSWORD,
            );
            
            $emailData = array(
                'title' => 'Restore Password on Reservation Manager',
                'data' => array_merge($data, SendMailModel::entityToArray($user)),
            );                        
            $isSend = $sendmailHelper->sendEmail(SendMailHelper::FROM, 
                    $user->getEmail(), $emailData['title'], $emailData, $where);            
            return $isSend;
        }
}