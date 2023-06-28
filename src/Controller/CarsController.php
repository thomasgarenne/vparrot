<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Cars;
use App\Form\CarsType;
use App\Form\SearchType;
use App\Repository\CarsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cars', name: 'cars_')]
class CarsController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET', 'POST'])]
    public function index(CarsRepository $carsRepository, Request $request): Response
    {
        $data = new SearchData();
        $form = $this->createForm(SearchType::class, $data);
        $form->handleRequest($request);
        $cars = $carsRepository->findSearch($data);

        if ($request->get('ajax')) {
            return new JsonResponse([
                'content' => $this->renderView('cars/_content.html.twig', [
                    'cars' => $cars
                ])
            ]);
        }

        return $this->render('cars/index.html.twig', [
            'cars' => $cars,
            'form' => $form
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Cars $car): Response
    {
        return $this->render('cars/show.html.twig', [
            'car' => $car,
        ]);
    }
}
