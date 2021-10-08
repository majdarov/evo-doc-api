<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\ProdCat;
use App\Lib\ProductInterface;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
#[ApiResource()]
class Product extends ProdCat implements ProductInterface
{
    /**
     * @ORM\Column(type="string", length=10)
     */
    #[Assert\Choice(choices: self::MEASURE_NAMES, message: 'Choose one from ')]
    private $measure_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Assert\Choice(choices: self::TAXES, message: 'Choose one from ')]
    private $tax;

    /**
     * @ORM\Column(type="string", length=128)
     */
    #[Assert\Choice(choices: self::TYPES, message: 'Choose one from ')]
    private $product_type;

    /**
     * @ORM\Column(type="float")
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
     * @ORM\OneToMany(targetEntity=DocProd::class, mappedBy="product")
     */
    private $documents;

    public function __construct()
    {
        parent::__construct();
        $this->setMeasureName();
        $this->setTax();
        $this->setProductType();
        $this->documents = new ArrayCollection();
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
        if (in_array($tax, self::TAXES)) {
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

    /**
     * @return Collection|DocProd[]
     */
    public function getDocuments(): Collection
    {
        return $this->documents;
    }

    public function addDocument(DocProd $document): self
    {
        if (!$this->documents->contains($document)) {
            $this->documents[] = $document;
            $document->setProduct($this);
        }

        return $this;
    }

    public function removeDocument(DocProd $document): self
    {
        if ($this->documents->removeElement($document)) {
            // set the owning side to null (unless already changed)
            if ($document->getProduct() === $this) {
                $document->setProduct(null);
            }
        }

        return $this;
    }
}
