<?php

namespace App\Entity;

use App\Repository\SoortactiviteitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SoortactiviteitRepository::class)
 */
class Soortactiviteit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $naam;

    /**
     * @ORM\Column(type="integer")
     */
    private $minLeeftijd;

    /**
     * @ORM\Column(type="integer")
     */
    private $tijdsduur;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $prijs;

    /**
     * @ORM\OneToMany(targetEntity=Activiteit::class, mappedBy="soort")
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

    public function getNaam(): ?string
    {
        return $this->naam;
    }

    public function setNaam(string $naam): self
    {
        $this->naam = $naam;

        return $this;
    }

    public function getMinLeeftijd(): ?int
    {
        return $this->minLeeftijd;
    }

    public function setMinLeeftijd(int $minLeeftijd): self
    {
        $this->minLeeftijd = $minLeeftijd;

        return $this;
    }

    public function getTijdsduur(): ?int
    {
        return $this->tijdsduur;
    }

    public function setTijdsduur(int $tijdsduur): self
    {
        $this->tijdsduur = $tijdsduur;

        return $this;
    }

    public function getPrijs(): ?string
    {
        return $this->prijs;
    }

    public function setPrijs(string $prijs): self
    {
        $this->prijs = $prijs;

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
            $activiteiten->setSoort($this);
        }

        return $this;
    }

    public function removeActiviteiten(Activiteit $activiteiten): self
    {
        if ($this->activiteiten->removeElement($activiteiten)) {
            // set the owning side to null (unless already changed)
            if ($activiteiten->getSoort() === $this) {
                $activiteiten->setSoort(null);
            }
        }

        return $this;
    }
}
