<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Orders\Controller\Orders' => 'Orders\Controller\OrdersController',
            'Orders\Controller\Invoice' => 'Orders\Controller\InvoiceController',
	    'Orders\Controller\Event' => 'Orders\Controller\EventController',
	    'Orders\Controller\OrdersResort' => 'Orders\Controller\OrdersResortController',
	    'Orders\Controller\OrdersCruises' => 'Orders\Controller\OrdersCruisesController',
	    'Orders\Controller\OrdersCancel' => 'Orders\Controller\OrdersCancelController',
            'Orders\Controller\OrdersDraft' => 'Orders\Controller\OrdersDraftController',
            'Orders\Controller\Ajax' => 'Orders\Controller\AjaxController',
	    'Orders\Controller\OrdersPending' => 'Orders\Controller\OrdersPendingController',

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
                    'route' => '/admin/reservation/add/:dataUrl',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'Orders',
                        'action' => 'add',
                        'dataUrl' => '[a-zA-Z][a-zA-Z0-9_-]+',
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
		

	   
            'orders-event' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/reservation/event',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'Event',
                        'action' => 'index',
                    ),
                ),
            ),



	   'orders-event-view' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/event/view/:id',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'Event',
                        'action' => 'view',
                        'id'     => 0,
                    ),
                ),
            ),


	   'orders-event-canceled' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/event/cancel/:id',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'Event',
                        'action' => 'cancel',
                        'id'     => 0,
                    ),
                ),
            ),




	     'orders-resort' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/reservation/resort',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'OrdersResort',
                        'action' => 'index',
                    ),
                ),
            ),

  
	    
	   'orders-resort-view' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/resort/view/:id',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'OrdersResort',
                        'action' => 'view',
                        'id'     => 0,
                    ),
                ),
            ),


	  
	   'orders-resort-canceled' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/resort/cancel/:id',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'OrdersResort',
                        'action' => 'cancel',
                        'id'     => 0,
                    ),
                ),
            ),	  



	    
	     'orders-cruise' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/reservation/cruise',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'OrdersCruises',
                        'action' => 'index',
                    ),
                ),
            ),


	     'orders-cruise-view' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/cruise/view/:id',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'OrdersCruises',
                        'action' => 'view',
                        'id'     => 0,
                    ),
                ),
            ),


	      


	  
	   'orders-cruise-canceled' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/cruise/cancel/:id',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'OrdersCruises',
                        'action' => 'cancel',
                        'id'     => 0,
                    ),
                ),
            ),	  


	   'orders-cruise-edit' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/cruise/edit/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller'=> 'OrdersCruises',
                        'action'    => 'edit',
                        'id'        => 0,
                    ),
                ),
            ),   




	      
	   'orders-cancel' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/reservation/cancelled',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'OrdersCancel',
                        'action' => 'index',
                    ),
                ),
            ),


	    'orders-cancel-view' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/cancel/view/:id',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'OrdersCancel',
                        'action' => 'view',
                        'id'     => 0,
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



	   'invoice-view' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/invoice/view/:id',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'Invoice',
                        'action' => 'view',
                        'id'     => 0,
                    ),
                ),
            ),   


	   'invoice-cruise-view' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/invoice/view',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'Invoice',
                        'action' => 'index',
			//'id' => 0,
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
            
            'orders-ajax-excursions' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/orders/ajax/excursions',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'Ajax',
                        'action' => 'excursions',                         
                    ),
                ),
            ),
            
            'orders-ajax-transfers' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/orders/ajax/transfers',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'Ajax',
                        'action' => 'transfers',                         
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
            
            'orders-rooms-search' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/reservation/order-reservation-search',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'Orders',
                        'action' => 'reservationRooms',
                        'id'     => 0,
                    ),
                ),
            ),      
             
            
             'exist-client-details' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/orders/ajax/client-details',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'Ajax',
                        'action' => 'clientDetails',                         
                    ),
                ),
            ),
            'rooms-available' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/orders/ajax/rooms-available',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'Ajax',
                        'action' => 'orderRoomsAvailable',                         
                    ),
                ),
            ),
          'print-reservation' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/orders/ajax/print-reservation/:id',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'Ajax',
                        'action' => 'printreservation',
                         'id'     => 0,
                    ),
                ),
            ),


	    'print-invoice' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/orders/ajax/print-invoice/:id',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'Ajax',
                        'action' => 'printinvoice',
                         'id'     => 0,
                    ),
                ),
            ),
            
             'orders-draft' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/reservation/orders-draft',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'OrdersDraft',
                        'action' => 'index',
                    ),
                ),
            ),
            
             'orders-draft-edit' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/reservation/orders-draft/edit/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'OrdersDraft',
                        'action' => 'edit',
                        'id'     => 0,
                    ),
                ),
            ),
            
            'orders-draft-delete' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/reservation/orders-draft/delete/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'OrdersDraft',
                        'action' => 'delete',
                        'id'     => 0,
                    ),
                ),
            ),
            
            'credit-payment' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/reservation/credit-payment',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'Orders',
                        'action' => 'creditPayment',
                        'id'     => 0,
                    ),
                ),
            ),
            
            'payment-response' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/reservation/payment-response',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'Orders',
                        'action' => 'getPaymentResponse',
                        'id'     => 0,
                    ),
                ),
            ),
            
            'payment-process' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/reservation/payment-process',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'Orders',
                        'action' => 'paymentProcess',
                        'id'     => 0,
                    ),
                ),
            ),
            
            'thank-you' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/reservation/thank-you',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'Orders',
                        'action' => 'thankYou',
                        'id'     => 0,
                    ),
                ),
            ),
            
            'orders-ajax-all-clients' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/orders/ajax/all-clients',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'Ajax',
                        'action' => 'allClients',
                    ),
                ),
            ),
            
             'order-deposit-exception' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/orders/ajax/get-deposit-exception',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'Ajax',
                        'action' => 'getDepositExceptions',
                    ),
                ),
            ),

	    


	     'orders-pending' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/reservation/pending',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Orders\Controller',
                        'controller' => 'OrdersPending',
                        'action' => 'index',
                    ),
                ),
            ),

    



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
