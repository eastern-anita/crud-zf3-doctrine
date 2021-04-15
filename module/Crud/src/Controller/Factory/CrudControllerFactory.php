<?php

declare(strict_types=1);

namespace Crud\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Crud\Controller\CrudController;
use Crud\Service\PostManager;

class CrudControllerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return CrudController
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): CrudController
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $empManager = $container->get(PostManager::class);

        return new CrudController($entityManager, $empManager);
    }
}
