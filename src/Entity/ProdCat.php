<?php

namespace App\Entity;

use App\Lib\BarcodeTrait;
use App\Repository\ProdCatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;

/**
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name = "discr", type = "string")
 * @ORM\DiscriminatorMap({"prod" = "Product", "cat" = "Category"})
 * @ORM\Entity(repositoryClass=ProdCatRepository::class)
 */
class ProdCat
{
   use BarcodeTrait;

   /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="CUSTOM")
    * @ORM\Column(type="uuid", unique=true)
    * @ORM\CustomIdGenerator(class=UuidGenerator::class)
    */
   protected $id;

   /**
    * @ORM\Column(type="string", length=255)
    */
   protected $instance_name;

   /**
    * @ORM\Column(type="integer")
    */
   protected $code;

   /**
    * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="members", cascade={"persist"})
    */
   protected $parent;

   /**
    * @ORM\OneToMany(targetEntity=Barcode::class, mappedBy="instance", orphanRemoval=true, cascade={"persist", "remove", "merge"})
    */
   protected $barcodes;

   public function __construct()
   {
      $this->barcodes = new ArrayCollection();
   }

   public function getId(): ?string
   {
      return $this->id;
   }

   public function getName(): ?string
   {
      return $this->instance_name;
   }

   public function setName(string $instance_name): self
   {
      $this->instance_name = $instance_name;

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

   public function getParent(): ?Category
   {
      return $this->parent;
   }

   public function setParent(?Category $parent): self
   {
      $this->parent = $parent;

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
         $barcode->setInstance($this);
      }

      return $this;
   }

   public function removeBarcode(Barcode $barcode): self
   {
      if ($this->barcodes->removeElement($barcode)) {
         // set the owning side to null (unless already changed)
         if ($barcode->getInstance() === $this) {
            $barcode->setInstance(null);
         }
      }

      return $this;
   }
}
