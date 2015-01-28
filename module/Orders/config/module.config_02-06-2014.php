<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Orders\Controller\Orders' => 'Orders\Controller\OrdersController',
            'Orders\Controller\Invoice' => 'Orders\Controller\InvoiceController',
            'Orders\Controller\Ajax' => 'Orders\Controller\AjaxController',

        ),
    ),
    'router' => array(
        'routes' => array(
            'orders' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/reservations',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'Orders',
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
            
            'orders-add' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/reservation/add',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'Orders',
                        'action' => 'add',
                    ),
                ),
            ),
            
            'orders-edit' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/reservation/edit/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller'=> 'Orders',
                        'action'    => 'edit',
                        'id'        => 0,
                    ),
                ),
            ),
            
            'orders-delete' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/reservation/delete/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller'=> 'Orders',
                        'action'    => 'delete',
                        'id'        => 0,
                    ),
                ),
            ),
            
            'invoice' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/invoce',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'Invoice',
                        'action' => 'index',
                    ),
                ),
            ),
            'invoice-add' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/invoice/add',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'Invoice',
                        'action' => 'add',
                    ),
                ),
            ),
            'invoice-edit' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/invoice/edit/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'Invoice',
                        'action' => 'edit',
                        'id' => 0,
                    ),
                ),
            ),
            'invoice-delete' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/invoice/delete/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'Invoice',
                        'action' => 'delete',
                        'id' => 0,
                    ),
                ),
            ),
            'orders-ajax-cruises' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/orders/ajax/cruises',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'Ajax',
                        'action' => 'cruises',                        
                    ),
                ),
            ),
            'orders-ajax-events' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/orders/ajax/events',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'Ajax',
                        'action' => 'events',                        
                    ),
                ),
            ),
            'orders-ajax-resorts' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/orders/ajax/resorts',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'Ajax',
                        'action' => 'resorts',                        
                    ),
                ),
            ),
            'orders-ajax-resort-rooms' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/orders/ajax/resort/rooms/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'Ajax',
                        'action' => 'resortrooms', 
                        'id' => 0,
                    ),
                ),
            ),
            'orders-ajax-cruise-cabins' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/orders/ajax/cruise/cabins/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'Ajax',
                        'action' => 'cruisecabins',
                        'id' => 0,
                    ),
                ),
            ),
            'orders-ajax-event-rooms' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/orders/ajax/event/rooms/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'Ajax',
                        'action' => 'eventrooms', 
                        'id' => 0,
                    ),
                ),
            ),
            'orders-ajax-resort-room' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/orders/ajax/resort/room/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'Ajax',
                        'action' => 'resortroom', 
                        'id' => 0,
                    ),
                ),
            ),
            'orders-ajax-cruise-cabin' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/orders/ajax/cruise/cabin/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'Ajax',
                        'action' => 'cruisecabin',
                        'id' => 0,
                    ),
                ),
            ),
            'orders-ajax-event-room' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/orders/ajax/event/room/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'Ajax',
                        'action' => 'eventroom', 
                        'id' => 0,
                    ),
                ),
            ),
            'orders-ajax-items' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/orders/ajax/items',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'Ajax',
                        'action' => 'items',                         
                    ),
                ),
            ),
            
            'orders-ajax' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/orders/ajax/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'Ajax',
                        'action' => 'ajax',                         
                    ),
                ),
            ),
            
            'orders-ajax-reservation' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/orders/ajax/reservation',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'Ajax',
                        'action' => 'reservation',                         
                    ),
                ),
            ),
            /*
            'orders-ajax-reservation-sendmail' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/orders/ajax/reservation/sendmail',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'Ajax',
                        'action' => 'reservationsendmail',                         
                    ),
                ),
            ),
            */
            'orders-view' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/reservation/view/:id',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'Orders',
                        'action' => 'view',
                        'id'     => 0,
                    ),
                ),
            ),
            
            'orders-canceled' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/reservation/cancel/:id',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'Orders',
                        'action' => 'cancel',
                        'id'     => 0,
                    ),
                ),
            ),
            /*
            'orders-sendmail' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/reservation/sendmail/:id',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'Orders',
                        'action' => 'sendmail',
                        'id'     => 0,
                    ),
                ),
            ),             
             */
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Orders' => __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
);
