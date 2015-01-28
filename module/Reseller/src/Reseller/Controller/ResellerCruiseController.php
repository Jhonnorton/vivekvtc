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

class ResellerCruiseController extends \Base\Controller\BaseController {

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
        $data = array('collection' => $this->model->getResellerCruise(),);
        return $this->getView($data);
    }
    public function viewAction() {
        $id=$this->params()->fromRoute('id', 0);
        $data = array('collection' => $this->model->getResellerCruiseDetails($id),);
        return $this->getView($data);
    }
    public function galleryAction() {
        $id=$this->params()->fromRoute('id', 0);
        $data = array('collection' => $this->model->getResellerCruiseGallery($id),'id'=>$id);
        return $this->getView($data);
    }
    public function addgalleryAction() {
        $id=$this->params()->fromRoute('id', 0);
        $form = new \Reseller\Form\EventsForm($this->getEm(self::AVP_CONFIG), '\Base\Entity\Avp\CruiseImages');
        
        if ($this->request->isPost()) {
            $files = $this->request->getFiles()->toArray();
            $data = $this->request->getPost();
            if (!empty($files['image']['name'])) {
                $data['image'] = $files['image']['name'];
            }

            //  d($data);    
            $form->setData($data);

            if ($this->model->isValidModel($form)) {
                $object = array('object' => $this->request->getPost(),
                    'files' => $files);
                $this->model->cruiseimagesave($object);
                $this->addPageMessage('The cruise image has been added.', 'success');
                $this->redirect()->toRoute('affiliate-cruise-gallery', array('id' => $id));
            }
        }
        
        $data = array('form' => $form, 'id'=>$id);
        return $this->getView($data);
    }
    
    public function deletegalleryAction() {
        
        $data = $this->getEm()->find('Base\Entity\Avp\CruiseImages', $this->_id);
        // d($data);
        $this->model->deleteCruiseImage($this->_id);

        $this->addPageMessage('The cruise gallery image has been deleted.', 'success');
        $this->redirect()->toRoute('affiliate-cruise-gallery', array('id' => $data->getCruiseId()));
    }
    
     public function cabinAction() {
        $id=$this->params()->fromRoute('id', 0);
        $data = array('collection' => $this->model->getResellerCruiseCabin($id),'id'=>$id);
        return $this->getView($data);
    }
    
    public function deleteAction() {
        
        $data = $this->getEm()->find('Base\Entity\Avp\Cruises', $this->_id);
        //d($data);
        $this->model->deletecruise($this->_id);

        $this->addPageMessage('The cruise has been deleted.', 'success');
        $this->redirect()->toRoute('affiliate-cruise-view');
    }
}