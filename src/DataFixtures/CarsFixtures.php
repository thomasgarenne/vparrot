<?php

namespace App\DataFixtures;

use App\Entity\Cars;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CarsFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $motor = ['Essence', 'Diesel', 'Hybride', 'Electrique', 'GPL', 'Autre'];
        $power = [75, 90, 110, 130, 150];

        $faker = Factory::create('fr_FR');

        for ($i = 1; $i < 10; $i++) {

            $car = new Cars();
            $car->setColor($faker->colorName());
            $car->setYear($faker->dateTime());
            $car->setCreatedAt(new DateTimeImmutable());
            $car->setKm($faker->numberBetween(40000, 200000));
            $car->setMotor($faker->randomElement($motor));
            $car->setPower($faker->randomElement($power));
            $car->setPrice($faker->numberBetween(3000, 50000));
            $car->setSeats(5);
            $car->setDoors(5);
            $car->setDescription($faker->text(100));

            $type = $this->getReference('type-' . $i);
            $car->setType($type);

            $model = $this->getReference('mod-' . $i);
            $car->setModel($model);

            $model = $car->getModel()->getName();
            $car->setRef($model . uniqid());

            $manager->persist($car);

            $this->setReference('car-' . $i, $car);
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
