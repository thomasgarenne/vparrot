<?php

namespace App\Controller\Admin;

use App\Entity\Brands;
use App\Form\BrandsType;
use App\Repository\BrandsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted("ROLE_ADMIN_PRODUCT")]
#[Route('/admin/brands', name: 'admin_brands_')]
class BrandsController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(BrandsRepository $brands): Response
    {
        return $this->render('admin/brands/index.html.twig', [
            'brands' => $brands->findAll()
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, BrandsRepository $brandsRepository)
    {
        $brand = new Brands();

        $form = $this->createForm(BrandsType::class, $brand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $brandsRepository->save($brand, true);

            $this->addFlash('success', 'Constructeur ajouté');

            return $this->redirectToRoute('admin_brands_index', [], Response::HTTP_SEE_OTHER);
        } else {
            $this->addFlash('error', 'Une erreur est survenue');
        }

        return $this->render('admin/brands/new.html.twig', [
            'brand' => $brand,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Brands $brand): Response
    {
        return $this->render('admin/brands/show.html.twig', [
            'brand' => $brand,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Brands $brand, BrandsRepository $brandsRepository): Response
    {
        $form = $this->createForm(BrandsType::class, $brand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $brandsRepository->save($brand, true);

            $this->addFlash('success', 'Constructeur modifié');

            return $this->redirectToRoute('admin_brands_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/brands/edit.html.twig', [
            'brand' => $brand,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Brands $brand, BrandsRepository $brandsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $brand->getId(), $request->request->get('_token'))) {
            $brandsRepository->remove($brand, true);
        }

        $this->addFlash('success', 'Constructeur suprimé');

        return $this->redirectToRoute('admin_brands_index', [], Response::HTTP_SEE_OTHER);
    }
}
