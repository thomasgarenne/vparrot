<?php

namespace App\Controller\Admin;

use App\Entity\Models;
use App\Repository\ModelsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/models', name: 'admin_models_')]
class ModelsController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ModelsRepository $models): Response
    {
        return $this->render('admin/models/index.html.twig', [
            'models' => $models->findAll()
        ]);
    }

    #[Route('/{name}', name: 'details')]
    public function details(Models $models): Response
    {
        $cars = $models->getCars();

        return $this->render('admin/models/details.html.twig', [
            'cars' => $cars
        ]);
    }
}
