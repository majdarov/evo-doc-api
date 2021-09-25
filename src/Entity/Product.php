<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use App\Lib\ProductInterface;
use App\Lib\TraitBarcode;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product implements ProductInterface
{
    use TraitBarcode;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $product_name;

    /**
     * @ORM\Column(type="integer")
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $measure_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tax;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $product_type;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="boolean")
     */
    private $allow_to_sell;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $article_number;

    /**
     * @ORM\Column(type="float")
     */
    private $cost_price;

    /**
     * @ORM\Column(type="float")
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity=ProductGroup::class, inversedBy="products")
     */
    private $parent_id;

    /**
     * @ORM\OneToMany(targetEntity=Barcode::class, mappedBy="product", orphanRemoval=true)
     */
    private $barcodes;

    public function __construct()
    {
        $this->setMeasureName();
        $this->setTax();
        $this->setProductType();
        $this->barcodes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductName(): ?string
    {
        return $this->product_name;
    }

    public function setProductName(string $product_name): self
    {
        $this->product_name = $product_name;

        return $this;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getMeasureName()
    {
        return $this->measure_name;
    }

    public function setMeasureName(string $measureName = self::MEASURE_NAMES[0]): self
    {
        if (in_array($measureName, self::MEASURE_NAMES)) {
            $this->measure_name = $measureName;
        } else {
            $this->measure_name = self::MEASURE_NAMES[0];
        }

        return $this;
    }

    public function getTax(): ?string
    {
        return $this->tax;
    }

    public function setTax(string $tax = self::TAXES[0]): self
    {
        if (in_array($tax, self::TAXES)){
            $this->tax = $tax;
        } else {
            $this->tax = self::TAXES[0];
        }
        return $this;
    }

    public function getProductType(): ?string
    {
        return $this->product_type;
    }

    public function setProductType(string $product_type = self::TYPES[0]): self
    {
        if (in_array($product_type, self::TYPES)) {
            $this->product_type = $product_type;
        } else {
            $this->product_type = self::TYPES[0];
        }

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getAllowToSell(): ?bool
    {
        return $this->allow_to_sell;
    }

    public function setAllowToSell(bool $allow_to_sell): self
    {
        $this->allow_to_sell = $allow_to_sell;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getArticleNumber(): ?string
    {
        return $this->article_number;
    }

    public function setArticleNumber(?string $article_number): self
    {
        $this->article_number = $article_number;

        return $this;
    }

    public function getCostPrice(): ?float
    {
        return $this->cost_price;
    }

    public function setCostPrice(float $cost_price): self
    {
        $this->cost_price = $cost_price;

        return $this;
    }

    public function getQuantity(): ?float
    {
        return $this->quantity;
    }

    public function setQuantity(float $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getParentId(): ?ProductGroup
    {
        return $this->parent_id;
    }

    public function setParentId(?ProductGroup $parent_id): self
    {
        $this->parent_id = $parent_id;

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
