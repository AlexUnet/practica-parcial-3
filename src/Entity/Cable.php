<?php

namespace App\Entity;

use App\Repository\CableRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CableRepository::class)
 */
class Cable
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
     * @ORM\ManyToMany(targetEntity=Chanel::class)
     */
    private $chanels;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    public function __construct()
    {
        $this->chanels = new ArrayCollection();
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
     * @return Collection|Chanel[]
     */
    public function getChanels(): Collection
    {
        return $this->chanels;
    }

    public function addChanel(Chanel $chanel): self
    {
        if (!$this->chanels->contains($chanel)) {
            $this->chanels[] = $chanel;
        }

        return $this;
    }

    public function removeChanel(Chanel $chanel): self
    {
        $this->chanels->removeElement($chanel);

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }
}
