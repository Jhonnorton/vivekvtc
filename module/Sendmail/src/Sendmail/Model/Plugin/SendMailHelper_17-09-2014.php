<?php

namespace Sendmail\Model\Plugin;

use Sendmail\Model\Plugin\SendMail;

class SendMailHelper extends SendMail{
    
    const FROM = 'admin@dev.serv4dev.com';      
    const PATH_TO_TEMPLATE = 'module/Sendmail/view/template/templates/';
    const TEMPLATE_NAME = 'email-template.phtml';
    const TEMPLATE = 'module/Sendmail/view/template/templates/base-template.phtml';
    
    //actions
    const ADD_USER = 1;
    const EDIT_USER = 2;
    const RESTORE_PASSWORD = 3;
    const RESERVATION = 4;
    
    protected $_serviceManager;
    protected $_model;

    public function __construct($serviceManager) {
        $this->_serviceManager = $serviceManager;
        $this->_model = new SendMailModel($this->_serviceManager);
    }
    
    public static function getActions(){
        return array(
            0 => 'No action',
            1 => 'Add User',
            2 => 'Edit User',
            3 => 'Restore Password',
            4 => 'Reservation',
        );
    }

    protected function checkTemplate($template){
        if(!isset($template)) {            
            return self::TEMPLATE;
        }
        if(!file_exists($template)){                           
            $templatePath = self::PATH_TO_TEMPLATE.$template;
            $template = !file_exists($templatePath)? 
                    $templatePath : self::TEMPLATE;
        }  
        return $template;
    }
    
    public function getModel(){
        return $this->_model;
    }
    
    protected function prepareData(array $sendmailParams, array $data){
        $sd = $this->getSendmailData($sendmailParams);
        if(!isset($sd)){ return null; }        
        $sendmailData = $sd;        
        return array_merge($sendmailData, $data);        
    }

    protected function getSendmailData(array $where){
        
        return $this->_model->getSendmailItem($where);
    }

    public function getContent(array $sendmailParams, array $data){
        
        $sendmailData = $this->prepareData($sendmailParams, $data);  
        if(!isset($sendmailData)) {
            return 'Sendmail not exists';            
        }        
        $template = isset($sendmailData['template']) ? $sendmailData['template'] : null;
		$obj = new SendMailTemplate($this->checkTemplate($template), $sendmailData);                
        return $obj->getContent();        
    }
       
    public function sendEmail($from, $to, $subject, $data, array $sendmailParams){
           
        $sendmailData = $this->prepareData($sendmailParams, $data); 
        if(!isset($sendmailData)){
            return false;
        }
        $template = isset($sendmailData['template']) ? $sendmailData['template'] : null;   
        if(!isset($template)){
            return false;
        }        
        return parent::send($from, $to, $subject, $sendmailData, $this->checkTemplate($template));
    }    
}

