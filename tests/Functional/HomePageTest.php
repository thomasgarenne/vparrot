<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomePageTest extends WebTestCase
{
    public function testTitle(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Nouveaux véhicules d\'occasions');
    }

    public function testContent(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();

        $button = $crawler->selectButton('Découvrez nos occasions');
        $this->assertEquals(1, count($button));

        $card = $crawler->filter('.card');
        $this->assertEquals(7, count($card));
    }
}
