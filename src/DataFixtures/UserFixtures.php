<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordEncoder)
    {
    }

    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 2; $i++) {
            $user = new User();
            $user->setEmail($faker->email());
            $user->setPassword($this->passwordEncoder->hashPassword($user, 'password'));
            //set roles user and admin but role admin just to one user
            if ($i == 0) {
                $user->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
            } else {
                $user->setRoles(['ROLE_USER']);
            }
            $user->setIsVerified(true);

            $manager->persist($user);
        }
        $manager->flush();
    }
}
