<?php

namespace App\Entity;

use App\Repository\PartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PartRepository::class)]
class Part
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $name;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $active;

    #[ORM\ManyToMany(targetEntity: Vehicle::class, inversedBy: 'parts')]
    private $vehicleIds;

    public function __construct()
    {
        $this->vehicleIds = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getActive(): ?int
    {
        return $this->active;
    }

    public function setActive(?int $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return Collection<int, Vehicle>
     */
    public function getVehicleIds(): Collection
    {
        return $this->vehicleIds;
    }

    public function addVehicleId(?Vehicle $vehicleId): self
    {
        if (!$this->vehicleIds->contains($vehicleId)) {
            $this->vehicleIds[] = $vehicleId;
        }

        return $this;
    }

    public function removeVehicleId(Vehicle $vehicleId): self
    {
        $this->vehicleIds->removeElement($vehicleId);

        return $this;
    }
}
