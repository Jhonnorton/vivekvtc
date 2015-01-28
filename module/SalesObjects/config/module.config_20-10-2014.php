<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'SalesObjects\Controller\Hotels' => 'SalesObjects\Controller\HotelsController',
        	'SalesObjects\Controller\Rooms' => 'SalesObjects\Controller\RoomsController',
        	'SalesObjects\Controller\Cruises' => 'SalesObjects\Controller\CruisesController',
        	'SalesObjects\Controller\Cabins' => 'SalesObjects\Controller\CabinsController',
        	'SalesObjects\Controller\Ports' => 'SalesObjects\Controller\PortsController',
        	'SalesObjects\Controller\Iterary' => 'SalesObjects\Controller\IteraryController',
                'SalesObjects\Controller\Events' => 'SalesObjects\Controller\EventsController',
                'SalesObjects\Controller\Ajax' => 'SalesObjects\Controller\AjaxController',
                'SalesObjects\Controller\EventRooms' => 'SalesObjects\Controller\EventRoomsController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'sales-objects' => array(
                'type'    => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/hotels',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'SalesObjects\Controller',
                        'controller'    => 'Hotels',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    // This route is a sane default when developing a module;
                    // as you solidify the routes for your module, however,
                    // you may want to remove it and replace it with more
                    // specific routes.
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        		
        		'hotels' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						// Change this to something specific to your module
        						'route'    => '/admin/resorts',
        						'defaults' => array(
        								// Change this value to reflect the namespace in which
        								// the controllers for your module are found
        								'__NAMESPACE__' => 'SalesObjects\Controller',
        								'controller'    => 'Hotels',
        								'action'        => 'index',
        						),
        				),
        		),
        		
        		'hotels-add' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						// Change this to something specific to your module
        						'route'    => '/admin/resorts/add',
        						'defaults' => array(
        								// Change this value to reflect the namespace in which
        								// the controllers for your module are found
        								'__NAMESPACE__' => 'SalesObjects\Controller',
        								'controller'    => 'Hotels',
        								'action'        => 'add',
        						),
        				),
        		),
        		
        		'hotels-edit' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						// Change this to something specific to your module
        						'route'    => '/admin/resorts/edit/:id',
        						'defaults' => array(
        								// Change this value to reflect the namespace in which
        								// the controllers for your module are found
        								'__NAMESPACE__' => 'SalesObjects\Controller',
        								'controller'    => 'Hotels',
        								'action'        => 'edit',
        								'id'			=> 0,
        						),
        				),
        		),
        		
        		'hotels-delete' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						// Change this to something specific to your module
        						'route'    => '/admin/resorts/delete/:id',
        						'defaults' => array(
        								// Change this value to reflect the namespace in which
        								// the controllers for your module are found
        								'__NAMESPACE__' => 'SalesObjects\Controller',
        								'controller'    => 'Hotels',
        								'action'        => 'delete',
        								'id'			=> 0,
        						),
        				),
        		),
        		
        		'rooms' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						// Change this to something specific to your module
        						'route'    => '/admin/rooms',
        						'defaults' => array(
        								// Change this value to reflect the namespace in which
        								// the controllers for your module are found
        								'__NAMESPACE__' => 'SalesObjects\Controller',
        								'controller'    => 'Rooms',
        								'action'        => 'index',
        						),
        				),
        		),
        		
        		'rooms-add' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						// Change this to something specific to your module
        						'route'    => '/admin/rooms/add',
        						'defaults' => array(
        								// Change this value to reflect the namespace in which
        								// the controllers for your module are found
        								'__NAMESPACE__' => 'SalesObjects\Controller',
        								'controller'    => 'Rooms',
        								'action'        => 'add',
        						),
        				),
        		),
        		
        		'rooms-edit' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						// Change this to something specific to your module
        						'route'    => '/admin/rooms/edit/:id',
        						'defaults' => array(
        								// Change this value to reflect the namespace in which
        								// the controllers for your module are found
        								'__NAMESPACE__' => 'SalesObjects\Controller',
        								'controller'    => 'Rooms',
        								'action'        => 'edit',
        								'id'			=> 0,
        						),
        				),
        		),
        		
        		'rooms-delete' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						// Change this to something specific to your module
        						'route'    => '/admin/rooms/delete/:id',
        						'defaults' => array(
        								// Change this value to reflect the namespace in which
        								// the controllers for your module are found
        								'__NAMESPACE__' => 'SalesObjects\Controller',
        								'controller'    => 'Rooms',
        								'action'        => 'delete',
        								'id'			=> 0,
        						),
        				),
        		),
        		

        		'cruises' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						// Change this to something specific to your module
        						'route'    => '/admin/cruises',
        						'defaults' => array(
        								// Change this value to reflect the namespace in which
        								// the controllers for your module are found
        								'__NAMESPACE__' => 'SalesObjects\Controller',
        								'controller'    => 'Cruises',
        								'action'        => 'index',
        						),
        				),
        		),
        		
        		'cruises-add' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						// Change this to something specific to your module
        						'route'    => '/admin/cruises/add',
        						'defaults' => array(
        								// Change this value to reflect the namespace in which
        								// the controllers for your module are found
        								'__NAMESPACE__' => 'SalesObjects\Controller',
        								'controller'    => 'Cruises',
        								'action'        => 'add',
        						),
        				),
        		),
        		
        		'cruises-edit' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						// Change this to something specific to your module
        						'route'    => '/admin/cruises/edit/:id',
        						'defaults' => array(
        								// Change this value to reflect the namespace in which
        								// the controllers for your module are found
        								'__NAMESPACE__' => 'SalesObjects\Controller',
        								'controller'    => 'Cruises',
        								'action'        => 'edit',
        								'id'			=> 0,
        						),
        				),
        		),
        		
        		'cruises-delete' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						// Change this to something specific to your module
        						'route'    => '/admin/cruises/delete/:id',
        						'defaults' => array(
        								// Change this value to reflect the namespace in which
        								// the controllers for your module are found
        								'__NAMESPACE__' => 'SalesObjects\Controller',
        								'controller'    => 'Cruises',
        								'action'        => 'delete',
        								'id'			=> 0,
        						),
        				),
        		),
        		
        		'cabins' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						// Change this to something specific to your module
        						'route'    => '/admin/cruise/cabins',
        						'defaults' => array(
        								// Change this value to reflect the namespace in which
        								// the controllers for your module are found
        								'__NAMESPACE__' => 'SalesObjects\Controller',
        								'controller'    => 'Cabins',
        								'action'        => 'index',
        						),
        				),
        		),
        		
        		'cabins-add' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						// Change this to something specific to your module
        						'route'    => '/admin/cruise/cabins/add',
        						'defaults' => array(
        								// Change this value to reflect the namespace in which
        								// the controllers for your module are found
        								'__NAMESPACE__' => 'SalesObjects\Controller',
        								'controller'    => 'Cabins',
        								'action'        => 'add',
        						),
        				),
        		),
        		
        		'cabins-edit' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						// Change this to something specific to your module
        						'route'    => '/admin/cruise/cabins/edit/:id',
        						'defaults' => array(
        								// Change this value to reflect the namespace in which
        								// the controllers for your module are found
        								'__NAMESPACE__' => 'SalesObjects\Controller',
        								'controller'    => 'Cabins',
        								'action'        => 'edit',
        								'id'			=> 0,
        						),
        				),
        		),
        		
        		'cabins-delete' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						// Change this to something specific to your module
        						'route'    => '/admin/cruise/cabins/delete/:id',
        						'defaults' => array(
        								// Change this value to reflect the namespace in which
        								// the controllers for your module are found
        								'__NAMESPACE__' => 'SalesObjects\Controller',
        								'controller'    => 'Cabins',
        								'action'        => 'delete',
        								'id'			=> 0,
        						),
        				),
        		),
        		
        		
        		'ports' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						// Change this to something specific to your module
        						'route'    => '/admin/cruise/ports',
        						'defaults' => array(
        								// Change this value to reflect the namespace in which
        								// the controllers for your module are found
        								'__NAMESPACE__' => 'SalesObjects\Controller',
        								'controller'    => 'Ports',
        								'action'        => 'index',
        						),
        				),
        		),
        		
        		'ports-add' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						// Change this to something specific to your module
        						'route'    => '/admin/cruise/ports/add',
        						'defaults' => array(
        								// Change this value to reflect the namespace in which
        								// the controllers for your module are found
        								'__NAMESPACE__' => 'SalesObjects\Controller',
        								'controller'    => 'Ports',
        								'action'        => 'add',
        						),
        				),
        		),
        		
        		'ports-edit' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						// Change this to something specific to your module
        						'route'    => '/admin/cruise/ports/edit/:id',
        						'defaults' => array(
        								// Change this value to reflect the namespace in which
        								// the controllers for your module are found
        								'__NAMESPACE__' => 'SalesObjects\Controller',
        								'controller'    => 'Ports',
        								'action'        => 'edit',
        								'id'			=> 0,
        						),
        				),
        		),
        		
        		'ports-delete' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						// Change this to something specific to your module
        						'route'    => '/admin/cruise/ports/delete/:id',
        						'defaults' => array(
        								// Change this value to reflect the namespace in which
        								// the controllers for your module are found
        								'__NAMESPACE__' => 'SalesObjects\Controller',
        								'controller'    => 'Ports',
        								'action'        => 'delete',
        								'id'			=> 0,
        						),
        				),
        		),
        		
				'itineraries' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						// Change this to something specific to your module
        						'route'    => '/admin/cruise/itineraries',
        						'defaults' => array(
        								// Change this value to reflect the namespace in which
        								// the controllers for your module are found
        								'__NAMESPACE__' => 'SalesObjects\Controller',
        								'controller'    => 'Itinerary',
        								'action'        => 'index',
        						),
        				),
        		),
        		
        		'itineraries-add' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						// Change this to something specific to your module
        						'route'    => '/admin/cruise/itineraries/add',
        						'defaults' => array(
        								// Change this value to reflect the namespace in which
        								// the controllers for your module are found
        								'__NAMESPACE__' => 'SalesObjects\Controller',
        								'controller'    => 'Itinerary',
        								'action'        => 'add',
        						),
        				),
        		),
        		
        		'itineraries-edit' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						// Change this to something specific to your module
        						'route'    => '/admin/cruise/itineraries/edit/:id',
        						'defaults' => array(
        								// Change this value to reflect the namespace in which
        								// the controllers for your module are found
        								'__NAMESPACE__' => 'SalesObjects\Controller',
        								'controller'    => 'Itinerary',
        								'action'        => 'edit',
        								'id'			=> 0,
        						),
        				),
        		),
        		
        		'itineraries-delete' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						// Change this to something specific to your module
        						'route'    => '/admin/cruise/itineraries/delete/:id',
        						'defaults' => array(
        								// Change this value to reflect the namespace in which
        								// the controllers for your module are found
        								'__NAMESPACE__' => 'SalesObjects\Controller',
        								'controller'    => 'Itinerary',
        								'action'        => 'delete',
        								'id'			=> 0,
        						),
        				),
        		),
            
                        'events' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						// Change this to something specific to your module
        						'route'    => '/admin/events',
        						'defaults' => array(
        								// Change this value to reflect the namespace in which
        								// the controllers for your module are found
        								'__NAMESPACE__' => 'SalesObjects\Controller',
        								'controller'    => 'Events',
        								'action'        => 'index',
        						),
        				),
        		),
        		
        		'events-add' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						// Change this to something specific to your module
        						'route'    => '/admin/events/add',
        						'defaults' => array(
        								// Change this value to reflect the namespace in which
        								// the controllers for your module are found
        								'__NAMESPACE__' => 'SalesObjects\Controller',
        								'controller'    => 'Events',
        								'action'        => 'add',
        						),
        				),
        		),
        		
        		'events-edit' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						// Change this to something specific to your module
        						'route'    => '/admin/events/edit/:id',
        						'defaults' => array(
        								// Change this value to reflect the namespace in which
        								// the controllers for your module are found
        								'__NAMESPACE__' => 'SalesObjects\Controller',
        								'controller'    => 'Events',
        								'action'        => 'edit',
        								'id'			=> 0,
        						),
        				),
        		),
        		
        		'events-delete' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						// Change this to something specific to your module
        						'route'    => '/admin/events/delete/:id',
        						'defaults' => array(
        								// Change this value to reflect the namespace in which
        								// the controllers for your module are found
        								'__NAMESPACE__' => 'SalesObjects\Controller',
        								'controller'    => 'Events',
        								'action'        => 'delete',
        								'id'			=> 0,
        						),
        				),
        		),
            
                        //event rooms new view 29-05-2014
                        
//                        'event-rooms-cms' => array(
//        				'type'    => 'Segment',
//        				'options' => array(
//        						// Change this to something specific to your module
//        						'route'    => '/admin/eventrooms',
//        						'defaults' => array(
//        								// Change this value to reflect the namespace in which
//        								// the controllers for your module are found
//        								'__NAMESPACE__' => 'SalesObjects\Controller',
//        								'controller'    => 'EventRooms',
//        								'action'        => 'index',
//        						),
//        				),
//        		),
//        		
//        		'event-rooms-add' => array(
//        				'type'    => 'Segment',
//        				'options' => array(
//        						// Change this to something specific to your module
//        						'route'    => '/admin/eventrooms/add',
//        						'defaults' => array(
//        								// Change this value to reflect the namespace in which
//        								// the controllers for your module are found
//        								'__NAMESPACE__' => 'SalesObjects\Controller',
//        								'controller'    => 'EventRooms',
//        								'action'        => 'add',
//        						),
//        				),
//        		),
//        		
//        		'event-rooms-edit' => array(
//        				'type'    => 'Segment',
//        				'options' => array(
//        						// Change this to something specific to your module
//        						'route'    => '/admin/eventrooms/edit/:id',
//        						'defaults' => array(
//        								// Change this value to reflect the namespace in which
//        								// the controllers for your module are found
//        								'__NAMESPACE__' => 'SalesObjects\Controller',
//        								'controller'    => 'EventRooms',
//        								'action'        => 'edit',
//        								'id'			=> 0,
//        						),
//        				),
//        		),
//        		
//        		'event-rooms-delete' => array(
//        				'type'    => 'Segment',
//        				'options' => array(
//        						// Change this to something specific to your module
//        						'route'    => '/admin/eventrooms/delete/:id',
//        						'defaults' => array(
//        								// Change this value to reflect the namespace in which
//        								// the controllers for your module are found
//        								'__NAMESPACE__' => 'SalesObjects\Controller',
//        								'controller'    => 'EventRooms',
//        								'action'        => 'delete',
//        								'id'			=> 0,
//        						),
//        				),
//        		),
                        //end smart
                        
                        
            
                        'ajax-resorts-item' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						// Change this to something specific to your module
        						'route'    => '/admin/resort/:id',
        						'defaults' => array(
        								// Change this value to reflect the namespace in which
        								// the controllers for your module are found
        								'__NAMESPACE__' => 'SalesObjects\Controller',
        								'controller'    => 'Ajax',
        								'action'        => 'resort',
                                                                        'id'		=> 0,
        						),
        				),
        		),
                        
                        'ajax-events-item' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						// Change this to something specific to your module
        						'route'    => '/admin/events/item/:id',
        						'defaults' => array(
        								// Change this value to reflect the namespace in which
        								// the controllers for your module are found
        								'__NAMESPACE__' => 'SalesObjects\Controller',
        								'controller'    => 'Ajax',
        								'action'        => 'event',
                                                                        'id'		=> 0,
        						),
        				),
        		),
                        
                        'ajax-cruises-item' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						// Change this to something specific to your module
        						'route'    => '/admin/cruises/item/:id',
        						'defaults' => array(
        								// Change this value to reflect the namespace in which
        								// the controllers for your module are found
        								'__NAMESPACE__' => 'SalesObjects\Controller',
        								'controller'    => 'Ajax',
        								'action'        => 'cruise',
                                                                        'id'		=> 0,
        						),
        				),
        		),
                        
                        'ajax-event-rooms-save' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						// Change this to something specific to your module
        						'route'    => '/admin/event/eventroomsadd',
        						'defaults' => array(
        								// Change this value to reflect the namespace in which
        								// the controllers for your module are found
        								'__NAMESPACE__' => 'SalesObjects\Controller',
        								'controller'    => 'Ajax',
        								'action'        => 'saveEventRooms',
        						),
        				),
        		),
                        'ajax-event-rooms' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						// Change this to something specific to your module
        						'route'    => '/admin/event/rooms/:id',
        						'defaults' => array(
        								// Change this value to reflect the namespace in which
        								// the controllers for your module are found
        								'__NAMESPACE__' => 'SalesObjects\Controller',
        								'controller'    => 'Ajax',
        								'action'        => 'eventRooms',
        						),
        				),
        		),
        		
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'SalesObjects' => __DIR__ . '/../view',
        ),
    ),
	
		'doctrine' => array(
				 
				// Metadata Mapping driver configuration
				'driver' => array(
						'Avp_Driver' => array(
								'class' => '\Doctrine\ORM\Mapping\Driver\AnnotationDriver',
								'cache' => 'array',
								'paths' => array(__DIR__ . '/../../Base/src/Base/Entity/Avp')
						),
						'orm_avp' => array(
								'class'   => 'Doctrine\ORM\Mapping\Driver\DriverChain',
								'drivers' => array(
										'Base\Entity\Avp' => 'Avp_Driver'
								)
						)
				),
		
		
				'configuration' => array(
						// Configuration for service `doctrine.configuration.orm_avp` service
						'orm_avp' => array(
								// metadata cache instance to use. The retrieved service name will
								// be `doctrine.cache.$thisSetting`
								'metadata_cache'    => 'array',
		
								// DQL queries parsing cache instance to use. The retrieved service
								// name will be `doctrine.cache.$thisSetting`
								'query_cache'       => 'array',
		
								// ResultSet cache to use.  The retrieved service name will be
								// `doctrine.cache.$thisSetting`
								'result_cache'      => 'array',
		
								// Mapping driver instance to use. Change this only if you don't want
								// to use the default chained driver. The retrieved service name will
								// be `doctrine.driver.$thisSetting`
								'driver'            => 'orm_avp',
		
								// Generate proxies automatically (turn off for production)
								'generate_proxies'  => true,
		
								// directory where proxies will be stored. By default, this is in
								// the `data` directory of your application
								'proxy_dir'         => 'data/DoctrineORMModule/Proxy',
		
								// namespace for generated proxy classes
								'proxy_namespace'   => 'DoctrineORMModule\Proxy',
		
								// SQL filters.
								'filters'           => array()
						)
				),
		
		
				// Entity Manager instantiation settings
				'entitymanager' => array(
						// configuration for the `doctrine.entitymanager.orm_avp` service
						'orm_avp' => array(
								// connection instance to use. The retrieved service name will
								// be `doctrine.connection.$thisSetting`
								'connection'    => 'orm_avp',
		
								// configuration instance to use. The retrieved service name will
								// be `doctrine.configuration.$thisSetting`
								'configuration' => 'orm_avp',
						)
				),
		
		
				'eventmanager' => array(
						// configuration for the `doctrine.eventmanager.orm_avp` service
						'orm_avp' => array()
				),
		
		
				// collector SQL logger, used when ZendDeveloperTools and its toolbar are active
				'sql_logger_collector' => array(
						// configuration for the `doctrine.sql_logger_collector.orm_avp` service
						'orm_avp' => array(),
				),
		
		
				// entity resolver configuration, allows mapping associations to interfaces
				'entity_resolver' => array(
						// configuration for the `doctrine.entity_resolver.orm_avp` service
						'orm_avp' => array()
				),
		
		
				// authentication service configuration
// 				'authentication' => array(
// 						// configuration for the `doctrine.authentication.orm_avp` authentication service
// 						'orm_avp' => array(
// 								// name of the object manager to use. By default, the EntityManager is used
// 								'objectManager' => 'doctrine.entitymanager.orm_avp'
// 						),
// 				)
		),
		
		
		
		'service_manager' => array(
				'factories' => array(
						//'doctrine.authenticationadapter.orm_avp' => new DoctrineModule\Service\Authentication\AdapterFactory('orm_avp'),
						//'doctrine.authenticationstorage.orm_avp' => new DoctrineModule\Service\Authentication\StorageFactory('orm_avp'),
						//'doctrine.authenticationservice.orm_avp' => new DoctrineModule\Service\Authentication\AuthenticationServiceFactory('orm_avp'),
						'doctrine.connection.orm_avp' => new DoctrineORMModule\Service\DBALConnectionFactory('orm_avp'),
						'doctrine.configuration.orm_avp' => new DoctrineORMModule\Service\ConfigurationFactory('orm_avp'),
						'doctrine.entitymanager.orm_avp' => new DoctrineORMModule\Service\EntityManagerFactory('orm_avp'),
						'doctrine.driver.orm_avp' => new DoctrineModule\Service\DriverFactory('orm_avp'),
						'doctrine.eventmanager.orm_avp' => new DoctrineModule\Service\EventManagerFactory('orm_avp'),
						'doctrine.entity_resolver.orm_avp' => new DoctrineORMModule\Service\EntityResolverFactory('orm_avp'),
						'doctrine.sql_logger_collector.orm_avp' => new DoctrineORMModule\Service\SQLLoggerCollectorFactory('orm_avp'),
						'doctrine.mapping_collector.orm_avp' => function (Zend\ServiceManager\ServiceLocatorInterface $sl) {
							$em = $sl->get('doctrine.entitymanager.orm_avp');
		
							return new DoctrineORMModule\Collector\MappingCollector($em->getMetadataFactory(), 'orm_avp_mappings');
						},
						'DoctrineORMModule\Form\Annotation\AnnotationBuilder' => function(Zend\ServiceManager\ServiceLocatorInterface $sl) {
							return new DoctrineORMModule\Form\Annotation\AnnotationBuilder($sl->get('doctrine.entitymanager.orm_avp'));
						},
				),
		),
);
