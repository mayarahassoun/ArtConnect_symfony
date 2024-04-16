<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\EntrepriseRepository;

/**
 * @ORM\Entity(repositoryClass=EntrepriseRepository::class)
 */
class Entreprise
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Le nom ne peut pas être vide")
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @Assert\NotBlank(message="L'adresse ne peut pas être vide")
     * @Assert\Length(max=10, maxMessage="L'adresse ne doit pas dépasser {{ limit }} caractères")
     * @Assert\Regex(
     *     pattern="/^[A-Z]/",
     *     message="L'adresse doit commencer par une majuscule"
     * )
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @Assert\NotBlank(message="Le contact ne peut pas être vide")
     * @Assert\Email(message="L'adresse email '{{ value }}' n'est pas valide.")
     * @ORM\Column(type="string", length=255)
     */
    private $contact;

    // Getters and setters...
    
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(string $contact): self
    {
        $this->contact = $contact;

        return $this;
    }
    public function __toString()
{
    return $this->nom;
}

}
