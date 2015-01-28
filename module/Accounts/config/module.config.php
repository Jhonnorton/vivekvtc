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
            'role-commission-add' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/accounts/roleCommission/add',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Accounts\Controller',
                        'controller'=> 'Accounts',
                        'action'    => 'addRoleCommission',
                        
                    ),
                ),
            ),
            'role-commission-delete' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/accounts/roleCommission/delete/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Accounts\Controller',
                        'controller'=> 'Accounts',
                        'action'    => 'deleteRoleCommission',
                        'id'=>0
                        
                    ),
                ),
            ),
            'role-commission-edit' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/accounts/roleCommission/edit/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Accounts\Controller',
                        'controller'=> 'Accounts',
                        'action'    => 'editRoleCommission',
                        'id'=>0
                        
                    ),
                ),
            ),
            'commission-set' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/accounts/commission/set/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Accounts\Controller',
                        'controller'=> 'Accounts',
                        'action'    => 'setCommission',
                        'id'=>0
                        
                    ),
                ),
            ),
            'commission-set-delete' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/accounts/commission/set/delete/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Accounts\Controller',
                        'controller'=> 'Accounts',
                        'action'    => 'deleteUserCommission',
                        'id'=>0
                        
                    ),
                ),
            ),
            'commission-set-edit' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/accounts/commission/set/edit/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Accounts\Controller',
                        'controller'=> 'Accounts',
                        'action'    => 'editUserCommission',
                        'id'=>0
                        
                    ),
                ),
            ),
            'accounts-bonus' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/accounts/bonus',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Accounts\Controller',
                        'controller'=> 'Accounts',
                        'action'    => 'bonus',
                        
                    ),
                ),
            ),
            'accounts-bonus-add' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/accounts/bonus/add',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Accounts\Controller',
                        'controller'=> 'Accounts',
                        'action'    => 'addBonus',
                        
                    ),
                ),
            ),
            'accounts-bonus-view' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/accounts/bonus/view/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Accounts\Controller',
                        'controller'=> 'Accounts',
                        'action'    => 'viewBonus',
                        'id'=>0,
                        
                    ),
                ),
            ),
            'accounts-bonus-edit' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/accounts/bonus/edit/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Accounts\Controller',
                        'controller'=> 'Accounts',
                        'action'    => 'editBonus',
                        'id'=>0,
                        
                    ),
                ),
            ),
            'accounts-bonus-apply' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/accounts/bonus/apply/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Accounts\Controller',
                        'controller'=> 'Accounts',
                        'action'    => 'applyBonus',
                        'id'=>0,
                        
                    ),
                ),
            ),
            'accounts-bonus-revert' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/accounts/bonus/revert/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Accounts\Controller',
                        'controller'=> 'Accounts',
                        'action'    => 'revertBonus',
                        'id'=>0,
                        
                    ),
                ),
            ),
            'accounts-bonus-delete' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/accounts/bonus/delete/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Accounts\Controller',
                        'controller'=> 'Accounts',
                        'action'    => 'deleteBonus',
                        'id'=>0,
                        
                    ),
                ),
            ),
            'accounts-expense' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/accounts/expense',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Accounts\Controller',
                        'controller'=> 'Accounts',
                        'action'    => 'expense',
                        
                    ),
                ),
            ),
            'accounts-expense-add' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/accounts/expense/add',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Accounts\Controller',
                        'controller'=> 'Accounts',
                        'action'    => 'addExpense',
                        
                    ),
                ),
            ),
            'accounts-expense-add-category' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/accounts/expense/category/add',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Accounts\Controller',
                        'controller'=> 'Accounts',
                        'action'    => 'addExpenseCategory',
                        
                    ),
                ),
            ),
            'accounts-expense-edit' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/accounts/expense/edit/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Accounts\Controller',
                        'controller'=> 'Accounts',
                        'action'    => 'editExpense',
                        'id'=>0
                        
                    ),
                ),
            ),
            'accounts-expense-delete' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/accounts/expense/delete/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Accounts\Controller',
                        'controller'=> 'Accounts',
                        'action'    => 'deleteExpense',
                        'id'=>0
                        
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
