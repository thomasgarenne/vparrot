<?php

namespace App\DataFixtures;

use App\Entity\Workshops;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class WorkshopFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $workshop = new Workshops();
        $workshop->setName('DrivesCares');
        $workshop->setAddress('10 rue du garage');
        $workshop->setZipcode('33000');
        $workshop->setCity('Bordeaux');

        $manager->persist($workshop);

        $this->setReference('work-1', $workshop);

        $manager->flush();
    }
}
