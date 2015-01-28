<?php

namespace Sales\Controller;

use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;

//class AjaxController extends \Base\Controller\BaseController {
class AjaxController extends AbstractActionController {

    protected $_entity = false;
    public $model;

    public function onDispatch(MvcEvent $e) {

        $e->getViewModel()->setVariable('modulename', 'SalesObjects');
        $this->layout('layout/ajax');
        $this->model= $this->getModel('Receipts');
        return parent::onDispatch($e);
    }

    public function viewreceiptAction() {
       
        $id = $this->params()->fromRoute('id', 0);
        $receipt = $this->model->getReceiptDetail($id);
        $forTypeForId = $this->model->getForTypeForId($receipt->getForType(),$receipt->getForId());
        $data = array(
            'receipt' => $receipt,
            'forId'   => $forTypeForId,
        );
        return new ViewModel($data);
    }

    protected function getEm() {
        return $this->getServiceLocator()->get('doctrine.entitymanager.orm_avp');
    }

    protected function getModel($model) {
        return $this->getServiceLocator()->get($model);
    }

}
