<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Base\Controller\Base' => 'Base\Controller\BaseController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'base' => array(
                'type'    => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Base\Controller',
                        'controller'    => 'Base',
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
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Base' => __DIR__ . '/../view',
        ),
    ),
    
    'doctrine' => array(
    		'driver' => array(
    				'Base_driver' => array(
    						'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
    						'cache' => 'array',
    						'paths' => array(__DIR__ . '/../src/Base/Entity'),
    
    				),
    				'orm_default' => array(
    						'drivers' => array(
    								'Base\Entity' =>  'Base_driver'
    						),
    				),
    				
    		),
    		//added email as username smart
    		'authentication' => array(
    				'orm_default' => array(
    						'object_manager' => 'Doctrine\ORM\EntityManager',
    						'identity_class' => 'Base\Entity\Users',
    						'identity_property' => 'email',
    						'credential_property' => 'password',
    		
    				),
    		),
    ),
);
