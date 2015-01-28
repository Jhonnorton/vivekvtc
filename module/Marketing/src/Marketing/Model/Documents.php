<?php

namespace Marketing\Model;

use Zend\InputFilter\Factory as InputFactory;     // <-- Add this import
use Zend\InputFilter\InputFilter;                 // <-- Add this import
use Zend\InputFilter\InputFilterAwareInterface;   // <-- Add this import
use Zend\InputFilter\InputFilterInterface;        // <-- Add this import
use Sendmail\Controller\SendmailController;

class Documents extends \Base\Model\BaseModel implements InputFilterAwareInterface {

    protected $inputFilter;

    const RESORT_ROOM = 1;
    const EVENT_ROOM = 2;
    const CRUISE_CABIN = 3;

    //  const CANCELED = 0;
    //  const OPEN_BALANCE = 1;
    //  const CLOSED_BALANCE = 2;
    
    protected $_maxImageSize = 2097152;             //2*1024*1024 = 2Mb

    public function getImagePath() {
        return \Base\Model\Plugins\Imagine::$imagesBaseUrl . 'userdocimage/thumbnails_80x80/';
    }

     protected $_imageOptions = array(
            //img 80x80
            array(
            'options' => array('width'=>80, 'height'=>80), 
            'destination' => 'userdocimage/thumbnails_80x80/'
            ),                       
            //img 150x150
            array(
            'options' => array('width'=>150, 'height'=>150), 
            'destination' => 'userdocimage/thumbnails_150x150/'
            ),
            //img 150x93
            array(
            'options' => array('width'=>150, 'height'=>93), 
            'destination' => 'userdocimage/thumbnails_150x93/'
            ),            
            //img small 250x250
            array(
            'options' => array('width'=>250, 'height'=>250), 
            'destination' => 'userdocimage/small/'
            ),
            //img large 800x600
            array(
            'options' => array('width'=>800, 'height'=>600), 
            'destination' => 'userdocimage/large/'
            ),
            //img
            array(
            'options' => null, 
            'destination' => 'userdocimage/'
            )           
        );

    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Not used");
    }

    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory = new InputFactory();




            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

    public function isValidModel($form) {

        return true;
    }
    
    public function saveNewsletter($object){
            $news = new \Base\Entity\Avp\NewsletterContents();
           // d($news);
            $date = new \DateTime();
            $sender_id='1';
            $news->setToType($object->to);
            $news->setSubject($object->subject);
            $news->setContent($object->message);            
            $news->setAddedOn($date);
            $news->setSender($sender_id);            
            $em = $this->_entityManager;                
            $em->persist($news);  
            $em->flush(); 
            return true;
        
    }
    
    public function sendNewsletter($data){
        
        $typeId = $data['to'];
        $subject = $data['subject'];
        $content = $data['content'];
        if($typeId==1){
            $users=$this->getAllUserType($typeId); //clients
        }
        if($typeId==2){
            $users=$this->getAllUserType($typeId); //resellers
        }
        if($typeId==3){
            $users=$this->getAllUserType($typeId); //agents
        }
        foreach($users as $user){
            $to = $user->getEmail();
            
            SendmailController::sendMailToClient($this->_serviceManager, $to, $subject, $content);
        }
        exit;
        return true;
        
    }
    
    public function getNewsletterList(){
        $newsletter = $this->_entityManager
                    ->getRepository('\Base\Entity\Avp\NewsletterContents')->findAll();
                    
        
        if(!is_null($newsletter)) //d($this->_serviceManager);
           
        
            return $newsletter;
    }   
    
    
    public function getPdfList(){
        $pdf = $this->_entityManager->getRepository('\Base\Entity\Avp\Documents')->findAll();
        if(!is_null($pdf)) //d($this->_serviceManager);
        return $pdf;
    } 
    
    public function getImageList(){
        $image = $this->_entityManager->getRepository('\Base\Entity\Avp\DocumentImages')->findAll();
        if(!is_null($image)) //d($this->_serviceManager);
        return $image;
    }
    
    public function getVideoList(){
        $video = $this->_entityManager->getRepository('\Base\Entity\Avp\DocumentVideos')->findAll();
        if(!is_null($video)) //d($this->_serviceManager);
        return $video;
    }
    
    
    public function getAllUserType($typeId){
       
         $receipient  = $this->getEntityManager()->getRepository('\Base\Entity\Users')->findBy(array('role' => (int)$typeId));        
        return $receipient;  
    }
    
    public function getVideoDetails($id){
       
        $item = $this->_entityManager->find('\Base\Entity\Avp\DocumentVideos', (int)$id);
        return $item;            
        
    }
    
    
    public function savePdf($pdf,$files){
        $doc = new \Base\Entity\Avp\Documents();
        $filename=$pdf->name.time().".pdf";
        if(move_uploaded_file($files['pdf']['tmp_name'],'/home/isteam/public_html/rmv/public/img/user_uploads/userdocuments/'.$filename)){
            $created = new \DateTime();
            $modified = new \DateTime();
            $doc->setFile($filename);
            $doc->setType($pdf->for_type);
            $doc->setTypeId($pdf->resortId);
            $doc->setCreated($created);
            $doc->setModified($modified);
            $doc->setStatus('1');
            $em = $this->_entityManager;                
            $em->persist($doc);                              
            $em->flush();
            return true;
        }else{
           return false;
        }          
        
    }
    
    public function saveImage($data,$image){
        $img = new \Base\Entity\Avp\DocumentImages();
        $img_array =  explode('.', $image['image']['name']);
        $image_name= $data['name'].time().".".$img_array[1];
        $this->uploadImages($image['image']['tmp_name'], $image_name);
        $created = new \DateTime();
        $modified = new \DateTime();
        $img->setFile($image_name);
        $img->setType($data->for_type);
        $img->setTypeId($data->resortId);
        $img->setCreated($created);
        $img->setModified($modified);
        $img->setStatus('1');
        $em = $this->_entityManager;                
        $em->persist($img);                              
        $em->flush();
        return true;
    }
    
    protected function uploadImages($tmpName, $imgName){            
            foreach($this->_imageOptions as $imgOption){                
                \Base\Model\Plugins\Imagine::uploadImage($tmpName, $imgName, $imgOption['options'], $imgOption['destination']);
            }                 
        }
    
    public function saveVideo($data,$video){
        $doc = new \Base\Entity\Avp\DocumentVideos();
        $video_array =  explode('.', $video['video']['name']);
        $videoname= $video_array[0].time().".".$video_array[1];
        if(move_uploaded_file($video['video']['tmp_name'],'/home/isteam/public_html/rmv/public/img/user_uploads/userdocvideos/'.$videoname)){
            $created = new \DateTime();
            $modified = new \DateTime();
            $doc->setFile($videoname);
            $doc->setCategory($data->category);
            $doc->setCreated($created);
            $doc->setModified($modified);
            $doc->setStatus('1');
            $em = $this->_entityManager;                
            $em->persist($doc);                              
            $em->flush();
            return true;
        }else{
           return false;
        }          
        
    }
     

    
}