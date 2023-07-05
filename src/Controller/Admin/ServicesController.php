<?php

namespace App\Controller\Admin;

use App\Entity\Services;
use App\Form\ServicesType;
use App\Repository\ServicesRepository;
use App\Service\PictureService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted("ROLE_ADMIN")]
#[Route('/admin/services', name: 'admin_services_')]
class ServicesController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ServicesRepository $servicesRepository): Response
    {
        return $this->render('admin/services/index.html.twig', [
            'services' => $servicesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, ServicesRepository $servicesRepository, PictureService $pictureService): Response
    {
        $service = new Services();

        $form = $this->createForm(ServicesType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $picture = $form->get('picture')->getData();

            $file = $pictureService->upload($picture);

            $service->setPicture($file);

            $servicesRepository->save($service, true);

            $this->addFlash('success', 'Service ajouté avec succés');

            return $this->redirectToRoute('admin_services_index');
        }

        return $this->render('admin/services/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Services $service): Response
    {
        return $this->render('admin/services/show.html.twig', [
            'service' => $service
        ]);
    }



    #[Route('{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Services $service, ServicesRepository $servicesRepository, Request $request, PictureService $pictureService): Response
    {
        $form = $this->createForm(ServicesType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $picture = $form->get('picture')->getData();

            $file = $pictureService->upload($picture);

            $service->setPicture($file);

            $servicesRepository->save($service, true);

            $this->addFlash('success', 'Service modifié avec succés');

            return $this->redirectToRoute('admin_services_index');
        }

        return $this->render('admin/services/edit.html.twig', [
            'service' => $service,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Services $service, Request $request, ServicesRepository $servicesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $service->getId(), $request->request->get('_token'))) {
            $servicesRepository->remove($service, true);
        }

        return $this->redirectToRoute('admin_services_index', [], Response::HTTP_SEE_OTHER);
    }
}
