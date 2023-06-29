<?php

namespace App\Controller;

use App\Repository\CarsRepository;
use App\Repository\CommentsRepository;
use App\Repository\ServicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(CarsRepository $carsRepository, ServicesRepository $servicesRepository, CommentsRepository $commentsRepository): Response
    {
        return $this->render('main/index.html.twig', [
            'cars' => $carsRepository->findBy([], ['createdAt' => 'DESC'], 3),
            'services' => $servicesRepository->findAll(),
            'comments' => $commentsRepository->findBy(['is_valid' => true], ['created_at' => 'DESC'], 3),
        ]);
    }
}
