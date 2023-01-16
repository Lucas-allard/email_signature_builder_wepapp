<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SignatureController extends AbstractController
{
    #[Route('/signature', name: 'app_signature')]
    public function index(): Response
    {
        return $this->render('signature/index.html.twig', [
            'controller_name' => 'SignatureController',
        ]);
    }
}
