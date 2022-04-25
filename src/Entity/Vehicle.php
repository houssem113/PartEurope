<?php

namespace App\Entity;

use App\Repository\VehicleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehicleRepository::class)]
class Vehicle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $bikeProducer;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $series;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $size;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $configuration;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $bikeModel;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $salesName;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $year;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $cylinder;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $typeofDrive;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $engineOutput;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $country;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $category1;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $category2;

    #[ORM\Column(type: 'integer', nullable: false)]
    private $uuid;

    #[ORM\ManyToMany(targetEntity: Part::class, mappedBy: 'vehicleIds')]
    private $parts;


    public function __construct()
    {
        $this->parts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBikeProducer(): ?string
    {
        return $this->bikeProducer;
    }

    public function setBikeProducer(?string $bikeProducer): self
    {
        $this->bikeProducer = $bikeProducer;

        return $this;
    }

    public function getSeries(): ?string
    {
        return $this->series;
    }

    public function setSeries(?string $series): self
    {
        $this->series = $series;

        return $this;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(?string $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getConfiguration(): ?string
    {
        return $this->configuration;
    }

    public function setConfiguration(?string $configuration): self
    {
        $this->configuration = $configuration;

        return $this;
    }

    public function getBikeModel(): ?string
    {
        return $this->bikeModel;
    }

    public function setBikeModel(?string $bikeModel): self
    {
        $this->bikeModel = $bikeModel;

        return $this;
    }

    public function getSalesName(): ?string
    {
        return $this->salesName;
    }

    public function setSalesName(?string $salesName): self
    {
        $this->salesName = $salesName;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(?int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getUuid(): ?int
    {
        return $this->uuid;
    }

    public function setUuid(?int $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getCylinder(): ?string
    {
        return $this->cylinder;
    }

    public function setCylinder(?string $cylinder): self
    {
        $this->cylinder = $cylinder;

        return $this;
    }

    public function getTypeofDrive(): ?string
    {
        return $this->typeofDrive;
    }

    public function setTypeofDrive(?string $typeofDrive): self
    {
        $this->typeofDrive = $typeofDrive;

        return $this;
    }

    public function getEngineOutput(): ?string
    {
        return $this->engineOutput;
    }

    public function setEngineOutput(?string $engineOutput): self
    {
        $this->engineOutput = $engineOutput;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getCategory1(): ?string
    {
        return $this->category1;
    }

    public function setCategory1(?string $category1): self
    {
        $this->category1 = $category1;

        return $this;
    }

    public function getCategory2(): ?string
    {
        return $this->category2;
    }

    public function setCategory2(?string $category2): self
    {
        $this->category2 = $category2;

        return $this;
    }

    /**
     * @return Collection<int, Part>
     */
    public function getParts(): Collection
    {
        return $this->parts;
    }

    public function addPart(Part $part): self
    {
        if (!$this->parts->contains($part)) {
            $this->parts[] = $part;
            $part->addVehicleId($this);
        }

        return $this;
    }

    public function removePart(Part $part): self
    {
        if ($this->parts->removeElement($part)) {
            $part->removeVehicleId($this);
        }

        return $this;
    }
}
