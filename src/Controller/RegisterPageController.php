<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegisterPageController extends AbstractController
{
    #[Route('/register/page', name: 'app_register_page')]
    public function index(): Response
    {
        return $this->render('register_page/index.html.twig', [
            'controller_name' => 'RegisterPageController',
        ]);
    }
}
