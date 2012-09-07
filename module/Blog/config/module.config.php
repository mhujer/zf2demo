<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Blog\Controller\Index' => 'Blog\Controller\IndexController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'blog' => array(
                'type'    => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Blog\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
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
                    'page' => array(
						'type'    => 'Segment',
						'options' => array(
							'route'    => 'p/[:p]/',
							'constraints' => array(
								'id' => '[0-9]*',
							),
							'defaults' => array(
								'controller' => 'Blog\Controller\Index',
								'action'     => 'index',
								'p'			 => '1',
							),
						),
					),
					'article' => array(
						'type'    => 'Segment',
						'options' => array(
							'route'    => 'article/[:id]/',
							'constraints' => array(
								'id' => '[0-9]*',
							),
							'defaults' => array(
								'controller' => 'Blog\Controller\Index',
								'action'     => 'article',
							),
						),
					),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Blog' => __DIR__ . '/../view',
        ),
    ),
);
