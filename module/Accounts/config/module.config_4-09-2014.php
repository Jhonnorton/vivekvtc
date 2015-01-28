<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Accounts\Controller\Accounts' => 'Accounts\Controller\AccountsController',
            'Accounts\Controller\Ajax' => 'Accounts\Controller\AjaxController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'accounts' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/accounts',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Accounts\Controller',
                        'controller' => 'Accounts',
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
            
            'payroll-edit' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/accounts/edit/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Accounts\Controller',
                        'controller'=> 'Accounts',
                        'action'    => 'edit',
                        'id'        => 0,
                    ),
                ),
            ),
            
             'payroll-view' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/accounts/view/:id',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Accounts\Controller',
                        'controller' => 'Accounts',
                        'action' => 'view',
                        'id'     => 0,
                    ),
                ),
            ),
            
           'commission' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/accounts/commission',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Accounts\Controller',
                        'controller'=> 'Accounts',
                        'action'    => 'commission',
                        
                    ),
                ),
            ),
           
            'role-commission' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/accounts/roleCommission',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Accounts\Controller',
                        'controller'=> 'Accounts',
                        'action'    => 'roleCommission',
                        
                    ),
                ),
            ),
            
            
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Accounts' => __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
);
