<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Brands;
use Symfony\Component\String\Slugger\SluggerInterface;

class BrandsFixtures extends Fixture
{
    private $counter = 1;

    public function __construct(private SluggerInterface $slugger)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $parent = $this->create('Peugeot', null, $manager);
        $this->create('208', $parent, $manager);
        $this->create('308', $parent, $manager);
        $this->create('5008', $parent, $manager);

        $parent = $this->create('Renault', null, $manager);
        $this->create('clio', $parent, $manager);
        $this->create('megane', $parent, $manager);
        $this->create('twingo', $parent, $manager);

        $parent = $this->create('Volkswagen', null, $manager);
        $this->create('polo', $parent, $manager);
        $this->create('golf', $parent, $manager);
        $this->create('t-roc', $parent, $manager);

        $manager->flush();
    }

    public function create(string $name, Brands $parent = null, ObjectManager $manager)
    {
        $categories = new Brands;
        $categories->setName($name);
        //$categories->setSlug($this->slugger->slug($categories->getName())->lower());
        $categories->setParent($parent);
        $manager->persist($categories);

        $this->setReference('brand-' . $this->counter, $categories);
        $this->counter++;

        return $categories;
    }
}
