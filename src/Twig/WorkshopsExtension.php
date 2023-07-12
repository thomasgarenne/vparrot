<?php

namespace App\Twig;

use App\Entity\Workshops;
use Doctrine\ORM\EntityManagerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class WorkshopsExtension extends AbstractExtension
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getFunctions()
    {
        return new TwigFunction('workshops', [$this, 'getWorkshops']);
    }

    public function getWorkshops()
    {
        return $this->em->getRepository(Workshops::class)->findAll();
    }
}
