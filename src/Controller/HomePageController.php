<?php

namespace App\Controller;

use App\Repository\SubjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class HomePageController extends AbstractController
{
    #[Route('/', name: 'app_home_page')]
    public function index(SubjectRepository $subjectRepository, TranslatorInterface $translator): Response
    {
        $subjects = $subjectRepository->findAll();
        $title = $translator->trans('welcome');

        return $this->render('home_page/index.html.twig', [
            'controller_name' => 'HomePageController',
            'subjects' => $subjects,
            'title' => $title
        ]);
    }
}
