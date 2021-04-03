<?php

namespace App\Entity;

use App\Repository\RegionOfOriginRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RegionOfOriginRepository::class)
 */
class RegionOfOrigin
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Coffee::class, mappedBy="RegionOfOrigin")
     */
    private $coffees;

    public function __construct()
    {
        $this->coffees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Coffee[]
     */
    public function getCoffees(): Collection
    {
        return $this->coffees;
    }

    public function addCoffee(Coffee $coffee): self
    {
        if (!$this->coffees->contains($coffee)) {
            $this->coffees[] = $coffee;
            $coffee->setRegionOfOrigin($this);
        }

        return $this;
    }

    public function removeCoffee(Coffee $coffee): self
    {
        if ($this->coffees->removeElement($coffee)) {
            // set the owning side to null (unless already changed)
            if ($coffee->getRegionOfOrigin() === $this) {
                $coffee->setRegionOfOrigin(null);
            }
        }

        return $this;
    }
}