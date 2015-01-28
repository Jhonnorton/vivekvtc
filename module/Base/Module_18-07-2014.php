<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Base for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Base;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Authentication\AuthenticationService;

class Module implements AutoloaderProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
		    // if we're in a namespace deeper than one level we need to fix the \ in the path
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/' , __NAMESPACE__),
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig()
    {
    	return array(
    			'factories' => array(
    					'Zend\Authentication\AuthenticationService' => function($serviceManager) {
    						// If you are using DoctrineORMModule:
    						return $serviceManager->get('doctrine.authenticationservice.orm_default');

    					},
//     					'doctrine.entitymanager.orm_avp'        => new \DoctrineORMModule\Service\EntityManagerFactory('orm_avp'),
//     					'doctrine.connection.orm_avp'           => new \DoctrineORMModule\Service\DBALConnectionFactory('orm_avp'),
//     					'doctrine.configuration.orm_avp'        => new \DoctrineORMModule\Service\ConfigurationFactory('orm_avp'),
    			)
    	);
    }
    
    public function onBootstrap($e)
    {        
        // You may not need to do this if you're doing it elsewhere in your
        // application
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        
        $app = $e->getParam('application');
        $app->getEventManager()->attach('render', array($this, 'setLayoutTitle'));
    }
    
    /**
     * @param  \Zend\Mvc\MvcEvent $e The MvcEvent instance
     * @return void
     */
    public function setLayoutTitle($e)
    {
    	$matches    = $e->getRouteMatch();
    	//$action     = $matches->getParam('action');
    	//$controller = $matches->getParam('controller');
    	$module     = __NAMESPACE__;
    	$siteName   = 'Reservation Manager';
    
    	// Getting the view helper manager from the application service manager
    	$viewHelperManager = $e->getApplication()->getServiceManager()->get('viewHelperManager');
    
    	// Getting the headTitle helper from the view helper manager
    	$headTitleHelper   = $viewHelperManager->get('headTitle');
    
    	// Setting a separator string for segments
    	$headTitleHelper->setSeparator(' - ');
    
    	// Setting the action, controller, module and site name as title segments
    	//$headTitleHelper->append($action);
    	//$headTitleHelper->append($controller);
    	$headTitleHelper->append($module);
    	$headTitleHelper->append($siteName);
    }
}
