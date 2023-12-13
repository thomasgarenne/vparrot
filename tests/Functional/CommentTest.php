<?php

namespace App\Tests;

use App\Entity\Comments;
use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CommentTest extends WebTestCase
{
    public function testCreatedCommentIsSuccessfull(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/comments/new');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Ajoutez un commentaire');

        //récupérer le formulaire
        $submitButton = $crawler->selectButton('Ajouter');
        $form = $submitButton->form();

        //remplir le formulaire
        $form["comments[firstname]"] = "Thomas";
        $form["comments[lastname]"] = "Garenne";
        $form["comments[content]"] = "Commentaire de test";
        $form["comments[note]"] = 4;

        //soumettre le formulaire
        $client->submit($form);

        //récuperer le statut http
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
        $client->followRedirect();

        //verifier le msg de succès
        $this->assertSelectorTextContains(
            'div.alert-message',
            'Commentaire ajouté avec succés'
        );
    }

    public function testUpdateCommentIsSuccessfull(): void
    {
        $client = static::createClient();
        $urlGenerator = $client->getContainer()->get('router');
        $em = $client->getContainer()->get('doctrine.orm.entity_manager');

        $user = $em->find(Users::class, 6);
        $comment = $em->getRepository(Comments::class)->findOneBy(['id' => 1]);

        $client->loginUser($user);

        $crawler = $client->request(Request::METHOD_GET, $urlGenerator->generate('admin_comments_edit', ['id' => $comment->getId()]));

        $form = $crawler->filter("form[name=valid_comments]")
            ->form([
                "valid_comments[is_valid]" => true,
            ]);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();

        $this->assertSelectorTextContains(
            'div.alert.alert-success',
            'Commentaire validé avec succés'
        );

        $this->assertRouteSame('admin_comments_index');
    }

    public function testDeleteCommentIsSuccessfull(): void
    {
        $client = static::createClient();

        $urlGenerator = $client->getContainer()->get('router');
        $em = $client->getContainer()->get('doctrine.orm.entity_manager');

        $user = $em->find(Users::class, 6);
        $comment = $em->getRepository(Comments::class)->findOneBy(['id' => 1]);

        $client->loginUser($user);

        $client->request(Request::METHOD_POST, $urlGenerator->generate('admin_comments_delete', ['id' => $comment->getId()]));

        $this->assertResponseRedirects($urlGenerator->generate('admin_comments_index'));

        $client->followRedirect();

        $this->assertSelectorTextContains(
            'div.alert.alert-success',
            'Commentaire supprimé avec succés'
        );

        $this->assertRouteSame('admin_comments_index');
    }
    /*
      public function testDeletedCommentIsSuccessfull(): void
    {
        $client = static::createClient();
        $urlGenerator = $client->getContainer()->get('router');
        $em = $client->getContainer()->get('doctrine.orm.entity_manager');

        $user = $em->find(Users::class, 6);
        $comment = $em->getRepository(Comments::class)->findOneBy(['id' => 1]);

        $client->loginUser($user);

        $client->request(Request::METHOD_GET, $urlGenerator->generate('admin_comments_delete', ['id' => $comment->getId()]));

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();

        $this->assertSelectorTextContains(
            'div.alert.alert-success',
            'Commentaire supprimé avec succés'
        );

        $this->assertRouteSame('admin_comments_index');
    }
    */
}
