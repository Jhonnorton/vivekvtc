<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Users\Controller\Users' => 'Users\Controller\UsersController',
        	'Users\Controller\Auth' => 'Users\Controller\AuthController',
        	'Users\Controller\Acl' => 'Users\Controller\AclController',
        	'Users\Controller\Clients' => 'Users\Controller\ClientsController',
                'Users\Controller\Ajax' => 'Users\Controller\AjaxController',
                'Users\Controller\Dashboard' => 'Users\Controller\DashboardController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'users' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/admin/users',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Users\Controller',
                        'controller'    => 'Users',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
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
        		'users-add' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						'route'    => '/admin/users/add',
        						'defaults' => array(
        								'__NAMESPACE__' => 'Users\Controller',
        								'controller'    => 'Users',
        								'action'        => 'add',
        								
        						),
        				),
        			),
        		'users-edit' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						'route'    => '/admin/users/edit/:id',
        						'defaults' => array(
        								'__NAMESPACE__' => 'Users\Controller',
        								'controller'    => 'Users',
        								'action'        => 'edit',
        								'id'			=> 0,
        						),
        				),
        		),
        		'users-delete' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						'route'    => '/admin/users/delete/:id',
        						'defaults' => array(
        								'__NAMESPACE__' => 'Users\Controller',
        								'controller'    => 'Users',
        								'action'        => 'delete',
        								'id'			=> 0,
        						),
        				),
        		),
        		
        		'profile' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						'route'    => '/profile',
        						'defaults' => array(
        								'__NAMESPACE__' => 'Users\Controller',
        								'controller'    => 'Users',
        								'action'        => 'profile',
        						),
        				),
        		),
        		
        		'profile-save' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						'route'    => '/profile/save',
        						'defaults' => array(
        								'__NAMESPACE__' => 'Users\Controller',
        								'controller'    => 'Users',
        								'action'        => 'save',
        						),
        				),
        		),
        		
        		'login' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						'route'    => '/login',
        						'defaults' => array(
        								'__NAMESPACE__' => 'Users\Controller',
        								'controller'    => 'Auth',
        								'action'        => 'login',
        						),
        				),
        		),
        		'logout' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						'route'    => '/logout',
        						'defaults' => array(
        								'__NAMESPACE__' => 'Users\Controller',
        								'controller'    => 'Auth',
        								'action'        => 'logout',
        						),
        				),
        		),
        		'acl' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						'route'    => '/admin/acl',
        						'defaults' => array(
        								'__NAMESPACE__' => 'Users\Controller',
        								'controller'    => 'Acl',
        								'action'        => 'index',
        						),
        				),
        		),
        		'acl-add' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						'route'    => '/admin/acl/add',
        						'defaults' => array(
        								'__NAMESPACE__' => 'Users\Controller',
        								'controller'    => 'Acl',
        								'action'        => 'add',
        						),
        				),
        		),
        		'acl-edit' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						'route'    => '/admin/acl/edit/:id',
        						'defaults' => array(
        								'__NAMESPACE__' => 'Users\Controller',
        								'controller'    => 'Acl',
        								'action'        => 'edit',
        								'id'			=> 0,
        						),
        				),
        		),
        		'acl-delete' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						'route'    => '/admin/acl/delete/:id',
        						'defaults' => array(
        								'__NAMESPACE__' => 'Users\Controller',
        								'controller'    => 'Acl',
        								'action'        => 'delete',
        								'id'			=> 0,
        						),
        				),
        		),
        		
        		'clients' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						'route'    => '/admin/clients',
        						'defaults' => array(
        								'__NAMESPACE__' => 'Users\Controller',
        								'controller'    => 'Clients',
        								'action'        => 'index',
        						),
        				),
        		),
        		
        		'clients-add' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						'route'    => '/admin/clients/add',
        						'defaults' => array(
        								'__NAMESPACE__' => 'Users\Controller',
        								'controller'    => 'Clients',
        								'action'        => 'add',
        						),
        				),
        		),
        		
        		'clients-edit' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						'route'    => '/admin/clients/edit/:id',
        						'defaults' => array(
        								'__NAMESPACE__' => 'Users\Controller',
        								'controller'    => 'Clients',
        								'action'        => 'edit',
        								'id'			=> 0,
        						),
        				),
        		),
        		
        		'clients-delete' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						'route'    => '/admin/clients/delete/:id',
        						'defaults' => array(
        								'__NAMESPACE__' => 'Users\Controller',
        								'controller'    => 'Clients',
        								'action'        => 'delete',
        								'id'			=> 0,
        						),
        				),
        		),
            
                        'clients-item' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						// Change this to something specific to your module
        						'route'    => '/admin/clients/item/:id',
        						'defaults' => array(
        								// Change this value to reflect the namespace in which
        								// the controllers for your module are found
        								'__NAMESPACE__' => 'Users\Controller',
        								'controller'    => 'Ajax',
        								'action'        => 'client',
                                                                        'id'		=> 0,
        						),
        				),
        		),
        		
        		'restore' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						'route'    => '/restore',
        						'defaults' => array(
        								'__NAMESPACE__' => 'Users\Controller',
        								'controller'    => 'Auth',
        								'action'        => 'restore',
        						),
        				),
        		),
                        
                        'dashboard' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						'route'    => '/admin/dashboard',
        						'defaults' => array(
        								'__NAMESPACE__' => 'Users\Controller',
        								'controller'    => 'Dashboard',
        								'action'        => 'index',
        						),
        				),
        		),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Users' => __DIR__ . '/../view',
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