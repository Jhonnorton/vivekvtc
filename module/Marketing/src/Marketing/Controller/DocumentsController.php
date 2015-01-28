<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Orders for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License 123
 */

namespace Marketing\Controller;

use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;
use Sendmail\Controller\SendmailController;

class DocumentsController extends \Base\Controller\BaseController {

    protected $_entity = false;

    public function onDispatch(MvcEvent $e) {

        //     echo 'hello'; die;


        $this->model = $this->getModel('Documents');

        if ($this->params()->fromRoute('id', 0)) {

            $this->_entity = $this->model->getItem($this->params()->fromRoute('id', 0));
        }

        $e->getViewModel()->setVariable('modulename', 'Marketing');

        return parent::onDispatch($e); //smart
    }

    public function indexAction() {

        
    }

    public function newsletterViewAction() {
       $newsletter=$this->model->getNewsletterList(); 
       $data = array(
           'newsletter'=>$newsletter,
           'message'=>$this->getPageMessages(),
       );
       return new ViewModel($data);
        
    }
    
    public function newsletterAddAction() {
       $form = new \Marketing\Form\SendNewsletterForm($this->getEm(self::AVP_CONFIG), '\Base\Entity\Avp\NewsletterContents');
       $data = array(
                'form' => $form,
            );
       if($this->request->isPost()){
           $newsletter=$this->request->getPost();
           $data1=array();
           $data1['to']=$newsletter['to'];
           $data1['subject']=$newsletter['subject'];
           $data1['content']=$newsletter['message'];
           $stat=$this->model->saveNewsletter($newsletter);
           $stat0=$this->model->sendNewsletter($data1);
           if($stat){
           $this->addPageMessage('Newsletter has been sent successfully.','success');				
           $this->redirect()->toRoute('marketing-newsletter');
           }
       }
       return new ViewModel($data); 
       
        
    }
    
    public function pdfViewAction() {
        $pdf=$this->model->getPdfList(); 
        $data = array(
           'pdf'=>$pdf,
           'message'=>$this->getPageMessages(),
       );
       return new ViewModel($data);
        
    }
    
    public function pdfAddAction(){
        $form = new \Marketing\Form\AddPdfForm($this->getEm(self::AVP_CONFIG), '\Base\Entity\Avp\Documents');
        $data = array(
                'form' => $form,
            );
        if($this->request->isPost()){
            $pdf=$this->request->getPost();
             $files = $this->request->getFiles()->toArray();
             
             $ext = explode('.',$files['pdf']['name']);
             if($ext[1]=='pdf'){
             if($files['pdf']['size'] <= 10485760){
             $status=$this->model->savePdf($pdf,$files);
             if($status){
                $this->addPageMessage('PDF uploaded successfully.','success');				
           
             }else{
                $this->addPageMessage('PDF could not be uploaded successfully.','error'); 
             }
                 $this->redirect()->toRoute('marketing-pdf'); 
             }else{
                $this->addPageMessage('PDF could not be uploaded, Please check the size of file.','error');
                $this->redirect()->toRoute('marketing-pdf'); 
             }
             }else{
                $this->addPageMessage('Please uplaod PDF only','error');
                $this->redirect()->toRoute('marketing-pdf');    
             }
        }
        return new ViewModel($data);
    }
    
    public function pdfDownloadAction(){
        echo "Hello"; die;
    }
    
    
    public function imageViewAction() {
        $image=$this->model->getImageList(); 
        $data = array(
           'image'=>$image,
           'message'=>$this->getPageMessages(),
       );
       return new ViewModel($data);
        
    }
    
    public function imageAddAction(){
        $form = new \Marketing\Form\AddImageForm($this->getEm(self::AVP_CONFIG), '\Base\Entity\Avp\DocumentImages');
        $data = array(
                'form' => $form,
            );
        if($this->request->isPost()){
            $data1=$this->request->getPost();
             $image = $this->request->getFiles()->toArray();
             $ext = explode('.',$image['image']['name']);
             if($ext[1]=='png' || $ext[1]=='jpeg' || $ext[1]=='jpg' || $ext[1]=='gif'){
             $status=$this->model->saveImage($data1,$image);
             if($status){
                $this->addPageMessage('Image uploaded successfully.','success');				
           
             }else{
                $this->addPageMessage('Image could not be uploaded successfully.','error'); 
             }
             $this->redirect()->toRoute('marketing-image'); 
        }else{
            $this->addPageMessage('Please check for proper image extension','error'); 
            $this->redirect()->toRoute('marketing-image'); 
        }
        }
        return new ViewModel($data);
    }
    
    public function videoViewAction() {
        $video=$this->model->getVideoList(); 
        $data = array(
           'video' =>$video,
           'message'=>$this->getPageMessages(),
       );
       return new ViewModel($data);
        
    }
    
    public function videoAddAction() {
        $form = new \Marketing\Form\AddVideoForm($this->getEm(self::AVP_CONFIG), '\Base\Entity\Avp\DocumentVideos');
        $data = array(
                'form' => $form,
            );
        if($this->request->isPost()){
            $data1=$this->request->getPost();
             $video = $this->request->getFiles()->toArray();
             $ext = explode('.',$video['video']['name']);
             if($ext[1]=='mp4' || $ext[1]=='mov' ){
              if($video['video']['size'] <= 10485760){
             $status=$this->model->saveVideo($data1,$video);
             if($status){
                 
                $this->addPageMessage('Video uploaded successfully.','success');				
           
             }else{
                $this->addPageMessage('Video could not be uploaded successfully.','error'); 
             }
             
             $this->redirect()->toRoute('marketing-video'); 
              }else{
                  $this->addPageMessage('Video could not be uploaded, Please check the video size .','error'); 
                  $this->redirect()->toRoute('marketing-video'); 
              }
             }else{
                 $this->addPageMessage('Please upload .mp4 or .mov videos','error'); 
                  $this->redirect()->toRoute('marketing-video'); 
             }
        }
        return new ViewModel($data);
        
    }
 

}
