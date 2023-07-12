<?php

namespace App\Controller\Admin;

use App\Entity\Comments;
use App\Form\CommentsType;
use App\Form\ValidCommentsType;
use App\Repository\CommentsRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted("ROLE_ADMIN_PRODUCT")]
#[Route('/admin/comments', name: 'admin_comments_')]
class CommentsController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(Request $request, PaginatorInterface $paginator, CommentsRepository $commentsRepository): Response
    {
        $comments = $commentsRepository->findBy([], ['created_at' => 'DESC']);

        $comments = $paginator->paginate(
            $comments,
            $request->query->getInt('page', 1),
            20
        );

        return $this->render('admin/comments/index.html.twig', [
            'comments' => $comments,
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, CommentsRepository $commentsRepository): Response
    {
        $comment = new Comments();

        $form = $this->createForm(CommentsType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setIsValid(true);

            $commentsRepository->save($comment, true);

            $this->addFlash('success', 'Commentaire ajouté avec succés');

            return $this->redirectToRoute('admin_comments_index');
        }

        return $this->render('admin/comments/new.html.twig', [
            'form' => $form,
            'comment' => $comment,
        ]);
    }

    #[Route('{id}', name: 'show', methods: ['GET'])]
    public function show(Comments $comment): Response
    {
        return $this->render('admin/comments/show.html.twig', [
            'comment' => $comment,
        ]);
    }

    #[Route('{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function valid(Comments $comment, CommentsRepository $commentsRepository, Request $request): Response
    {
        $form = $this->createForm(ValidCommentsType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentsRepository->save($comment, true);

            $this->addFlash('success', 'Commentaire validé avec succés');

            return $this->redirectToRoute('admin_comments_index');
        }

        return $this->render('admin/comments/edit.html.twig', [
            'comment' => $comment,
            'form' => $form,
        ]);
    }

    #[Route('{id}', name: 'delete', methods: ['POST'])]
    public function delete(Comments $comment, CommentsRepository $commentsRepository, Request $request): Response
    {
        if ($this->isCsrfTokenValid('delete' . $comment->getId(), $request->request->get('_token'))) {
            $commentsRepository->remove($comment, true);
        }

        $this->addFlash('success', 'Commentaire supprimé avec succés');

        return $this->redirectToRoute('admin_comments_index', [], Response::HTTP_SEE_OTHER);
    }
}
