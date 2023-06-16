<?php

namespace App\DataFixtures;

use App\Entity\Types;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $type = new Types();
        $type->setName('Berline');

        $manager->persist($type);

        $this->setReference('type-1', $type);

        $manager->flush();
    }
}
