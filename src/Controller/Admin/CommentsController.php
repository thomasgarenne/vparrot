<?php

namespace App\Controller\Admin;

use App\Repository\CommentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/comments', name: 'admin_comments_')]
class CommentsController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CommentsRepository $commentsRepository): Response
    {
        return $this->render('admin/comments/index.html.twig', [
            'comments' => $commentsRepository->findAll(),
        ]);
    }
}
