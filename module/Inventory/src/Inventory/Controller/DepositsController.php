<?php

namespace Inventory\Controller;

use Zend\Mvc\MvcEvent;

class DepositsController extends \Base\Controller\BaseController {

    protected $_entity = false;

    public function onDispatch(MvcEvent $e) {
//        d('here');

        $this->model = $this->getModel('InventoryDeposits');
        $e->getViewModel()->setVariable('modulename', 'Inventory');
        return parent::onDispatch($e);
    }

    public function indexAction() {
         return $this->getView(array(
                    'collection' => $this->model->getCollection(),
                    'message' => $this->getPageMessages(),
        ));

    }
    
    public function addAction() {
        $form = new \Inventory\Form\DepositForm($this->getEm(), '\Base\Entity\InventoryDeposits');
        
        if ($this->request->isPost()) {
            $data = $this->request->getPost();

            $form->setData($data);

            if ($this->model->isValidModel($form)) {


                $object = array('object' => $this->request->getPost(),);
                //d($object);
                $this->model->depositsave($object);
                $this->addPageMessage('Deposit has been Saved.', 'success');
                // d('success');
                $this->redirect()->toRoute('inventory-deposits');
            }
            
        }
        return $this->getView(array('form' => $form));
    }
    
    public function deleteAction() {
        
        $data = $this->getEm()->find('\Base\Entity\InventoryDeposits', $this->_id);
       
        $this->model->depositdelete($this->_id);

        $this->addPageMessage('The Deposit has been deleted.', 'success');
        $this->redirect()->toRoute('inventory-deposits');
    }
    
    public function updateAction() {

        $data = $this->getEm()->find('\Base\Entity\InventoryDeposits', $this->_id);
       // d($data);
        $form = new \Inventory\Form\DepositForm($this->getEm(),$data);
        //d($form);
        if ($this->request->isPost()) {
            $data = $this->request->getPost();
            $form->setData($data);
            if ($this->model->isValidModel($form)) {
                $object = array('object' => $this->request->getPost(),);
                $this->model->depositupdate($object);
                $data = $this->getEm()->find('\Base\Entity\InventoryDeposits', $this->_id);
                $this->addPageMessage('Deposit has been updated.', 'success');
                $this->redirect()->toRoute('inventory-deposits');
            }
        }

        $view = $this->getView(array(
            'form' => $form,
            'id' => $this->_id,
            'data' => $data,//->getTourId(),
        ));
        return $view;
    }
    
    public function viewAction() {
        $data = $this->getEm()->find('\Base\Entity\InventoryDeposits', $this->_id);

        $types = array();
        $typeIds = array();
        $linkedTo = $data->getlinkedTo();
        $typeId = NULL;
        
        if ($linkedTo == 4) {
            $typeId = $data->getresortId();
        } elseif ($linkedTo == 5) {
            $typeId = $data->geteventId();
        } elseif ($linkedTo == 6) {
            $typeId = $data->getcruiseId();
        } elseif ($linkedTo == 3) {
            $types[] = "Cruises";
        } elseif ($linkedTo == 2) {
            $types[] = "Events";
        } elseif ($linkedTo == 1) {
            $types[] = "Resorts";
        } else {
            $types[] = "All";
        }

        if ($typeId != NULL) {
            $typeIds = explode(',', $typeId);
        }

        foreach ($typeIds as $id) {
            $types[] = $this->model->getTypes($linkedTo, $id);
        }



        $view = $this->getView(array(
            'id' => $this->_id,
            'data' => $data,
            'typenames' => $types
        ));

        return $view;
    }

}
