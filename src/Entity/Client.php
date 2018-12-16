<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 */
class Client
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phone;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Compte", mappedBy="client")
     */
    private $comptes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Pret", mappedBy="client")
     */
    private $prets;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dernierEmploi;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lienDernierEmploi;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Epargne", mappedBy="client")
     */
    private $epargnes;

    public function __construct()
    {
        $this->comptes = new ArrayCollection();
        $this->prets = new ArrayCollection();
        $this->epargnes = new ArrayCollection();
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

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return Collection|Compte[]
     */
    public function getComptes(): Collection
    {
        return $this->comptes;
    }

    public function addCompte(Compte $compte): self
    {
        if (!$this->comptes->contains($compte)) {
            $this->comptes[] = $compte;
            $compte->setClient($this);
        }

        return $this;
    }

    public function removeCompte(Compte $compte): self
    {
        if ($this->comptes->contains($compte)) {
            $this->comptes->removeElement($compte);
            // set the owning side to null (unless already changed)
            if ($compte->getClient() === $this) {
                $compte->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Pret[]
     */
    public function getPrets(): Collection
    {
        return $this->prets;
    }

    public function addPret(Pret $pret): self
    {
        if (!$this->prets->contains($pret)) {
            $this->prets[] = $pret;
            $pret->setClient($this);
        }

        return $this;
    }

    public function removePret(Pret $pret): self
    {
        if ($this->prets->contains($pret)) {
            $this->prets->removeElement($pret);
            // set the owning side to null (unless already changed)
            if ($pret->getClient() === $this) {
                $pret->setClient(null);
            }
        }

        return $this;
    }

    public function getDernierEmploi(): ?string
    {
        return $this->dernierEmploi;
    }

    public function setDernierEmploi(?string $dernierEmploi): self
    {
        $this->dernierEmploi = $dernierEmploi;

        return $this;
    }

    public function getLienDernierEmploi(): ?string
    {
        return $this->lienDernierEmploi;
    }

    public function setLienDernierEmploi(?string $lienDernierEmploi): self
    {
        $this->lienDernierEmploi = $lienDernierEmploi;

        return $this;
    }

    public function hasPretEnCours()
    {
        foreach($this->getPrets() as $monPret)
        {
            if(!$monPret->getTermine()) return true;
        }
        return false;
    }

    /**
     * @return Collection|Epargne[]
     */
    public function getEpargnes(): Collection
    {
        return $this->epargnes;
    }

    public function addEpargne(Epargne $epargne): self
    {
        if (!$this->epargnes->contains($epargne)) {
            $this->epargnes[] = $epargne;
            $epargne->setClient($this);
        }

        return $this;
    }

    public function removeEpargne(Epargne $epargne): self
    {
        if ($this->epargnes->contains($epargne)) {
            $this->epargnes->removeElement($epargne);
            // set the owning side to null (unless already changed)
            if ($epargne->getClient() === $this) {
                $epargne->setClient(null);
            }
        }

        return $this;
    }

    public function hasEpargneEnCours()
    {
        foreach ($this->getEpargnes() as $uneEpargne)
        {
            if(!$uneEpargne->getFinished()) return true;
        }
        return false;
    }
}
