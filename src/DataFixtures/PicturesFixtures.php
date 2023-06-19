<?php

namespace App\DataFixtures;

use App\Entity\Pictures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PicturesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        for ($i = 1; $i < 10; $i++) {
            $car = $this->getReference('car-' . $i);

            $picture = new Pictures();
            $picture->setCar($car);
            $picture->setTitle('../public/assets/uploads/car' . $i . '.jpg');

            $manager->persist($picture);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CarsFixtures::class
        ];
    }
}
