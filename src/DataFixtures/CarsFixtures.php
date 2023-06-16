<?php

namespace App\DataFixtures;

use App\Entity\Cars;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CarsFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $motor = ['essence', 'diesel', 'electrique'];
        $power = [75, 90, 110, 130, 150];

        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 3; $i++) {
            $car = new Cars();
            $car->setColor($faker->colorName());
            $car->setYear($faker->numberBetween(2000, 2023));
            $car->setKm($faker->numberBetween(40000, 200000));
            $car->setMotor($faker->randomElement($motor));
            $car->setPower($faker->randomElement($power));

            $type = $this->getReference('type-1');
            $car->setType($type);

            $brand = $this->getReference('brand-' . rand(2, 4));
            $car->setBrand($brand);

            $manager->persist($car);
        }
        for ($i = 0; $i < 3; $i++) {
            $car = new Cars();
            $car->setColor($faker->colorName());
            $car->setYear($faker->numberBetween(2000, 2023));
            $car->setKm($faker->numberBetween(40000, 200000));
            $car->setMotor($faker->randomElement($motor));
            $car->setPower($faker->randomElement($power));

            $type = $this->getReference('type-1');
            $car->setType($type);

            $brand = $this->getReference('brand-' . rand(6, 8));
            $car->setBrand($brand);

            $manager->persist($car);
        }
        for ($i = 0; $i < 3; $i++) {
            $car = new Cars();
            $car->setColor($faker->colorName());
            $car->setYear($faker->numberBetween(2000, 2023));
            $car->setKm($faker->numberBetween(40000, 200000));
            $car->setMotor($faker->randomElement($motor));
            $car->setPower($faker->randomElement($power));

            $type = $this->getReference('type-1');
            $car->setType($type);

            $brand = $this->getReference('brand-' . rand(10, 12));
            $car->setBrand($brand);

            $manager->persist($car);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            TypesFixtures::class
        ];
    }
}
