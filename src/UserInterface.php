<?php

/**
 * @see       https://github.com/mezzio/mezzio-authentication for the canonical source repository
 * @copyright https://github.com/mezzio/mezzio-authentication/blob/master/COPYRIGHT.md
 * @license   https://github.com/mezzio/mezzio-authentication/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Mezzio\Authentication;

interface UserInterface
{
    /**
     * Get the unique user identity (id, username, email address or ...)
     */
    public function getIdentity() : string;

    /**
     * Get all user roles
     *
     * @return string[]
     */
    public function getUserRoles() : array;
}
