<?php

namespace App\Controller;

use App\Repository\SubjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SubjectPageController extends AbstractController
{
    #[Route('/subject/{id}', name: 'app_subject_page')]
    public function index(int $id, SubjectRepository $subjectRepository): Response
    {
        $subject = $subjectRepository->find($id);

        $comments = $subject->getComments();

        return $this->render('subject_page/index.html.twig', [
            'controller_name' => 'SubjectPageController',
            'subject' => $subject,
            'comments' => $comments,
        ]);
    }
}
