<?php

namespace App\Controller;

use App\Repository\CommentsRepository;
use App\Repository\ServicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(ServicesRepository $servicesRepository, CommentsRepository $commentsRepository): Response
    {
        return $this->render('main/index.html.twig', [
            'services' => $servicesRepository->findAll(),
            'comments' => $commentsRepository->findAll(),
        ]);
    }
}
