<?php

namespace App\Entity;

use App\Repository\QuanFeatureValueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\ManyToOne(targetEntity=CoffeeSort::class, inversedBy="quanFeatureValues", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $coffeeSort;

    /**
     * @ORM\ManyToOne(targetEntity=QuanFeature::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $feature;

    /**
     * @ORM\ManyToMany(targetEntity=QuanPossibleValues::class)
     */
    private $featureValues;

    public function __construct()
    {
        $this->featureValues = new ArrayCollection();
    }

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

    public function getFeature(): ?QuanFeature
    {
        return $this->feature;
    }

    public function setFeature(?QuanFeature $feature): self
    {
        $this->feature = $feature;

        return $this;
    }

    /**
     * @return Collection|QuanPossibleValues[]
     */
    public function getFeatureValues(): Collection
    {
        return $this->featureValues;
    }

    public function addFeatureValue(QuanPossibleValues $featureValue): self
    {
        if (!$this->featureValues->contains($featureValue)) {
            $this->featureValues[] = $featureValue;
        }

        return $this;
    }

    public function removeFeatureValue(QuanPossibleValues $featureValue): self
    {
        $this->featureValues->removeElement($featureValue);

        return $this;
    }
}
