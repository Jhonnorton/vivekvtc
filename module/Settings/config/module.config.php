<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Settings\Controller\Settings' => 'Settings\Controller\SettingsController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'settings' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/admin/settings',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Settings\Controller',
                        'controller'    => 'Settings',
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
        	'settings-disclaimer-add' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						'route'    => '/admin/settings/disclaimer/add',
        						'defaults' => array(
        								'__NAMESPACE__' => 'Settings\Controller',
        								'controller'    => 'Settings',
        								'action'        => 'addDisclaimer',
        								
        						),
        				),
        			),	
        	'settings-disclaimer-edit' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						'route'    => '/admin/settings/disclaimer/edit/:id',
        						'defaults' => array(
        								'__NAMESPACE__' => 'Settings\Controller',
        								'controller'    => 'Settings',
        								'action'        => 'editDisclaimer',
                                                                        'id'            => 0,
        								
        						),
        				),
        			),	
        	'settings-disclaimer-view' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						'route'    => '/admin/settings/disclaimer/view/:id',
        						'defaults' => array(
        								'__NAMESPACE__' => 'Settings\Controller',
        								'controller'    => 'Settings',
        								'action'        => 'viewDisclaimer',
                                                                        'id'            => 0,
        								
        						),
        				),
        			),	
        		
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Settings' => __DIR__ . '/../view',
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