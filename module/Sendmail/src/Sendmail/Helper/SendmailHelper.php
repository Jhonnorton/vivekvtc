<?php
namespace Sendmail\Helper;

use Zend\Mail\Transport\Sendmail as SendmailTransport;
use Sendmail\Helper\EmailTemplate as SendmailTemplate;
use Zend\Mail\Message;
use Zend\Mail\Headers as SendmailHeaders;

class SendmailHelper {
	
	//protected static $From = 'admin@dev.serv4dev.com';
	protected static $From = "bookings@mytravelcenter.net.";
	protected static $Site = 'Reservation Manager';	
	
	private static function send($from, $to, $subject, SendmailTemplate $template, 
									SendmailHeaders $headers = null){
		if(!$headers){
			
			$headers = new SendmailHeaders();			
			$headers->addHeaderLine('Content-type','text/html');
			$headers->addHeaderLine('charset','utf-8');				
		}	
		$headers->addHeaderLine('To', $to);
		$headers->addHeaderLine('From', $from);
		$headers->addHeaderLine('Reply-To', $from);
				
		$message = new Message();
		$message->setHeaders($headers)
			->setSubject($subject)
			->setBody($template->getContent());
		
		$sendmail = new SendmailTransport();
		try{
			$sendmail->send($message);
		}
		catch(\Exception $e){
			throw new \Exception($e->getMessage());			
		}
	}
	
	public static function sendMailOnAddUser(\Base\Controller\BaseController $controller = null, $data = null){		
		if(is_null($controller))
			throw new \Exception('Controller is null!');
		if(is_null($data))
			throw new \Exception('Input data is null!');
		
		$subject = 'Registration on '.SendmailHelper::$Site;			
		$template = new SendmailTemplate(				
				'module/Sendmail/view/template/email-template-add-user.phtml');
					
	
		$template->site = SendmailHelper::$Site;	
		$template->user = $data;
		$template->header = 'Rezervation manager';
		$template->footer = 'Copyright&copy; '.date('Y');
		$template->url = $controller->url()->fromRoute('profile', array(), array('force_canonical' => true)); 													
		
		SendmailHelper::send(SendmailHelper::$From, 
                                        $data->getEmail(), 
                                        $subject, 
                                        $template);
	}
		
	public static function sendMailOnUpdateUser(\Base\Controller\BaseController $controller = null, $data = null){
		
		if(is_null($controller))
			throw new \Exception('Controller is null!');
		if(is_null($data))
			throw new \Exception('Input data is null!');
		$flag = true;
		
		if($controller->isValidMd5($data->getPassword())){
			$flag = false;
		}
					
		$subject = 'Update profile on '.SendmailHelper::$Site;			
		$template = new SendmailTemplate(
				'module/Sendmail/view/template/email-template-update-user.phtml');
	
		//add data to template
		$template->flag = $flag;
		$template->site = SendmailHelper::$Site;
		$template->user = $data;
		$template->header = 'Rezervation manager';
		$template->footer = 'Copyright&copy; '.date('Y');
		$template->url = $controller->url()->fromRoute('profile', array(), array('force_canonical' => true));
				
		SendmailHelper::send(SendmailHelper::$From, 
                                        $data->getEmail(), 
                                        $subject, 
                                        $template);
	}
	
	public static function sendMailOnRestorePassword(\Base\Controller\BaseController $controller = null, $data = null){
		if(is_null($controller))
			throw new \Exception('Controller is null!');
		if(is_null($data))
			throw new \Exception('Input data is null!');
	
		$subject = 'Restore password on '.SendmailHelper::$Site;
		$template = new SendmailTemplate(
				'module/Sendmail/view/template/email-template-add-user.phtml');
		
		$template->site = SendmailHelper::$Site;
		$template->user = $data;
		$template->header = 'Rezervation manager';
		$template->footer = 'Copyright&copy; '.date('Y');
		$template->url = $controller->url()->fromRoute('profile', array(), array('force_canonical' => true));
	
		SendmailHelper::send(SendmailHelper::$From,
		$data->getEmail(),
		$subject,
		$template);
	}               
}
	
