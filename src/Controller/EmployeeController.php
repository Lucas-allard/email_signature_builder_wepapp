<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Form\EmployeeFormType;
use App\Repository\EmployeeRepository;
use App\Services\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/salaries', name: 'app_employee_')]
#[IsGranted('ROLE_USER')]
class EmployeeController extends AbstractController
{


    public function __construct(private EmployeeRepository $employeeRepository, private FileUploader $fileUploader)
    {
    }

    #[Route('/', name: 'index')]
    #[IsGranted('ROLE_USER')]
    public function index(): Response
    {
        $employees = $this->employeeRepository->findAll();

        return $this->render('employee/index.html.twig', [
            'employees' => $employees,
        ]);
    }

    #[Route('/signature/{employee}', name: 'show')]
    #[IsGranted('ROLE_USER')]
    public function show(Employee $employee): Response
    {
        return $this->render('employee/show.html.twig', [
            'employee' => $employee,
        ]);
    }


    #[Route('/nouveau', name: 'new')]
    #[IsGranted('ROLE_ADMIN')]
    public function new(Request $request): Response
    {

        $employee = new Employee();

        $submitLabel = 'Ajouter';

        $form = $this->createForm(EmployeeFormType::class, $employee, [
            'submit_label' => $submitLabel,
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->employeeRepository->save($employee, true);

            return $this->redirectToRoute('app_employee_index');
        }
        return $this->render('employee/new.html.twig', [
            'employeeForm' => $form->createView(),
        ]);

    }

    #[Route('/{employee}/editer', name: 'edit')]
    #[IsGranted('ROLE_ADMIN')]
    public function edit(Employee $employee, Request $request): Response
    {

        $submitLabel = 'Modifier';

        $form = $this->createForm(EmployeeFormType::class, $employee, [
            'submit_label' => $submitLabel,
        ]);

        $form->setData($employee);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->employeeRepository->save($employee, true);

            return $this->redirectToRoute('app_employee_index');
        }

        return $this->render('employee/edit.html.twig', [
            'employeeForm' => $form->createView(),
            'employee' => $employee,
        ]);
    }

    #[Route('/{employee}/supprimer', name: 'delete')]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(Employee $employee): Response
    {

        $this->employeeRepository->remove($employee, true);

        return $this->redirectToRoute('app_employee_index');
    }
}
