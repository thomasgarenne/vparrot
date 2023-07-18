<?php

namespace App\Controller\Admin;

use App\Repository\CommentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted("ROLE_ADMIN_PRODUCT")]
#[Route('/admin', name: 'admin_')]
class MainController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CommentsRepository $commentsRepository): Response
    {
        return $this->render('admin/index.html.twig', [
            'comments' => $commentsRepository->findBy(['is_valid' => false], ['created_at' => 'DESC'])
        ]);
    }
}
