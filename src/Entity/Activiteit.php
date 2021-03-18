<?php

namespace App\Entity;

use App\Repository\ActiviteitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActiviteitRepository::class)
 */
class Activiteit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $datum;

    /**
     * @ORM\Column(type="time")
     */
    private $tijd;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="activiteiten")
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity=Soortactiviteit::class, inversedBy="activiteiten")
     */
    private $soort;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatum(): ?\DateTimeInterface
    {
        return $this->datum;
    }

    public function setDatum(\DateTimeInterface $datum): self
    {
        $this->datum = $datum;

        return $this;
    }

    public function getTijd(): ?\DateTimeInterface
    {
        return $this->tijd;
    }

    public function setTijd(\DateTimeInterface $tijd): self
    {
        $this->tijd = $tijd;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        $this->users->removeElement($user);

        return $this;
    }

    public function getSoort(): ?Soortactiviteit
    {
        return $this->soort;
    }

    public function setSoort(?Soortactiviteit $soort): self
    {
        $this->soort = $soort;

        return $this;
    }
}
