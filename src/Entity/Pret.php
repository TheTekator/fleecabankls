<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PretRepository")
 */
class Pret
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateOuverture;

    /**
     * @ORM\Column(type="integer")
     */
    private $montant;

    /**
     * @ORM\Column(type="float")
     */
    private $interet;

    /**
     * @ORM\Column(type="integer")
     */
    private $duree;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="prets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\Column(type="boolean")
     */
    private $termine;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $raison;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Virement", mappedBy="pret")
     */
    private $virements;

    public function __construct()
    {
        $today = new \DateTime();
        $today->sub(new \DateInterval("P2Y"));
        $this->dateOuverture = $today;
        $this->virements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateOuverture(): ?\DateTimeInterface
    {
        return $this->dateOuverture;
    }

    public function setDateOuverture(\DateTimeInterface $dateOuverture): self
    {
        $this->dateOuverture = $dateOuverture;

        return $this;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(int $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getInteret(): ?float
    {
        return $this->interet;
    }

    public function setInteret(float $interet): self
    {
        $this->interet = $interet;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getTermine(): ?bool
    {
        return $this->termine;
    }

    public function setTermine(bool $termine): self
    {
        $this->termine = $termine;

        return $this;
    }

    public function getRaison(): ?string
    {
        return $this->raison;
    }

    public function setRaison(string $raison): self
    {
        $this->raison = $raison;

        return $this;
    }

    /**
     * @return Collection|Virement[]
     */
    public function getVirements(): Collection
    {
        return $this->virements;
    }

    public function addVirement(Virement $virement): self
    {
        if (!$this->virements->contains($virement)) {
            $this->virements[] = $virement;
            $virement->setPret($this);
        }

        return $this;
    }

    public function removeVirement(Virement $virement): self
    {
        if ($this->virements->contains($virement)) {
            $this->virements->removeElement($virement);
            // set the owning side to null (unless already changed)
            if ($virement->getPret() === $this) {
                $virement->setPret(null);
            }
        }

        return $this;
    }

    public function isLate()
    {
        foreach($this->getVirements() as $monVirement)
        {
            if($monVirement->isLate()) return true;
        }

        return false;
    }

    public function isToday()
    {
        foreach($this->getVirements() as $monVirement)
        {
            if($monVirement->isLate()) return false;
            elseif($monVirement->isToday()) return true;
        }

        return false;
    }
}
