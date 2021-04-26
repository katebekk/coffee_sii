<?php

namespace App\Entity;

use App\Repository\QuanPossibleValuesRepository;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuanPossibleValuesRepository::class)
 * @UniqueEntity(fields={"name","feature"}, message="Значение признака с таким названием уже существует")
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
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=QuanFeature::class, inversedBy="quanPossibleValues")
     * @ORM\JoinColumn(nullable=false)
     */
    private $feature;

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

    public function getFeature(): ?QuanFeature
    {
        return $this->feature;
    }

    public function setFeature(?QuanFeature $feature): self
    {
        $this->feature = $feature;

        return $this;
    }
    public function __toString(){
        // to show the name of the Category in the select
        return $this->name;
    }
    
}
