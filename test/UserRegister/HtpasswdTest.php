<?php
/**
 * @see       https://github.com/zendframework/zend-expressive-authentication for the canonical source repository
 * @copyright Copyright (c) 2017 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   https://github.com/zendframework/zend-expressive-authorization/blob/master/LICENSE.md New BSD License
 */
namespace ZendTest\Expressive\Authentication\UserRegister;

use PHPUnit\Framework\TestCase;
use Zend\Expressive\Authentication\UserInterface;
use Zend\Expressive\Authentication\UserRegisterInterface;
use Zend\Expressive\Authentication\UserRegister\Htpasswd;

class HtpasswdTest extends TestCase
{
    /**
     * @expectedException Zend\Expressive\Authentication\Exception\InvalidConfigException
     */
    public function testConstructorWithNoFile()
    {
        $htpasswd = new Htpasswd('foo');
    }

    public function testConstructor()
    {
        $htpasswd = new Htpasswd(__DIR__ . '/../TestAssets/htpasswd');
        $this->assertInstanceOf(UserRegisterInterface::class, $htpasswd);
    }

    public function testCheckCredential()
    {
        $htpasswd = new Htpasswd(__DIR__ . '/../TestAssets/htpasswd');

        $user = $htpasswd->authenticate('test', 'password');
        $this->assertInstanceOf(UserInterface::class, $user);
        $this->assertEquals('test', $user->getUsername());
    }

    public function testCheckUnauthorizedUser()
    {
        $htpasswd = new Htpasswd(__DIR__ . '/../TestAssets/htpasswd');
        $this->assertNull($htpasswd->authenticate('test', 'foo'));
    }

    public function testCheckCredentialWithoutPassword()
    {
        $htpasswd = new Htpasswd(__DIR__ . '/../TestAssets/htpasswd');
        $this->assertNull($htpasswd->authenticate('test', null));
    }

    /**
     * @expectedException Zend\Expressive\Authentication\Exception\RuntimeException
     */
    public function testCheckInsecureCredential()
    {
        $htpasswd = new Htpasswd(__DIR__ . '/../TestAssets/htpasswd_insecure');
        $htpasswd->authenticate('test', 'password');
    }
}
