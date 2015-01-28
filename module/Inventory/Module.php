<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Inventory for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Inventory;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module implements AutoloaderProviderInterface {

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    // if we're in a namespace deeper than one level we need to fix the \ in the path
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/', __NAMESPACE__),
                ),
            ),
        );
    }

    public function getServiceConfig() {
        return array(
            'factories' => array(
                'InventoryCruise' => function($sm) {
                    return new \Inventory\Model\InventoryCruise($sm, '\Base\Entity\InventoryCruise');
                },
                'InventoryHotels' => function($sm) {
                    return new \Inventory\Model\InventoryHotels($sm, '\Base\Entity\InventoryHotels');
                },
                'InventoryEvent' => function($sm) {
                    return new \Inventory\Model\InventoryEvent($sm, '\Base\Entity\InventoryEvent');
                },
                'Transfers' => function($sm) {
                    return new \Inventory\Model\Transfers($sm, '\Base\Entity\InventoryTransfer');
                },
                'Excursions' => function($sm) {
                    return new \Inventory\Model\Excursions($sm, '\Base\Entity\InventoryExcursion');
                },
                'Items' => function($sm) {
                    return new \Inventory\Model\Items($sm, '\Base\Entity\InventoryItem');
                },
                'Promos' => function($sm) {
                    return new \Inventory\Model\Promos($sm, '\Base\Entity\InventoryPromo');
                },
                'AjaxModel' => function($sm) {
                    return new \Inventory\Model\AjaxModel($sm);
                },
                'CruisePromo' => function($sm) {
                    return new \Base\Model\BaseModel($sm, '\Base\Entity\CruisePromo');
                },
                'ResortPromo' => function($sm) {
                    return new \Base\Model\BaseModel($sm, '\Base\Entity\ResortPromo');
                },
                'EventCategoryPromo' => function($sm) {
                    return new \Base\Model\BaseModel($sm, '\Base\Entity\EventCategoryPromo');
                },
                'EventsPromo' => function($sm) {
                    return new \Base\Model\BaseModel($sm, '\Base\Entity\EventsPromo');
                },
                'RoomsPromo' => function($sm) {
                    return new \Base\Model\BaseModel($sm, '\Base\Entity\RoomsPromo');
                },
                'EventRoomsPromo' => function($sm) {
                    return new \Base\Model\BaseModel($sm, '\Base\Entity\EventRoomsPromo');
                },
                'CabinsPromo' => function($sm) {
                    return new \Base\Model\BaseModel($sm, '\Base\Entity\CabinsPromo');
                },
                'Tours' => function($sm) {
                    return new \Inventory\Model\Tours($sm, '\Base\Entity\Tours');
                },
                'InventoryDeposits' => function($sm) {
                    return new \Inventory\Model\InventoryDeposits($sm, '\Base\Entity\InventoryDeposits');
                },
            )
        );
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function onBootstrap(MvcEvent $e) {
        // You may not need to do this if you're doing it elsewhere in your
        // application
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        $e->getViewModel()->setVariable(__NAMESPACE__, __NAMESPACE__);
    }

}
