<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Orders for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Front;


use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
class Module implements AutoloaderProviderInterface, ConfigProviderInterface {

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getServiceConfig() {
        return array(
            'factories' => array(
             /*   'Payments' => function($sm) {
                    return new \Payments\Model\Payments($sm, '\Base\Entity\Reservation');
                }, */
                'Front' => function($sm) {
                    return new \Front\Model\Front($sm,'\Base\Entity\Reservation');
                },
            )
        );
    }
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}