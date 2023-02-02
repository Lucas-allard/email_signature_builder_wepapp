<?php

namespace App\DataFixtures;

use App\Entity\Employee;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EmployeeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $firstName = "Lucas";
        $lastName = "ALLARD";
        $employee = new Employee();
        $employee->setFirstName($firstName);
        $employee->setLastName($lastName);
        $employee->setFirstEmail(strtolower($firstName[0]) . strtolower($lastName) . '@mili-atlas.fr');
        $employee->setSecondEmail(strtolower($firstName[0]) . strtolower($lastName) . '@mili-invest.fr');
        $employee->setThirdEmail(strtolower($firstName[0]) . strtolower($lastName) . '@1806-patrimoine.fr');
        $employee->setPicture('https://mili-atlas.fr/wp-content/uploads/' . $firstName . '-' . $lastName . '-300x300.png');
        $employee->setPosition('Developpeur Web');
        $employee->setPhoneNumber('06 00 00 00 00');
        $employee->setLinkedinUrl('https://www.linkedin.com/in/' . strtolower($lastName) . strtolower($firstName) . '/');

        $manager->persist($employee);

        $manager->flush();
    }
}
