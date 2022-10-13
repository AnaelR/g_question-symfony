<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentFormType;
use App\Repository\CommentRepository;
use App\Repository\SubjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SubjectPageController extends AbstractController
{
    #[Route('/subject/{id}', name: 'app_subject_page')]
    public function index(Request $request, int $id, SubjectRepository $subjectRepository, CommentRepository $commentRepository): Response
    {

        $subject = $subjectRepository->find($id);

        $comments = $subject->getComments();

        $newComment = $this->setUpCommentForm($id, $subjectRepository);
        $commentForm = $this->createForm(CommentFormType::class, $newComment);

        $commentForm->handleRequest($request);

        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            $commentRepository->save($newComment, true);
        }

        return $this->render('subject_page/index.html.twig', [
            'controller_name' => 'SubjectPageController',
            'subject' => $subject,
            'comments' => $comments,
            'commentForm' => $commentForm->createView()
        ]);
    }

    private function setUpCommentForm(int $id, SubjectRepository $subjectRepository): Comment|null
    {
        $user = $this->getUser();

        if ($user == null) return null;

        $newComment = new Comment();
        $newComment->setOwner($user);
        $newComment->setSubject($subjectRepository->find($id));

        return $newComment;
    }
}
