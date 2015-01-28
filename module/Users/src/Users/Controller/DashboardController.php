<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Orders for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License 123
 */

namespace Users\Controller;

use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class DashboardController extends \Base\Controller\BaseController {

    protected $_entity = false;

    public function onDispatch(MvcEvent $e) {

        //$this->model = $this->getModel('Dashboard');

        if ($this->params()->fromRoute('id', 0)) {

            $this->_entity = $this->model->getItem($this->params()->fromRoute('id', 0));
        }

        $e->getViewModel()->setVariable('modulename', 'Users');

       return parent::onDispatch($e);//smart
    }

    /**
     * indexAction Dashboard 
     * 
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction() {
        $user = new Container('User');
        $this->model = $this->getModel('Clients');
        $client = $this->model->getClientbyUserId(array('userId'=>$user->user->getId()), true);
    	$data = array(
            'user'=>$user,
            'message'=>$this->getPageMessages(),
            'client'=> $client
    	);  
        return $this->getView($data);
    }
}
