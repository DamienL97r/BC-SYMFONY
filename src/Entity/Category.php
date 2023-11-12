<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource]
#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Article::class)]
    private Collection $categoryName;

    public function __construct()
    {
        $this->categoryName = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getCategoryName(): Collection
    {
        return $this->categoryName;
    }

    public function addCategoryName(Article $categoryName): static
    {
        if (!$this->categoryName->contains($categoryName)) {
            $this->categoryName->add($categoryName);
            $categoryName->setCategory($this);
        }

        return $this;
    }

    public function removeCategoryName(Article $categoryName): static
    {
        if ($this->categoryName->removeElement($categoryName)) {
            // set the owning side to null (unless already changed)
            if ($categoryName->getCategory() === $this) {
                $categoryName->setCategory(null);
            }
        }

        return $this;
    }
}
