<?php

namespace App\Controller\Admin;

use App\Entity\Models;
use App\Form\ModelsType;
use App\Repository\BrandsRepository;
use App\Repository\ModelsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted("ROLE_ADMIN_PRODUCT")]
#[Route('/admin/models', name: 'admin_models_')]
class ModelsController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ModelsRepository $modelsRepository, BrandsRepository $brandsRepository): Response
    {
        return $this->render('admin/models/index.html.twig', [
            'models' => $modelsRepository->findAll(),
            'brands' => $brandsRepository->findAll()
        ]);
    }

    #[Route('new', name: 'new', methods: ['GET', 'POST'])]
    public function new(ModelsRepository $modelsRepository, Request $request): Response
    {
        $model = new Models();
        $form = $this->createForm(ModelsType::class);

        // $modeleFromApi = $this->getApiData("https://private-anon-c5f770ea7f-carsapi1.apiary-mock.com/cars");

        // $modele = array_values(array_map(function ($m) {
        //     return $m['model'];
        // }, $modeleFromApi));

        // $modele = array_combine($modele, $modele);

        // $form = $this->createForm(ModelsType::class, $model, [
        //     'modele' => $modele
        // ]);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $modelsRepository->save($data, true);

            $this->addFlash('success', 'Modèle ajouté avec succés');

            return $this->redirectToRoute('admin_models_index');
        }

        return $this->render('admin/models/new.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('{id}', name: 'show', methods: ['GET'])]
    public function show(Models $model): Response
    {
        return $this->render('admin/models/show.html.twig', [
            'model' => $model
        ]);
    }

    #[Route('{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Models $model, ModelsRepository $modelsRepository, Request $request): Response
    {
        $form = $this->createForm(ModelsType::class, $model);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $modelsRepository->save($model, true);

            $this->addFlash('success', 'Modèle modifié avec succés');

            return $this->redirectToRoute('admin_models_index');
        }

        return $this->render('admin/models/edit.html.twig', [
            'model' => $model,
            'form' => $form
        ]);
    }

    #[Route('{id}', name: 'delete', methods: ['POST'])]
    public function delete(Models $model, Request $request, ModelsRepository $modelsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $model->getId(), $request->request->get('_token'))) {
            $modelsRepository->remove($model, true);
        }

        $this->addFlash('success', 'Modèle supprimé avec succés');

        return $this->redirectToRoute('admin_models_index', [], Response::HTTP_SEE_OTHER);
    }

    //Fonction d'appel API
    private function getApiData($url)
    {
        $client = HttpClient::create();
        $response = $client->request('GET', $url);

        return $response->toArray();
    }
}
