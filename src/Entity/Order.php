<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Email = null;

    #[ORM\Column]
    private ?int $Total = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $StateSending = null;

    #[ORM\Column]
    private ?int $Quantity = null;

    #[ORM\Column]
    private ?bool $State = null;

    #[ORM\Column(length: 255)]
    private ?string $NameFacturation = null;

    #[ORM\Column(length: 255)]
    private ?string $NameLivraison = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(length: 255)]
    private ?string $Reference = null;

    #[ORM\Column(type: Types::ARRAY)]
    private ?array $Panier = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    private ?User $User = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->Email;
    }

    /**
     * @param string|null $Email
     */
    public function setEmail(?string $Email): void
    {
        $this->Email = $Email;
    }

    /**
     * @return int|null
     */
    public function getTotal(): ?int
    {
        return $this->Total;
    }

    /**
     * @param int|null $Total
     */
    public function setTotal(?int $Total): void
    {
        $this->Total = $Total;
    }

    /**
     * @return string|null
     */
    public function getStateSending(): ?string
    {
        return $this->StateSending;
    }

    /**
     * @param string|null $StateSending
     */
    public function setStateSending(?string $StateSending): void
    {
        $this->StateSending = $StateSending;
    }

    /**
     * @return int|null
     */
    public function getQuantity(): ?int
    {
        return $this->Quantity;
    }

    /**
     * @param int|null $Quantity
     */
    public function setQuantity(?int $Quantity): void
    {
        $this->Quantity = $Quantity;
    }

    /**
     * @return bool|null
     */
    public function getState(): ?bool
    {
        return $this->State;
    }

    /**
     * @param bool|null $State
     */
    public function setState(?bool $State): void
    {
        $this->State = $State;
    }

    /**
     * @return string|null
     */
    public function getNameFacturation(): ?string
    {
        return $this->NameFacturation;
    }

    /**
     * @param string|null $NameFacturation
     */
    public function setNameFacturation(?string $NameFacturation): void
    {
        $this->NameFacturation = $NameFacturation;
    }

    /**
     * @return string|null
     */
    public function getNameLivraison(): ?string
    {
        return $this->NameLivraison;
    }

    /**
     * @param string|null $NameLivraison
     */
    public function setNameLivraison(?string $NameLivraison): void
    {
        $this->NameLivraison = $NameLivraison;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeImmutable|null $createdAt
     */
    public function setCreatedAt(?\DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string|null
     */
    public function getReference(): ?string
    {
        return $this->Reference;
    }

    /**
     * @param string|null $Reference
     */
    public function setReference(?string $Reference): void
    {
        $this->Reference = $Reference;
    }

    /**
     * @return string|null
     */
    public function getPanier(): ?array
    {
        return $this->Panier;
    }

    /**
     * @param string|null $Panier
     */
    public function setPanier(?array $Panier): void
    {
        $this->Panier = $Panier;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->User;
    }

    /**
     * @param User|null $User
     */
    public function setUser(?User $User): void
    {
        $this->User = $User;
    }

    /**
     * @return string|null
     */
    public function getAadresseLivraison(): ?string
    {
        return $this->AadresseLivraison;
    }

    /**
     * @param string|null $AadresseLivraison
     */
    public function setAadresseLivraison(?string $AadresseLivraison): void
    {
        $this->AadresseLivraison = $AadresseLivraison;
    }

    /**
     * @return string|null
     */
    public function getAadresseFacturation(): ?string
    {
        return $this->AadresseFacturation;
    }

    /**
     * @param string|null $AadresseFacturation
     */
    public function setAadresseFacturation(?string $AadresseFacturation): void
    {
        $this->AadresseFacturation = $AadresseFacturation;
    }

    #[ORM\Column(length: 255)]
    private ?string $AadresseLivraison = null;

    #[ORM\Column(length: 255)]
    private ?string $AadresseFacturation = null;
}

