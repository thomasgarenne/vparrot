<?php

namespace App\DataFixtures;

use App\Entity\Types;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $styles = [
            '4x4, Suv',
            'Berline',
            'Break',
            'Cabriolet',
            'Citadine',
            'Coupé',
            'Minibus',
            'Monospace',
            'Pick-up',
            'Voiture sociéte',
            'Autre'
        ];

        $i = 1;

        foreach ($styles as $style) {
            $type = new Types();
            $type->setName($style);

            $manager->persist($type);

            $this->setReference('type-' . $i, $type);

            $i++;
        }


        $manager->flush();
    }
}
