<?php
namespace Sendmail\Helper;

class EmailTemplate
{
        protected $_controller = null;
        protected $_variables = array(
                                        'header'=>'header', 
                                        'footer'=>'footer',
                                        'message'=>'message',
                                        'data'=>array()
        );
        protected $_pathToFile = 'module/Sendmail/view/template/email-template.phtml';
    
    public function __construct($pathToFile = null) {            	
        if(!is_null($pathToFile)){            
            if(!file_exists($pathToFile))         	
                    throw new \Exception('Template file exists...path = '.$pathToFile);         	                                      	
            $this->_pathToFile = $pathToFile;        
        }
    }

    public function __set($key, $val) {
    	
        $this->_variables[$key] = $val;
    }        

    public function getContent(){
    	
        ob_start();
        extract($this->_variables);
        
        include_once 'module/Sendmail/view/template/partial/email-header.phtml';
        include_once $this->_pathToFile;
        include_once 'module/Sendmail/view/template/partial/email-footer.phtml';
        
        $content = ob_get_contents();
        ob_end_clean();
                
        return $content;
    }        
}