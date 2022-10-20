<?php

namespace App\Controller;

use App\Entity\Subject;
use App\Entity\Comment;
use App\Form\CommentFormType;
use App\Form\SubjectType;
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

            return $this->redirectToRoute('app_subject_page', ['id' => $id]);

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

    #[Route('/{id}', name: 'app_subject_delete', methods: ['POST'])]
    public function delete(Request $request, Subject $subject, SubjectRepository $subjectRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$subject->getId(), $request->request->get('_token'))) {
            $subjectRepository->remove($subject, true);
        }

        return $this->redirectToRoute('app_profil_page', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/edit', name: 'app_subject_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Subject $subject, SubjectRepository $subjectRepository): Response
    {
        $form = $this->createForm(SubjectType::class, $subject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $subjectRepository->save($subject, true);

            return $this->redirectToRoute('app_profil_page', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('subject/edit.html.twig', [
            'subject' => $subject,
            'form' => $form,
        ]);
    }
}
