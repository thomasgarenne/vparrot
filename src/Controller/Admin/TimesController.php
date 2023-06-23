<?php

namespace App\Controller\Admin;

use App\Entity\Times;
use App\Form\TimesType;
use App\Repository\TimesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/times', name: 'admin_times_')]
class TimesController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(TimesRepository $timesRepository): Response
    {
        return $this->render('admin/times/index.html.twig', [
            'times' => $timesRepository->findAll(),
        ]);
    }

    /*
    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(TimesRepository $timesRepository, Request $request): Response
    {
        $time = new Times();

        $form = $this->createForm(TimesType::class, $time);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $timesRepository->save($time, true);

            return $this->redirectToRoute('admin_times_index');
        }

        return $this->render('admin/times/new.html.twig', [
            'time' => $time,
            'form' => $form,
        ]);
    }
    */

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Times $time): Response
    {
        return $this->render('admin/times/show.html.twig', [
            'time' => $time,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Times $time, TimesRepository $timesRepository, Request $request): Response
    {
        $form = $this->createForm(TimesType::class, $time);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $timesRepository->save($time, true);

            return $this->redirectToRoute('admin_times_index');
        }

        return $this->render('admin/times/edit.html.twig', [
            'time' => $time,
            'form' => $form,
        ]);
    }

    /*
    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Times $time, TimesRepository $timesRepository, Request $request): Response
    {
        if ($this->isCsrfTokenValid('delete' . $time->getId(), $request->request->get('_token'))) {
            $timesRepository->remove($time, true);
        }

        return $this->redirectToRoute('admin_times_index', [], Response::HTTP_SEE_OTHER);
    }
    */
}
