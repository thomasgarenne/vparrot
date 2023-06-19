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

        $names = ['Carrosserie', 'Réparation', 'Pneus', 'Révision'];

        foreach ($names as $name) {
            $service = new Services();
            $service->setName($name);
            $service->setDescription($faker->text(20));
            $service->setPicture('public/assets/uploads/service2.jpg');

            $manager->persist($service);
        }

        $manager->flush();
    }
}
