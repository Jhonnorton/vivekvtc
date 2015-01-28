<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Payments\Controller\Payments' => 'Payments\Controller\PaymentsController',
            'Payments\Controller\Ajax' => 'Payments\Controller\AjaxController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'payments' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/payments',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Payments\Controller',
                        'controller' => 'Payments',
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
            'payments-edit' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/payments/edit/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Payments\Controller',
                        'controller' => 'Payments',
                        'action' => 'edit',
                        'id' => 0,
                    ),
                ),
            ),
            'payment-refund' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/payments/ajax/refundAmount',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Payments\Controller',
                        'controller' => 'Ajax',
                        'action' => 'refundAmount',
                        'id' => 0,
                    ),
                ),
            ),
           'payments-applypayment' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/payments/applypayment/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Payments\Controller',
                        'controller' => 'Payments',
                        'action' => 'payment',
                        'id' => 0,
                    ),
                ),
            ),
            
            
            'payments-canceled' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/payments/cancel/:id',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Payments\Controller',
                        'controller' => 'Payments',
                        'action' => 'cancel',
                        'id' => 0,
                    ),
                ),
            ),
            'ajax-payment' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/payments/ajax/reservation/:id', ///admin/orders/ajax/reservation',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Payments\Controller',
                        'controller' => 'Ajax',
                        'action' => 'reservation',
                        'id' => 0,
                    ),
                ),
            ),
            'payments-resort' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/payments/resort',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Payments\Controller',
                        'controller' => 'Payments',
                        'action' => 'resort',
                    ),
                ),
            ),
            'payments-cruise' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/payments/cruise',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Payments\Controller',
                        'controller' => 'Payments',
                        'action' => 'cruise',
                    ),
                ),
            ),
            'payments-event' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/payments/event',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Payments\Controller',
                        'controller' => 'Payments',
                        'action' => 'event',
                    ),
                ),
            ),
            
             'payment-sendreminder' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/payments/reminder/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Payments\Controller',
                        'controller' => 'Payments',
                        'action' => 'sendmail',
                        'id'     => 0,
                    ),
                ),
            ),
            
            
             'sendreminder' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/payments/autoreminder',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Payments\Controller',
                        'controller' => 'Payments',
                        'action' => 'sendReminder',
                  
                    ),
                ),
            ),
            
            
            'payment-sendinvoice' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/payments/invoice/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Payments\Controller',
                        'controller' => 'Payments',
                        'action' => 'sendinvoice',
                        'id'     => 0,
                    ),
                ),
            ),
            'express-payment-response' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/express-payment-response',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Payments\Controller',
                        'controller' => 'Payments',
                        'action' => 'expressResponse'
                    ),
                ),
            ),
            
            
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Payments' => __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
);
