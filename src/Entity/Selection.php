<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\SelectionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    operations: [
        new GetCollection(),
        new Get(
            normalizationContext: ['groups' => ['read:Usercollection', 'read:order']]
        ),
        new Post(),
        new Put(),
        new Patch(),
        new Delete(),
    ]
)]
#[ORM\Entity(repositoryClass: SelectionRepository::class)]
class Selection
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read:Usercollection', 'read:user'])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'selections')]
    private ?Article $article = null;

    #[ORM\ManyToOne(inversedBy: 'selections')]
    private ?Service $service = null;

    #[Groups(['read:Usercollection', 'read:user'])]
    #[ORM\ManyToOne(inversedBy: 'selections')]
    private ?User $employee = null;

    #[Groups(['read:Usercollection', 'read:user'])]
    #[ORM\Column(nullable: true)]
    private ?array $jsonOrder = null;

    
    #[ORM\OneToOne(inversedBy: 'selection', cascade: ['persist', 'remove'])]
    private ?Order $OrderId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): static
    {
        $this->article = $article;

        return $this;
    }

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): static
    {
        $this->service = $service;

        return $this;
    }

    public function getEmployee(): ?User
    {
        return $this->employee;
    }

    public function setEmployee(?User $employee): static
    {
        $this->employee = $employee;

        return $this;
    }

    public function getJsonOrder(): ?array
    {
        return $this->jsonOrder;
    }

    public function setJsonOrder(?array $jsonOrder): static
    {
        $this->jsonOrder = $jsonOrder;

        return $this;
    }

    public function getOrderId(): ?Order
    {
        return $this->OrderId;
    }

    public function setOrderId(?Order $OrderId): static
    {
        $this->OrderId = $OrderId;

        return $this;
    }
}
