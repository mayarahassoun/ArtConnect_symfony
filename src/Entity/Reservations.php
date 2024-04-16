<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservations
 *
 * @ORM\Table(name="reservations", indexes={@ORM\Index(name="fk", columns={"idev"})})
 * @ORM\Entity
 */
class Reservations
{
    /**
     * @var int
     *
     * @ORM\Column(name="idreserv", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idreserv;

    /**
     * @var int|null
     *
     * @ORM\Column(name="userId", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $userid = NULL;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrP", type="integer", nullable=false)
     */
    private $nbrp;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var int
     *
     * @ORM\Column(name="num", type="integer", nullable=false)
     */
    private $num;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=255, nullable=false)
     */
    private $etat;

    /**
     * @var \Event
     *
     * @ORM\ManyToOne(targetEntity="Event")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idev", referencedColumnName="id")
     * })
     */
    private $idev;


    public function getIdreserv(): ?int
    {
        return $this->idreserv;
    }

    public function getUserid(): ?int
    {
        return $this->userid;
    }

    public function setUserid(?int $userid): self
    {
        $this->userid = $userid;

        return $this;
    }

    public function getNbrp(): ?int
    {
        return $this->nbrp;
    }

    public function setNbrp(int $nbrp): self
    {
        $this->nbrp = $nbrp;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getNum(): ?int
    {
        return $this->num;
    }

    public function setNum(int $num): self
    {
        $this->num = $num;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getIdev(): ?Event
    {
        return $this->idev;
    }

    public function setIdev(?Event $idev): self
    {
        $this->idev = $idev;

        return $this;
    }
}
