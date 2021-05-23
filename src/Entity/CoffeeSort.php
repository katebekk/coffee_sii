<?php

namespace App\Entity;

use App\Repository\CoffeeSortRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CoffeeSortRepository::class)
 * @UniqueEntity(fields={"name"}, message="Сорт с таким названием уже существует")
 */
class CoffeeSort
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=QuanFeature::class)
     */
    private $quanFeatures;

    /**
     * @ORM\ManyToMany(targetEntity=CountFeature::class)
     */
    private $countFeatures;

    /**
     * @ORM\OneToMany(targetEntity=QuanFeatureValue::class, mappedBy="coffeeSort", cascade={"persist", "remove"})
     */
    private $quanFeatureValues;

    /**
     * @ORM\OneToMany(targetEntity=CountFeatureValue::class, mappedBy="coffeeSort", cascade={"persist", "remove"})
     */
    private $countFeatureValues;

    public function __construct()
    {
        $this->quanFeatures = new ArrayCollection();
        $this->countFeatures = new ArrayCollection();
        $this->quanFeatureValues = new ArrayCollection();
        $this->countFeatureValues = new ArrayCollection();
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
     * @return Collection|QuanFeature[]
     */
    public function getQuanFeatures(): Collection
    {
        return $this->quanFeatures;
    }

    public function addQuanFeature(QuanFeature $quanFeature): self
    {
        if (!$this->quanFeatures->contains($quanFeature)) {
            $this->quanFeatures[] = $quanFeature;
            //$quanFeature->addCoffeeSort($this);
        }

        return $this;
    }

    public function removeQuanFeature(QuanFeature $quanFeature): self
    {
        if ($this->quanFeatures->contains($quanFeature)) {
            $this->quanFeatures->removeElement($quanFeature);
            $quanFeature->removeCoffeeSort($this);
        }

        return $this;
    }

    /**
     * @return Collection|CountFeature[]
     */
    public function getCountFeatures(): Collection
    {
        return $this->countFeatures;
    }

    public function addCountFeature(CountFeature $countFeature): self
    {
        if (!$this->countFeatures->contains($countFeature)) {
            $this->countFeatures[] = $countFeature;
            //$countFeature->addCoffeeSort($this);
        }

        return $this;
    }

    public function removeCountFeature(CountFeature $countFeature): self
    {
        if ($this->countFeatures->removeElement($countFeature)) {
            $countFeature->removeCoffeeSort($this);
        }

        return $this;
    }

    /**
     * @return Collection|QuanFeatureValue[]
     */
    public function getQuanFeatureValues(): Collection
    {
        return $this->quanFeatureValues;
    }

    public function addQuanFeatureValue(QuanFeatureValue $quanFeatureValue): self
    {
        if (!$this->quanFeatureValues->contains($quanFeatureValue)) {
            $this->quanFeatureValues[] = $quanFeatureValue;
            $quanFeatureValue->setCoffeeSort($this);
        }

        return $this;
    }

    public function removeQuanFeatureValue(QuanFeatureValue $quanFeatureValue): self
    {
        if ($this->quanFeatureValues->removeElement($quanFeatureValue)) {
            // set the owning side to null (unless already changed)
            if ($quanFeatureValue->getCoffeeSort() === $this) {
                $quanFeatureValue->setCoffeeSort(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CountFeatureValue[]
     */
    public function getCountFeatureValues(): Collection
    {
        return $this->countFeatureValues;
    }

    public function addCountFeatureValue(CountFeatureValue $countFeatureValue): self
    {
        if (!$this->countFeatureValues->contains($countFeatureValue)) {
            $this->countFeatureValues[] = $countFeatureValue;
            $countFeatureValue->setCoffeeSort($this);
        }

        return $this;
    }

    public function removeCountFeatureValue(CountFeatureValue $countFeatureValue): self
    {
        if ($this->countFeatureValues->removeElement($countFeatureValue)) {
            // set the owning side to null (unless already changed)
            if ($countFeatureValue->getCoffeeSort() === $this) {
                $countFeatureValue->setCoffeeSort(null);
            }
        }

        return $this;
    }
    public function __toString(){
        // to show the name of the Category in the select
        return $this->name;
    }
}
