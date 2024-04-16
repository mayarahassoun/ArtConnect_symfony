<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity
 */
class Event
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
     * @Assert\NotBlank(message="Le nom de l'événement ne peut pas être vide")
     * @Assert\Length(max=255, maxMessage="Le nom de l'événement ne peut pas dépasser {{ limit }} caractères")
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     */
    private $type;

     /**
     * @var \DateTime
     *
     * @Assert\NotBlank(message="La date de l'événement ne peut pas être vide")
     * @Assert\GreaterThan("today", message="La date de l'événement doit être ultérieure à aujourd'hui")
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="eventpath", type="string", length=255, nullable=false)
     */
    private $eventpath;

    /**
     * @var string
     *
     * @ORM\Column(name="localisation", type="string", length=255, nullable=false)
     */
    private $localisation;

/**
 * @var int
 *
 * @Assert\NotBlank(message="Le nombre de participants ne peut pas être vide")
 * @Assert\GreaterThan(value=0, message="Le nombre de participants doit être supérieur à zéro")
 * @Assert\LessThanOrEqual(value=5, message="Le nombre de participants ne peut pas dépasser 5")
 * @ORM\Column(name="nombre_P", type="integer", nullable=false)
 */

    private $nombreP;

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float", precision=10, scale=0, nullable=false)
     */
    private $latitude;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float", precision=10, scale=0, nullable=false)
     */
    private $longitude;
    // Getters and Setters for properties

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getEventpath(): ?string
    {
        return $this->eventpath;
    }

    public function setEventpath(string $eventpath): self
    {
        $this->eventpath = $eventpath;
        return $this;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): self
    {
        $this->localisation = $localisation;
        return $this;
    }

    public function getNombreP(): ?int
    {
        return $this->nombreP;
    }

    public function setNombreP(int $nombreP): self
    {
        $this->nombreP = $nombreP;
        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;
        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;
        return $this;
    }

    public function __toString():string
    {
        return $this->id;
    }
}