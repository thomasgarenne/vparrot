<?php

namespace App\Controller\Admin;

use App\Repository\TimesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/times', name: 'admin_times_')]
class TimesController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(TimesRepository $timesRepository): Response
    {
        return $this->render('admin/times/index.html.twig', [
            'times' => $timesRepository->findAll(),
        ]);
    }
}
