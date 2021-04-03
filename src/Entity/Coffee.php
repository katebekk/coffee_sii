<?php

namespace App\Entity;

use App\Repository\CoffeeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CoffeeRepository::class)
 */
class Coffee
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="integer")
     */
    private $growthHeight;



    /**
     * @ORM\Column(type="integer")
     */
    private $rainfall;

    /**
     * @ORM\Column(type="integer")
     */
    private $averageGrowingTemperature;

    /**
     * @ORM\Column(type="integer")
     */
    private $averageHeightCoffeeTree;

    /**
     * @ORM\Column(type="float")
     */
    private $grainSize;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $kindOfCoffeeTree;

    /**
     * @ORM\Column(type="integer")
     */
    private $averagePricePerKilogram;

    /**
     * @ORM\Column(type="integer")
     */
    private $evaluationCQL;

    /**
     * @ORM\Column(type="float")
     */
    private $caffeineContent;


    /**
     * @ORM\Column(type="integer")
     */
    private $density;

    /**
     * @ORM\Column(type="integer")
     */
    private $kislotnost;

    /**
     * @ORM\ManyToOne(targetEntity=RegionOfOrigin::class, inversedBy="coffees")
     * @ORM\JoinColumn(nullable=false)
     */
    private $regionOfOrigin;

    /**
     * @ORM\ManyToOne(targetEntity=ClimaticZone::class, inversedBy="coffees")
     * @ORM\JoinColumn(nullable=false)
     */
    private $climaticZone;

    /**
     * @ORM\ManyToOne(targetEntity=MethodOfProcessingCoffee::class, inversedBy="coffees")
     * @ORM\JoinColumn(nullable=false)
     */
    private $methodOfProcessing;

    /**
     * @ORM\Column(type="integer")
     */
    private $growthHeightMin;

    /**
     * @ORM\Column(type="integer")
     */
    private $growthHeightMax;

    /**
     * @ORM\Column(type="integer")
     */
    private $rainfallMin;

    /**
     * @ORM\Column(type="integer")
     */
    private $rainfallMax;

    /**
     * @ORM\Column(type="integer")
     */
    private $growingTemperatureMin;

    /**
     * @ORM\Column(type="integer")
     */
    private $growingTemperatureMax;

    /**
     * @ORM\Column(type="integer")
     */
    private $averageHeightCoffeeTreeMin;

    /**
     * @ORM\Column(type="integer")
     */
    private $averageHeightCoffeeTreeMax;

    /**
     * @ORM\Column(type="float")
     */
    private $grainSizeMin;

    /**
     * @ORM\Column(type="float")
     */
    private $grainSizeMax;
    

    /**
     * @ORM\Column(type="integer")
     */
    private $averagePricePerKilogramMin;

    /**
     * @ORM\Column(type="integer")
     */
    private $averagePricePerKilogramMax;

    /**
     * @ORM\Column(type="integer")
     */
    private $evaluationCQLMin;

    /**
     * @ORM\Column(type="integer")
     */
    private $evaluationCQLMax;

    /**
     * @ORM\Column(type="float")
     */
    private $caffeineContentMin;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $class;

    public function getId(): ?int
    {
        return $this->id;
    }
    

    public function getGrowthHeight(): ?int
    {
        return $this->growthHeight;
    }

    public function setGrowthHeight(int $growthHeight): self
    {
        $this->growthHeight = $growthHeight;

        return $this;
    }


    public function getRainfall(): ?int
    {
        return $this->rainfall;
    }

    public function setRainfall(int $rainfall): self
    {
        $this->rainfall = $rainfall;

        return $this;
    }

    public function getAverageGrowingTemperature(): ?int
    {
        return $this->averageGrowingTemperature;
    }

    public function setAverageGrowingTemperature(int $averageGrowingTemperature): self
    {
        $this->averageGrowingTemperature = $averageGrowingTemperature;

        return $this;
    }

    public function getAverageHeightCoffeeTree(): ?int
    {
        return $this->averageHeightCoffeeTree;
    }

    public function setAverageHeightCoffeeTree(int $averageHeightCoffeeTree): self
    {
        $this->averageHeightCoffeeTree = $averageHeightCoffeeTree;

        return $this;
    }

    public function getGrainSize(): ?float
    {
        return $this->grainSize;
    }

    public function setGrainSize(float $grainSize): self
    {
        $this->grainSize = $grainSize;

        return $this;
    }

    public function getKindOfCoffeeTree(): ?string
    {
        return $this->kindOfCoffeeTree;
    }

    public function setKindOfCoffeeTree(string $kindOfCoffeeTree): self
    {
        $this->kindOfCoffeeTree = $kindOfCoffeeTree;

        return $this;
    }

    public function getAveragePricePerKilogram(): ?int
    {
        return $this->averagePricePerKilogram;
    }

    public function setAveragePricePerKilogram(int $averagePricePerKilogram): self
    {
        $this->averagePricePerKilogram = $averagePricePerKilogram;

        return $this;
    }

    public function getEvaluationCQL(): ?int
    {
        return $this->evaluationCQL;
    }

    public function setEvaluationCQL(int $evaluationCQL): self
    {
        $this->evaluationCQL = $evaluationCQL;

        return $this;
    }

    public function getCaffeineContent(): ?float
    {
        return $this->caffeineContent;
    }

    public function setCaffeineContent(float $caffeineContent): self
    {
        $this->caffeineContent = $caffeineContent;

        return $this;
    }
    

    public function getDensity(): ?int
    {
        return $this->density;
    }

    public function setDensity(int $density): self
    {
        $this->density = $density;

        return $this;
    }

    public function getKislotnost(): ?int
    {
        return $this->kislotnost;
    }

    public function setKislotnost(int $kislotnost): self
    {
        $this->kislotnost = $kislotnost;

        return $this;
    }

    public function getRegionOfOrigin(): ?RegionOfOrigin
    {
        return $this->RegionOfOrigin;
    }

    public function setRegionOfOrigin(?RegionOfOrigin $RegionOfOrigin): self
    {
        $this->RegionOfOrigin = $RegionOfOrigin;

        return $this;
    }

    public function getClimaticZone(): ?ClimaticZone
    {
        return $this->climaticZone;
    }

    public function setClimaticZone(?ClimaticZone $climaticZone): self
    {
        $this->climaticZone = $climaticZone;

        return $this;
    }

    public function getMethodOfProcessing(): ?MethodOfProcessingCoffee
    {
        return $this->methodOfProcessing;
    }

    public function setMethodOfProcessing(?MethodOfProcessingCoffee $methodOfProcessing): self
    {
        $this->methodOfProcessing = $methodOfProcessing;

        return $this;
    }

    public function getGrowthHeightMin(): ?int
    {
        return $this->growthHeightMin;
    }

    public function setGrowthHeightMin(int $growthHeightMin): self
    {
        $this->growthHeightMin = $growthHeightMin;

        return $this;
    }

    public function getGrowthHeightMax(): ?int
    {
        return $this->growthHeightMax;
    }

    public function setGrowthHeightMax(int $growthHeightMax): self
    {
        $this->growthHeightMax = $growthHeightMax;

        return $this;
    }

    public function getRainfallMin(): ?int
    {
        return $this->rainfallMin;
    }

    public function setRainfallMin(int $rainfallMin): self
    {
        $this->rainfallMin = $rainfallMin;

        return $this;
    }

    public function getRainfallMax(): ?int
    {
        return $this->rainfallMax;
    }

    public function setRainfallMax(int $rainfallMax): self
    {
        $this->rainfallMax = $rainfallMax;

        return $this;
    }

    public function getGrowingTemperatureMin(): ?int
    {
        return $this->growingTemperatureMin;
    }

    public function setGrowingTemperatureMin(int $growingTemperatureMin): self
    {
        $this->growingTemperatureMin = $growingTemperatureMin;

        return $this;
    }

    public function getGrowingTemperatureMax(): ?int
    {
        return $this->growingTemperatureMax;
    }

    public function setGrowingTemperatureMax(int $growingTemperatureMax): self
    {
        $this->growingTemperatureMax = $growingTemperatureMax;

        return $this;
    }

    public function getAverageHeightCoffeeTreeMin(): ?int
    {
        return $this->averageHeightCoffeeTreeMin;
    }

    public function setAverageHeightCoffeeTreeMin(int $averageHeightCoffeeTreeMin): self
    {
        $this->averageHeightCoffeeTreeMin = $averageHeightCoffeeTreeMin;

        return $this;
    }

    public function getAverageHeightCoffeeTreeMax(): ?int
    {
        return $this->averageHeightCoffeeTreeMax;
    }

    public function setAverageHeightCoffeeTreeMax(int $averageHeightCoffeeTreeMax): self
    {
        $this->averageHeightCoffeeTreeMax = $averageHeightCoffeeTreeMax;

        return $this;
    }

    public function getGrainSizeMin(): ?float
    {
        return $this->grainSizeMin;
    }

    public function setGrainSizeMin(float $grainSizeMin): self
    {
        $this->grainSizeMin = $grainSizeMin;

        return $this;
    }

    public function getGrainSizeMax(): ?float
    {
        return $this->grainSizeMax;
    }

    public function setGrainSizeMax(float $grainSizeMax): self
    {
        $this->grainSizeMax = $grainSizeMax;

        return $this;
    }

    public function getAveragePricePerKilogramMin(): ?int
    {
        return $this->averagePricePerKilogramMin;
    }

    public function setAveragePricePerKilogramMin(int $averagePricePerKilogramMin): self
    {
        $this->averagePricePerKilogramMin = $averagePricePerKilogramMin;

        return $this;
    }

    public function getAveragePricePerKilogramMax(): ?int
    {
        return $this->averagePricePerKilogramMax;
    }

    public function setAveragePricePerKilogramMax(int $averagePricePerKilogramMax): self
    {
        $this->averagePricePerKilogramMax = $averagePricePerKilogramMax;

        return $this;
    }

    public function getEvaluationCQLMin(): ?int
    {
        return $this->evaluationCQLMin;
    }

    public function setEvaluationCQLMin(int $evaluationCQLMin): self
    {
        $this->evaluationCQLMin = $evaluationCQLMin;

        return $this;
    }

    public function getEvaluationCQLMax(): ?int
    {
        return $this->evaluationCQLMax;
    }

    public function setEvaluationCQLMax(int $evaluationCQLMax): self
    {
        $this->evaluationCQLMax = $evaluationCQLMax;

        return $this;
    }

    public function getCaffeineContentMin(): ?float
    {
        return $this->caffeineContentMin;
    }

    public function setCaffeineContentMin(float $caffeineContentMin): self
    {
        $this->caffeineContentMin = $caffeineContentMin;

        return $this;
    }

    public function getClass(): ?string
    {
        return $this->class;
    }

    public function setClass(?string $class): self
    {
        $this->class = $class;

        return $this;
    }
}
