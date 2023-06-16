<?php

namespace App\DataFixtures;

use App\Entity\Times;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class TimesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $days = ['lun', 'mar', 'mer', 'jeu', 'ven', 'sam'];

        foreach ($days as $day) {
            $time = new Times();
            $time->setDay($day);
            $time->setOpenAm('10:00');
            $time->setCloseAm('13:00');
            $time->setOpenPm('14:00');
            $time->setClosePm('18:00');

            $work = $this->getReference('work-1');
            $time->setWorkshops($work);

            $manager->persist($time);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            WorkshopFixtures::class
        ];
    }
}
