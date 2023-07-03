<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Cars;
use App\Form\ContactType;
use App\Form\SearchType;
use App\Repository\CarsRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
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

    #[Route('/{id}', name: 'show', methods: ['POST', 'GET'])]
    public function show(Cars $car, Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $subject = $data['model'] . ' - ' . $data['ref'];

            $email = (new TemplatedEmail())
                ->from($data['email'])
                ->to('to@example.com')
                ->subject($subject)
                ->htmlTemplate('emails/contact_annonce.html.twig')
                ->context([
                    'ref' => $data['ref'],
                    'model' => $data['model'],
                    'prenom' => $data['prenom'],
                    'nom' => $data['nom'],
                    'message' => $data['message'],
                ]);

            $mailer->send($email);

            $this->addFlash('success', 'Message envoyé');

            return $this->redirectToRoute('cars_show', ['id' => $car->getId()]);
        }

        return $this->render('cars/show.html.twig', [
            'car' => $car,
            'form' => $form
        ]);
    }
}
