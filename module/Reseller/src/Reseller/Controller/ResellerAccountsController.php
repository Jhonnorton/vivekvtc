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

class ResellerAccountsController extends \Base\Controller\BaseController {

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
        $data = array('collection' => $this->model->getResellerAccounts(),'message' => $this->getPageMessages());
        return $this->getView($data);
    }
    
    public function addRoleAction() {
        if ($this->request->isPost()) {
            $data = $this->request->getPost();
            
            $this->model->affiliaterolesave($data);
            $this->addPageMessage('New Role Has Been Added', 'success');
            $this->redirect()->toRoute('affiliate-accounts');
        }
    }
    public function addRoleActivityAction() {
        if ($this->request->isPost()) {
            $data = $this->request->getPost();
            
            $this->model->affiliateroleactivitysave($data);
            $this->addPageMessage('New Role Activity Has Been Added', 'success');
            $this->redirect()->toRoute('affiliate-accounts');
        }
        $data = array('roles' => $this->model->getResellerRoles(),);
        return $this->getView($data);
    }
    
    public function updateAction() {
        $id=$this->params()->fromRoute('id', 0);
        if ($this->request->isPost()) {
            $data = $this->request->getPost();
           
            $this->model->affiliateaccountupdate($data);
            $this->addPageMessage('Account is updated', 'success');
            $this->redirect()->toRoute('affiliate-accounts');
        }
        $data = array(
            'account' => $this->model->getResellerAccountInfo($id),
            'roles'=>$this->model->getResellerRoles(),
            'rolesactivity'=>$this->model->getRolesActivity(),
            'related'=>$this->model->getRelationRoles($id)
                );
        return $this->getView($data);
    }
    
    public function rolesAction() {
        $data = array('collection' => $this->model->getResellerRoles(),'message' => $this->getPageMessages());
        return $this->getView($data);
    }
    
    public function deleteRoleAction(){
        $id=$this->params()->fromRoute('id', 0);
        $this->model->affiliatedeleterole($id);
        $this->addPageMessage('Role is Deleted', 'success');
        $this->redirect()->toRoute('affiliate-roles');
    }
    
    public function editRoleAction() {
        $id=$this->params()->fromRoute('id', 0);
        if ($this->request->isPost()) {
            $data = $this->request->getPost();
            
            $this->model->affiliateroleedit($data);
            $this->addPageMessage('Role Has Been Updated', 'success');
            $this->redirect()->toRoute('affiliate-roles');
        }
         $data = array('collection' => $this->model->getResellerRolesData($id),);
        return $this->getView($data);
    }
    
    public function rolesActivityAction() {
        $data = array('collection' => $this->model->getResellerRolesActivity(),
            'message' => $this->getPageMessages());
        return $this->getView($data);
    }
    
    public function deleteActivityAction(){
        $id=$this->params()->fromRoute('id', 0);
        $this->model->affiliatedeleteactivity($id);
        $this->addPageMessage('Role Activity is Deleted', 'success');
        $this->redirect()->toRoute('affiliate-roles-activity');
    }
    
    public function editActivityAction() {
        $id=$this->params()->fromRoute('id', 0);
        if ($this->request->isPost()) {
            $data = $this->request->getPost();
            
            $this->model->affiliateeditactivity($data);
            $this->addPageMessage('Role Activity Has Been Updated', 'success');
            $this->redirect()->toRoute('affiliate-roles-activity');
        }
         $data = array('collection' => $this->model->getResellerRolesActivityData($id),'roles' => $this->model->getResellerRoles());
        return $this->getView($data);
    }
    
}