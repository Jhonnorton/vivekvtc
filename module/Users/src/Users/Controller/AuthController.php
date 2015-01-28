<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Users for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Users\Controller;

use Zend\Mvc\MvcEvent;

class AuthController extends \Base\Controller\BaseController
{
	public function onDispatch(MvcEvent $e){
		
		parent::onDispatch($e);
		
		$this->layout('layout/login');
		
	}
	
        public function loginAction() {
        
        $authenticationService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
        $loggedUser = $authenticationService->getIdentity();

        if ($this->request->isPost()) {

            $data = $this->request->getPost();

            $login = $data['login'];
            $password = md5($data['password']);
//    			$password = '51ced3230e0940ca182008863c6afe4b06de30d1';//smart
//    			$password = '51ced3230e0940ca182008863c6afe4b06de30d1';//smart

            $authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');

            $adapter = $authService->getAdapter();
            $adapter->setIdentityValue($login);
            $adapter->setCredentialValue($password);

            $authResult = $authService->authenticate();
            $notValid = array(2,8);//add roles which is not eligible to login to RM system.

            if ($authResult->isValid()) {
               
                $identity = $authResult->getIdentity();
                
                $validUserAuth = in_array($identity->getRole()->getId(),$notValid); 

                if ($identity->getIsActive() == FALSE ||  $validUserAuth == true) {
                    return $this->getView(array(
                                'message' => 'Your authentication credentials are not valid',
                    ));
                }
                $authService->getStorage()->write($identity);

                $this->setSessionData('User', 'user', $identity);

                return $this->redirect()->toRoute('dashboard');
            }

            return $this->getView(array(
                        'message' => 'Your authentication credentials are not valid',
            ));
        }
        
        if ($loggedUser) {
            return $this->redirect()->toRoute('dashboard');
        }
    }
    
    public function logoutAction(){
    	
    	$authenticationService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
    	 
    	$identity = $authenticationService->getIdentity();
    	$authenticationService->getStorage()->clear($identity);
    	
    	$authenticationService->clearIdentity();
    	 
    	$session = $this->getSessionData('User');
    	
    	$session->offsetUnset('User');
    	 
    	$session->getManager()->destroy();
    	
    	return $this->redirect()->toRoute('login');
    	
    }
        
    //restore password
    public function restoreAction(){
    	if($this->request->isPost()){    		 
            $data = $this->request->getPost();    		 
            $email = trim($data['email']);
            $model = $this->getModel('Auth');
            $user = $model->getUserByEmail($email);                
            if(!is_null($user)){
                    $data = array(                            
                        'profile'=>$this->url()->fromRoute('profile', array(), 
                                array('force_canonical' => true)),                            
                    );                        
                    if($model->sendMail($user, $data)){
                        $message = 'New password has been sent on email';
                        $model->save($user);
                    }else{
                        $message = 'The password has not been restored!';
                    }                        
                    return $this->getView(array(
                                    'message' => $message,
                    ));
            }

            return $this->getView(array(
                            'message' => 'Email does not exists',
            ));
    	}    	    	
    }

    
}
