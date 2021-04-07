<?php

namespace App\Entity;

use App\Repository\QuanFeatureValueRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuanFeatureValueRepository::class)
 */
class QuanFeatureValue
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
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity=CoffeeSort::class, inversedBy="quanFeatureValues", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $coffeeSort;

    /**
     * @ORM\ManyToOne(targetEntity=QuanFeature::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $feature;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getCoffeeSort(): ?CoffeeSort
    {
        return $this->coffeeSort;
    }

    public function setCoffeeSort(?CoffeeSort $coffeeSort): self
    {
        $this->coffeeSort = $coffeeSort;

        return $this;
    }

    public function getFeature(): ?QuanFeature
    {
        return $this->feature;
    }

    public function setFeature(?QuanFeature $feature): self
    {
        $this->feature = $feature;

        return $this;
    }
}
