<?php

namespace App\Entity;

use App\Repository\PilotRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PilotRepository::class)
 */
class Pilot
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
     * @ORM\Column(type="smallint")
     */
    private $Piloting;

    /**
     * @ORM\Column(type="smallint")
     */
    private $gunnery;

    /**
     * @ORM\ManyToOne(targetEntity=Mecha::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $mecha;

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

    public function getPiloting(): ?int
    {
        return $this->Piloting;
    }

    public function setPiloting(int $Piloting): self
    {
        $this->Piloting = $Piloting;

        return $this;
    }

    public function getGunnery(): ?int
    {
        return $this->gunnery;
    }

    public function setGunnery(int $gunnery): self
    {
        $this->gunnery = $gunnery;

        return $this;
    }

    public function getMecha(): ?Mecha
    {
        return $this->mecha;
    }

    public function setMecha(?Mecha $mecha): self
    {
        $this->mecha = $mecha;

        return $this;
    }
}
