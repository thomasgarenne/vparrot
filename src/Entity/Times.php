<?php

namespace App\Entity;

use App\Repository\TimesRepository;
use Doctrine\DBAL\Types\Types;
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

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $am_open = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $am_close = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $pm_open = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $pm_close = null;

    #[ORM\ManyToOne(inversedBy: 'time')]
    private ?Workshops $workshops = null;

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

    public function getAmOpen(): ?\DateTimeInterface
    {
        return $this->am_open;
    }

    public function setAmOpen(?\DateTimeInterface $am_open): static
    {
        $this->am_open = $am_open;

        return $this;
    }

    public function getAmClose(): ?\DateTimeInterface
    {
        return $this->am_close;
    }

    public function setAmClose(?\DateTimeInterface $am_close): static
    {
        $this->am_close = $am_close;

        return $this;
    }

    public function getPmOpen(): ?\DateTimeInterface
    {
        return $this->pm_open;
    }

    public function setPmOpen(?\DateTimeInterface $pm_open): static
    {
        $this->pm_open = $pm_open;

        return $this;
    }

    public function getPmClose(): ?\DateTimeInterface
    {
        return $this->pm_close;
    }

    public function setPmClose(?\DateTimeInterface $pm_close): static
    {
        $this->pm_close = $pm_close;

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
}
