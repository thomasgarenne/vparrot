<?php

namespace App\Controller\Admin;

use App\Entity\Brands;
use App\Repository\BrandsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/brands', name: 'admin_brands_')]
class BrandsController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(BrandsRepository $brands): Response
    {
        return $this->render('admin/brands/index.html.twig', [
            'brands' => $brands->findAll()
        ]);
    }

    #[Route('/{name}', name: 'details')]
    public function details(Brands $brands): Response
    {
        $models = $brands->getModels();

        return $this->render('admin/brands/details.html.twig', [
            'models' => $models,
        ]);
    }
}
