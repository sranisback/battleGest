<?php

namespace App\Entity;

use App\Repository\ListeMechaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ListeMechaRepository::class)
 */
class ListeMecha
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Joueur::class, inversedBy="liste")
     * @ORM\JoinColumn(nullable=false)
     */
    private $joueur;

    /**
     * @ORM\ManyToMany(targetEntity=Mecha::class)
     */
    private $mech;

    public function __construct()
    {
        $this->mech = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJoueur(): ?Joueur
    {
        return $this->joueur;
    }

    public function setJoueur(?Joueur $joueur): self
    {
        $this->joueur = $joueur;

        return $this;
    }

    /**
     * @return Collection|Mecha[]
     */
    public function getMech(): Collection
    {
        return $this->mech;
    }

    public function addMech(Mecha $mech): self
    {
        if (!$this->mech->contains($mech)) {
            $this->mech[] = $mech;
        }

        return $this;
    }

    public function removeMech(Mecha $mech): self
    {
        $this->mech->removeElement($mech);

        return $this;
    }
}
