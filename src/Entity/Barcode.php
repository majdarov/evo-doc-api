<?php

namespace App\Entity;

use App\Repository\BarcodeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BarcodeRepository::class)
 */
class Barcode
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=255, unique=true, nullable=false)
     */
    private $barcode;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Product::class|Category::class, inversedBy="barcodes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $instance;

    public function getBarcode(): ?string
    {
        return $this->barcode;
    }

    public function setBarcode(string $barcode): self
    {
        $this->barcode = $barcode;

        return $this;
    }

    public function getInstance(): Product|Category
    {
        return $this->instance;
    }

    public function setInstance(Product|Category|null $instance): self
    {
        $this->product = $instance;

        return $this;
    }
}
