<?php

namespace App\Services;

use App\Form\EmployeeFormType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class EmployeeFormManager
{
    private FormFactoryInterface $formFactory;

    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    public function createForm($data = null, array $options = [])
    {
        return $this->formFactory->create(EmployeeFormType::class, $data, $options);
    }

    public function handleForm(FormInterface $form, Request $request) {
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            return true;
        }
        return false;
    }
}