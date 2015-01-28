<?php
namespace Sendmail\Model\Plugin;
use Zend\Mime;

class SendMailTemplate {
       
    protected $_variables = array(
                                'title'=>'',
                                'header'=>'', 
                                'message'=>'',
                                'footer'=>'',                                                                
                                'data' => array(),
                                'files' => array() 
    );    
    protected $_pathToTemplate;
    
    public function __construct($pathToTemplate, array $data = null) {            	
        
        if(isset($pathToTemplate)){                        
            $this->setTemplate($pathToTemplate);
        }        
        if(isset($data)){
            $this->setVariables($data);
        }       
    }
    
    public function __set($key, $val) {
    	
        $this->_variables[$key] = $val;
    }
    
    public function setTemplate($pathToTemplate){        
        $this->_pathToTemplate = $pathToTemplate;
        if (!file_exists($this->_pathToTemplate)) {
                throw new \Exception('Template file not exists...path = ' . $pathToTemplate);
        }            
    }
    
    public function setVariables(array $data){
        
        foreach($data as $k=>$v){
                $this->__set($k, $v);
        } 
    }
    
    protected function getContentFromTemplate(){
        
        if(!file_exists($this->_pathToTemplate)){
            return '';            
        } 
        return file_get_contents($this->_pathToTemplate);
    }


    protected function prepareTemplate(array $data = null){    	
                 
        if(isset($data)){
            $this->setVariables($data);
        }        
        $replace = $search = array();              
        foreach($this->_variables as $k=>$v){
            if(!is_array($v) && !is_object($v)){
                $search[] = '##'.$k.'##';
                $replace[] = htmlspecialchars_decode($v);
            }
        }                        
        $content = str_replace($search, $replace, $this->getContentFromTemplate());
        if(!empty($this->_variables['data'])){
            $replace = $search = array();            
            foreach($this->_variables['data'] as $k=>$v){
                if(!is_array($v) && !is_object($v)){
                    $search[] = '##'.$k.'##';
                    $replace[] = htmlspecialchars_decode($v);
                }
                $content = str_replace($search, $replace, $content);
            }            
        }             
        return $content;
    }
            
    protected function prepareAttachment($path) {
        
        if (file_exists($path)) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $ftype = finfo_file($finfo, $path);
            $file = fopen($path, "r");
            $attachment = new Mime\Part($file);
            $attachment->type = $ftype;
            $attachment->disposition = Mime\Mime::DISPOSITION_ATTACHMENT;
            $attachment-> filename = basename($path);                       
            return $attachment;            
        } else {
            return false;
        }
    }
    
    public function getAttachments(){
        $attachArr = array();        
        if(is_array($this->_variables['files'])){
            foreach ($this->_variables['files'] as $path){                    
               $a = $this->prepareAttachment($path);
               if($a){
                   $attachArr[] = $a;
               }
            }
        }
        return $attachArr;
    }
    
    public function getMessage(){  
        
        $content = new Mime\Part($this->prepareTemplate($this->_variables));
        $content->type = Mime\Mime::TYPE_HTML;
        $content->charset = 'utf-8';                       
        return $content;
    }   
    
    public function getContent(array $data = null){
        
        return $this->prepareTemplate($data);
    }
}

