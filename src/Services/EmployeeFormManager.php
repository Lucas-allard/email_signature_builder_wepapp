<?php

namespace App\Services;

use App\Form\EmployeeFormType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class EmployeeFormManager
{
    /**
     * @var FormFactoryInterface
     */
    private FormFactoryInterface $formFactory;

    /**
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    /**
     * @param $data
     * @param array $options
     * @return FormInterface
     */
    public function createForm($data = null, array $options = []): FormInterface
    {
        return $this->formFactory->create(EmployeeFormType::class, $data, $options);
    }

    /**
     * @param FormInterface $form
     * @param Request $request
     * @return bool
     */
    public function handleForm(FormInterface $form, Request $request): bool
    {
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return true;
        }
        return false;
    }
}