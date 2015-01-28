<?php
 
namespace Sendmail\Model;

use Zend\InputFilter\Factory as InputFactory;     // <-- Add this import
use Zend\InputFilter\InputFilter;                 // <-- Add this import
use Zend\InputFilter\InputFilterAwareInterface;   // <-- Add this import
use Zend\InputFilter\InputFilterInterface;        // <-- Add this import
use Zend\View\Model\ViewModel;
use Sendmail\Model\Plugin\SendMailHelper;


class Sendmail extends \Base\Model\BaseModel implements InputFilterAwareInterface{
	
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
                                                                                    'min'      => 3,
                                                                                    'max'      => 50,
                                                                    ),
                                                    ),
                                    ),
                    )));

                    $inputFilter->add($factory->createInput(array(
                                    'name'     => 'header',
                                    'required' => true,
                                    'filters'  => array(							
                                                    array('name' => 'StringTrim'),
                                    ),
                                    'validators' => array(
                                                    array(
                                                                    'name'    => 'StringLength',
                                                                    'options' => array(
                                                                                    'encoding' => 'UTF-8',
                                                                                    'min'      => 6,											
                                                                    ),
                                                    ),
                                    ),
                    )));

                    $inputFilter->add($factory->createInput(array(
                                    'name'     => 'footer',
                                    'required' => true,
                                    'filters'  => array(							
                                                    array('name' => 'StringTrim'),
                                    ),
                                    'validators' => array(
                                                    array(
                                                                    'name'    => 'StringLength',
                                                                    'options' => array(
                                                                                    'encoding' => 'UTF-8',
                                                                                    'min'      => 6,
                                                                    ),
                                                    ),
                                    ),
                    )));

                    $inputFilter->add($factory->createInput(array(
                                    'name'     => 'message',
                                    'required' => true,
                                    'filters'  => array(							
                                                    array('name' => 'StringTrim'),
                                    ),
                                    'validators' => array(
                                                    array(
                                                                    'name'    => 'StringLength',
                                                                    'options' => array(
                                                                                    'encoding' => 'UTF-8',
                                                                                    'min'      => 6,
                                                                    ),
                                                    ),
                                    ),
                    )));

                    $this->inputFilter = $inputFilter;
            }

            return $this->inputFilter;
    }	

    protected function isValidName($object){
            if($this->checkItem(array('name'=>$object->getData()->getName()))){
                    $object->get('name')->setMessages(array('Sendmail with this name already exists'));
                    return false;
            }
            return true;
    }

    public function isValidModel($object){
            return $this->isValidName($object);
    }

    public function isValidModelOnEdit($object){
            if($this->checkItem(array(
                            'id'=>$object->getData()->getId(),
                            'name'=>$object->getData()->getName()))
            ){
                    return true;
            }
            return $this->isValidName($object);
    }

    public function getContent($id){            
        $sendmailHelper = new Plugin\SendMailHelper($this->_serviceManager);
        $where = array(  
            'id'=>$id,                
        );            
        $data = array();            
        $content= $sendmailHelper->getContent($where, $data);            
        return $content;          
    }  

    public function save($object) {

        if($object->getAction()){
            $item = $this->getItemBy(array('action' => $object->getAction()), true);
            if(isset($item)){
                $item->setAction(0);
                parent::save($item);
            }
        }            
        parent::save($object);
    }

    public function update($object){
        if($object->getAction()){
            $item = $this->getItemBy(array('action' => $object->getAction()), true);
            if(isset($item)){
                if($object->getId() != $item->getId()){
                    $item->setAction(0);                        
                    parent::save($item);
                }
            }
        }            
        parent::save($object);
    }


    public function getSendmailCollection($page = false) {

        return parent::getCollection($page);            
    }

    public function sendMailOnEdit($to, array $data){
        $sendmailHelper = new SendMailHelper($this->_serviceManager);
        $where = array(                  
            'action'=> SendMailHelper::RESERVATION,
        );            
        $emailData = array(
            'title' => 'Reservation',
            'data' => $data,
        );                        
        $isSend = $sendmailHelper->sendEmail(SendMailHelper::FROM, 
                $to, $emailData['title'], $emailData, $where);            
        return $isSend;
    }
    
    public function sendMailOnReservation($to, array $data, $subject, array $params = null){
        $viewRender = $this->_serviceManager->get("ViewRenderer");        
        $viewModel = new ViewModel();
        $viewModel->setTemplate("reservation-template");        
        $sendmail = $this->getItemBy(array('action'=> SendMailHelper::RESERVATION), true);
        $viewModel->data = $data;                
        if($params){
            foreach ($params as $key => $value) {
                $viewModel->__set($key, $value);
            }            
        }        
        if($sendmail){            
            $viewModel->header = htmlspecialchars_decode($sendmail->getHeader());
            $viewModel->footer = htmlspecialchars_decode($sendmail->getFooter());
            $viewModel->message = htmlspecialchars_decode($sendmail->getMessage());
        }          
        $html = $viewRender->render($viewModel);   
        $from = SendMailHelper::FROM;
        
        return Plugin\SendMail::sendMail($from, $to, $subject, $html);
    }
    
    public function sendMail($to, array $data, $subject, $template, $action, array $params = null){
        $viewRender = $this->_serviceManager->get("ViewRenderer");        
        $viewModel = new ViewModel();
        $viewModel->setTemplate($template);        
        $sendmail = $this->getItemBy(array('action'=> $action), true);
        $viewModel->data = $data;                
        if($params){
            foreach ($params as $key => $value) {
                $viewModel->__set($key, $value);
            }            
        }        
        if($sendmail){            
            $viewModel->header = htmlspecialchars_decode($sendmail->getHeader());
            $viewModel->footer = htmlspecialchars_decode($sendmail->getFooter());
            $viewModel->message = htmlspecialchars_decode($sendmail->getMessage());
        }          
        $html = $viewRender->render($viewModel);   
        $from = SendMailHelper::FROM;
        
        return Plugin\SendMail::sendMail($from, $to, $subject, $html);
    }
} 