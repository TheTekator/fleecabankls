<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VirementRepository")
 */
class Virement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $montant;

    /**
     * @ORM\Column(type="date")
     */
    private $dateVirement;

    /**
     * @ORM\Column(type="boolean")
     */
    private $valide;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pret", inversedBy="virements")
     */
    private $pret;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDateVirement(): ?\DateTimeInterface
    {
        return $this->dateVirement;
    }

    public function setDateVirement(\DateTimeInterface $dateVirement): self
    {
        $this->dateVirement = $dateVirement;

        return $this;
    }

    public function getValide(): ?bool
    {
        return $this->valide;
    }

    public function setValide(bool $valide): self
    {
        $this->valide = $valide;

        return $this;
    }

    public function getPret(): ?Pret
    {
        return $this->pret;
    }

    public function setPret(?Pret $pret): self
    {
        $this->pret = $pret;

        return $this;
    }

    public function isLate()
    {
        $today = new \DateTime("today");
        if($this->getDateVirement() < $today->modify('-2 years')) return true;
        return false;
    }

    public function isToday()
    {
        $today = new \DateTime("today");
        if($this->getDateVirement() == $today->modify('-2 years')) return true;
        return false;
    }
}
