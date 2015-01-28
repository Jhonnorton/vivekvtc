<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/SalesObjects for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace SalesObjects;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;

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
	
    public function getServiceConfig()
    {
    	return array(
    			'factories' => array(
    					'Resorts' => function($sm) {
    						return new \SalesObjects\Model\Resorts($sm, '\Base\Entity\Avp\Resorts');
    					},
    					'Rooms' => function($sm) {
    						return new \SalesObjects\Model\Rooms($sm, '\Base\Entity\Avp\ResortRooms');
    					},
    					'Cruises' => function($sm) {
    						return new \SalesObjects\Model\Cruises($sm, '\Base\Entity\Avp\Cruises');
    					},
    					'Cabins' => function($sm) {
    						return new \SalesObjects\Model\Cabins($sm, '\Base\Entity\Avp\CruiseCabins');
    					},
    					'Ports' => function($sm) {
    						return new \SalesObjects\Model\Ports($sm, '\Base\Entity\Avp\CruisePorts');
    					},
    					'Itinerary' => function($sm) {
    						return new \SalesObjects\Model\Itinerary($sm, '\Base\Entity\Itinerary');
    					},
                                        'Events' => function($sm) {
    						return new \SalesObjects\Model\Events($sm, '\Base\Entity\Avp\Events');
    					},
                                        'EventCategories' => function($sm) {
                                            return new \SalesObjects\Model\EventCategory($sm, '\Base\Entity\Avp\EventCategories');
                                        },
                                        'EventRooms' => function($sm) {
                                            return new \SalesObjects\Model\EventRooms($sm, '\Base\Entity\Avp\EventRooms');
                                        },
    			)
    	);
    }
    
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function onBootstrap($e)
    {
        // You may not need to do this if you're doing it elsewhere in your
        // application
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        $e->getViewModel()->setVariable(__NAMESPACE__, __NAMESPACE__);
    }
}
