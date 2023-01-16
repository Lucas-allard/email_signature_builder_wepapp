<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\SignatureRepository;

#[ORM\Entity(repositoryClass: SignatureRepository::class)]
class Signature
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'signature', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $signatureOne = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $signatureTwo = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $signatureThree = null;

    #[ORM\ManyToOne(inversedBy: 'signatures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Employee $employee = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getSignatureOne(): ?string
    {
        return $this->signatureOne;
    }

    public function setSignatureOne(string $signatureOne): self
    {
        $this->signatureOne = $signatureOne;

        return $this;
    }

    public function getSignatureTwo(): ?string
    {
        return $this->signatureTwo;
    }

    public function setSignatureTwo(?string $signatureTwo): self
    {
        $this->signatureTwo = $signatureTwo;

        return $this;
    }

    public function getSignatureThree(): ?string
    {
        return $this->signatureThree;
    }

    public function setSignatureThree(?string $signatureThree): self
    {
        $this->signatureThree = $signatureThree;

        return $this;
    }

    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }

    public function setEmployee(?Employee $employee): self
    {
        $this->employee = $employee;

        return $this;
    }
}
