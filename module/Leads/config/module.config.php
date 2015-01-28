<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Leads\Controller\Leads' => 'Leads\Controller\LeadsController', 
             'Leads\Controller\Ajax' => 'Leads\Controller\AjaxController',

        ),
    ),
    'router' => array(
        'routes' => array(
            'leads' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/leads',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Leads\Controller',
                        'controller' => 'Leads',
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
             'leads-add' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/leads/add',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Leads\Controller',
                        'controller' => 'Leads',
                        'action' => 'add',
                    ),
                ),
            ),
            
            
             'leads-view' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/leads/view/:id',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Leads\Controller',
                        'controller' => 'Leads',
                        'action' => 'view',
                        'id'     => 0,
                    ),
                ),
            ),
          
           'leads-ajax-cruises' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/leads/ajax/cruises',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Leads\Controller',
                        'controller' => 'Ajax',
                        'action' => 'cruises',                        
                    ),
                ),
            ),
            'leads-ajax-events' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/leads/ajax/events',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Leads\Controller',
                        'controller' => 'Ajax',
                        'action' => 'events',                        
                    ),
                ),
            ),
            'leads-ajax-resorts' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/leads/ajax/resorts',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Leads\Controller',
                        'controller' => 'Ajax',
                        'action' => 'resorts',                        
                    ),
                ),
            ),
          
            
             'leads-ajax-resort-rooms' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/leads/ajax/resort/rooms/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Leads\Controller',
                        'controller' => 'Ajax',
                        'action' => 'resortrooms', 
                        'id' => 0,
                    ),
                ),
            ),
            'leads-ajax-cruise-cabins' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/leads/ajax/cruise/cabins/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Leads\Controller',
                        'controller' => 'Ajax',
                        'action' => 'cruisecabins',
                        'id' => 0,
                    ),
                ),
            ),
            'leads-ajax-event-rooms' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/leads/ajax/event/rooms/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Leads\Controller',
                        'controller' => 'Ajax',
                        'action' => 'eventrooms', 
                        'id' => 0,
                    ),
                ),
            ),
            'leads-ajax-resort-room' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/leads/ajax/resort/room/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'leads\Controller',
                        'controller' => 'Ajax',
                        'action' => 'resortroom', 
                        'id' => 0,
                    ),
                ),
            ),
            'leads-ajax-cruise-cabin' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/leads/ajax/cruise/cabin/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'leads\Controller',
                        'controller' => 'Ajax',
                        'action' => 'cruisecabin',
                        'id' => 0,
                    ),
                ),
            ),
            'leads-ajax-event-room' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/leads/ajax/event/room/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'leads\Controller',
                        'controller' => 'Ajax',
                        'action' => 'eventroom', 
                        'id' => 0,
                    ),
                ),
            ),
           'lead-ajax-items' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/leads/ajax/items',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'leads\Controller',
                        'controller' => 'Ajax',
                        'action' => 'items',                         
                    ),
                ),
            ),
            
           'leads-ajax-excursions' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/leads/ajax/excursions',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'leads\Controller',
                        'controller' => 'Ajax',
                        'action' => 'excursions',                         
                    ),
                ),
            ),
            
            'leads-ajax-transfers' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/leads/ajax/transfers',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'leads\Controller',
                        'controller' => 'Ajax',
                        'action' => 'transfers',                         
                    ),
                ),
            ),
         
            'leads-ajax' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/leads/ajax/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'leads\Controller',
                        'controller' => 'Ajax',
                        'action' => 'ajax',                         
                    ),
                ),
            ),
            
            'leads-resort' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/leads/resort',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Leads\Controller',
                        'controller' => 'Leads',
                        'action' => 'resort',
                    ),
                ),
            ),
             'leads-cruise' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/leads/cruise',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Leads\Controller',
                        'controller' => 'Leads',
                        'action' => 'cruise',
                    ),
                ),
            ),
            
             'leads-event' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/leads/event',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Leads\Controller',
                        'controller' => 'Leads',
                        'action' => 'event',
                    ),
                ),
            ),
            
            'leads-sendmail' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/leads/sendmail/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Leads\Controller',
                        'controller' => 'Leads',
                        'action' => 'sendmail',
                        'id'     => 0,
                    ),
                ),
            ),
            
            'lead-generate-quote' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/leads/sendquote/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Leads\Controller',
                        'controller' => 'Leads',
                        'action' => 'sendquote',
                        'id'     => 0,
                    ),
                ),
            ),
            
            
            'leads-ajax-rooms-detail' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/leads/ajaxroomdetails/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'leads\Controller',
                        'controller' => 'Ajax',
                        'action' => 'ajaxRoomDetails',                         
                    ),
                ),
            ),
            'leads-ajax-get-description' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/leads/ajaxgetdescription/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'leads\Controller',
                        'controller' => 'Ajax',
                        'action' => 'ajaxGetDescription',                         
                    ),
                ),
            ),
            'leads-quote-reservation' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/leads/quoteReservation/:id',
                    'defaults' => array(
                        '__NAMESPACE__' => 'leads\Controller',
                        'controller' => 'Leads',
                        'action' => 'quoteReservation',    
                        'id'=>0
                    ),
                ),
            ),
            
                        
/*            
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
  */       
           
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Leads' => __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
);
