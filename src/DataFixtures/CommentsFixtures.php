<?php

namespace App\DataFixtures;

use App\Entity\Comments;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CommentsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $comment = new Comments();
            $comment->setFirstname($faker->firstName());
            $comment->setLastname($faker->LastName());
            $comment->setContent($faker->text(50));
            $comment->setIsValid(false);

            $manager->persist($comment);
        }



        $manager->flush();
    }
}
