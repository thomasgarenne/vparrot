<?php

namespace App\Controller\Admin;

use App\Entity\Workshops;
use App\Form\WorkshopsType;
use App\Repository\WorkshopsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted("ROLE_ADMIN")]
#[Route('/admin/workshops', name: 'admin_workshops_')]
class WorkshopsController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(WorkshopsRepository $workshopsRepository): Response
    {
        return $this->render('admin/workshops/index.html.twig', [
            'workshops' => $workshopsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, WorkshopsRepository $workshopsRepository): Response
    {
        $workshop = new Workshops();
        $form = $this->createForm(WorkshopsType::class, $workshop);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $workshopsRepository->save($workshop, true);

            return $this->redirectToRoute('admin_workshops_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/workshops/new.html.twig', [
            'workshop' => $workshop,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Workshops $workshop): Response
    {
        return $this->render('admin/workshops/show.html.twig', [
            'workshop' => $workshop,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Workshops $workshop, WorkshopsRepository $workshopsRepository): Response
    {
        $form = $this->createForm(WorkshopsType::class, $workshop);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $workshopsRepository->save($workshop, true);

            $this->addFlash('success', 'Infos magasin modifié avec succés');

            return $this->redirectToRoute('admin_workshops_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/workshops/edit.html.twig', [
            'workshop' => $workshop,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Workshops $workshop, WorkshopsRepository $workshopsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $workshop->getId(), $request->request->get('_token'))) {
            $workshopsRepository->remove($workshop, true);
        }

        return $this->redirectToRoute('admin_workshops_index', [], Response::HTTP_SEE_OTHER);
    }
}
