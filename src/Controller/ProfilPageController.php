<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilPageController extends AbstractController
{
    #[Route('/profile', name: 'app_profil_page')]
    public function index(UserRepository $userRepository): Response
    {
        $user = $userRepository->find($this->getUser());

        $userSubjects = $user->getSubjects();

        return $this->render('profil_page/index.html.twig', [
            'controller_name' => 'ProfilPageController',
            'user' => $user,
            'userSubjects' => $userSubjects
        ]);
    }
}
