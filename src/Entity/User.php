<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isAdmin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $phoneNumber;

    /**
     * @ORM\OneToMany(targetEntity=ChangeRequest::class, mappedBy="user")
     */
    private $changeRequest;

    /**
     * @ORM\ManyToOne(targetEntity=Package::class, inversedBy="users")
     */
    private $package;

    public function __construct()
    {
        $this->changeRequest = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsAdmin(): ?bool
    {
        return $this->isAdmin;
    }

    public function setIsAdmin(bool $isAdmin): self
    {
        $this->isAdmin = $isAdmin;

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

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * @return Collection|ChangeRequest[]
     */
    public function getChangeRequest(): Collection
    {
        return $this->changeRequest;
    }

    public function addChangeRequest(ChangeRequest $changeRequest): self
    {
        if (!$this->changeRequest->contains($changeRequest)) {
            $this->changeRequest[] = $changeRequest;
            $changeRequest->setUser($this);
        }

        return $this;
    }

    public function removeChangeRequest(ChangeRequest $changeRequest): self
    {
        if ($this->changeRequest->removeElement($changeRequest)) {
            // set the owning side to null (unless already changed)
            if ($changeRequest->getUser() === $this) {
                $changeRequest->setUser(null);
            }
        }

        return $this;
    }

    public function getPackage(): ?Package
    {
        return $this->package;
    }

    public function setPackage(?Package $Package): self
    {
        $this->package = $Package;

        return $this;
    }
}
