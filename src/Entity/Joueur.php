<?php

namespace App\Entity;

use App\Repository\JoueurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JoueurRepository::class)
 */
class Joueur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=ListeMecha::class, mappedBy="joueur", orphanRemoval=true)
     */
    private $liste;

    public function __construct()
    {
        $this->liste = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|ListeMecha[]
     */
    public function getListe(): Collection
    {
        return $this->liste;
    }

    public function addListe(ListeMecha $liste): self
    {
        if (!$this->liste->contains($liste)) {
            $this->liste[] = $liste;
            $liste->setJoueur($this);
        }

        return $this;
    }

    public function removeListe(ListeMecha $liste): self
    {
        if ($this->liste->removeElement($liste)) {
            // set the owning side to null (unless already changed)
            if ($liste->getJoueur() === $this) {
                $liste->setJoueur(null);
            }
        }

        return $this;
    }
}
