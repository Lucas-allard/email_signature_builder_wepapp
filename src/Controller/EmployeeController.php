<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Form\EmployeeFormType;
use App\Repository\EmployeeRepository;
use App\Services\EmployeeFormManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/collaborateurs', name: 'app_employee_')]
#[IsGranted('ROLE_USER')]
class EmployeeController extends AbstractController
{

    const CREATE_VIEW = 'employee/new.html.twig';

    const EDIT_VIEW = 'employee/edit.html.twig';

    /**
     * @param EmployeeRepository $employeeRepository
     * @param EmployeeFormManager $employeeFormManager
     * @param ValidatorInterface $validator
     */
    public function __construct(
        private EmployeeRepository  $employeeRepository,
        private EmployeeFormManager $employeeFormManager,
        private ValidatorInterface  $validator
    )
    {
    }

    /**
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    #[Route('/', name: 'index')]
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $data = $this->employeeRepository->findBy([], ['lastName' => 'ASC']);

        $employees = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            20
        );

        return $this->render('employee/index.html.twig', [
            'employees' => $employees,
        ]);
    }

    /**
     * @param Employee $employee
     * @return Response
     */
    #[Route('/signature/{employee}', name: 'show')]
    public function show(Employee $employee): Response
    {
        return $this->render('employee/show.html.twig', [
            'employee' => $employee,
        ]);
    }


    /**
     * @param Request $request
     * @return Response
     */
    #[Route('/nouveau', name: 'new')]
    #[IsGranted('ROLE_ADMIN')]
    public function new(Request $request): Response
    {
        return $this->handleEmployeeForm(
            new Employee(),
            $request,
            'Ajouter',
            self::CREATE_VIEW,
            $this->validator
        );
    }

    /**
     * @param Employee $employee
     * @param Request $request
     * @return Response
     */
    #[Route('/{employee}/editer', name: 'edit')]
    #[IsGranted('ROLE_ADMIN')]
    public function edit(Employee $employee, Request $request): Response
    {
        return $this->handleEmployeeForm($employee, $request, 'Modifier', self::EDIT_VIEW, $this->validator);
    }

    /**
     * @param Employee $employee
     * @param Request $request
     * @param string $submitLabel
     * @param string $view
     * @param ValidatorInterface $validator
     * @return Response
     */
    public function handleEmployeeForm(
        Employee           $employee,
        Request            $request,
        string             $submitLabel,
        string             $view,
        ValidatorInterface $validator
    ): Response
    {

        $form = $this->employeeFormManager->createForm($employee, ['submit_label' => $submitLabel]);

        if ($this->employeeFormManager->handleForm($form, $request)) {
            $errors = $validator->validate($employee);
            if (count($errors) > 0) {
                return $this->render($view, [
                    'form' => $form->createView(),
                    'errors' => $errors,
                ]);
            }

            if ($employee->getId() === null) {
                $this->addFlash('success', 'Le salarié a bien été ajouté');
            } else {
                $this->addFlash('success', 'Le salarié a bien été modifié');
            }

            $this->employeeRepository->save($employee, true);

            return $this->redirectToRoute('app_employee_index');
        }

        return $this->render($view, [
            'employeeForm' => $form->createView(),
            'employee' => $employee,
        ]);
    }

    /**
     * @param Employee $employee
     * @return Response
     */
    #[Route('/{employee}/supprimer', name: 'delete')]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(Employee $employee): Response
    {
        $this->employeeRepository->remove($employee, true);

        return $this->redirectToRoute('app_employee_index');
    }
}
