<?php

namespace App\Controller\Admin;

use App\Entity\Cars;
use App\Repository\CarsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/cars', name: 'admin_cars_')]
class CarsController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CarsRepository $carsRepository): Response
    {
        return $this->render('admin/cars/index.html.twig', [
            'cars' => $carsRepository->findAll(),
        ]);
    }
}
