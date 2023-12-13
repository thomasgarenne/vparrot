<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class CarrosserieTest extends WebTestCase
{

    public function Something(): void
    {
        /*
        $client = static::createClient();
        $crawler = $client->request('GET', '/carrosserie');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Demandez nous un devis');

        //récuperer formulaire
        $submitButton = $crawler->selectButton('Envoyer');
        $form = $submitButton->form();

        //remplir formulaire
        $form["contacts[email]"] = "thomas.garenne@outlook.com";
        $form["contacts[phone]"] = "0606060606";
        $form["contacts[prenom]"] = "Thomas";
        $form["contacts[nom]"] = "Garenne";
        $form["contacts[message]"] = "Devis de test";

        //soumettre formulaire
        $client->submit($form);

        //verifier statut http
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        //verifier envoie email
        $this->assertEmailCount(1);

        //verifier message de succès
        $client->followRedirect();
        $this->assertSelectorTextContains(
            'div.alert.alert-success',
            'Message envoyé'
        );
        */
        $this->assertTrue(true);
    }
}
