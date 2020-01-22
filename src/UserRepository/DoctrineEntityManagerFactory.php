<?php

/**
 * @see       https://github.com/mezzio/mezzio-authentication for the canonical source repository
 * @copyright https://github.com/mezzio/mezzio-authentication/blob/master/COPYRIGHT.md
 * @license   https://github.com/mezzio/mezzio-authentication/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Mezzio\Authentication\UserRepository;

use Mezzio\Authentication\Exception;
use Mezzio\Authentication\UserInterface;
use Psr\Container\ContainerInterface;

class DoctrineEntityManagerFactory
{
    public function __invoke(ContainerInterface $container) : DoctrineEntityManager
    {
        $config = $container->get('config')['authentication']['doctrine'] ?? null;
        if (null === $config) {
            throw new Exception\InvalidConfigException(
                'Doctrine values are missing in authentication config'
            );
        }

        return new DoctrineEntityManager(
            $container->get($config['entity-manager-class']),
            $config,
            $container->get(UserInterface::class)
        );
    }
}
