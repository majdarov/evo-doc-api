<?php

namespace App\Entity;

use App\Repository\ProductGroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;

/**
 * @ORM\Entity(repositoryClass=ProductGroupRepository::class)
 */
class ProductGroup
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     */
    private $id;

    /**
     * @ORM\Column(type="uuid", nullable=true)
     */
    private $parent_id;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $name;

    /**
     * @ORM\Column(type="simple_array", nullable=true)
     */
    private $barcodes = [];

    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="parent_id")
     */
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParentId()
    {
        return $this->parent_id;
    }

    public function setParentId($parent_id): self
    {
        $this->parent_id = $parent_id;

        return $this;
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

    public function getBarcodes(): ?array
    {
        return $this->barcodes;
    }

    public function setBarcodes(string|array $barcodes): self
    {
        if (is_string($barcodes)){
            $this->barcodes[] = $barcodes;
        } else {
            $this->barcodes = $barcodes;
        }
        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setParentId($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getParentId() === $this) {
                $product->setParentId(null);
            }
        }

        return $this;
    }
}
