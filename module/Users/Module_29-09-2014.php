<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Users for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Users;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Session\Container;

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
    					'Users' => function($sm) {
    						return new \Users\Model\Users($sm, '\Base\Entity\Users');
    					},
    					'Clients' => function($sm) {
    						return new \Users\Model\Clients($sm, '\Base\Entity\Avp\Clients');
    					},
    					'Auth' => function($sm) {
    						return new \Users\Model\Auth($sm, '\Base\Entity\Users');
    					},
    					'Acl' => function($sm) {
    						return new \Users\Model\Acl($sm, '\Base\Entity\Role');
    					},
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
        
        $this -> initAcl($e);
        $e -> getApplication() -> getEventManager() -> attach('route', array($this, 'checkAcl'));
        
       	$e->getViewModel()->setVariable(__NAMESPACE__, __NAMESPACE__);
        
        //d($this->getPermissions($e));
        
        
        
    }
    
	public function initAcl(MvcEvent $e) {
	 	
	    $acl = new \Zend\Permissions\Acl\Acl();	    
	    $roles = $this->getPermissions($e);
	    $allResources = $this->getAllResources($e);
	    //d($roles);
	    foreach ($roles as $role => $resources) {
	 
	        $role = new \Zend\Permissions\Acl\Role\GenericRole($role);
	        $acl -> addRole($role);
	 
	        //$allResources = array_merge($resources, $allResources);
	 
	        //adding resources
	        foreach ($allResources as $resource) {
	             // Edit 4
                   // d($allResources);
	             if(!$acl ->hasResource($resource))
	                $acl -> addResource(new \Zend\Permissions\Acl\Resource\GenericResource($resource));
	        }                
	        //adding restrictions
	        foreach ($resources as $resource) {

                    if(in_array($resource, $allResources)){
                        $acl -> allow($role, $resource);
                    }	            
	        }                
                
                //$acl->allow($role, 'orders-ajax-reservation-sendmail');
                /*
	        $acl->allow($role, $resource);	        	        	        
	        $acl->allow($role, 'orders-ajax');
	        $acl->allow($role, 'profile');	        
	        $acl->allow($role, 'profile-save');
	        $acl->allow($role, 'sendmail');
	        $acl->allow($role, 'clients');
	        $acl->allow($role, 'clients-add');
	        $acl->allow($role, 'clients-edit');
	        $acl->allow($role, 'clients-delete');
	        $acl->allow($role, 'hotels');
	        $acl->allow($role, 'hotels-add');
	        $acl->allow($role, 'hotels-edit');
	        $acl->allow($role, 'hotels-delete');
	        $acl->allow($role, 'rooms');
	        $acl->allow($role, 'rooms-add');
	        $acl->allow($role, 'rooms-edit');
	        $acl->allow($role, 'rooms-delete');
	        $acl->allow($role, 'sendmail');
	        $acl->allow($role, 'sendmail-add');
	        $acl->allow($role, 'sendmail-edit');
	        $acl->allow($role, 'sendmail-delete');	        
	        $acl->allow($role, 'resources');
	        $acl->allow($role, 'cruises');
	        $acl->allow($role, 'cruises-add');
	        $acl->allow($role, 'cruises-edit');
	        $acl->allow($role, 'cruises-delete');
	        $acl->allow($role, 'cabins');
	        $acl->allow($role, 'cabins-add');
	        $acl->allow($role, 'cabins-edit');
	        $acl->allow($role, 'cabins-delete');
	        $acl->allow($role, 'ports');
	        $acl->allow($role, 'ports-add');
	        $acl->allow($role, 'ports-edit');
	        $acl->allow($role, 'ports-delete');
                $acl->allow($role, 'imgupload');
		$acl->allow($role, 'itineraries');
	        $acl->allow($role, 'itineraries-add');
	        $acl->allow($role, 'itineraries-edit');
	        $acl->allow($role, 'itineraries-delete');
	        $acl->allow($role, 'restore');
                $acl->allow($role, 'events');
	        $acl->allow($role, 'events-add');
	        $acl->allow($role, 'events-edit');
	        $acl->allow($role, 'events-delete');
                $acl->allow($role, 'ajax-resorts-item');
                $acl->allow($role, 'ajax-cruises-item');
                $acl->allow($role, 'orders');
                $acl->allow($role, 'orders-add');
                $acl->allow($role, 'orders-edit');
                $acl->allow($role, 'orders-delete');                
                $acl->allow($role, 'invoice');
                $acl->allow($role, 'invoice-add');
                $acl->allow($role, 'invoice-edit');
                $acl->allow($role, 'invoice-delete');
                $acl->allow($role, 'sendmail-foo');
                $acl->allow($role, 'sendmail-item');                
                $acl->allow($role, 'clients-item');                
                $acl->allow($role, 'inventory-resort-rooms');
                $acl->allow($role, 'inventory-event-rooms');                                                                                
                $acl->allow($role, 'inventory-resort-rooms-add');
                $acl->allow($role, 'inventory-resort-rooms-edit');
                $acl->allow($role, 'inventory-resort-rooms-delete');
                $acl->allow($role, 'inventory-event-rooms-add');
                $acl->allow($role, 'inventory-event-rooms-edit');
                $acl->allow($role, 'inventory-event-rooms-delete');
                $acl->allow($role, 'inventory-cruise-cabins');
                $acl->allow($role, 'inventory-cruise-cabins-add');
                $acl->allow($role, 'inventory-cruise-cabins-edit');
                $acl->allow($role, 'inventory-cruise-cabins-delete');
                $acl->allow($role, 'inventory-transfers');
                $acl->allow($role, 'inventory-transfers-add');
                $acl->allow($role, 'inventory-transfers-edit');
                $acl->allow($role, 'inventory-transfers-delete');
                $acl->allow($role, 'inventory-excursions');
                $acl->allow($role, 'inventory-excursions-add');
                $acl->allow($role, 'inventory-excursions-edit');
                $acl->allow($role, 'inventory-excursions-delete');                
                $acl->allow($role, 'inventory-items');
                $acl->allow($role, 'inventory-items-add');
                $acl->allow($role, 'inventory-items-edit');
                $acl->allow($role, 'inventory-items-delete');
                $acl->allow($role, 'inventory-promos');
                $acl->allow($role, 'inventory-promos-add');
                $acl->allow($role, 'inventory-promos-edit');
                $acl->allow($role, 'inventory-promos-delete');                
                $acl->allow($role, 'inventory-ajax-cruise-cabins');                
                $acl->allow($role, 'inventory-ajax-resort-rooms');                 
                $acl->allow($role, 'inventory-ajax-event-rooms');                
                $acl->allow($role, 'inventory-ajax-events');
                $acl->allow($role, 'inventory-ajax-cruises');
                $acl->allow($role, 'inventory-ajax-resorts');
                $acl->allow($role, 'inventory-ajax-evevnt-categories');                
                $acl->allow($role, 'orders-ajax-events');
                $acl->allow($role, 'orders-ajax-cruises');
                $acl->allow($role, 'orders-ajax-resorts');                 
                $acl->allow($role, 'orders-ajax-event-rooms');
                $acl->allow($role, 'orders-ajax-cruise-cabins');
                $acl->allow($role, 'orders-ajax-resort-rooms');                
                $acl->allow($role, 'orders-ajax-event-room');
                $acl->allow($role, 'orders-ajax-cruise-cabin');
                $acl->allow($role, 'orders-ajax-resort-room');    
                
                $acl->allow($role, 'inventory-ajax-promo-linkedto');                
                
                $acl->allow($role, 'orders-ajax-items');  
                
        */
                $acl->allow($role, 'orders-ajax-reservation');
                $acl->allow($role, 'orders-view');
                $acl->allow($role, 'orders-canceled');
				                                
	    }
	    
	    //setting to view
	    $e -> getViewModel() -> acl = $acl;
	 
	}
	 
	public function checkAcl(MvcEvent $e) {
	    $route = $e -> getRouteMatch() -> getMatchedRouteName();
	    //you set your role
	    $userRole = 'Administrator';
            
            $authenticationService = $e->getApplication()->getServiceManager()->get('Zend\Authentication\AuthenticationService');
            $loggedUser = $authenticationService->getIdentity();
	    if($loggedUser):
                $userRole = $loggedUser->getRole()->getName();
            
            if($loggedUser->getRole()->getId()== 8 || $loggedUser->getRole()->getId()== 2){
               // $this->clearAll($e);
               return true;
            }
            endif;
                //$userRole  = 'Administrator';//added smart
            //d($e -> getViewModel() -> acl -> isAllowed($userRole, $route));
	    if ($e -> getViewModel() -> acl ->hasResource($route) && !$e -> getViewModel() -> acl -> isAllowed($userRole, $route)) {
	        $response = $e -> getResponse();
	        //location to page or what ever
	        $response -> getHeaders() -> addHeaderLine('Location', $e -> getRequest() -> getBaseUrl() . '/404');
	        $response -> setStatusCode(303);
	 
	    }
	}
    
    public function getPermissions(MvcEvent $e){
    	
    	$permissions = array();
    	
    	$acl = $e->getApplication()->getServiceManager()->get('Acl');
    	
    	foreach ($acl->getPermissions() as $item){
    		
    		$permissions[$item->getRole()->getName()][] = $item->getResource()->getName();
    		
    	}     	
    	return $permissions;
    	
    }
    
    public function getAllResources(MvcEvent $e){
    	
    	$exceptions = array('0','doctrine_orm_module_yuml', 'home', 'application', 'base');
    	
    	$resourses = array();
    	
    	$config = $e->getApplication()->getServiceManager()->get('COnfig');
    	
    	$routes = $config['router']['routes'];
    	
    	foreach ($routes as $name => $routeConfig){
    		
    		if(array_search($name, $exceptions)) continue;
    		
    		$resourses[] = $name;
    		
    	}    	
    	
    	return $resourses;
    	
    }
    
    public function setAllResources(MvcEvent $e){
    	
    	$acl = $e->getApplication()->getServiceManager()->get('Acl');
    	
    	$acl->setResources($this->getAllResources($e));    	    	
    }
    
//    public function clearAll(MvcEvent $e){
//    	
//    	$authenticationService = $e->getApplication()->getServiceManager()->get('Zend\Authentication\AuthenticationService');
//    	 
//    	$identity = $authenticationService->getIdentity();
//    	$authenticationService->getStorage()->clear($identity);
//    	
//    	$authenticationService->clearIdentity();
//    	 
//    	$session = $this->getSessionData('User');
//    	
//    	$session->offsetUnset('User');
//    	 
//    	$session->getManager()->destroy();
//    	
//    	$response = $e -> getResponse();
//	        //location to page or what ever
//        //$e->getViewModel()->setTemplate('/login');
//        $response -> getHeaders() -> addHeaderLine('Location', $e -> getRequest() -> getBaseUrl() . '/login');
//        $response -> setStatusCode(303);
//    	
//    }
//    
//     protected function getSessionData($namespace, $name = null) {
//
//        $session = new Container($namespace);
//
//        if (!is_null($name))
//            return $session->$name;
//
//        return $session;
//    }
}




