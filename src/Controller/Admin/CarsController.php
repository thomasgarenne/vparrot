<?php

namespace App\Controller\Admin;

use App\Entity\Cars;
use App\Form\CarsType;
use App\Repository\CarsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/cars', name: 'admin_cars_')]
class CarsController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(CarsRepository $carsRepository): Response
    {
        return $this->render('admin/cars/index.html.twig', [
            'cars' => $carsRepository->findAll(),
        ]);
    }

    #[Route('new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, CarsRepository $carsRepository): Response
    {
        $car = new Cars();

        $form = $this->createForm(CarsType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $carsRepository->save($car, true);

            return $this->redirectToRoute('admin_cars_index');
        }

        return $this->render('admin/cars/new.html.twig', [
            'car' => $car,
            'form' => $form,
        ]);
    }

    #[Route('{id}', name: 'show', methods: ['GET'])]
    public function show(Cars $car): Response
    {
        return $this->render('admin/cars/show.html.twig', [
            'car' => $car,
        ]);
    }

    #[Route('{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Cars $car, Request $request, CarsRepository $carsRepository): Response
    {
        $form = $this->createForm(CarsType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $carsRepository->save($car, true);

            $this->redirectToRoute('admin_cars_index');
        }

        return $this->render('admin/cars/edit.html.twig', [
            'car' => $car,
            'form' => $form,
        ]);
    }

    #[Route('{id}', name: 'delete', methods: ['POST'])]
    public function delete(Cars $car, Request $request, CarsRepository $carsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $car->getId(), $request->request->get('_token'))) {
            $carsRepository->remove($car, true);
        }

        return $this->redirectToRoute('admin_cars_index', [], Response::HTTP_SEE_OTHER);
    }
}
