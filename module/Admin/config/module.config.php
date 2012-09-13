<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Admin\Controller\Index' => 'Admin\Controller\IndexController',
            'Admin\Controller\Articles' => 'Admin\Controller\ArticlesController',
            //'Admin\Controller\Comments' => 'Admin\Controller\ArticlesCommentsController',
            //'Admin\Controller\Admins' => 'Admin\Controller\AdminsController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'admin' => array(
                'type'    => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/admin',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'articles' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/articles',
                            'defaults' => array(
                                'controller' => 'articles',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'update' => array(
                                'type'    => 'Segment',
                                'options' => array(
                                    'route'    => '/update/[:id]',
                                    'constraints' => array(
                                        'id' => '[0-9]+',
                                    ),
                                    'defaults' => array(
                                        'action' => 'update'
                                    ),
                                ),
                            ),
                            'delete' => array(
                                'type'    => 'Segment',
                                'options' => array(
                                    'route'    => '/delete/[:id]',
                                    'constraints' => array(
                                        'id' => '[0-9]+',
                                    ),
                                    'defaults' => array(
                                        'action' => 'delete'
                                    ),
                                ),
                            ),
                        ),
                    ),
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Admin' => __DIR__ . '/../view',
        ),
    ),
);
