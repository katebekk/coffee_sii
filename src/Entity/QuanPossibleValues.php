<?php

namespace App\Entity;

use App\Repository\QuanPossibleValuesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuanPossibleValuesRepository::class)
 */
class QuanPossibleValues
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=QuanFeature::class, inversedBy="quanPossibleValues")
     * @ORM\JoinColumn(nullable=false)
     */
    private $feature;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;



    public function getId(): ?int
    {
        return $this->id;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
    
}
