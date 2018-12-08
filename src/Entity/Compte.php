<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompteRepository")
 */
class Compte
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
    private $number;

    /**
     * @ORM\Column(type="boolean")
     */
    private $open;

    /**
     * @ORM\Column(type="date")
     */
    private $dateOuverture;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\GenreCompte", inversedBy="comptes", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $genreCompte;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="comptes", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\Column(type="integer")
     */
    private $fraisOuverture;

    /**
     * @ORM\Column(type="integer")
     */
    private $fraisTenue;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getOpen(): ?bool
    {
        return $this->open;
    }

    public function setOpen(bool $open): self
    {
        $this->open = $open;

        return $this;
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

    public function getGenreCompte(): ?GenreCompte
    {
        return $this->genreCompte;
    }

    public function setGenreCompte(?GenreCompte $genreCompte): self
    {
        $this->genreCompte = $genreCompte;

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

    public function getFraisOuverture(): ?int
    {
        return $this->fraisOuverture;
    }

    public function setFraisOuverture(int $fraisOuverture): self
    {
        $this->fraisOuverture = $fraisOuverture;

        return $this;
    }

    public function getFraisTenue(): ?int
    {
        return $this->fraisTenue;
    }

    public function setFraisTenue(int $fraisTenue): self
    {
        $this->fraisTenue = $fraisTenue;

        return $this;
    }
}
