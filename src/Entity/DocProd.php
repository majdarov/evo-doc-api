<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use App\Repository\DocProdRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=DocProdRepository::class)
 */
class DocProd
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Document::class, inversedBy="products", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    #[Groups(['product'])]
    #[ApiProperty(writableLink: \false, readableLink: \false)]
    private $document;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="documents", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    #[Groups(['document:item'])]
    private $product;

    /**
     * @ORM\Column(type="float")
     */
    #[Groups(['document:item'])]
    private $price;

    /**
     * @ORM\Column(type="float")
     */
    #[Groups(['document:item'])]
    private $amount;

    public function getDocument(): ?Document
    {
        return $this->document;
    }

    public function setDocument(?Document $document): self
    {
        $this->document = $document;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }
}
