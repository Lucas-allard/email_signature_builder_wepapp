<?php

namespace App\Tests\Repository;


use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserRepositoryTest extends KernelTestCase
{
    protected $databaseTool;
    private $userRepository;

    public function setUp(): void
    {
        parent::setUp();

        self::bootKernel();

        $this->databaseTool = static::getContainer()->get(DatabaseToolCollection::class)->get();
        $em = static::getContainer()->get('doctrine')->getManager();
        $connection = $em->getConnection();
        $connection->query('DELETE FROM user');
        $this->userRepository = static::getContainer()->get(UserRepository::class);
        $this->databaseTool->loadAliceFixture([
            __DIR__ . '/UserRepositoryTestFixtures.yaml',
        ]);

    }

    public function testLoadFixtures(): void
    {
        $users = static::getContainer()->get(UserRepository::class)->count([]);

        $this->assertSame(4, $users);
    }

    public function createUser($email): User
    {
        $user = new User();
        $user->setEmail($email);
        $user->setPassword('password');
        $user->setRoles(['ROLE_USER']);

        return $user;
    }

    public function testSave()
    {
        $user = $this->createUser('john.doe@gmail.com');

        $this->userRepository->save($user, true);

        $savedUser = $this->userRepository->findOneBy(['email' => 'john.doe@gmail.com']);
        $this->assertSame('john.doe@gmail.com', $savedUser->getEmail());
    }

    public function testUniqueEmail()
    {
        $user = $this->createUser('john@gmail.com');
        $this->userRepository->save($user, true);

        try {
            $user = $this->createUser('john@gmail.com');
            $this->userRepository->save($user, true);
            $this->fail('Expected exception for duplicate email');
        } catch (UniqueConstraintViolationException $e) {
            $this->assertSame(1, $this->userRepository->count(['email' => 'john@gmail.com']));
        }
    }

    public function testRemove()
    {
        $user = $this->createUser('marie@gmail.com');

        $this->userRepository->save($user, true);
        $this->userRepository->remove($user, true);

        $this->assertEmpty($this->userRepository->findOneBy(['email' => 'marie@gmail.com']));
    }

    public function testFind()
    {
        $user = $this->userRepository->find(1);
        $this->assertSame('user1@domain.com', $user->getEmail());
        $user = $this->userRepository->findOneBy(['email' => 'user1@domain.com']);
        $this->assertSame('user1@domain.com', $user->getEmail());
    }

    public function testFindAll()
    {
        $users = $this->userRepository->findAll();
        $this->assertSame(4, count($users));
    }


    public function testUpgradePassword()
    {
        $user = $this->createUser('upgrade-password@mail.com');
        $this->userRepository->save($user, true);
        $this->userRepository->upgradePassword($user, 'new-password');
        $this->assertSame('new-password', $user->getPassword());
    }
}