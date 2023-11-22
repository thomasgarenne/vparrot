<?php

namespace App\Controller\Admin;

use App\Data\SearchData;
use App\Entity\Cars;
use App\Entity\Pictures;
use App\Form\CarsType;
use App\Form\SearchType;
use App\Repository\CarsRepository;
use App\Repository\PicturesRepository;
use App\Service\PictureService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted("ROLE_ADMIN_PRODUCT")]
#[Route('/admin/cars', name: 'admin_cars_')]
class CarsController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET', 'POST'])]
    public function index(CarsRepository $carsRepository, Request $request): Response
    {
        $data = new SearchData();
        $data->page = $request->get('page', 1);

        $form = $this->createForm(SearchType::class, $data);
        $form->handleRequest($request);
        $cars = $carsRepository->findSearch($data);

        if ($request->isXmlHttpRequest()) {
            return new JsonResponse([
                'content' => $this->renderView('admin/cars/_content.html.twig', ['cars' => $cars]),
                'sorting' => $this->renderView('admin/cars/_sorting.html.twig', ['cars' => $cars]),
                'pagination' => $this->renderView('admin/cars/_pagination.html.twig', ['cars' => $cars]),
            ]);
        }

        return $this->render('admin/cars/index.html.twig', [
            'cars' => $cars,
            'form' => $form
        ]);
    }

    #[Route('new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, CarsRepository $carsRepository, PictureService $pictureService): Response
    {
        $car = new Cars();

        $form = $this->createForm(CarsType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $model = $car->getModel()->getName();

            $car->setRef($model . uniqid());

            $pictures = $form->get('pictures')->getData();

            foreach ($pictures as $picture) {
                $file = $pictureService->upload($picture);

                $img = new Pictures();
                $img->setTitle($file);

                $car->addPicture($img);
            }

            $carsRepository->save($car, true);

            $this->addFlash('success', 'Voiture ajouté avec succés');

            return $this->redirectToRoute('admin_cars_index');
        }

        return $this->render('admin/cars/new.html.twig', [
            'car' => $car,
            'form' => $form,
        ]);
    }

    #[Route('{id}', name: 'show', methods: ['GET'])]
    public function show(Cars $car): Response
    {
        return $this->render('admin/cars/show.html.twig', [
            'car' => $car,
        ]);
    }

    #[Route('{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(
        Cars $car,
        Request $request,
        CarsRepository $carsRepository,
        PictureService $pictureService
    ): Response {
        $form = $this->createForm(CarsType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pictures = $form->get('pictures')->getData();

            foreach ($pictures as $picture) {
                $file = $pictureService->upload($picture);

                $img = new Pictures();
                $img->setTitle($file);

                $car->addPicture($img);
            }

            $carsRepository->save($car, true);

            $this->addFlash('success', 'Voiture modifié avec succés');

            return $this->redirectToRoute('admin_cars_index');
        }

        return $this->render('admin/cars/edit.html.twig', [
            'car' => $car,
            'form' => $form,
        ]);
    }

    #[Route('{id}', name: 'delete', methods: ['POST'])]
    public function delete(Cars $car, Request $request, CarsRepository $carsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $car->getId(), $request->request->get('_token'))) {
            $carsRepository->remove($car, true);
        }

        $this->addFlash('success', 'Voiture supprimé avec succés');

        return $this->redirectToRoute('admin_cars_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('{id}/picture', name: 'delete_picture', methods: ['DELETE'])]
    public function deletePicture(Pictures $picture, Request $request, PicturesRepository $picturesRepository): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if ($this->isCsrfTokenValid('delete' . $picture->getId(), $data['_token'])) {
            $picturesRepository->remove($picture, true);

            return new JsonResponse(['success' => true], 200);
        }

        return new JsonResponse(['error' => 'Token invalide'], 400);
    }

    //Fonction d'appel API
    private function getApiData(string $url)
    {
        $client = HttpClient::create();
        $response = $client->request('GET', $url);

        return $response->toArray();
    }
}
