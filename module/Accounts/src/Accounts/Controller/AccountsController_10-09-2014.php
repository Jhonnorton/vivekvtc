<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Orders for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License 123
 */

namespace Accounts\Controller;

use Zend\Mvc\MvcEvent;
use Sendmail\Controller\SendmailController;
use Zend\View\Model\ViewModel;

class AccountsController extends \Base\Controller\BaseController {

    protected $_entity = false;

    public function onDispatch(MvcEvent $e) {

        //echo "hello"; die;
        $this->model = $this->getModel('Accounts');

        if ($this->params()->fromRoute('id', 0)) {

            $this->_entity = $this->model->getItem($this->params()->fromRoute('id', 0));
        }

        $e->getViewModel()->setVariable('modulename', 'Accounts');

        return parent::onDispatch($e); //smart
    }

    public function indexAction() {
 	$model = $this->getModel('Accounts');    	
    	$data = array(
            'collection' => $model->getCollection(),
            'message'=>$this->getPageMessages(),
    	);  
        return $this->getView($data);
    }
 
       public function editAction() {
        if (!$this->_entity)
            throw new \Exception('Invalid Entity');

        $form = new \Accounts\Form\PayrollForm($this->getEm(), $this->_entity);
        if($this->request->isPost()){    		
            $form->setInputFilter($this->model->getInputFilter());
            $form->setData($this->request->getPost());
            if($form->isValid()){
                
               // d('i m here');
                if($this->model->isValidModel($form)){
                 //          d('indise is valid');
                    $this->model->save($form->getData());
                    $this->addPageMessage('Payroll Information Updated.','success');
                    $this->redirect()->toRoute('accounts');
                }
            } else {
                d($form->getMessages());
            }    		
    	}    	    
        $view = $this->getView(array('form' => $form));
        return $view;
    }
    
    public function viewAction(){
        
        if (!$this->_entity)
            throw new \Exception('Invalid Entity');
        
        
        $data = array('collection' => $this->model->getItemView($this->_entity->getId()));
//d($data);
        return $this->getView($data);        
    }
    
    public function commissionAction(){
        $model = $this->getModel('Accounts');    	
    	$data = array(
            'collection' => $model->getCommissionCollection($type=1),
            'message'=>$this->getPageMessages(),
    	);  
        return $this->getView($data);
    }
    
    
    public function roleCommissionAction(){
        $model = $this->getModel('Accounts');    	
    	$data = array(
            'collection' => $model->getRoleCollection($type=1),
            'message'=>$this->getPageMessages(),
    	);  
        return $this->getView($data);
    }
    
     public function bonusAction(){
        $model = $this->getModel('Accounts');    	
    	$data = array(
            'collection' => $model->getBonusCollection(),
            'message'=>$this->getPageMessages(),
    	);  
        return $this->getView($data);
    }
    
    public function addBonusAction() {

        if($this->request->isPost()){    	
                $this->model->saveBonus($this->request->getPost());
                $this->addPageMessage('New Bonus has been Added.','success');
                $this->redirect()->toRoute('accounts-bonus');
        }    	    
        $view = $this->getView(array('users' => $this->model->getAllUsers()));
        return $view;
    }
    
    public function viewBonusAction(){
        $model = $this->getModel('Accounts');  
        $id=$this->params()->fromRoute('id', 0);
    	$data = array(
            'collection' => $model->getBonusData($id),
            'message'=>$this->getPageMessages(),
    	);  
        //return $this->getView($data);
        
        $result = new ViewModel();
        $result->setTerminal(true);
        $result->setVariables($data);
        return $result;

    }
    
    public function editBonusAction() {
        $id=$this->params()->fromRoute('id', 0);
        if($this->request->isPost()){    	
                $this->model->editBonus($this->request->getPost());
                $this->addPageMessage('Bonus has been Edited.','success');
                $this->redirect()->toRoute('accounts-bonus');
        }    	    
        $view = $this->getView(array('users' => $this->model->getAllUsers(),'data' => $this->model->getBonusData($id)));
        return $view;
    }
    
    public function applyBonusAction() {
        $id=$this->params()->fromRoute('id', 0); 	
        $this->model->applyBonus($id);
        $this->addPageMessage('Bonus has been Applied.','success');
        $this->redirect()->toRoute('accounts-bonus');
       
    }
    public function revertBonusAction() {
        $id=$this->params()->fromRoute('id', 0); 	
        $this->model->revertBonus($id);
        $this->addPageMessage('Bonus has been Revert.','success');
        $this->redirect()->toRoute('accounts-bonus');
       
    }
    public function deleteBonusAction() {
        $id=$this->params()->fromRoute('id', 0); 	
        $this->model->deleteBonus($id);
        $this->addPageMessage('Bonus has been Deleted.','success');
        $this->redirect()->toRoute('accounts-bonus');
       
    }
    
    public function expenseAction(){
        $model = $this->getModel('Accounts');    	
    	$data = array(
            'collection' => $model->getExpenseCollection(),
            'message'=>$this->getPageMessages(),
    	);  
        if($this->request->isPost()){    	
            $search=$this->model->getExpenseSearch($this->request->getPost());
            $data = array(
                'collection' => $search,
                'message'=>$this->getPageMessages(),
                'from'=>$this->request->getPost('from'),
                'to'=>$this->request->getPost('to'),
            ); 
        }    	    
        return $this->getView($data);
    }
    
    public function addExpenseAction() {

        if($this->request->isPost()){    	
                $this->model->saveExpense($this->request->getPost());
                $this->addPageMessage('New Expense has been Added.','success');
                $this->redirect()->toRoute('accounts-expense');
        }    	    
        $view = $this->getView(array('categories'=>$this->model->getExpenseCategories()));
        return $view;
    }
    public function addExpenseCategoryAction() {

        if($this->request->isPost()){    	
                $this->model->saveExpenseCategory($this->request->getPost());
                $this->addPageMessage('New Expense Category has been Added.','success');
                $this->redirect()->toRoute('accounts-expense');
        }    	    
    }
    
    public function editExpenseAction() {
        $id=$this->params()->fromRoute('id', 0);
        if($this->request->isPost()){    	
                $this->model->editExpense($this->request->getPost());
                $this->addPageMessage('Expense has been Updated.','success');
                $this->redirect()->toRoute('accounts-expense');
        }    	    
        $view = $this->getView(array('categories' => $this->model->getExpenseCategories(),'data' => $this->model->getExpenseData($id)));
        return $view;
    }
    
    public function deleteExpenseAction() {
        $id=$this->params()->fromRoute('id', 0); 	
        $this->model->deleteExpense($id);
        $this->addPageMessage('Expense has been Deleted.','success');
        $this->redirect()->toRoute('accounts-expense');
       
    }
    
    public function addRoleCommissionAction(){
        $model = $this->getModel('Accounts');    	
    	$data = array(
            'collection' => $model->getAddRoleCollection(),
            'message'=>$this->getPageMessages(),
            'reservation'=>$model->getReservationActivity(),
            'reseller'=>$model->getResellerActivity(),
    	);  
        if($this->request->isPost()){    	
                $this->model->saveRoleCommission($this->request->getPost());
                $this->addPageMessage('New Role Commission has been Added.','success');
                $this->redirect()->toRoute('role-commission');
        } 
        
        return $this->getView($data);
    }
    
    public function deleteRoleCommissionAction() {
        $id=$this->params()->fromRoute('id', 0); 	
        $this->model->deleteRoleCommission($id);
        $this->addPageMessage('Role Commission has been Deleted.','success');
        $this->redirect()->toRoute('role-commission');
       
    }
    
     public function editRoleCommissionAction(){
        $id=$this->params()->fromRoute('id', 0); 
        $model = $this->getModel('Accounts');    	
    	$data = array(
            'collection' => $model->getAddRoleCollection(),
            'message'=>$this->getPageMessages(),
            'reservation'=>$model->getReservationActivity(),
            'reseller'=>$model->getResellerActivity(),
            'data'=>$model->getRoleCommissionData($id)
    	);  
        if($this->request->isPost()){    	
                $this->model->saveRoleCommissionUpdate($this->request->getPost());
                $this->addPageMessage('Role Commission has been Updated.','success');
                $this->redirect()->toRoute('role-commission');
        } 
        
        return $this->getView($data);
    }
    
    public function setCommissionAction(){
        $userid=$this->params()->fromRoute('id', 0);
        $model = $this->getModel('Accounts');    	
    	$data = array(
            'collection' => $model->getAddRoleCollection(),
            'message'=>$this->getPageMessages(),
            'reservation'=>$model->getReservationActivity(),
            'reseller'=>$model->getResellerActivity(),
            'userdata'=>$model->getUserData($userid),
            'commission'=>$model->getUserCommission($userid)
    	); 
        if($this->request->isPost()){   
//            d($this->request->isPost());
                $this->model->saveUserCommission($this->request->getPost());
                $this->addPageMessage('Commission has been Set for Agent','success');
                $this->redirect()->toRoute('commission-set',array('id'=>$userid));
        } 
        return $this->getView($data);
    }
    public function editUserCommissionAction(){
        $id=$this->params()->fromRoute('id', 0);
        $model = $this->getModel('Accounts');    	
    	$data = array(
           'data'=>$model->getRoleCommissionData($id)
    	); 
        if($this->request->isPost()){   
//            d($this->request->getPost());
                $this->model->saveRoleCommissionUpdate($this->request->getPost());
                $this->addPageMessage('Commission has been Updated for Agent','success');
                $this->redirect()->toRoute('commission-set',array('id'=>$data['data']['0']->getUserId()->getId()));
        } 
        $view=new ViewModel();
        $view->setTerminal(true);
        $view->setVariables($data);
        
        return $view;
    }
    
    public function deleteUserCommissionAction() {
        $id=$this->params()->fromRoute('id', 0); 	
        $data=$this->model->deleteRoleCommission($id);
        $this->addPageMessage('User Commission has been Deleted.','success');
        $this->redirect()->toRoute('commission-set',array('id'=>$data->getUserId()->getId()));
       
    }
}
