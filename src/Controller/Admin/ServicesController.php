<?php

namespace App\Controller\Admin;

use App\Repository\ServicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
}
