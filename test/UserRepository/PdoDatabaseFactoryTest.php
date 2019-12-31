<?php

/**
 * @see       https://github.com/mezzio/mezzio-authentication for the canonical source repository
 * @copyright https://github.com/mezzio/mezzio-authentication/blob/master/COPYRIGHT.md
 * @license   https://github.com/mezzio/mezzio-authentication/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace MezzioTest\Authentication\UserRepository;

use Mezzio\Authentication\Exception\InvalidConfigException;
use Mezzio\Authentication\UserInterface;
use Mezzio\Authentication\UserRepository\PdoDatabase;
use Mezzio\Authentication\UserRepository\PdoDatabaseFactory;
use PDO;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

class PdoDatabaseFactoryTest extends TestCase
{
    protected function setUp()
    {
        $this->container = $this->prophesize(ContainerInterface::class);
        $this->user = $this->prophesize(UserInterface::class);
        $this->pdo = $this->prophesize(PDO::class);
        $this->factory = new PdoDatabaseFactory();
    }

    public function testInvokeWithMissingConfig()
    {
        // We cannot throw a ContainerExceptionInterface directly; this
        // approach simply mimics `get()` throwing _any_ exception, which is
        // what will happen if `config` is not defined.
        $this->container->get('config')->willThrow(new InvalidConfigException());

        $this->expectException(InvalidConfigException::class);
        ($this->factory)($this->container->reveal());
    }

    public function testInvokeWithEmptyConfig()
    {
        $this->container->get('config')->willReturn([]);

        $this->expectException(InvalidConfigException::class);
        $this->expectExceptionMessage('PDO values are missing in authentication config');
        $pdoDatabase = ($this->factory)($this->container->reveal());
    }

    public function getPdoInvalidConfig()
    {
        return [
            [[]],
            [[
                'service' => PDO::class,
            ]],
            [[
                'service' => PDO::class,
                'table'   => 'test'
            ]],
            [[
                'service' => PDO::class,
                'table'   => 'test',
                'field'   => []
            ]],
            [[
                'service' => PDO::class,
                'table'   => 'test',
                'field'   => [
                    'identity' => 'email',
                ]
            ]],
            [[
                'dsn' => 'mysql:dbname=testdb;host=127.0.0.1'
            ]],
            [[
                'dsn'   => 'mysql:dbname=testdb;host=127.0.0.1',
                'table' => 'test'
            ]],
            [[
                'dsn'   => 'mysql:dbname=testdb;host=127.0.0.1',
                'table' => 'test',
                'field' => []
            ]],
            [[
                'dsn'   => 'mysql:dbname=testdb;host=127.0.0.1',
                'table' => 'test',
                'field' => [
                    'identity' => 'email'
                ]
            ]]
        ];
    }

    /**
     * @dataProvider getPdoInvalidConfig
     * @expectedException Mezzio\Authentication\Exception\InvalidConfigException
     */
    public function testInvokeWithInvalidConfig($pdoConfig)
    {
        $this->container->get('config')->willReturn([
            'authentication' => ['pdo' => $pdoConfig]
        ]);
        $this->container->has(PDO::class)->willReturn(true);
        $this->container->get(PDO::class)->willReturn($this->pdo->reveal());
        $this->container->get(UserInterface::class)->willReturn(
            function () {
                return $this->user->reveal();
            }
        );
        $pdoDatabase = ($this->factory)($this->container->reveal());
    }

    public function getPdoValidConfig()
    {
        return [
            [[
                'service' => PDO::class,
                'table'   => 'user',
                'field'   => [
                    'identity' => 'username',
                    'password' => 'password'
                ]
            ]],
            [[
                'dsn'   => 'sqlite:' . __DIR__ . '/../TestAssets/pdo.sqlite',
                'table' => 'user',
                'field' => [
                    'identity' => 'username',
                    'password' => 'password'
                ]
            ]],
        ];
    }

    /**
     * @dataProvider getPdoValidConfig
     */
    public function testInvokeWithValidConfig($pdoConfig)
    {
        $this->container->get('config')->willReturn([
            'authentication' => ['pdo' => $pdoConfig]
        ]);
        $this->container->has(PDO::class)->willReturn(true);
        $this->container->get(PDO::class)->willReturn($this->pdo->reveal());
        $this->container->get(UserInterface::class)->willReturn(
            function () {
                return $this->user->reveal();
            }
        );
        $pdoDatabase = ($this->factory)($this->container->reveal());
        $this->assertInstanceOf(PdoDatabase::class, $pdoDatabase);
    }
}
