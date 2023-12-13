<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class LoginTest extends WebTestCase
{
    public function testIfLoginIsSuccessfull(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Connexion administration');

        $buttonSubmit = $crawler->selectButton('Me connecter');
        $form = $buttonSubmit->form();

        $form["email"] = "drivescares@gmail.com";
        $form["password"] = "admin";

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();
    }

    public function testIfPasswordIsWrong(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Connexion administration');

        $buttonSubmit = $crawler->selectButton('Me connecter');
        $form = $buttonSubmit->form();

        $form["email"] = "drivescares@gmail.com";
        $form["password"] = "admins";

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();

        $this->assertRouteSame('app_login');

        $this->assertSelectorTextContains(
            'div.alert.alert-danger',
            'Invalid credentials.'
        );
    }
}
