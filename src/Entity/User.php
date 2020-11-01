<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * @Gedmo\Loggable
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=255)
     * @Gedmo\Versioned
     */
    private string $fullName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Gedmo\Versioned
     */
    private string $role;

    /**
     * @ORM\Column(type="date")
     * @Gedmo\Versioned
     */
    private ?\DateTimeInterface $dateOfBirth = null;

    /**
     * @ORM\Column (type="string", length=255)
     * @Gedmo\Versioned
     */
    private string $passport;

    /**
     * @ORM\Column (type="string", length=255)
     * @Gedmo\Versioned
     */
    private string $mobileNumber;

    /**
     * @ORM\Column (type="string", length=255)
     * @Gedmo\Versioned
     */
    private string $email;


    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @param string $fullName
     */
    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDateOfBirth (): ?\DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    /**
     * @return  \DateTimeInterface|null $dateOfBirth
     */
    public function setDateOfBirth (\DateTimeInterface $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    /**
     * @return   string
     */
    public function getPassport (): string
    {
        return $this->passport;
    }

    /**
     * @param   string $passport
     */
    public function setPassport (string $passport): self
    {
        $this->passport = $passport;
        return $this;
    }

    /**
     * @return   string
     */
    public function getMobileNumber (): string
    {
        return $this->mobileNumber;
    }

    /**
     * @param  string $mobileNumber
     */
    public function setMobileNumber (string $mobileNumber): self
    {
        $this->mobileNumber = $mobileNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail (): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail (string $email): self
    {
        $this->email = $email;
        return $this;
    }
}
