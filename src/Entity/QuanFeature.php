<?php

namespace App\Entity;

use App\Repository\QuanFeatureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuanFeatureRepository::class)
 */
class QuanFeature
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=QuanPossibleValues::class, mappedBy="feature")
     */
    private $quanPossibleValues;



    public function __construct()
    {
        $this->quanPossibleValues = new ArrayCollection();
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
     * @return Collection|QuanPossibleValues[]
     */
    public function getQuanPossibleValues(): Collection
    {
        return $this->quanPossibleValues;
    }

    public function addQuanPossibleValue(QuanPossibleValues $quanPossibleValue): self
    {
        if (!$this->quanPossibleValues->contains($quanPossibleValue)) {
            $this->quanPossibleValues[] = $quanPossibleValue;
            $quanPossibleValue->setFeature($this);
        }

        return $this;
    }

    public function removeQuanPossibleValue(QuanPossibleValues $quanPossibleValue): self
    {
        if ($this->quanPossibleValues->removeElement($quanPossibleValue)) {
            // set the owning side to null (unless already changed)
            if ($quanPossibleValue->getFeature() === $this) {
                $quanPossibleValue->setFeature(null);
            }
        }

        return $this;
    }
    
}