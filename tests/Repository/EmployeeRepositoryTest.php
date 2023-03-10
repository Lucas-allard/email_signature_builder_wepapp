<?php

namespace App\Tests\Repository;


use App\Entity\Employee;
use App\Repository\EmployeeRepository;
use Exception;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class EmployeeRepositoryTest extends KernelTestCase
{

    protected $databaseTool;

    private $employeeRepository;

    /**
     * @throws Exception
     */
    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        self::bootKernel();

        $this->databaseTool = static::getContainer()->get(DatabaseToolCollection::class)->get();
        $em = static::getContainer()->get('doctrine')->getManager();
        $connection = $em->getConnection();
        $connection->query('DELETE FROM employee');
        $this->employeeRepository = static::getContainer()->get(EmployeeRepository::class);
        $this->databaseTool->loadAliceFixture([
            __DIR__ . '/EmployeeRepositoryTestFixtures.yaml',
        ]);

    }

    /**
     * @throws Exception
     */
    public function testLoadFixtures(): void
    {
        $employees = static::getContainer()->get(EmployeeRepository::class)->count([]);

        $this->assertSame(10, $employees);
    }

    public function createEmployee($firstName, $lastName, $position, $picture): Employee
    {
        $employee = new Employee();
        $employee->setFirstName($firstName);
        $employee->setLastName($lastName);
        $employee->setPosition($position);
        $employee->setPicture($picture);

        return $employee;
    }

    public function testSave()
    {
        $employee = $this->createEmployee('John', 'Doe', 'Developer', 'picture.jpg');

        $this->employeeRepository->save($employee, true);

        $this->assertSame(11, $this->employeeRepository->count([]));
    }

    public function testRemove()
    {
        $employee = $this->createEmployee('John', 'Doe', 'Developer', 'picture.jpg');

        $this->employeeRepository->save($employee, true);

        $this->assertSame(11, $this->employeeRepository->count([]));

        $this->employeeRepository->remove($employee, true);

        $this->assertSame(10, $this->employeeRepository->count([]));

    }

    public function testFindAll()
    {
        $employees = $this->employeeRepository->findAll();

        $this->assertSame(10, count($employees));
    }

    public function testFindOneBy()
    {
        $employee = $this->createEmployee('John', 'Doe', 'Developer', 'picture.jpg');
        $this->employeeRepository->save($employee, true);

        $employee = $this->employeeRepository->findOneBy(['firstName' => 'John']);

        $this->assertSame('John', $employee->getFirstName());
    }

    public function testFind()
    {
        $employee = $this->createEmployee('John', 'Doe', 'Developer', 'picture.jpg');
        $this->employeeRepository->save($employee, true);

        $employee = $this->employeeRepository->find(11);

        $this->assertSame('John', $employee->getFirstName());
    }

    public function testFindBy()
    {
        $employee = $this->createEmployee('John', 'Doe', 'Developer', 'picture.jpg');
        $this->employeeRepository->save($employee, true);

        $employees = $this->employeeRepository->findBy(['firstName' => 'John']);

        $this->assertSame(1, count($employees));
    }
}