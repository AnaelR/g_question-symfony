<?php

namespace App\Controller;

use App\Entity\Subject;
use App\Form\SubjectType;
use App\Repository\SubjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class HomePageController extends AbstractController
{
    #[Route('/', name: 'app_home_page')]
    public function index(SubjectRepository $subjectRepository, TranslatorInterface $translator, Request $request): Response
    {
        $user = $this->getUser();
        $subjects = $subjectRepository->findAll();
        $title = $translator->trans('welcome');

        $newSubject = new Subject();
        $newSubject->setOwner($user);
        $newSubject->setStatus(false);
        $newSubjectForm = $this->createForm(SubjectType::class, $newSubject);

        $newSubjectForm->handleRequest($request);

        if ($newSubjectForm->isSubmitted() && $newSubjectForm->isValid()) {
            $subjectRepository->save($newSubject, true);
        }

        return $this->render('home_page/index.html.twig', [
            'controller_name' => 'HomePageController',
            'subjects' => $subjects,
            'subjectForm' => $newSubjectForm->createView(),
            'title' => $title
        ]);
    }
}
