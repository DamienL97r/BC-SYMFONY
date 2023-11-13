<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Repository\OrderRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    operations: [
        new GetCollection(),
        new Get(
            normalizationContext: ['groups' => ['read:Ordercollection', 'read:user']]
        ),
        new Post(),
    ]
)]

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read:Ordercollection', 'read:order'])]
    private ?int $id = null;

    #[Groups(['read:Ordercollection', 'read:order'])]
    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $createdDate = null;

    #[Groups(['read:Ordercollection', 'read:order'])]
    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $depositDate = null;

    #[Groups(['read:Ordercollection', 'read:order'])]
    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $retrievalDate = null;

    #[Groups(['read:Ordercollection', 'read:order'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $paymentType = null;

    #[Groups(['read:Ordercollection', 'read:order'])]
    #[ORM\Column(nullable: true)]
    private ?float $totalPrice = null;

    #[Groups(['read:Ordercollection', 'read:order'])]
    #[ORM\ManyToOne(inversedBy: 'orders')]
    private ?User $userId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->createdDate;
    }

    public function setCreatedDate(?\DateTimeInterface $createdDate): static
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    public function getDepositDate(): ?\DateTimeInterface
    {
        return $this->depositDate;
    }

    public function setDepositDate(?\DateTimeInterface $depositDate): static
    {
        $this->depositDate = $depositDate;

        return $this;
    }

    public function getRetrievalDate(): ?\DateTimeInterface
    {
        return $this->retrievalDate;
    }

    public function setRetrievalDate(?\DateTimeInterface $retrievalDate): static
    {
        $this->retrievalDate = $retrievalDate;

        return $this;
    }

    public function getPaymentType(): ?string
    {
        return $this->paymentType;
    }

    public function setPaymentType(?string $paymentType): static
    {
        $this->paymentType = $paymentType;

        return $this;
    }

    public function getTotalPrice(): ?float
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(?float $totalPrice): static
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(?User $userId): static
    {
        $this->userId = $userId;

        return $this;
    }
}
