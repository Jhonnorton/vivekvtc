<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Reports\Controller\Reports' => 'Reports\Controller\ReportsController',
            'Reports\Controller\Ajax' => 'Reports\Controller\AjaxController',
            //  'Inventory\Controller\Ajax' => 'Inventory\Controller\AjaxController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'reports' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/reports',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reports\Controller',
                        'controller' => 'Reports',
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
            'csv-sale' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/admin/reports/csv',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Reports\Controller',
                        'controller' => 'Reports',
                        'action' => 'csv',
                    ),
                ),
            ),
            
            'report-reservation' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/admin/reports/reservation',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Reports\Controller',
                        'controller' => 'Reports',
                        'action' => 'reservation',
                    ),
                ),
            ),
            'report-agent' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/admin/reports/agent',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Reports\Controller',
                        'controller' => 'Reports',
                        'action' => 'agent',
                    ),
                ),
            ),
            'agent-ajax' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/report/ajax/agent/user/:id',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reports\Controller',
                        'controller' => 'Ajax',
                        'action' => 'user',
                        'id' => 0,
                    ),
                ),
            ),
             'csv-agent' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/admin/reports/csvagent',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Reports\Controller',
                        'controller' => 'Reports',
                        'action' => 'csvagent',
                    ),
                ),
            ),
            
             'csv-reservation' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/admin/reports/csv-reservation',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Reports\Controller',
                        'controller' => 'Reports',
                        'action' => 'csvReservation',
                    ),
                ),
            ),
            
            
             'report-room-night' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/admin/reports/roomnight',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Reports\Controller',
                        'controller' => 'Reports',
                        'action' => 'roomNight',
                    ),
                ),
            ),
            
             'csv-room-night' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/admin/reports/csv-room-night',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Reports\Controller',
                        'controller' => 'Reports',
                        'action' => 'csvRoomNight',
                    ),
                ),
            ),
            
            
              
             'report-rooming' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/admin/reports/rooming',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Reports\Controller',
                        'controller' => 'Reports',
                        'action' => 'rooming',
                    ),
                ),
            ),
            
             'csv-rooming' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/admin/reports/csv-room-night',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Reports\Controller',
                        'controller' => 'Reports',
                        'action' => 'csvrooming',
                    ),
                ),
            ),
            
            
            
             'report-commision' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/admin/reports/commision',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Reports\Controller',
                        'controller' => 'Reports',
                        'action' => 'commision',
                    ),
                ),
            ),
            
             'csv-commission' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/admin/reports/csv-commission',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Reports\Controller',
                        'controller' => 'Reports',
                        'action' => 'csvcommission',
                    ),
                ),
            ),
            
            'report-ajax' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/report/ajax/commision/type/:id/:typeid[/:source]',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Reports\Controller',
                        'controller' => 'Ajax',
                        'action' => 'type',
                        'id' => 0,
                    ),
                ),
            ),
            'report-profitloss' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/admin/reports/profitloss',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Reports\Controller',
                        'controller' => 'Reports',
                        'action' => 'profitloss',
                    ),
                ),
            ),
             'csv-profitloss' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/admin/reports/csvprofitloss',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Reports\Controller',
                        'controller' => 'Reports',
                        'action' => 'csvprofitloss',
                    ),
                ),
            ),
            
            
            
        ),
    ),
    'view_manager' => array(
        'template_map' => array(
            'download/download-csv' => __DIR__ . '/../view/download/download/download-csv.phtml',
            'download/download-csv-reservation' => __DIR__ . '/../view/download/download/download-csv-reservation.phtml',
            'download/download-csv-roomnight' => __DIR__ . '/../view/download/download/download-csv-roomnight.phtml',
            'download/download-csv-rooming' => __DIR__ . '/../view/download/download/download-csv-rooming.phtml',
            'download/download-csv-agent' => __DIR__ . '/../view/download/download/download-csv-agent.phtml',
            'download/download-csv-commission' => __DIR__ . '/../view/download/download/download-csv-commission.phtml',
            'download/download-csv-profitloss' => __DIR__ . '/../view/download/download/download-csv-profitloss.phtml',
 
            ),
        'template_path_stack' => array(
            'Reports' => __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
);
