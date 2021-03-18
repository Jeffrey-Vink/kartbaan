<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $voorletters;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $tussenvoegsel;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $achternaam;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $adres;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $postcode;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $telefoon;

    /**
     * @ORM\ManyToMany(targetEntity=Activiteit::class, mappedBy="users")
     */
    private $activiteiten;

    public function __construct()
    {
        $this->activiteiten = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    function getNaam()
    {
        return $this->voorletters." ".$this->tussenvoegsel." ".$this->achternaam;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getVoorletters(): ?string
    {
        return $this->voorletters;
    }

    public function setVoorletters(string $voorletters): self
    {
        $this->voorletters = $voorletters;

        return $this;
    }

    public function getTussenvoegsel(): ?string
    {
        return $this->tussenvoegsel;
    }

    public function setTussenvoegsel(?string $tussenvoegsel): self
    {
        $this->tussenvoegsel = $tussenvoegsel;

        return $this;
    }

    public function getAchternaam(): ?string
    {
        return $this->achternaam;
    }

    public function setAchternaam(string $achternaam): self
    {
        $this->achternaam = $achternaam;

        return $this;
    }

    public function getAdres(): ?string
    {
        return $this->adres;
    }

    public function setAdres(string $adres): self
    {
        $this->adres = $adres;

        return $this;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(string $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function getTelefoon(): ?string
    {
        return $this->telefoon;
    }

    public function setTelefoon(string $telefoon): self
    {
        $this->telefoon = $telefoon;

        return $this;
    }

    /**
     * @return Collection|Activiteit[]
     */
    public function getActiviteiten(): Collection
    {
        return $this->activiteiten;
    }

    public function addActiviteiten(Activiteit $activiteiten): self
    {
        if (!$this->activiteiten->contains($activiteiten)) {
            $this->activiteiten[] = $activiteiten;
            $activiteiten->addUser($this);
        }

        return $this;
    }

    public function removeActiviteiten(Activiteit $activiteiten): self
    {
        if ($this->activiteiten->removeElement($activiteiten)) {
            $activiteiten->removeUser($this);
        }

        return $this;
    }
}
