<?php

return array(
    'controllers' => array(
        'invokables' => array(
                'Sales\Controller\Promos' => 'Sales\Controller\PromosController',
                'Sales\Controller\Receipts' => 'Sales\Controller\ReceiptsController',
                'Sales\Controller\Vouchers' => 'Sales\Controller\VouchersController',
                'Sales\Controller\Ajax' => 'Sales\Controller\AjaxController', 
        ),
    ),
    'router' => array(
        'routes' => array(
            'promos' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/sales/promos',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Sales\Controller',
                        'controller' => 'Promos',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    // This route is a sane default when developing a module;
                    // as you solidify the routes for your module, however,
                    // you may want to remove it and replace it with more
                    // specific routes.
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
            
            'promos-add' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/sales/promos/add',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Sales\Controller',
                        'controller' => 'Promos',
                        'action' => 'add',
                    ),
                ),
            ),
            
            'promos-edit' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/sales/promos/edit/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Sales\Controller',
                        'controller' => 'Promos',
                        'action' => 'edit',
                        'id' => 0,
                    ),
                ),
            ),
            'promos-delete' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/sales/promos/delete/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Sales\Controller',
                        'controller' => 'Promos',
                        'action' => 'delete',
                        'id' => 0,
                    ),
                ),
            ),
        
            'receipts-list' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/sales/receipts/list',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Sales\Controller',
                        'controller' => 'Receipts',
                        'action' => 'list',
                        
                    ),
                ),
            ),
            
            'receipts-add' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/sales/receipts/add',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Sales\Controller',
                        'controller' => 'Receipts',
                        'action' => 'add',
                        
                    ),
                ),
            ),
            
            'receipts-edit' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/sales/receipts/edit/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Sales\Controller',
                        'controller' => 'Receipts',
                        'action' => 'edit',
                        'id'=>0,
                    ),
                ),
            ),
            
            
            'receipts-view' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/sales/receipts/view/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Sales\Controller',
                        'controller' => 'Ajax',
                        'action' => 'viewreceipt',
                        'id'=>0,
                        
                    ),
                ),
            ),
            
            'receipts-delete' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/sales/receipts/delete/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Sales\Controller',
                        'controller' => 'Receipts',
                        'action' => 'delete',
                        'id'=>0,
                    ),
                ),
            ),
            
            'receipts-sendmail' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/sales/receipts/sendmail/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Sales\Controller',
                        'controller' => 'Receipts',
                        'action' => 'sendmail',
                        'id'=>0,
                        
                    ),
                ),
            ),
            
            'vouchers' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/sales/vouchers',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Sales\Controller',
                        'controller' => 'Vouchers',
                        'action' => 'index',
                        
                    ),
                ),
            ),
            
            'vouchers-add' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/sales/vouchers-add',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Sales\Controller',
                        'controller' => 'Vouchers',
                        'action' => 'add',
                        
                    ),
                ),
            ),
            
            'vouchers-edit' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/sales/vouchers-edit/:vid',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Sales\Controller',
                        'controller' => 'Vouchers',
                        'action' => 'edit',
                        'vid'=>0,
                    ),
                ),
            ),
            
            'vouchers-delete' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/sales/vouchers-delete/:vid',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Sales\Controller',
                        'controller' => 'Vouchers',
                        'action' => 'delete',
                        'vid'=>0,
                    ),
                ),
            ),
          
      
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Sales' => __DIR__ . '/../view',
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
                'class' => 'Doctrine\ORM\Mapping\Driver\DriverChain',
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
                'metadata_cache' => 'array',
                // DQL queries parsing cache instance to use. The retrieved service
                // name will be `doctrine.cache.$thisSetting`
                'query_cache' => 'array',
                // ResultSet cache to use.  The retrieved service name will be
                // `doctrine.cache.$thisSetting`
                'result_cache' => 'array',
                // Mapping driver instance to use. Change this only if you don't want
                // to use the default chained driver. The retrieved service name will
                // be `doctrine.driver.$thisSetting`
                'driver' => 'orm_avp',
                // Generate proxies automatically (turn off for production)
                'generate_proxies' => true,
                // directory where proxies will be stored. By default, this is in
                // the `data` directory of your application
                'proxy_dir' => 'data/DoctrineORMModule/Proxy',
                // namespace for generated proxy classes
                'proxy_namespace' => 'DoctrineORMModule\Proxy',
                // SQL filters.
                'filters' => array()
            )
        ),
        // Entity Manager instantiation settings
        'entitymanager' => array(
            // configuration for the `doctrine.entitymanager.orm_avp` service
            'orm_avp' => array(
                // connection instance to use. The retrieved service name will
                // be `doctrine.connection.$thisSetting`
                'connection' => 'orm_avp',
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

