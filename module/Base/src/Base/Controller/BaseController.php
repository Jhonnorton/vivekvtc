<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Base for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Base\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;
use Zend\Mvc\MvcEvent;

class BaseController extends AbstractActionController {

    public static $itemPerPage = 10;
    protected $_em;
    protected $_id = false;
    public $request;
    
    const AVP_CONFIG = 1;
    const RM_config  = 0;

    public function onDispatch(MvcEvent $e) {

        $authenticationService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
        $loggedUser = $authenticationService->getIdentity();


        if (!$loggedUser && !$this->getSessionData('User', 'user') || !$authenticationService->hasIdentity()) {

            if ($this->url()->fromRoute() !== $this->url()->fromRoute('login') &&
                    $this->url()->fromRoute() !== $this->url()->fromRoute('restore')
            ) {

                return $this->redirect()->toRoute('login');
            }
        }
        //d($this->url('/'));
        if ($this->url()->fromRoute() == $this->url()->fromRoute('base'))
            return $this->redirect()->toRoute('users');


        $this->_em = $this->getDoctrineEntityManager();

        $this->request = $this->getRequest();

        if ($this->params()->fromRoute('id', 0)) {
            $this->_id = $this->params()->fromRoute('id', 0);
        }

        //d($this->request->getBaseUrl());

        $this->layout('layout/base');

        $this->setLayoutTitle($e);

       return parent::onDispatch($e);
    }

    protected function setSessionData($namespace, $name, $value) {

        $session = new Container($namespace);

        $session->$name = $value;
    }

    protected function getSessionData($namespace, $name = null) {

        $session = new Container($namespace);

        if (!is_null($name))
            return $session->$name;

        return $session;
    }

    protected function getModel($model) {
        return $this->getServiceLocator()->get($model);
    }

    protected function getDoctrineEntityManager() {
        return $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
    }

    protected function getViewHelper($helperName) {
        return $this->getServiceLocator()->get('viewhelpermanager')->get($helperName);
    }

    protected function getHeadScript() {
        return $this->getViewHelper('HeadScript');
    }

    protected function getHeadLink() {
        return $this->getViewHelper('HeadLink');
    }

    protected function addPageMessage($message, $messageType = '') {
        $session = new Container(__NAMESPACE__ . '\Page\Messages');

        $pageMessages = array();

        if ($session->offsetExists('pageMessages')) {
            $pageMessages = $session->offsetGet('pageMessages');
        }

        $pageMessages[] = array(
            'message' => $message,
            'type' => $messageType
        );

        $session->offsetSet('pageMessages', $pageMessages);
    }

    protected function getPageMessages() {
        $session = new Container(__NAMESPACE__ . '\Page\Messages');

        $pageMessages = array();

        if ($session->offsetExists('pageMessages')) {
            $pageMessages = $session->offsetGet('pageMessages');
        }

        $session->offsetUnset('pageMessages');

        return $pageMessages;
    }

    protected function getView(array $data) {

        return new ViewModel($data);
    }

    protected function getEm($name = 0) {
        
        $doctrine = 'doctrine.entitymanager.orm_default';
        
        switch ($name){
            case self::AVP_CONFIG:
                $doctrine = 'doctrine.entitymanager.orm_avp';
                break;
            default :
                $doctrine = 'doctrine.entitymanager.orm_default';
                break;
        }
        
        return $this->getServiceLocator()->get($doctrine);
    }
    

    public function index() {
        
    }

    public function setLayoutTitle(MvcEvent $e) {
        //d($e->getRouteMatch()->getMatchedRouteName());

        $matches = $e->getRouteMatch();
        $action = $matches->getParam('action');
        $controller = $matches->getParam('controller');
        //$module     = __NAMESPACE__;
        $siteName = 'Reservation Manager';

        // Getting the view helper manager from the application service manager
        $viewHelperManager = $e->getApplication()->getServiceManager()->get('viewHelperManager');

        // Getting the headTitle helper from the view helper manager
        $headTitleHelper = $viewHelperManager->get('headTitle');

        // Setting a separator string for segments
        $headTitleHelper->setSeparator(' - ');

        // Setting the action, controller, module and site name as title segments
        $headTitleHelper->append($action);
        $headTitleHelper->append($controller);
        //$headTitleHelper->append($module);
        $headTitleHelper->append($siteName);
    }

}
