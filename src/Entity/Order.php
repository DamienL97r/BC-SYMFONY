<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
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
        new Put(),
        new Patch(),
        new Delete(),
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

    #[Groups(['read:Ordercollection', 'read:order'])]
    #[ORM\Column(nullable: true)]
    private ?array $selectionJson = null;

    #[Groups(['read:Ordercollection', 'read:order'])]
    #[ORM\Column(nullable: true)]
    private ?bool $isAssigned = null;

    #[Groups(['read:Ordercollection', 'read:order'])]
    #[ORM\Column(nullable: true)]
    private ?bool $isDone = null;

    #[ORM\OneToOne(mappedBy: 'OrderId', cascade: ['persist', 'remove'])]
    private ?Selection $selection = null;


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

    public function getSelectionJson(): ?array
    {
        return $this->selectionJson;
    }

    public function setSelectionJson(?array $selectionJson): static
    {
        $this->selectionJson = $selectionJson;

        return $this;
    }

    public function isIsAssigned(): ?bool
    {
        return $this->isAssigned;
    }

    public function setIsAssigned(?bool $isAssigned): static
    {
        $this->isAssigned = $isAssigned;

        return $this;
    }

    public function isIsDone(): ?bool
    {
        return $this->isDone;
    }

    public function setIsDone(?bool $isDone): static
    {
        $this->isDone = $isDone;

        return $this;
    }

    public function getSelection(): ?Selection
    {
        return $this->selection;
    }

    public function setSelection(?Selection $selection): static
    {
        // unset the owning side of the relation if necessary
        if ($selection === null && $this->selection !== null) {
            $this->selection->setOrderId(null);
        }

        // set the owning side of the relation if necessary
        if ($selection !== null && $selection->getOrderId() !== $this) {
            $selection->setOrderId($this);
        }

        $this->selection = $selection;

        return $this;
    }


}
