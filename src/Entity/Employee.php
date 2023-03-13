<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 *
 */
#[ORM\Entity(repositoryClass: EmployeeRepository::class)]
class Employee implements EntityInterface
{
    /**
     * @var int|null
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var string|null
     */
    #[ORM\Column(length: 30)]
    private ?string $firstName = null;

    /**
     * @var string|null
     */
    #[ORM\Column(length: 50)]
    private ?string $lastName = null;

    /**
     * @var string|null
     */
    #[ORM\Column(length: 255)]
    private ?string $position = null;

    /**
     * @var string|null
     */
    #[ORM\Column(length: 255)]
    #[Assert\Regex(
        '/^https:\/\/mili-atlas\.fr\/wp-content\/uploads\/.*$/',
        message: 'L\'URL doit commencer par https://mili-atlas.fr/wp-content/uploads/'
    )]
    private ?string $picture = null;

    /**
     * @var string|null
     */
    #[ORM\Column(length: 14, nullable: true)]
    private ?string $phoneNumber = null;

    /**
     * @var string|null
     */
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $firstEmail = null;

    /**
     * @var string|null
     */
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $secondEmail = null;

    /**
     * @var string|null
     */
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $thirdEmail = null;

    /**
     * @var string|null
     */


    /**
     * @var string|null
     */
    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Regex(
        pattern: '/^https:\/\/www\.linkedin\.com\/.*$/',
        message: 'L\'URL doit commencer par https://www.linkedin.com/'
    )]
    private ?string $linkedinUrl = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return $this
     */
    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return $this
     */
    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPosition(): ?string
    {
        return $this->position;
    }

    /**
     * @param string $position
     * @return $this
     */
    public function setPosition(string $position): self
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPicture(): ?string
    {
        return $this->picture;
    }

    /**
     * @param string $picture
     * @return $this
     */
    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string|null $phoneNumber
     * @return $this
     */
    public function setPhoneNumber(?string $phoneNumber): self
    {
     $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSecondEmail(): ?string
    {
        return $this->secondEmail;
    }

    /**
     * @param string $secondEmail
     * @return $this
     */
    public function setSecondEmail(string $secondEmail): self
    {
        $this->secondEmail = $secondEmail;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getThirdEmail(): ?string
    {
        return $this->thirdEmail;
    }

    /**
     * @param string $thirdEmail
     * @return $this
     */
    public function setThirdEmail(string $thirdEmail): self
    {
        $this->thirdEmail = $thirdEmail;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLinkedinUrl(): ?string
    {
        return $this->linkedinUrl;
    }

    /**
     * @param string|null $linkedinUrl
     * @return $this
     */
    public function setLinkedinUrl(?string $linkedinUrl): self
    {
        $this->linkedinUrl = $linkedinUrl;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFirstEmail(): ?string
    {
        return $this->firstEmail;
    }

    /**
     * @param string $firstEmail
     * @return $this
     */
    public function setFirstEmail(string $firstEmail): self
    {
        $this->firstEmail = $firstEmail;

        return $this;
    }
}
