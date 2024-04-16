<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Partenaire
 *
 * @ORM\Table(name="partenaire")
 * @ORM\Entity
 */
class Partenaire
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=20, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="Type", type="string", length=20, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=1000, nullable=false)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="Numero", type="integer", nullable=false)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="DateDebut", type="string", length=100, nullable=false)
     */
    private $datedebut;

    /**
     * @var string
     *
     * @ORM\Column(name="DateFin", type="string", length=100, nullable=false)
     */
    private $datefin;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): static
    {
        $this->numero = $numero;

        return $this;
    }

    public function getDatedebut(): ?string
    {
        return $this->datedebut;
    }

    public function setDatedebut(string $datedebut): static
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    public function getDatefin(): ?string
    {
        return $this->datefin;
    }

    public function setDatefin(string $datefin): static
    {
        $this->datefin = $datefin;

        return $this;
    }

    public function __toString():string
    {
        return $this->name;
    }



}
