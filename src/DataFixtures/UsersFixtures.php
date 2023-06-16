<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UsersFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 5; $i++) {
            $user = new Users();
            $user->setFirstname($faker->firstName());
            $user->setLastname($faker->lastName());
            $user->setEmail($faker->email());
            $user->setPassword($faker->password());
            $user->setPhone($faker->phoneNumber());
            $user->setRoles(['ROLE_EMPLOYE']);

            $manager->persist($user);
        }

        $user = new Users();
        $user->setFirstname($faker->firstName());
        $user->setLastname($faker->lastName());
        $user->setEmail($faker->email());
        $user->setPassword($faker->password());
        $user->setPhone($faker->phoneNumber());
        $user->setRoles(['ROLE_ADMIN']);

        $manager->persist($user);

        $manager->flush();
    }
}
