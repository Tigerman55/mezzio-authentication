<?php

/**
 * @see       https://github.com/mezzio/mezzio-authentication for the canonical source repository
 * @copyright https://github.com/mezzio/mezzio-authentication/blob/master/COPYRIGHT.md
 * @license   https://github.com/mezzio/mezzio-authentication/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Mezzio\Authentication\UserRepository;

use Mezzio\Authentication\UserInterface;
use Mezzio\Authentication\UserRepositoryInterface;

class DoctrineEntityManager implements UserRepositoryInterface
{
    /**
     * @var object
     */
    private $em;

    /**
     * @var array
     */
    private $config;

    /**
     * @var callable
     */
    private $userFactory;

    /**
     * @param object $em
     */
    public function __construct(
        $em,
        array $config,
        callable $userFactory
    ) {
        $this->em = $em;
        $this->config = $config;

        // Provide type safety for the composed user factory.
        $this->userFactory = function (
            string $identity,
            array $roles = [],
            array $details = []
        ) use ($userFactory) : UserInterface {
            return $userFactory($identity, $roles, $details);
        };
    }

    public function authenticate(string $credential, string $password = null) : ?UserInterface
    {
        $users = $this->em->createQueryBuilder()->select('u')
            ->from($this->config['table']['user'], 'u')
            ->where('u.' . $this->config['field']['identity'] . ' = :identity')
            ->setParameter('identity', $credential)
            ->getQuery()
            ->getArrayResult();

        if ($users === []) {
            return null;
        }

        $user = $users[0];
        if (password_verify($password ?? '', $user[$this->config['field']['password']] ?? '')) {
            return ($this->userFactory)(
                $credential,
                $this->getUserRoles(),
                $this->getUserDetails($user)
            );
        }

        return null;
    }

    private function getUserRoles() : array
    {
        $roles = $this->em->createQueryBuilder()
            ->select('r')
            ->from($this->config['entity']['role'], 'r')
            ->getQuery()
            ->getArrayResult();

        return array_map(function (array $roles) {
            return $roles[$this->config['field']['role']];
        }, $roles);
    }

    private function getUserDetails(array $user) : array
    {
        $details = [];
        foreach ($this->config['user']['details'] as $detail) {
            $details[$detail] = $user[$detail];
        }

        return $details;
    }
}
