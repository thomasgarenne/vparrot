<?php

namespace App\Entity;

use App\Repository\TimesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TimesRepository::class)]
class Times
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $day = null;

    #[ORM\ManyToOne(inversedBy: 'time')]
    private ?Workshops $workshops = null;

    #[ORM\Column(length: 10)]
    private ?string $open_am = null;

    #[ORM\Column(length: 10)]
    private ?string $close_am = null;

    #[ORM\Column(length: 10)]
    private ?string $open_pm = null;

    #[ORM\Column(length: 10)]
    private ?string $close_pm = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(string $day): static
    {
        $this->day = $day;

        return $this;
    }

    public function getWorkshops(): ?Workshops
    {
        return $this->workshops;
    }

    public function setWorkshops(?Workshops $workshops): static
    {
        $this->workshops = $workshops;

        return $this;
    }

    public function getOpenAm(): ?string
    {
        return $this->open_am;
    }

    public function setOpenAm(string $open_am): static
    {
        $this->open_am = $open_am;

        return $this;
    }

    public function getCloseAm(): ?string
    {
        return $this->close_am;
    }

    public function setCloseAm(string $close_am): static
    {
        $this->close_am = $close_am;

        return $this;
    }

    public function getOpenPm(): ?string
    {
        return $this->open_pm;
    }

    public function setOpenPm(string $open_pm): static
    {
        $this->open_pm = $open_pm;

        return $this;
    }

    public function getClosePm(): ?string
    {
        return $this->close_pm;
    }

    public function setClosePm(string $close_pm): static
    {
        $this->close_pm = $close_pm;

        return $this;
    }
}
