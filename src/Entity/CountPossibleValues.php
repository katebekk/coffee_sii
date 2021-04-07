<?php

namespace App\Entity;

use App\Repository\CountPossibleValuesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CountPossibleValuesRepository::class)
 */
class CountPossibleValues
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
    private $min;

    /**
     * @ORM\Column(type="float")
     */
    private $max;

    /**
     * @ORM\OneToOne(targetEntity=CountFeature::class, inversedBy="countPossibleValues", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $feature;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getFeature(): ?CountFeature
    {
        return $this->feature;
    }

    public function setFeature(CountFeature $feature): self
    {
        $this->feature = $feature;

        return $this;
    }
}
