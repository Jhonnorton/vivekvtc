<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Front\Controller\Front' => 'Front\Controller\FrontController',
            'Front\Controller\Ajax' => 'Front\Controller\AjaxController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'reservation' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/reservation/:dataUrl',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Front\Controller',
                        'controller' => 'Front',
                        'action' => 'reservation',
                         'dataUrl' => '[a-zA-Z][a-zA-Z0-9_-]+',
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
            
               'reservations' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/reservations',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Front\Controller',
                        'controller' => 'Front',
                        'action' => 'reservationss',
                        
                    ),
                ),
            ),
            
             'reservation-response' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/reservation/reservation-response',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Front\Controller',
                        'controller' => 'Front',
                        'action' => 'getPaymentResponse',
                        'id'     => 0,
                    ),
                ),
            ),
            
            'paymentdue' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/applypayment/:id/:date',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Front\Controller',
                        'controller' => 'Front',
                        'action' => 'payment',
                        'id' => 0,
                        'date' => 0,
                    ),
                ),
            ),
            
            
            'send-reminder' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/autoreminder',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Front\Controller',
                        'controller' => 'Front',
                        'action' => 'sendReminder',
                  
                    ),
                ),
            ),
            'send-reminder-message' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/reminder-message',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Front\Controller',
                        'controller' => 'Front',
                        'action' => 'reminderMessage',
                  
                    ),
                ),
            ),
            'send-reminder-lead' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/lead-reminder',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Front\Controller',
                        'controller' => 'Front',
                        'action' => 'leadReminder',
                  
                    ),
                ),
            ),
            
              'express-response' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/express-response',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Front\Controller',
                        'controller' => 'Front',
                        'action' => 'getExpressPaymentResponse',
                        'id'     => 0,
                    ),
                ),
            ),
            
            'quote-reservation-express-response' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/quote-reservation/express-response',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Front\Controller',
                        'controller' => 'Front',
                        'action' => 'quoteECResponse',
                    ),
                ),
            ),
            
             'thank-you-page' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/thank-you',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Front\Controller',
                        'controller' => 'Front',
                        'action' => 'thankYou',
                        'id'     => 0,
                    ),
                ),
            ),
             'quote-reservation' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/quoteReservation/:id/:inventoryid/:date',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Front\Controller',
                        'controller' => 'Front',
                        'action' => 'quoteReservation',
                        'id'     => 0,
                        'inventoryid'=> 0,
                        'date' => 0,
                    ),
                ),
            ),
            
             'apply-discount' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/reservation/ajax/apply-discount',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Front\Controller',
                        'controller' => 'Front',
                        'action' => 'applyDiscount',
                    ),
                ),
            ),
            
            'ajax-room-details' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/reservation/room-details/:roomId/:type',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Front\Controller',
                        'controller' => 'Front',
                        'action' => 'ajaxRoomDetails',
                        'roomId'     => 0,
                        'type'=> 0,
                    ),
                ),
            ),
            'ajax-add-traveller' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/addTraveller/:count',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Front\Controller',
                        'controller' => 'Ajax',
                        'action' => 'addTraveller',
                        'count'     => 0,
                    ),
                ),
            ),
            'ajax-check-availability' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/checkRoomAvailabilty',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Front\Controller',
                        'controller' => 'Ajax',
                        'action' => 'checkRoomAvailabilty',
                    ),
                ),
            ),
            'ajax-get-deposits' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/getDeposits',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Front\Controller',
                        'controller' => 'Front',
                        'action' => 'addPayment',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/front.phtml',
            'base-template'           => __DIR__ . '/../view/template/templates/base-template.phtml',
            'reservation-template'           => __DIR__ . '/../view/template/templates/reservation.phtml',
            'lead-template'           => __DIR__ . '/../view/template/templates/lead.phtml',
        ),
        'template_path_stack' => array(
            'front' => __DIR__ . '/../view',
        ),
    ),
);
