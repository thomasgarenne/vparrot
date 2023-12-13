<?php

namespace App\Tests;

use App\Entity\Services;
use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

class ServiceTest extends WebTestCase
{
    /*
    public function testIfCreatedServiceIsSuccessful(): void
    {
        $client = static::createClient();

        $urlGenerator = $client->getContainer()->get('router');

        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');

        $user = $entityManager->find(Users::class, 6);

        $client->loginUser($user);

        $crawler = $client->request(Request::METHOD_GET, $urlGenerator->generate('admin_services_new'));

        // Chemin du fichier fictif
        $filePath = sys_get_temp_dir() . '/testimage.jpg';

        // Contenu fictif de l'image (vous pouvez également copier une image existante)
        $imageContent = file_get_contents(__DIR__ . '/../../public/assets/uploads/service1.jpg');

        // Créer le fichier fictif image
        file_put_contents($filePath, $imageContent);

        // Créer un objet UploadedFile
        $uploadedImage = new UploadedFile(
            $filePath,
            'testimage.jpg',
            'image/jpeg',
            null,
            true
        );

        $form = $crawler->filter('form[name=services]')->form([
            "services[name]" => "un service",
            "services[description]" => "une description du service",
            "services[picture]" => $uploadedImage,
        ]);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();

        $this->assertSelectorTextContains(
            'div.alert.alert-success',
            'Service ajouté avec succés'
        );
    }
    */
    public function testIfListServiceIsSuccessful(): void
    {
        $client = static::createClient();
        $urlGenerator = $client->getContainer()->get('router');
        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');

        $user = $entityManager->find(Users::class, 6);

        $client->loginUser($user);

        $client->request(Request::METHOD_GET, $urlGenerator->generate('admin_services_index'));

        $this->assertResponseIsSuccessful();

        $this->assertRouteSame('admin_services_index');
    }

    /*
    public function testIfUpdatedServiceIsSuccessful(): void
    {
        $client = static::createClient();
        $urlGenerator = $client->getContainer()->get('router');
        $em = $client->getContainer()->get('doctrine.orm.entity_manager');

        $user = $em->find(Users::class, 6);
        $service = $em->getRepository(Services::class)->findOneBy(['id' => 1]);

        $client->loginUser($user);

        $crawler = $client->request(Request::METHOD_GET, $urlGenerator->generate('admin_services_edit', ['id' => $service->getId()]));

        // Chemin du fichier fictif
        $filePath = sys_get_temp_dir() . '/testimage.jpg';

        // Contenu fictif de l'image (vous pouvez également copier une image existante)
        $imageContent = file_get_contents(__DIR__ . '/../../public/assets/uploads/service1.jpg');

        // Créer le fichier fictif image
        file_put_contents($filePath, $imageContent);

        // Créer un objet UploadedFile
        $uploadedImage = new UploadedFile(
            $filePath,
            'testimage.jpg',
            'image/jpeg',
            null,
            true
        );

        $form = $crawler->filter("form[name=services]")
            ->form([
                "services[name]" => "un service 2",
                "services[description]" => "une description du service 2",
                "services[picture]" => $uploadedImage,
            ]);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();

        $this->assertSelectorTextContains(
            'div.alert.alert-success',
            'Service modifié avec succés'
        );

        $this->assertRouteSame('admin_services_index');
    }
    */
}
