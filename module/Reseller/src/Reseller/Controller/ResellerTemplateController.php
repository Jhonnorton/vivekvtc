<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Orders for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License 123
 */

namespace Reseller\Controller;

use Zend\Mvc\MvcEvent;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;
use Sendmail\Controller\SendmailController;

class ResellerTemplateController extends \Base\Controller\BaseController {

    protected $_entity = false;
    protected $_session = null;

    public function onDispatch(MvcEvent $e) {
        $this->_session = new Container('image');
        $this->_session = new Container('banner');
        $this->_session = new Container('listing');
        $this->model = $this->getModel('Reseller');

        if ($this->params()->fromRoute('id', 0)) {

            $this->_entity = $this->model->getItem($this->params()->fromRoute('id', 0));
        }

        $e->getViewModel()->setVariable('modulename', 'Reseller');

        return parent::onDispatch($e); //smart
    }

    public function indexAction() {
        $data = array('collection' => $this->model->getResellerTemplate(),'message' => $this->getPageMessages());
        return $this->getView($data);
    }
    
    public function addAction(){
        $form = new \Reseller\Form\TemplateForm($this->getEm(self::AVP_CONFIG), '\Base\Entity\Avp\Themes');
        
        if ($this->request->isPost()) {
            $files = $this->request->getFiles()->toArray();
            $data = $this->request->getPost();
            if (!empty($files['image']['name'])) {
                $data['image'] = $files['image']['name'];
            }

//            d($data);    
            $form->setData($data);

            if ($this->model->isValidModel($form)) {
                $object = array('object' => $this->request->getPost(),
                    'files' => $files);
                $this->model->saveTemplate($object);
                $this->addPageMessage('The new template has been uploaded', 'success');
                $this->redirect()->toRoute('affiliate-template');
            }
        }
        
        $data = array('form' => $form);
        return $this->getView($data);
    }
    
   public function suspendAction(){
       $id=$this->params()->fromRoute('id', 0);
       $this->model->suspendTheme($id);
       $this->addPageMessage('The template has been de-activated', 'success');
       $this->redirect()->toRoute('affiliate-template');
   }
   public function unsuspendAction(){
       $id=$this->params()->fromRoute('id', 0);
       $this->model->unsuspendTheme($id);
       $this->addPageMessage('The template has been activated', 'success');
       $this->redirect()->toRoute('affiliate-template');
   }
   public function deleteAction(){
       $id=$this->params()->fromRoute('id', 0);
       $this->model->deleteTheme($id);
       $this->addPageMessage('The template has been deleted', 'success');
       $this->redirect()->toRoute('affiliate-template');
   }
   
   public function editAction(){
        $form = new \Reseller\Form\TemplateForm($this->getEm(self::AVP_CONFIG), '\Base\Entity\Avp\Themes');
        $data=$this->model->getTemplateData($this->params()->fromRoute('id', 0));
        
       $form->setData($data);
        if ($this->request->isPost()) {
            $files = $this->request->getFiles()->toArray();
            $data = $this->request->getPost();
            if (!empty($files['image']['name'])) {
                $data['image'] = $files['image']['name'];
            }

//            d($data);    
            $form->setData($data);

            if ($this->model->isValidModel($form)) {
                $object = array('object' => $this->request->getPost(),
                    'files' => $files);
                $this->model->editTemplate($object,$this->params()->fromRoute('id', 0));
                $this->addPageMessage('The template has been edited', 'success');
                $this->redirect()->toRoute('affiliate-template');
            }
        }
        
        $data1 = array('form' => $form,'collection'=>$data,'id'=>$this->params()->fromRoute('id', 0));
        return $this->getView($data1);
    }
    
}