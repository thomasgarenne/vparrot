<?php

namespace App\Controller\Admin;

use App\Entity\Brands;
use App\Form\BrandsType;
use App\Repository\BrandsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted("ROLE_ADMIN_PRODUCT")]
#[Route('/admin/brands', name: 'admin_brands_')]
class BrandsController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(BrandsRepository $brands): Response
    {
        return $this->render('admin/brands/index.html.twig', [
            'brands' => $brands->findAll()
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, BrandsRepository $brandsRepository)
    {
        $brand = new Brands();

        /**
         * Obtient les données des fabricants depuis une API externe.
         * @param string $apiUrl L'URL de l'API fournissant les données des fabricants.
         * @return array Les données des fabricants obtenues depuis l'API.
         */
        $marquesFromApi = $this->getApiData("https://private-anon-c5f770ea7f-carsapi1.apiary-mock.com/manufacturers");

        /**
         * Transforme le tableau associatif des données des fabricants en un tableau simple contenant seulement les noms des fabricants.
         * @param array $marque Le tableau associatif représentant les données d'un fabricant.
         * @return string Le nom du fabricant extrait du tableau associatif.
         */
        $marques = array_values(array_map(function ($marque) {
            return $marque['name'];
        }, $marquesFromApi));

        /**
         * Crée un tableau associatif où les clés et les valeurs sont les noms des fabricants.
         * @param array $marques Le tableau simple contenant les noms des fabricants.
         * @return array Le tableau associatif des fabricants avec les clés et les valeurs étant les noms des fabricants.
         */
        $marques = array_combine($marques, $marques);

        /**
         * Crée un formulaire Symfony en utilisant le type BrandsType et les options spécifiées, y compris la liste des fabricants.
         * @param BrandsType $brand L'objet représentant le formulaire pour la gestion des marques.
         * @param array $marques Le tableau associatif des fabricants à utiliser comme options pour le champ du formulaire.
         * @return FormInterface Le formulaire Symfony prêt à être affiché.
         */
        $form = $this->createForm(BrandsType::class, $brand, [
            'marques' => $marques,
        ]);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $brandsRepository->save($brand, true);

            $this->addFlash('success', 'Constructeur ajouté');

            return $this->redirectToRoute('admin_brands_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/brands/new.html.twig', [
            'brand' => $brand,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Brands $brand): Response
    {
        return $this->render('admin/brands/show.html.twig', [
            'brand' => $brand,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Brands $brand, BrandsRepository $brandsRepository): Response
    {
        $form = $this->createForm(BrandsType::class, $brand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $brandsRepository->save($brand, true);

            $this->addFlash('success', 'Constructeur modifié');

            return $this->redirectToRoute('admin_brands_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/brands/edit.html.twig', [
            'brand' => $brand,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Brands $brand, BrandsRepository $brandsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $brand->getId(), $request->request->get('_token'))) {
            $brandsRepository->remove($brand, true);
        }

        $this->addFlash('success', 'Constructeur suprimé');

        return $this->redirectToRoute('admin_brands_index', [], Response::HTTP_SEE_OTHER);
    }

    //Fonction d'appel API
    private function getApiData($url)
    {
        $client = HttpClient::create();
        $response = $client->request('GET', $url);

        return $response->toArray();
    }
}
