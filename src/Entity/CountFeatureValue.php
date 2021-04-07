<?php

namespace App\Entity;

use App\Repository\CountFeatureValueRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CountFeatureValueRepository::class)
 */
class CountFeatureValue
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity=CoffeeSort::class, inversedBy="countFeatureValues", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $coffeeSort;

    /**
     * @ORM\ManyToOne(targetEntity=CountFeature::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $feature;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $value): self
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

    public function getFeature(): ?CountFeature
    {
        return $this->feature;
    }

    public function setFeature(?CountFeature $feature): self
    {
        $this->feature = $feature;

        return $this;
    }
}
