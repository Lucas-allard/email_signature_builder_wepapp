<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeeRepository::class)]
class Employee implements EntityInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $firstName = null;

    #[ORM\Column(length: 50)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $position = null;

    #[ORM\Column(length: 255)]
    private ?string $picture = null;

    #[ORM\Column(length: 14, nullable: true)]
    private ?string $phoneNumber = null;

    #[ORM\Column(length: 255)]
    private ?string $secondEmail = null;

    #[ORM\Column(length: 255)]
    private ?string $thirdEmail = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $facebookUrl = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $instagramUrl = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $linkedinUrl = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $twitterUrl = null;

    #[ORM\OneToMany(mappedBy: 'employee', targetEntity: Signature::class)]
    private Collection $signatures;

    #[ORM\Column(length: 255)]
    private ?string $firstEmail = null;

    public function __construct()
    {
        $this->signatures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

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

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(string $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): self
    {
        if (strlen($phoneNumber) >= 14) {
            $this->phoneNumber = substr($phoneNumber, 0, 14);
        }
        // add 1 space between each 2 number on the phoneNumber
        $this->phoneNumber = preg_replace('/(\d{2})/', '$1 ', $phoneNumber);

        return $this;
    }

    public function getSecondEmail(): ?string
    {
        return $this->secondEmail;
    }

    public function setSecondEmail(string $secondEmail): self
    {
        $this->secondEmail = $secondEmail;

        return $this;
    }

    public function getThirdEmail(): ?string
    {
        return $this->thirdEmail;
    }

    public function setThirdEmail(string $thirdEmail): self
    {
        $this->thirdEmail = $thirdEmail;

        return $this;
    }

    public function getFacebookUrl(): ?string
    {
        return $this->facebookUrl;
    }

    public function setFacebookUrl(string $facebookUrl): self
    {
        $this->facebookUrl = $facebookUrl;

        return $this;
    }

    public function getInstagramUrl(): ?string
    {
        return $this->instagramUrl;
    }

    public function setInstagramUrl(?string $instagramUrl): self
    {
        $this->instagramUrl = $instagramUrl;

        return $this;
    }

    public function getLinkedinUrl(): ?string
    {
        return $this->linkedinUrl;
    }

    public function setLinkedinUrl(?string $linkedinUrl): self
    {
        $this->linkedinUrl = $linkedinUrl;

        return $this;
    }

    public function getTwitterUrl(): ?string
    {
        return $this->twitterUrl;
    }

    public function setTwitterUrl(?string $twitterUrl): self
    {
        $this->twitterUrl = $twitterUrl;

        return $this;
    }

    /**
     * @return Collection<int, Signature>
     */
    public function getSignatures(): Collection
    {
        return $this->signatures;
    }

    public function addSignature(Signature $signature): self
    {
        if (!$this->signatures->contains($signature)) {
            $this->signatures->add($signature);
            $signature->setEmployee($this);
        }

        return $this;
    }

    public function removeSignature(Signature $signature): self
    {
        if ($this->signatures->removeElement($signature)) {
            // set the owning side to null (unless already changed)
            if ($signature->getEmployee() === $this) {
                $signature->setEmployee(null);
            }
        }

        return $this;
    }

    public function getFirstEmail(): ?string
    {
        return $this->firstEmail;
    }

    public function setFirstEmail(string $firstEmail): self
    {
        $this->firstEmail = $firstEmail;

        return $this;
    }
}
