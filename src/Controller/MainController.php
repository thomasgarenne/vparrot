<?php

namespace App\Controller;

use App\Entity\Cars;
use App\Form\ContactsType;
use App\Repository\CarsRepository;
use App\Repository\CommentsRepository;
use App\Repository\ServicesRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(
        CarsRepository $carsRepository,
        ServicesRepository $servicesRepository,
        CommentsRepository $commentsRepository,
    ): Response {
        $comments = $commentsRepository->findBy(['is_valid' => true]);

        $count = 0;
        $average = 0;

        if (!empty($comments)) {
            $notes = [];

            foreach ($comments as $comment) {
                $notes[] = $comment->getNote();
            }

            $count = count($notes);
            $total = array_sum($notes);

            $average = ceil($total / $count);
        }

        return $this->render('main/index.html.twig', [
            'cars' => $carsRepository->findBy([], ['createdAt' => 'DESC'], 3),
            'services' => $servicesRepository->findAll(),
            'comments' => $commentsRepository->findBy(['is_valid' => true], ['created_at' => 'DESC'], 3),
            'count' => $count,
            'average' => $average,
        ]);
    }

    #[Route('/mecanique', name: 'app_mecanique', methods: ['GET'])]
    public function mecanique(ServicesRepository $servicesRepository): Response
    {
        return $this->render('main/mecanique.html.twig', [
            'services' => $servicesRepository->findAll()
        ]);
    }

    #[Route('/carrosserie', name: 'app_carrosserie', methods: ['GET', 'POST'])]
    public function carrosserie(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactsType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $email = (new TemplatedEmail)
                ->from($data['email'])
                ->to('drivescares@gmail.com')
                ->subject('Devis')
                ->htmlTemplate('emails/contact_info.html.twig')
                ->context([
                    'phone' => $data['phone'],
                    'prenom' => $data['prenom'],
                    'nom' => $data['nom'],
                    'message' => $data['message'],
                ]);

            $mailer->send($email);

            $this->addFlash('success', 'Message envoyé');

            return $this->redirectToRoute('app_carrosserie');
        }

        return $this->render('main/carrosserie.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/contact', name: 'app_contact', methods: ['GET', 'POST'])]
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactsType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $email = (new TemplatedEmail())
                ->from('drivescares@gmail.com')
                ->to('drivescares@gmail.com')
                ->replyTo($data['email'])
                ->subject('Contact')
                ->htmlTemplate('emails/contact_info.html.twig')
                ->context([
                    'phone' => $data['phone'],
                    'prenom' => $data['prenom'],
                    'nom' => $data['nom'],
                    'message' => $data['message'],
                ]);

            $mailer->send($email);

            $this->addFlash('success', 'Message envoyé');

            return $this->redirectToRoute('app_main');
        }

        return $this->render('main/contacts.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/favories', name: 'app_favories')]
    public function favories(Request $request, CarsRepository $carsRepository): Response
    {
        if ($request->isXmlHttpRequest()) {
            $content = $request->getContent();
            $carsIdString = json_decode($content);
            $carsId = json_decode($carsIdString);

            $cars = $carsRepository->findBy(['id' => $carsId]);

            return new JsonResponse([
                'favories' => $this->renderView('main/_contentFavories.html.twig', ['cars' => $cars]),
            ]);
        }

        return $this->render('main/favories.html.twig');
    }
}
