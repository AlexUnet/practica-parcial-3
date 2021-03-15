<?php

namespace App\Entity;

use App\Repository\PackageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PackageRepository::class)
 */
class Package
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
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity=Cable::class)
     */
    private $cable;

    /**
     * @ORM\ManyToOne(targetEntity=Telephony::class)
     */
    private $telephony;

    /**
     * @ORM\ManyToOne(targetEntity=Internet::class)
     */
    private $internet;

    /**
     * @ORM\OneToMany(targetEntity=ChangeRequest::class, mappedBy="package")
     */
    private $changeRequests;

    public function __construct()
    {
        $this->changeRequests = new ArrayCollection();
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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCable(): ?Cable
    {
        return $this->cable;
    }

    public function setCable(?Cable $cable): self
    {
        $this->cable = $cable;

        return $this;
    }

    public function getTelephony(): ?Telephony
    {
        return $this->telephony;
    }

    public function setTelephony(?Telephony $telephony): self
    {
        $this->telephony = $telephony;

        return $this;
    }

    public function getInternet(): ?Internet
    {
        return $this->internet;
    }

    public function setInternet(?Internet $internet): self
    {
        $this->internet = $internet;

        return $this;
    }

    /**
     * @return Collection|ChangeRequest[]
     */
    public function getChangeRequests(): Collection
    {
        return $this->changeRequests;
    }

    public function addChangeRequest(ChangeRequest $changeRequest): self
    {
        if (!$this->changeRequests->contains($changeRequest)) {
            $this->changeRequests[] = $changeRequest;
            $changeRequest->setPackage($this);
        }

        return $this;
    }

    public function removeChangeRequest(ChangeRequest $changeRequest): self
    {
        if ($this->changeRequests->removeElement($changeRequest)) {
            // set the owning side to null (unless already changed)
            if ($changeRequest->getPackage() === $this) {
                $changeRequest->setPackage(null);
            }
        }

        return $this;
    }
}
