<?php

namespace App\Entity;

use App\Repository\CountFeatureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CountFeatureRepository::class)
 * @UniqueEntity(fields={"name"}, message="Признак с таким названием уже существует")
 */
class CountFeature
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     */
    private $name;


    /**
     * @ORM\OneToOne(targetEntity=CountPossibleValues::class, mappedBy="feature", cascade={"persist", "remove"})
     */
    private $countPossibleValues;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $measure;


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


    public function getCountPossibleValues(): ?CountPossibleValues
    {
        return $this->countPossibleValues;
    }

    public function setCountPossibleValues(CountPossibleValues $countPossibleValues): self
    {
        // set the owning side of the relation if necessary
        if ($countPossibleValues->getFeature() !== $this) {
            $countPossibleValues->setFeature($this);
        }

        $this->countPossibleValues = $countPossibleValues;

        return $this;
    }
    public function __toString(){
        // to show the name of the Category in the select
        return $this->name;
    }

    public function getMeasure(): ?string
    {
        return $this->measure;
    }

    public function setMeasure(?string $measure): self
    {
        $this->measure = $measure;

        return $this;
    }
}
