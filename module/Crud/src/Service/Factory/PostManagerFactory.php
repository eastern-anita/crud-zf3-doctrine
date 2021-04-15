<?php

declare(strict_types=1);

namespace Crud\Service\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Crud\Service\PostManager;

class PostManagerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return PostManager
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): PostManager
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');

        return new PostManager($entityManager);
    }
}
