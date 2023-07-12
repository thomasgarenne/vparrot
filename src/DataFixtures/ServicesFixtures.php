<?php

namespace App\DataFixtures;

use App\Entity\Services;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ServicesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $names = ['Révision et vidange', 'Pneus', 'Freinage', 'Distribution', 'Amortisseurs', 'Batterie, Eclairage', 'Bougies', 'Atelier deux roues'];

        foreach ($names as $name) {
            $i = 1;

            $service = new Services();
            $service->setName($name);
            $service->setDescription($faker->text(20));
            $service->setPicture('service' . $i . '.jpg');

            $manager->persist($service);

            $i++;
        }

        $manager->flush();
    }
}
