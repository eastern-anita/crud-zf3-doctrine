<?php

namespace Crud;

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Zend\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'crud' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/crud[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller'    => Controller\CrudController::class,
                        'action'        => 'index',
                    ]
                ]
            ],
            'delete' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/crud[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller'    => Controller\CrudController::class,
                        'action'        => 'index',
                    ]
                ]
            ],
            'edit' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/crud[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller'    => Controller\CrudController::class,
                        'action'        => 'index',
                    ]
                ]
            ],
            'add' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/crud[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller'    => Controller\CrudController::class,
                        'action'        => 'index',
                    ]
                ]
            ]
        ]
    ],
    'controllers' => [
        'factories' => [
            Controller\CrudController::class =>
                Controller\Factory\CrudControllerFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'crud' => __DIR__ . '/../view/',
        ],
    ],
    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ]
            ]
        ]
    ],
    'service_manager' => [
        'factories' => [
            Service\PostManager::class => Service\Factory\PostManagerFactory::class,
        ],
    ],
];
