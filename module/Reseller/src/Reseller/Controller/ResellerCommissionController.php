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

class ResellerCommissionController extends \Base\Controller\BaseController {

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
//        d("Commission");
        $data = array('collection' => $this->model->getResellerCommission(),'message' => $this->getPageMessages());
	//d('2');
        return $this->getView($data);
    }
    
    public function historyAction(){
       $id=$this->params()->fromRoute('id', 0);
       
       $data=array('collection'=>$this->model->getCommHistory($id));
       
       $view=new ViewModel();
       $view->setVariables($data);
       $view->setTerminal(true);
       return $view;
    }
    
    public function setCommissionAction() {
//        d("Set Commission");
        $id=$this->params()->fromRoute('id', 0);
       
        if ($this->request->isPost()) {
            $data = $this->request->getPost();
            $this->model->saveResellerCommission($data,$id);
            $this->addPageMessage('New Commission has been set for reseller', 'success');
//            d('Success');
        }
         $data = array(
            'collection' => $this->model->getResellerSetCommission($id),
            'message' => $this->getPageMessages(),
            'userdata'=>$this->model->getResellerData($id),
         );
         
        return $this->getView($data);
    }
    public function deleteCommissionAction() {
        $cid=$this->params()->fromRoute('id', 0);
        $affiliateid=$this->params()->fromRoute('affiliateid', 0);
        $this->model->deleteResellerCommission($cid);
        $this->addPageMessage('Commission has been deleted', 'success');
        $this->redirect()->toRoute('affiliate-commission-set',array('id'=>$affiliateid));
    }
    public function editCommissionAction() {
        $cid=$this->params()->fromRoute('id', 0);
        $affiliateid=$this->params()->fromRoute('affiliateid', 0);
        if ($this->request->isPost()) {
            $data = $this->request->getPost();
            $this->model->editResellerCommission($data,$cid);
            $this->addPageMessage('Commission has been Updated', 'success');
            $this->redirect()->toRoute('affiliate-commission-set',array('id'=>$affiliateid));
        }
       $data=array('collection'=>$this->model->getCommissionData($cid),'userdata'=>$this->model->getResellerData($affiliateid));
       
       $view=new ViewModel();
       $view->setVariables($data);
       $view->setTerminal(true);
       return $view;
    }
}
