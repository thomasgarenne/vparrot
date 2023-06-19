<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Models;
use Symfony\Component\String\Slugger\SluggerInterface;

class ModelsFixtures extends Fixture
{
    public function __construct(private SluggerInterface $slugger)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $count = 0;

        $peugeot = ['208', '308', '5008'];
        $renault = ['clio', 'megane', 'twingo'];
        $volkswagen = ['polo', 'golf', 'touran'];

        foreach ($peugeot as $car) {
            $count++;

            $model = new Models();
            $model->setName($car);
            $model->setBrand($this->getReference('brand-1'));

            $manager->persist($model);

            $this->setReference('mod-' . $count, $model);
        }

        foreach ($renault as $car) {
            $count++;

            $model = new Models();
            $model->setName($car);
            $model->setBrand($this->getReference('brand-2'));

            $manager->persist($model);

            $this->setReference('mod-' . $count, $model);
        }

        foreach ($volkswagen as $car) {
            $count++;

            $model = new Models();
            $model->setName($car);
            $model->setBrand($this->getReference('brand-3'));

            $manager->persist($model);

            $this->setReference('mod-' . $count, $model);
        }

        $manager->flush();
    }
}
//$categories->setSlug($this->slugger->slug($categories->getName())->lower());
