<?php

namespace App\Entity;

use App\Repository\ChanelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChanelRepository::class)
 */
class Chanel
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
     * @ORM\OneToMany(targetEntity=Program::class, mappedBy="chanel")
     */
    private $Programs;

    public function __construct()
    {
        $this->Programs = new ArrayCollection();
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
     * @return Collection|Program[]
     */
    public function getPrograms(): Collection
    {
        return $this->Programs;
    }

    public function addProgram(Program $program): self
    {
        if (!$this->Programs->contains($program)) {
            $this->Programs[] = $program;
            $program->setChanel($this);
        }

        return $this;
    }

    public function removeProgram(Program $program): self
    {
        if ($this->Programs->removeElement($program)) {
            // set the owning side to null (unless already changed)
            if ($program->getChanel() === $this) {
                $program->setChanel(null);
            }
        }

        return $this;
    }
}
