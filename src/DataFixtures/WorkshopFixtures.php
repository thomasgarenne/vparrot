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
        $workshop->setAddress('Place du capitol');
        $workshop->setZipcode('31000');
        $workshop->setCity('Toulouse');

        $manager->persist($workshop);

        $this->setReference('work-1', $workshop);

        $manager->flush();
    }
}
