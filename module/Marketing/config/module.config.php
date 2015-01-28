<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Marketing\Controller\Documents' => 'Marketing\Controller\DocumentsController', 
             'Marketing\Controller\Ajax' => 'Marketing\Controller\AjaxController',

        ),
    ),
    'router' => array(
        'routes' => array(
            'marketing' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/marketing',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Marketing\Controller',
                        'controller' => 'Documents',
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
             'marketing-newsletter-add' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/marketing/newsletter-add',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Marketing\Controller',
                        'controller' => 'Documents',
                        'action' => 'newsletterAdd',
                    ),
                ),
            ),
            
            
             'marketing-pdf-add' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/marketing/pdf-add',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Marketing\Controller',
                        'controller' => 'Documents',
                        'action' => 'pdfAdd',
                        
                    ),
                ),
            ),
            
            'marketing-pdfs-download' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/marketing/pdf-download/:pdfid',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Marketing\Controller',
                        'controller' => 'Documents',
                        'action' => 'pdfDownload',
                        'pdfid'=>0,
                    ),
                ),
            ),
            
            'marketing-newsletter' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/marketing/newsletter',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Marketing\Controller',
                        'controller' => 'Documents',
                        'action' => 'newsletterView',
                        
                    ),
                ),
            ),
            
            'marketing-sendnewsletter' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/marketing/send-newsletter',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Marketing\Controller',
                        'controller' => 'Documents',
                        'action' => 'newsletterSendMail',
                        
                    ),
                ),
            ),
            
            'marketing-pdf' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/marketing/pdf',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Marketing\Controller',
                        'controller' => 'Documents',
                        'action' => 'pdfView',
                        
                    ),
                ),
            ),
            
            'marketing-video' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/marketing/video',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Marketing\Controller',
                        'controller' => 'Documents',
                        'action' => 'videoView',
                        
                    ),
                ),
            ),
            
            'marketing-video-add' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/marketing/video-add',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Marketing\Controller',
                        'controller' => 'Documents',
                        'action' => 'videoAdd',
                        
                    ),
                ),
            ),
            
           'marketing-video-play' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            // Change this to something specific to your module
                            'route'    => '/admin/marketing/video-play/:vid',
                            'defaults' => array(
                                            // Change this value to reflect the namespace in which
                                            // the controllers for your module are found
                                            '__NAMESPACE__' => 'Marketing\Controller',
                                            'controller'    => 'Ajax',
                                            'action'        => 'playVideo',
                                            'vid'		=> 0,
                            ),
                        ),
          ),
            
            'marketing-image' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/marketing/image',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Marketing\Controller',
                        'controller' => 'Documents',
                        'action' => 'imageView',
                        
                    ),
                ),
            ),
           
            'marketing-image-add' => array(
                'type' => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/admin/marketing/image-add',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Marketing\Controller',
                        'controller' => 'Documents',
                        'action' => 'imageAdd',
                        
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Marketing' => __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
);
