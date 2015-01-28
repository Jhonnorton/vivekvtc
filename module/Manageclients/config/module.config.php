<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Manageclients\Controller\Manageclients' => 'Manageclients\Controller\ManageclientsController',
            'Manageclients\Controller\Ajax' => 'Manageclients\Controller\AjaxController', 
        ),
    ),
    'router' => array(
        'routes' => array(
            'manageclients' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/manageclients',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Manageclients\Controller',
                        'controller' => 'Manageclients',
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
            'manageclients-add' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						'route'    => '/admin/manageclients/add',
        						'defaults' => array(
        								'__NAMESPACE__' => 'Manageclients\Controller',
                                                                        'controller' => 'Manageclients',
        								'action'        => 'add',
        						),
        				),
        		),
        		
        		'manageclients-edit' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						'route'    => '/admin/manageclients/edit/:id',
        						'defaults' => array(
        								'__NAMESPACE__' => 'Manageclients\Controller',
                                                                        'controller' => 'Manageclients',
        								'action'        => 'edit',
        								'id'			=> 0,
        						),
        				),
        		),
        		
        		'manageclients-delete' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						'route'    => '/admin/manageclients/delete/:id',
        						'defaults' => array(
        								'__NAMESPACE__' => 'Manageclients\Controller',
                                                                        'controller' => 'Manageclients',
        								'action'        => 'delete',
        								'id'			=> 0,
        						),
        				),
        		),
            
                        'manageclients-item' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						// Change this to something specific to your module
        						'route'    => '/admin/manageclients/item/:id',
        						'defaults' => array(
        								// Change this value to reflect the namespace in which
        								// the controllers for your module are found
        								'__NAMESPACE__' => 'Manageclients\Controller',
        								'controller'    => 'Ajax',
        								'action'        => 'client',
                                                                        'id'		=> 0,
        						),
        				),
        		),
                        'manageclients-sendmail' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						// Change this to something specific to your module
        						'route'    => '/admin/manageclients/sendmail/:id',
        						'defaults' => array(
        								// Change this value to reflect the namespace in which
        								// the controllers for your module are found
        								'__NAMESPACE__' => 'Manageclients\Controller',
        								'controller'    => 'Manageclients',
        								'action'        => 'sendmail',
                                                                        'id'		=> 0,
        						),
        				),
        		),
                        'manageclients-notes' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						// Change this to something specific to your module
        						'route'    => '/admin/manageclients/note/:id',
        						'defaults' => array(
        								// Change this value to reflect the namespace in which
        								// the controllers for your module are found
        								'__NAMESPACE__' => 'Manageclients\Controller',
        								'controller'    => 'Manageclients',
        								'action'        => 'note',
                                                                        'id'		=> 0,
        						),
        				),
        		),
                        'manageclients-viewnotes' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						// Change this to something specific to your module
        						'route'    => '/admin/manageclients/viewnotes/:id',
        						'defaults' => array(
        								// Change this value to reflect the namespace in which
        								// the controllers for your module are found
        								'__NAMESPACE__' => 'Manageclients\Controller',
        								'controller'    => 'Manageclients',
        								'action'        => 'viewnotes',
                                                                        'id'		=> 0,
        						),
        				),
        		),  
                        'manageclients-noteview' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						// Change this to something specific to your module
        						'route'    => '/admin/manageclients/noteview/:id',
        						'defaults' => array(
        								// Change this value to reflect the namespace in which
        								// the controllers for your module are found
        								'__NAMESPACE__' => 'Manageclients\Controller',
        								'controller'    => 'Ajax',
        								'action'        => 'noteview',
                                                                        'id'		=> 0,
        						),
        				),
        		),
                        'manageclients-editnotes' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						'route'    => '/admin/manageclients/editnotes/:id',
        						'defaults' => array(
        								'__NAMESPACE__' => 'Manageclients\Controller',
                                                                        'controller' => 'Manageclients',
        								'action'        => 'editnotes',
        								'id'			=> 0,
        						),
        				),
        		),
                        'manageclients-deletenotes' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						'route'    => '/admin/manageclients/deletenotes/:id',
        						'defaults' => array(
        								'__NAMESPACE__' => 'Manageclients\Controller',
                                                                        'controller' => 'Manageclients',
        								'action'        => 'deletenotes',
        								'id'			=> 0,
        						),
        				),
        		),
                        'manageclients-orderhistory' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						'route'    => '/admin/manageclients/orderhistory/:id',
        						'defaults' => array(
        								'__NAMESPACE__' => 'Manageclients\Controller',
                                                                        'controller' => 'Manageclients',
        								'action'        => 'orderhistory',
        								'id'			=> 0,
        						),
        				),
        		),
                        'manageclients-viewinvoice' => array(
        				'type'    => 'Segment',
        				'options' => array(
        						// Change this to something specific to your module
        						'route'    => '/admin/manageclients/viewinvoice/:id/:uId',
        						'defaults' => array(
        								// Change this value to reflect the namespace in which
        								// the controllers for your module are found
        								'__NAMESPACE__' => 'Manageclients\Controller',
        								'controller'    => 'Ajax',
        								'action'        => 'viewinvoice',
                                                                        'id'		=> 0,
                                                                        'uId'           => 0,
        						),
        				),
        		),    
            
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Manageclients' => __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
);
