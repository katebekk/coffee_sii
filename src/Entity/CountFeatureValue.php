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
     * @ORM\ManyToOne(targetEntity=CoffeeSort::class, inversedBy="countFeatureValues", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $coffeeSort;

    /**
     * @ORM\ManyToOne(targetEntity=CountFeature::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $feature;

    /**
     * @ORM\Column(type="float")
     */
    private $min;

    /**
     * @ORM\Column(type="float")
     */
    private $max;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getMin(): ?float
    {
        return $this->min;
    }

    public function setMin(float $min): self
    {
        $this->min = $min;

        return $this;
    }

    public function getMax(): ?float
    {
        return $this->max;
    }

    public function setMax(float $max): self
    {
        $this->max = $max;

        return $this;
    }
}
