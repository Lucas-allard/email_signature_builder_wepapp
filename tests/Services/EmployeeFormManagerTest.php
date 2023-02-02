<?php

namespace App\Tests\Services;

use App\Entity\Employee;
use App\Form\EmployeeFormType;
use App\Services\EmployeeFormManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class EmployeeFormManagerTest extends KernelTestCase
{
    public function setUp(): void
    {
        // que fait le setUp() ?
        // 1. on crée un mock de FormFactoryInterface
        // 2. on crée un objet EmployeeFormManager
        parent::setUp();

        $this->formFactory = $this->createMock(FormFactoryInterface::class);

        $this->employeeFormManager = new EmployeeFormManager($this->formFactory);
    }

    public function testCreateForm()
    {
        // que fait le test ?
        // 1. on crée un mock de FormInterface
        // 2. on crée un tableau d'options
        // 3. on appelle la méthode createForm() de EmployeeFormManager
        // 4. on vérifie que la méthode createForm() retourne un objet FormInterface
        $this->formFactory->expects($this->once())
            ->method('create')
            ->willReturn($this->createMock(FormInterface::class));

        $options = ['submit_label' => 'Enregistrer'];

        $form = $this->employeeFormManager->createForm(new Employee(), $options);
        $this->assertInstanceOf(FormInterface::class, $form);
    }

//    public function testCreateFormWithOptions()
//    {
//     // on attend que le formulaire soit créé avec les options passées en paramètre
//        // on crée un mock de FormInterface
//        $this->formFactory->expects($this->once())
//            ->method('create')
//            ->with(EmployeeFormType::class, new Employee(), ['submit_label' => 'Enregistrer'])
//            ->willReturn($this->createMock(FormInterface::class));
//
//        // on crée un tableau d'options
//        $options = ['submit_label' => 'Enregistrer'];
//
//        // on appelle la méthode createForm() de EmployeeFormManager
//        $form = $this->employeeFormManager->createForm(new Employee());
//
//        // on vérifie que la méthode createForm() retourne un objet FormInterface
//        $this->assertInstanceOf(FormInterface::class, $form);
//
//        // on vérifie que le formulaire est créé avec les options passées en paramètre
//        $this->assertEquals($options, $form->getConfig()->getOptions());
//    }


    public function testHandleForm()
    {
        // que fait le test ?
        // 1. on crée un mock de FormInterface
        // 2. on crée un mock de Request
        // 3. on appelle la méthode handleForm() de EmployeeFormManager
        // 4. on vérifie que la méthode handleForm() retourne true
        $form = $this->createMock(FormInterface::class);

        $form->expects($this->once())
            ->method('handleRequest')
            ->willReturn($form);
        $form->expects($this->once())
            ->method('isSubmitted')
            ->willReturn(true);
        $form->expects($this->once())
            ->method('isValid')
            ->willReturn(true);

        $request = $this->createMock(Request::class);

        $this->assertTrue($this->employeeFormManager->handleForm($form, $request));
    }


}
