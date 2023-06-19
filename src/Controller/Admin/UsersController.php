<?php

namespace App\Controller\Admin;

use App\Entity\Users;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('admin/users', name: 'admin_users_')]
class UsersController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(UsersRepository $usersRepository): Response
    {
        $usersList = $usersRepository->findAll();

        return $this->render('admin/users/index.html.twig', [
            'users' => $usersList,
        ]);
    }

    #[Route('/create', name: 'create')]
    public function create()
    {
        $user = new Users();

        $form = $this->createForm(UsersType::class);

        /*
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($user);
            $manager->flush();
        }
        */
    }
}
