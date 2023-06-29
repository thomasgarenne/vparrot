<?php

namespace App\Controller;

use App\Entity\Comments;
use App\Form\CommentsType;
use App\Repository\CommentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/comments', name: 'comments_')]
class CommentsController extends AbstractController
{
    #[Route('/', name: 'index', methods: 'GET')]
    public function index(CommentsRepository $commentsRepository): Response
    {
        return $this->render('comments/index.html.twig', [
            'comments' => $commentsRepository->findBy([], ['created_at' => 'DESC']),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, CommentsRepository $commentsRepository): Response
    {
        $comment = new Comments();

        $form = $this->createForm(CommentsType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setIsValid(false);

            $commentsRepository->save($comment, true);

            $this->addFlash('success', 'Commentaire ajouté avec succés');

            return $this->redirectToRoute('app_main');
        }

        return $this->render('comments/new.html.twig', [
            'form' => $form,
            'comment' => $comment,
        ]);
    }
}
