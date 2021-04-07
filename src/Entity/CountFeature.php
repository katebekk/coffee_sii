<?php

namespace App\Entity;

use App\Repository\CountFeatureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CountFeatureRepository::class)
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
     * @ORM\Column(type="string", length=100)
     */
    private $name;


    /**
     * @ORM\OneToOne(targetEntity=CountPossibleValues::class, mappedBy="feature", cascade={"persist", "remove"})
     */
    private $countPossibleValues;


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
}
