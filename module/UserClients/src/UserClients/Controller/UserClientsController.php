<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Orders for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License 123
 */

namespace UserClients\Controller;

use Zend\Mvc\MvcEvent;
use Sendmail\Controller\SendmailController;

class UserClientsController extends \Base\Controller\BaseController {

    protected $_entity = false;

    public function onDispatch(MvcEvent $e) {
      // d('in dispatch');
        $this->model = $this->getModel('UserClients');
//d('in dispatch');
        
               // $e->getViewModel()->setVariable('modulename', 'User Clients');
		//return parent::onDispatch($e);
		
       

        
    }

    public function indexAction() {
    
       
    }

    

}

