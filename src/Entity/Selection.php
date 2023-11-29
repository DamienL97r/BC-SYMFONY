<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SelectionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource]
#[ORM\Entity(repositoryClass: SelectionRepository::class)]
class Selection
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'selections')]
    private ?Article $article = null;

    #[ORM\ManyToOne(inversedBy: 'selections')]
    private ?Service $service = null;

    #[ORM\ManyToOne(inversedBy: 'selections')]
    private ?User $employee = null;

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
