<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SubjectPageController extends AbstractController
{
    #[Route('/subject/page', name: 'app_subject_page')]
    public function index(): Response
    {
        return $this->render('subject_page/index.html.twig', [
            'controller_name' => 'SubjectPageController',
        ]);
    }
}
