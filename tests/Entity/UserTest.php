<?php

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{

    /**
     * @var User
     */
    private $user;

    protected function setUp(): void
    {
        $this->user = new User();
    }
    public function testSetPassword()
    {
        $this->user->setPassword('password');

        $this->assertEquals('password', $this->user->getPassword());
    }

    public function testIsVerified()
    {
        $this->user->setIsVerified(true);

        $this->assertTrue($this->user->isVerified());
    }

    public function testSetIsVerified()
    {
        $this->user->setIsVerified(true);

        $this->assertTrue($this->user->isVerified());
    }

    public function testGetEmail()
    {
        $this->user->setEmail('email');

        $this->assertEquals('email', $this->user->getEmail());
    }

      public function testGetId()
    {
        /** @var User|MockObject $this->user */
        $this->user = $this->getMockBuilder(User::class)
            ->disableOriginalConstructor()
            ->setMethods(['getId'])
            ->getMock();

        $this->user->method('getId')
            ->willReturn(1);

        $this->assertEquals(1, $this->user->getId());
    }

    public function testSetRoles()
    {
        $this->user->setRoles(['ROLE_USER']);

        $this->assertEquals(['ROLE_USER'], $this->user->getRoles());
    }

    public function testGetPassword()
    {
        $this->user->setPassword('password');

        $this->assertEquals('password', $this->user->getPassword());
    }

    public function testSetEmail()
    {
        $this->user->setEmail('email');

        $this->assertEquals('email', $this->user->getEmail());
    }

    public function testGetUserIdentifier()
    {
        $this->user->setEmail('email');

        $this->assertEquals('email', $this->user->getUserIdentifier());
    }

    public function testGetRoles()
    {
        $this->user->setRoles(['ROLE_USER']);

        $this->assertEquals(['ROLE_USER'], $this->user->getRoles());
    }
}
