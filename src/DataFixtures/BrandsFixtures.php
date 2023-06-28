<?php

namespace App\DataFixtures;

use App\Entity\Brands;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BrandsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $count = 0;
        $brands = ['Audi', 'BMW', 'Citroen', 'Fiat', 'Ford', 'Mercedes-Benz', 'Opel', 'Peugeot', 'Renault', 'Volkswagen'];

        foreach ($brands as $name) {
            $count++;

            $brand = new Brands();
            $brand->setName($name);

            $manager->persist($brand);

            $this->setReference('brand-' . $count, $brand);
        }

        $manager->flush();
    }
}
