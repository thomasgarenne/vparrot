<?php

namespace App\Controller\Admin;

use App\Entity\Types;
use App\Form\TypesType;
use App\Repository\TypesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted("ROLE_ADMIN_PRODUCT")]
#[Route('/admin/types', name: 'admin_types_')]
class TypesController extends AbstractController
{

    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(TypesRepository $typesRepository): Response
    {
        return $this->render('admin/types/index.html.twig', [
            'types' => $typesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, TypesRepository $typesRepository): Response
    {
        $type = new Types();
        $form = $this->createForm(TypesType::class, $type);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $typesRepository->save($type, true);

            return $this->redirectToRoute('admin_types_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/types/new.html.twig', [
            'type' => $type,
            'form' => $form,
        ]);
    }
    /*
    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Types $type): Response
    {
        return $this->render('admin/types/show.html.twig', [
            'type' => $type,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Types $type, TypesRepository $typesRepository): Response
    {
        $form = $this->createForm(TypesType::class, $type);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $typesRepository->save($type, true);

            return $this->redirectToRoute('admin_types_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/types/edit.html.twig', [
            'type' => $type,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Types $type, TypesRepository $typesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $type->getId(), $request->request->get('_token'))) {
            $typesRepository->remove($type, true);
        }

        return $this->redirectToRoute('admin_types_index', [], Response::HTTP_SEE_OTHER);
    }
    */
}
