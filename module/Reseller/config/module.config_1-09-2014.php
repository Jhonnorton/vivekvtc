<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Reseller\Controller\Reseller' => 'Reseller\Controller\ResellerController',
            'Reseller\Controller\ResellerCruise' => 'Reseller\Controller\ResellerCruiseController',
            'Reseller\Controller\ResellerTemplate' => 'Reseller\Controller\ResellerTemplateController',
           'Reseller\Controller\Ajax' => 'Reseller\Controller\AjaxController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'affiliate' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/affiliate',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'Reseller',
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
            'affiliate-add' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/affiliate/add',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'Reseller',
                        'action' => 'add',
                    ),
                ),
            ),
            'affiliate-edit' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/admin/affiliate/edit/:id',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'Reseller',
                        'action' => 'edit',
                        'id' => 0,
                    ),
                ),
            ),
            
            'affiliate-order' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/affiliate/order',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'Reseller',
                        'action' => 'order',
                    ),
                ),
            ),
            
            'affiliate-order-history' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/affiliate/order/history/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'Reseller',
                        'action' => 'orderhistory',
                        'id' => 0,
                    ),
                ),
            ),
            
           'affiliate-event' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/affiliate/event',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'Reseller',
                        'action' => 'event',
                    ),
                ),
            ),
            
             'affiliate-event-edit' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/admin/affiliate/event/edit/:id',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'Reseller',
                        'action' => 'eventedit',
                        'id' => 0,
                    ),
                ),
            ),
            
            'affiliate-gallery' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/affiliate/event/gallery/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'Reseller',
                        'action' => 'eventgallery',
                        'id' => 0,
                    ),
                ),
            ),
            
              
            'affiliate-gallery-add' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/affiliate/gallery/add/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'Reseller',
                        'action' => 'galleryadd',
                        'id'=>0,
                      
                    ),
                ),
            ),
            
            
            'affiliate-gallery-delete' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/affiliate/gallery/delete/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'Reseller',
                        'action' => 'gallerydelete',
                        'id'=>0,
                      
                    ),
                ),
            ),
            
            
            'affiliate-event-feature' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/affiliate/event/feature/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'Reseller',
                        'action' => 'eventfeature',
                        'id' => 0,
                    ),
                ),
            ),
            
              
            'affiliate-event-feature-add' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/affiliate/event/feature/add/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'Reseller',
                        'action' => 'eventfeatureadd',
                        'id'=>0,
                      
                    ),
                ),
            ),
            
            
            'affiliate-event-feature-delete' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/affiliate/event/feature/delete/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'Reseller',
                        'action' => 'eventfeaturedelete',
                        'id'=>0,
                      
                    ),
                ),
            ),
            
            'affiliate-event-feature-edit' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/affiliate/event/feature/edit/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'Reseller',
                        'action' => 'eventfeatureedit',
                        'id'=>0,
                      
                    ),
                ),
            ),
            
             'affiliate-event-itinerary' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/affiliate/event/itinerary/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'Reseller',
                        'action' => 'eventitinerary',
                        'id' => 0,
                    ),
                ),
            ),
            
              
            'affiliate-event-itinerary-add' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/affiliate/event/itinerary/add/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'Reseller',
                        'action' => 'eventitineraryadd',
                        'id'=>0,
                      
                    ),
                ),
            ),
            
            
            'affiliate-event-itinerary-delete' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/affiliate/event/itinerary/delete/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'Reseller',
                        'action' => 'eventitinerarydelete',
                        'id'=>0,
                      
                    ),
                ),
            ),
            
            'affiliate-event-itinerary-edit' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/affiliate/event/itinerary/edit/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'Reseller',
                        'action' => 'eventitineraryedit',
                        'id'=>0,
                      
                    ),
                ),
            ),
            
            
            'affiliate-event-rooms' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/affiliate/event/rooms/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'Reseller',
                        'action' => 'eventrooms',
                        'id' => 0,
                    ),
                ),
            ),
            
              
            'affiliate-event-rooms-add' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/affiliate/event/rooms/add/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'Reseller',
                        'action' => 'eventroomsadd',
                        'id'=>0,
                      
                    ),
                ),
            ),
            
            
            'affiliate-event-rooms-delete' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/affiliate/event/rooms/delete/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'Reseller',
                        'action' => 'eventroomsdelete',
                        'id'=>0,
                      
                    ),
                ),
            ),
            
            'affiliate-event-rooms-edit' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/affiliate/event/rooms/edit/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'Reseller',
                        'action' => 'eventroomsedit',
                        'id'=>0,
                      
                    ),
                ),
            ),
            
             'affiliate-event-feature-set' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/affiliate/event/feature/set/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'Reseller',
                        'action' => 'eventsetfeature',
                        'id'=>0,
                      
                    ),
                ),
            ),
            
            'affiliate-event-feature-unset' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/affiliate/event/feature/unset/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'Reseller',
                        'action' => 'eventunsetfeature',
                        'id'=>0,
                      
                    ),
                ),
            ),
            
            
            'affiliate-event-view' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/affiliate/event/view/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'Reseller',
                        'action' => 'eventview',
                        'id'=>0,
                      
                    ),
                ),
            ),
            
            'affiliate-event-delete' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/affiliate/event/delete/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'Reseller',
                        'action' => 'eventdelete',
                        'id'=>0,
                      
                    ),
                ),
            ),
            
             'affiliate-resort' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/affiliate/resort',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'Reseller',
                        'action' => 'resort',
                    ),
                ),
            ),
            
            
             'affiliate-resort-edit' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/admin/affiliate/resort/edit/:id',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'Reseller',
                        'action' => 'resortedit',
                        'id' => 0,
                    ),
                ),
            ),
            
            'affiliate-resort-gallery' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/affiliate/resort/gallery/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'Reseller',
                        'action' => 'resortgallery',
                        'id' => 0,
                    ),
                ),
            ),
            
              
            'affiliate-resort-gallery-add' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/affiliate/resort/gallery/add/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'Reseller',
                        'action' => 'resortgalleryadd',
                        'id'=>0,
                      
                    ),
                ),
            ),
            
            
            'affiliate-resort-gallery-delete' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/affiliate/resort/gallery/delete/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'Reseller',
                        'action' => 'resortgallerydelete',
                        'id'=>0,
                      
                    ),
                ),
            ),
            'affiliate-cruise-view' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/affiliate/cruise',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'ResellerCruise',
                        'action' => 'index',
                      
                    ),
                ),
            ),
            'affiliate-cruise-view-all' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/affiliate/cruise/view/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'ResellerCruise',
                        'action' => 'view',
                        'id'=>0,
                      
                    ),
                ),
            ),
            'affiliate-cruise-gallery' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/affiliate/cruise/gallery/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'ResellerCruise',
                        'action' => 'gallery',
                        'id'=>0,
                      
                    ),
                ),
            ),
            'affiliate-cruise-gallery-add' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/affiliate/cruise/gallery/add/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'ResellerCruise',
                        'action' => 'addgallery',
                        'id'=>0,
                      
                    ),
                ),
            ),
            'affiliate-cruise-gallery-delete' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/affiliate/cruise/gallery/delete/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'ResellerCruise',
                        'action' => 'deletegallery',
                        'id'=>0,
                      
                    ),
                ),
            ),
            'affiliate-cruise-cabins' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/affiliate/cruise/cabins/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'ResellerCruise',
                        'action' => 'cabin',
                        'id'=>0,
                      
                    ),
                ),
            ),
            'affiliate-cruise-delete' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/affiliate/cruise/delete/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'ResellerCruise',
                        'action' => 'delete',
                        'id'=>0,
                      
                    ),
                ),
            ),
            'affiliate-template' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/affiliate/template',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'ResellerTemplate',
                        'action' => 'index',
                      
                    ),
                ),
            ),
            'affiliate-template-add' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/affiliate/template/add',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'ResellerTemplate',
                        'action' => 'add',
                      
                    ),
                ),
            ),
            'affiliate-template-add-ajax' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/reseller/template/ajax/getEmails',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'Ajax',
                        'action' => 'getEmail',
                      
                    ),
                ),
            ),
            'affiliate-template-suspend' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/reseller/template/suspend/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'ResellerTemplate',
                        'action' => 'suspend',
                        'id'=>0,
                      
                    ),
                ),
            ),
            'affiliate-template-unsuspend' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/reseller/template/unsuspend/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'ResellerTemplate',
                        'action' => 'unsuspend',
                        'id'=>0,
                      
                    ),
                ),
            ),
            'affiliate-template-delete' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/reseller/template/delete/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'ResellerTemplate',
                        'action' => 'delete',
                        'id'=>0,
                      
                    ),
                ),
            ),
            'affiliate-template-edit' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/reseller/template/edit/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'ResellerTemplate',
                        'action' => 'edit',
                        'id'=>0,
                      
                    ),
                ),
            ),
            'affiliate-template-view' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/affiliate/template/ajax/view',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reseller\Controller',
                        'controller' => 'Ajax',
                        'action' => 'viewUsers',
                      
                    ),
                ),
            ),
            
            
            
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Reseller' => __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
);
