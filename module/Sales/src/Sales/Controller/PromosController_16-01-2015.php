<?php
namespace Sales\Controller;

use Zend\Mvc\MvcEvent;
use Sales\Model\Promos;

class PromosController extends \Base\Controller\BaseController {
	        
    protected $_entity = false;        

    public function onDispatch(MvcEvent $e){
        
        Promos::initServiceManager($this->getServiceLocator());
        
        $this->model = $this->getModel('Promos');
        if($this->params()->fromRoute('id', 0)){
                $this->_entity = $this->model->getItem($this->params()->fromRoute('id', 0));			
        }             
        $e->getViewModel()->setVariable('modulename', 'Promos');
        return parent::onDispatch($e);		
    }


    public function indexAction() {
        
        
      //  echo "hello promos"; die;
        
        return $this->getView (array (
                'collection' => $this->model->getCollection(),				                                
                'message'=>$this->getPageMessages(),                
        ) );
    }
    
    public function addAction() {
        
        $form = new \Sales\Form\PromosForm($this->getEm(), 
                $this->getEm(self::AVP_CONFIG), '\Base\Entity\InventoryPromo');
        if ($this->request->isPost()) {
            
       //     d($this->request->getPost());
            
            
            $data = $this->request->getPost();
          //  d($form->setInputFilter($this->model->getInputFilter()));
            //$form->setData($data);     
            
            //d($form->isValid());
            //if ($form->isValid()) {
                
                //if($this->model->isValidModel($form)){
                    
                   //   echo "down here"; die;
                
              
                    
                    $this->model->saveObject($this->request->getPost(), isset($data['ids']) ? $data['ids'] : null);
                    $this->addPageMessage('The promo has been saved.','success');
                    $this->redirect()->toRoute('promos');
               // }
           /* } else {
                $form->getMessages();
            }*/
        }
        $view = $this->getView(array('form' => $form));
        return $view;
    }
    
    public function editAction() {
        if (!$this->_entity){
            throw new \Exception('Invalid Entity');
        }        
        $form = new \Sales\Form\EditPromosForm($this->getEm(), 
                $this->getEm(self::AVP_CONFIG), $this->_entity);
        $form->get('submit')->setValue('edit');
        if ($this->request->isPost()) {
            $data = $this->request->getPost();            
            $form->setInputFilter($this->model->getInputFilter());            
         //   $form->setData($data);            
            //if ($form->isValid()) {                
            //    if($this->model->isValidModelOnEdit($form)){                    
                    $this->model->updateObject($this->request->getPost(), isset($data['ids']) ? $data['ids'] : null);                    
                    $this->addPageMessage('The promo has been updated.','success');	
                    $this->redirect()->toRoute('promos');
              //  }                
         //   } else {                
           //     $form->getMessages ();
            //}           
        }
    
    
   
        $form->initIds($this->_entity);            
        $view = $this->getView(array (
                        'form' => $form
        ) );
        return $view;
    }
    
    public function deleteAction() {                
        if(!$this->_id && !$this->request->isPost()){        
            throw new \Exception('Invalid Entity');
        }
        $this->model->delete($this->_id);
        $this->addPageMessage('The promo has been deleted.','success');        
        $this->redirect()->toRoute('promos');
    }     
}
