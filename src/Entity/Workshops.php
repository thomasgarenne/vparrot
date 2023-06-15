<?php

namespace App\Entity;

use App\Repository\WorkshopsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WorkshopsRepository::class)]
class Workshops
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(length: 5)]
    private ?string $zipcode = null;

    #[ORM\Column(length: 150)]
    private ?string $city = null;

    #[ORM\OneToMany(mappedBy: 'workshops', targetEntity: Times::class)]
    private Collection $time;

    public function __construct()
    {
        $this->time = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setZipcode(string $zipcode): static
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return Collection<int, Times>
     */
    public function getTime(): Collection
    {
        return $this->time;
    }

    public function addTime(Times $time): static
    {
        if (!$this->time->contains($time)) {
            $this->time->add($time);
            $time->setWorkshops($this);
        }

        return $this;
    }

    public function removeTime(Times $time): static
    {
        if ($this->time->removeElement($time)) {
            // set the owning side to null (unless already changed)
            if ($time->getWorkshops() === $this) {
                $time->setWorkshops(null);
            }
        }

        return $this;
    }
}
