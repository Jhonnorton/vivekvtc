<?php

namespace Sendmail\Model\Plugin;

use Zend\Mail\Transport\Sendmail as SendmailTransport;
use Zend\Mail\Message;
use Zend\Mime;

class SendMail {
    
    protected function prepareMessage($template, array $data) {
        
        $template = new SendMailTemplate($template, $data);        
        $parts = array();
        // first create the parts
        $parts[] = $template->getMessage();
        foreach ($template->getAttachments() as $attach) {
            $parts[] = $attach;
        }        
        // then add them to a MIME message
        $mimeMessage = new Mime\Message();
        $mimeMessage->setParts($parts);
        // and finally we create the actual email
        $message = new Message();
        $message->setBody($mimeMessage);
        return $message;        
    }
        
    protected function send($from, $to, $subject, $data, $template){
        
        $message = $this->prepareMessage($template, $data);         
        $message->addTo($to)
                ->addFrom($from)
                ->setSubject($subject);       
        $sendmail = new SendmailTransport();
        try{            
            $sendmail->send($message);
            return true;
        }
        catch(\Exception $e){
            throw new \Exception($e->getMessage());			
        }        
    } 
    public static function sendMail($from, $to, $subject, $html){
        $part = new Mime\Part($html);
        $part->type = Mime\Mime::TYPE_HTML;
        $part->charset = 'utf-8';
        $mimeMessage = new Mime\Message();
        $mimeMessage->addPart($part);
        $message = new Message();
        $message->addTo($to)
                ->addFrom($from)
                ->setSubject($subject)
                ->setBody($mimeMessage);            
        $sendmail = new SendmailTransport();
        try{            
            $sendmail->send($message);
            return true;
        }
        catch(\Exception $e){
            throw new \Exception($e->getMessage());			
        } 
    }
}