<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Sendmail\Controller\Sendmail' => 'Sendmail\Controller\SendmailController',
        	'Sendmail\Controller\Resources' => 'Sendmail\Controller\ResourcesController',
                'Sendmail\Controller\Ajax' => 'Sendmail\Controller\AjaxController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'sendmail' => array(
                'type'    => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/admin/sendmail',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Sendmail\Controller',
                        'controller'    => 'Sendmail',
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
        		'sendmail-add' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						'route'    => '/admin/sendmail/add',
        						'defaults' => array(
        								'__NAMESPACE__' => 'Sendmail\Controller',
        								'controller'    => 'Sendmail',
        								'action'        => 'add',
        		
        						),
        				),
        		),
        		'sendmail-edit' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						'route'    => '/admin/sendmail/edit/:id',
        						'defaults' => array(
        								'__NAMESPACE__' => 'Sendmail\Controller',
        								'controller'    => 'Sendmail',
        								'action'        => 'edit',
        								'id'			=> 0,
        						),
        				),
        		),
        		'sendmail-delete' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						'route'    => '/admin/sendmail/delete/:id',
        						'defaults' => array(
        								'__NAMESPACE__' => 'Sendmail\Controller',
        								'controller'    => 'Sendmail',
        								'action'        => 'delete',
        								'id'			=> 0,
        						),
        				),
        		), 
                        'sendmail-item' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						'route'    => '/admin/sendmail/item/:id',
        						'defaults' => array(
        								'__NAMESPACE__' => 'Sendmail\Controller',
        								'controller'    => 'Ajax',
        								'action'        => 'sendmail',        								
                                                                        'id'		=> 0,
        						),
        				),
        		),
            
                        'sendmail-foo' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						'route'    => '/admin/sendmail/foo',
        						'defaults' => array(
        								'__NAMESPACE__' => 'Sendmail\Controller',
        								'controller'    => 'Sendmail',
        								'action'        => 'foo',        								                                                                        
        						),
        				),
        		),             
             
        ),
    ),
    'view_manager' => array(
        'template_map' => array(                        
            'base-template'           => __DIR__ . '/../view/template/templates/base-template.phtml',
            'reservation-template'           => __DIR__ . '/../view/template/templates/reservation.phtml',
        ),
        'template_path_stack' => array(
            'Sendmail' => __DIR__ . '/../view',
        ),
    ),    
);
