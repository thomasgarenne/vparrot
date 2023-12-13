<?php

namespace App\DataFixtures;

use App\Entity\Times;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TimesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $days = ['lun', 'mar', 'mer', 'jeu', 'ven', 'sam'];

        foreach ($days as $day) {
            $time = new Times();
            $time->setDay($day);
            $time->setOpenAm(new DateTime());
            $time->setCloseAm(new DateTime());
            $time->setOpenPm(new DateTime());
            $time->setClosePm(new DateTime());

            $manager->persist($time);
        }

        $manager->flush();
    }
}
