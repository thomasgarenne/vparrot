<?php

namespace App\Twig;

use App\Entity\Times;
use Doctrine\ORM\EntityManagerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TimesExtension extends AbstractExtension
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('opening', [$this, 'getOpening'])
        ];
    }

    public function getOpening()
    {
        return $this->em->getRepository(Times::class)->findAll();
    }
}
