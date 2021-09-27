<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $category_name;

    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="parent")
     */
    private $products;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="categories")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity=Category::class, mappedBy="parent")
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity=Barcode::class, mappedBy="product")
     */
    private $barcodes;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getcategoryName(): ?string
    {
        return $this->category_name;
    }

    public function setcategoryName(string $name): self
    {
        $this->category_name = $name;

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
            $product->setParent($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getParent() === $this) {
                $product->setParent(null);
            }
        }

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategoryF(self $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->setParent($this);
        }

        return $this;
    }

    public function removeCategory(self $category): self
    {
        if ($this->categorys->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getParent() === $this) {
                $category->setParent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Barcode[]
     */
    public function getBarcodes(): Collection
    {
        return $this->barcodes;
    }

    public function addBarcode(Barcode $barcode): self
    {
        if (!$this->barcodes->contains($barcode)) {
            $this->barcodes[] = $barcode;
            $barcode->setProduct($this);
        }

        return $this;
    }

    public function removeBarcode(Barcode $barcode): self
    {
        if ($this->barcodes->removeElement($barcode)) {
            // set the owning side to null (unless already changed)
            if ($barcode->getProduct() === $this) {
                $barcode->setProduct(null);
            }
        }

        return $this;
    }
}
