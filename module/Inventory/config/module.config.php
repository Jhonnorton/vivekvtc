<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Inventory\Controller\Ajax' => 'Inventory\Controller\AjaxController',
            'Inventory\Controller\InventoryCruise' => 'Inventory\Controller\InventoryCruiseController',
            'Inventory\Controller\InventoryHotels' => 'Inventory\Controller\InventoryHotelsController',
            'Inventory\Controller\InventoryEvent' => 'Inventory\Controller\InventoryEventController',
            'Inventory\Controller\Transfers' => 'Inventory\Controller\TransfersController',
            'Inventory\Controller\Excursions' => 'Inventory\Controller\ExcursionsController',
            'Inventory\Controller\InventoryItem' => 'Inventory\Controller\InventoryItemController',
            'Inventory\Controller\Promos' => 'Inventory\Controller\PromosController',
            'Inventory\Controller\Tours' => 'Inventory\Controller\ToursController',
            'Inventory\Controller\Deposits' => 'Inventory\Controller\DepositsController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'inventory-resort-rooms' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/resort/rooms',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'InventoryHotels',
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
            'inventory-resort-rooms-add' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/resort/rooms/add',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'InventoryHotels',
                        'action' => 'add',
                    ),
                ),
            ),
            'inventory-resort-rooms-edit' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/resort/rooms/edit/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'InventoryHotels',
                        'action' => 'edit',
                        'id' => 0,
                    ),
                ),
            ),
            'inventory-resort-rooms-view' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/resort/rooms/ajax/view/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'ajax',
                        'action' => 'view',
                        'id' => 0,
                    ),
                ),
            ),
            'inventory-resort-rooms-check' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/resort/rooms/ajax/check/:type/:rid',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Ajax',
                        'action' => 'check',
                        'type'=>0,
                        'rid' => 0,                        
                    ),
                ),
            ),
            'inventory-resort-rooms-delete' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/resort/rooms/delete/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'InventoryHotels',
                        'action' => 'delete',
                        'id' => 0,
                    ),
                ),
            ),
            'inventory-event-rooms' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/event/rooms',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'InventoryEvent',
                        'action' => 'index',
                    ),
                ),
            ),
            'inventory-event-rooms-add' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/event/rooms/add',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'InventoryEvent',
                        'action' => 'add',
                    ),
                ),
            ),
            'inventory-event-rooms-edit' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/event/rooms/edit/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'InventoryEvent',
                        'action' => 'edit',
                        'id' => 0,
                    ),
                ),
            ),
            'inventory-event-rooms-delete' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/event/rooms/delete/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'InventoryEvent',
                        'action' => 'delete',
                        'id' => 0,
                    ),
                ),
            ),
            'inventory-cruise-cabins' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/cruise/cabins',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'InventoryCruise',
                        'action' => 'index',
                    ),
                ),
            ),
            'inventory-cruise-cabins-add' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/cruise/cabins/add',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'InventoryCruise',
                        'action' => 'add',
                    ),
                ),
            ),
            'inventory-cruise-cabins-edit' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/cruise/cabins/edit/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'InventoryCruise',
                        'action' => 'edit',
                        'id' => 0,
                    ),
                ),
            ),
            'inventory-cruise-cabins-delete' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/cruise/cabins/delete/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'InventoryCruise',
                        'action' => 'delete',
                        'id' => 0,
                    ),
                ),
            ),
            'inventory-transfers' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/transfers',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Transfers',
                        'action' => 'index',
                    ),
                ),
            ),
            'inventory-transfers-add' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/transfers/add',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Transfers',
                        'action' => 'add',
                    ),
                ),
            ),
            'inventory-transfers-edit' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/transfers/edit/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Transfers',
                        'action' => 'edit',
                        'id' => 0,
                    ),
                ),
            ),
            'inventory-transfers-delete' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/transfers/delete/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Transfers',
                        'action' => 'delete',
                        'id' => 0,
                    ),
                ),
            ),
            'inventory-excursions' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/excursions',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Excursions',
                        'action' => 'index',
                    ),
                ),
            ),
            'inventory-excursions-add' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/excursions/add',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Excursions',
                        'action' => 'add',
                    ),
                ),
            ),
            'inventory-excursions-edit' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/excursions/edit/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Excursions',
                        'action' => 'edit',
                        'id' => 0,
                    ),
                ),
            ),
            'inventory-excursions-delete' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/excursions/delete/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Excursions',
                        'action' => 'delete',
                        'id' => 0,
                    ),
                ),
            ),
            'inventory-items' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/items',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'InventoryItem',
                        'action' => 'index',
                    ),
                ),
            ),
            'inventory-items-add' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/items/add',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'InventoryItem',
                        'action' => 'add',
                    ),
                ),
            ),
            'inventory-items-edit' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/items/edit/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'InventoryItem',
                        'action' => 'edit',
                        'id' => 0,
                    ),
                ),
            ),
            'inventory-items-delete' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/items/delete/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'InventoryItem',
                        'action' => 'delete',
                        'id' => 0,
                    ),
                ),
            ),
            'inventory-promos' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/promos',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Promos',
                        'action' => 'index',
                    ),
                ),
            ),
            'inventory-promos-add' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/promos/add',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Promos',
                        'action' => 'add',
                    ),
                ),
            ),
            'inventory-promos-edit' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/promos/edit/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Promos',
                        'action' => 'edit',
                        'id' => 0,
                    ),
                ),
            ),
            'inventory-promos-delete' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/promos/delete/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Promos',
                        'action' => 'delete',
                        'id' => 0,
                    ),
                ),
            ),
            'inventory-ajax-cruise-cabins' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/ajax/cruise/cabins/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Ajax',
                        'action' => 'cabins',
                        'id' => 0,
                    ),
                ),
            ),
            'inventory-ajax-resort-rooms' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/ajax/resort/rooms/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Ajax',
                        'action' => 'rooms',
                        'id' => 0,
                    ),
                ),
            ),
            'inventory-ajax-event-rooms' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/ajax/event/rooms/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Ajax',
                        'action' => 'eventrooms',
                        'id' => 0,
                    ),
                ),
            ),
            'inventory-ajax-cruises' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/ajax/cruises',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Ajax',
                        'action' => 'cruises',
                    ),
                ),
            ),
            'inventory-ajax-events' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/ajax/events',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Ajax',
                        'action' => 'events',
                    ),
                ),
            ),
            'inventory-ajax-resorts' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/ajax/resorts',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Ajax',
                        'action' => 'resorts',
                    ),
                ),
            ),
            'inventory-ajax-evevnt-categories' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/ajax/event-categories',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Ajax',
                        'action' => 'eventcategories',
                    ),
                ),
            ),
            'inventory-ajax-promo-linkedto' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/ajax/promo/linkedto/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Ajax',
                        'action' => 'promolinkedto',
                        'id' => 0,
                    ),
                ),
            ),
            'inventory-ajax-resort-rooms-by-id' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/ajax/resort/roomsbyid/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Ajax',
                        'action' => 'roomDetailsById',
                        'id' => 0,
                    ),
                ),
            ),
            'inventory-ajax-cruise-cabins-by-id' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/ajax/cruise/cabinbyid/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Ajax',
                        'action' => 'cabinDetailsById',
                        'id' => 0,
                    ),
                ),
            ),
            'inventory-tours' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/tours',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Tours',
                        'action' => 'index',
                    ),
                ),
            ),
            'tour-location' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/tours/location/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Tours',
                        'action' => 'tourlocation',
                        'id' => 0,
                    ),
                ),
            ),
            'tour-location-add' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/tours/location/add/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Tours',
                        'action' => 'locationAdd',
                        'id' => 0,
                    ),
                ),
            ),
            'tour-location-edit' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/tours/location/edit/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Tours',
                        'action' => 'locationEdit',
                        'id' => 0,
                    ),
                ),
            ),
            
            'tour-location-delete' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/tours/location/delete/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Tours',
                        'action' => 'locationDelete',
                        'id' => 0,
                    ),
                ),
            ),
            
            'tour-location-resorts' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/tours/location/resorts/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Tours',
                        'action' => 'locationResorts',
                        'id' => 0,
                    ),
                ),
            ),
            
            'tour-location-resorts-add' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/tours/location/resorts/add/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Tours',
                        'action' => 'locationResortsAdd',
                        'id' => 0,
                    ),
                ),
            ),
            'inventory-deposits' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/deposits',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Deposits',
                        'action' => 'index',
                    ),
                ),
            ),
            'inventory-deposits-add' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/deposits/add',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Deposits',
                        'action' => 'add',
                    ),
                ),
            ),
            
               'tour-location-resorts-delete' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/tours/location/resorts/delete/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Tours',
                        'action' => 'resortDelete',
                        'id' => 0,
                    ),
                ),
            ),
            
            
            'tour-location-resorts-inactive' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/tours/location/resorts/inactive/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Tours',
                        'action' => 'resortInActive',
                        'id' => 0,
                    ),
                ),
            ),
            
            
            'tour-location-resorts-active' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/tours/location/resorts/active/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Tours',
                        'action' => 'resortActive',
                        'id' => 0,
                    ),
                ),
            ),
            
                'tour-location-resort-rooms' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/tours/location/resort/rooms/:locationid/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Tours',
                        'action' => 'locationResortRooms',
                        'id' => 0,
                        'locationid'=>0,
                    ),
                ),
            ),
            
            'tour-location-resort-rooms-add' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/tours/location/resort/rooms/add/:locationid/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Tours',
                        'action' => 'locationResortRoomsAdd',
                        'id' => 0,
                        'locationid'=>0,
                    ),
                ),
            ),
            
             'tour-location-resort-rooms-edit' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/tours/location/resort/rooms/edit/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Tours',
                        'action' => 'locationResortRoomsEdit',
                        'id' => 0,
                    ),
                ),
            ),
            'type-ajax' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/ajax/type/:id[/:type]',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Ajax',
                        'action' => 'type',
                        'id' => 0,
			'type'=>0,
			
                    ),
                ),
            ),
            'inventory-deposits-delete' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/deposits/delete/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Deposits',
                        'action' => 'delete',
                        'id'=>0
                    ),
                ),
            ),
            'inventory-deposits-update' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/deposits/update/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Deposits',
                        'action' => 'update',
                        'id'=>0
                    ),
                ),
            ),
            'inventory-deposits-view' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/deposits/view/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Deposits',
                        'action' => 'view',
                        'id'=>0
                    ),
                ),
            ),
            
              'tour-location-resort-rooms-delete' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/tours/location/resort/rooms/delete/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Tours',
                        'action' => 'resortRoomsDelete',
                        'id' => 0,
                    ),
                ),
            ),
            
            
            'tour-location-resort-rooms-inactive' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/tours/location/resort/rooms/inactive/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Tours',
                        'action' => 'resortRoomsInActive',
                        'id' => 0,
                    ),
                ),
            ),
            
            
            'tour-location-resort-rooms-active' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/inventory/tours/location/resort/rooms/active/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inventory\Controller',
                        'controller' => 'Tours',
                        'action' => 'resortRoomsActive',
                        'id' => 0,
                    ),
                ),
            ),
            
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Inventory' => __DIR__ . '/../view',
        ),
    ),
    'doctrine' => array(
        // Metadata Mapping driver configuration
        'driver' => array(
            'Avp_Driver' => array(
                'class' => '\Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../../Base/src/Base/Entity/Avp')
            ),
            'orm_avp' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\DriverChain',
                'drivers' => array(
                    'Base\Entity\Avp' => 'Avp_Driver'
                )
            )
        ),
        'configuration' => array(
            // Configuration for service `doctrine.configuration.orm_avp` service
            'orm_avp' => array(
                // metadata cache instance to use. The retrieved service name will
                // be `doctrine.cache.$thisSetting`
                'metadata_cache' => 'array',
                // DQL queries parsing cache instance to use. The retrieved service
                // name will be `doctrine.cache.$thisSetting`
                'query_cache' => 'array',
                // ResultSet cache to use.  The retrieved service name will be
                // `doctrine.cache.$thisSetting`
                'result_cache' => 'array',
                // Mapping driver instance to use. Change this only if you don't want
                // to use the default chained driver. The retrieved service name will
                // be `doctrine.driver.$thisSetting`
                'driver' => 'orm_avp',
                // Generate proxies automatically (turn off for production)
                'generate_proxies' => true,
                // directory where proxies will be stored. By default, this is in
                // the `data` directory of your application
                'proxy_dir' => 'data/DoctrineORMModule/Proxy',
                // namespace for generated proxy classes
                'proxy_namespace' => 'DoctrineORMModule\Proxy',
                // SQL filters.
                'filters' => array()
            )
        ),
        // Entity Manager instantiation settings
        'entitymanager' => array(
            // configuration for the `doctrine.entitymanager.orm_avp` service
            'orm_avp' => array(
                // connection instance to use. The retrieved service name will
                // be `doctrine.connection.$thisSetting`
                'connection' => 'orm_avp',
                // configuration instance to use. The retrieved service name will
                // be `doctrine.configuration.$thisSetting`
                'configuration' => 'orm_avp',
            )
        ),
        'eventmanager' => array(
            // configuration for the `doctrine.eventmanager.orm_avp` service
            'orm_avp' => array()
        ),
        // collector SQL logger, used when ZendDeveloperTools and its toolbar are active
        'sql_logger_collector' => array(
            // configuration for the `doctrine.sql_logger_collector.orm_avp` service
            'orm_avp' => array(),
        ),
        // entity resolver configuration, allows mapping associations to interfaces
        'entity_resolver' => array(
            // configuration for the `doctrine.entity_resolver.orm_avp` service
            'orm_avp' => array()
        ),
    // authentication service configuration
// 				'authentication' => array(
// 						// configuration for the `doctrine.authentication.orm_avp` authentication service
// 						'orm_avp' => array(
// 								// name of the object manager to use. By default, the EntityManager is used
// 								'objectManager' => 'doctrine.entitymanager.orm_avp'
// 						),
// 				)
    ),
    'service_manager' => array(
        'factories' => array(
            //'doctrine.authenticationadapter.orm_avp' => new DoctrineModule\Service\Authentication\AdapterFactory('orm_avp'),
            //'doctrine.authenticationstorage.orm_avp' => new DoctrineModule\Service\Authentication\StorageFactory('orm_avp'),
            //'doctrine.authenticationservice.orm_avp' => new DoctrineModule\Service\Authentication\AuthenticationServiceFactory('orm_avp'),
            'doctrine.connection.orm_avp' => new DoctrineORMModule\Service\DBALConnectionFactory('orm_avp'),
            'doctrine.configuration.orm_avp' => new DoctrineORMModule\Service\ConfigurationFactory('orm_avp'),
            'doctrine.entitymanager.orm_avp' => new DoctrineORMModule\Service\EntityManagerFactory('orm_avp'),
            'doctrine.driver.orm_avp' => new DoctrineModule\Service\DriverFactory('orm_avp'),
            'doctrine.eventmanager.orm_avp' => new DoctrineModule\Service\EventManagerFactory('orm_avp'),
            'doctrine.entity_resolver.orm_avp' => new DoctrineORMModule\Service\EntityResolverFactory('orm_avp'),
            'doctrine.sql_logger_collector.orm_avp' => new DoctrineORMModule\Service\SQLLoggerCollectorFactory('orm_avp'),
            'doctrine.mapping_collector.orm_avp' => function (Zend\ServiceManager\ServiceLocatorInterface $sl) {
                $em = $sl->get('doctrine.entitymanager.orm_avp');

                return new DoctrineORMModule\Collector\MappingCollector($em->getMetadataFactory(), 'orm_avp_mappings');
            },
            'DoctrineORMModule\Form\Annotation\AnnotationBuilder' => function(Zend\ServiceManager\ServiceLocatorInterface $sl) {
                return new DoctrineORMModule\Form\Annotation\AnnotationBuilder($sl->get('doctrine.entitymanager.orm_avp'));
            },
        ),
    ),
);

