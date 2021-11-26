<?php

namespace App\Entity;

use App\Repository\DocumentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;

#[ORM\Entity(repositoryClass: DocumentRepository::class)]
class Document
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\Column(type: 'uuid', unique: \true)]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: \true)]
    private $doc_num;

    #[ORM\Column(type: 'date')]
    private $doc_date;

    #[ORM\ManyToOne(targetEntity: Contragent::class, inversedBy: 'sentDocuments')]
    private $cnt_seller;

    #[ORM\ManyToOne(targetEntity: Contragent::class, inversedBy: 'receivedDocuments')]
    private $cnt_receiver;

    #[ORM\OneToMany(targetEntity: DocProd::class, mappedBy: 'document')]
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDocNum(): ?string
    {
        return $this->doc_num;
    }

    public function setDocNum(?string $doc_num): self
    {
        $this->doc_num = $doc_num;

        return $this;
    }

    public function getDocDate(): ?\DateTimeInterface
    {
        return $this->doc_date;
    }

    public function setDocDate(\DateTimeInterface $doc_date): self
    {
        $this->doc_date = $doc_date;

        return $this;
    }

    public function getCntSeller(): ?Contragent
    {
        return $this->cnt_seller;
    }

    public function setCntSeller(?Contragent $cnt_seller): self
    {
        $this->cnt_seller = $cnt_seller;

        return $this;
    }

    public function getCntReceiver(): ?Contragent
    {
        return $this->cnt_receiver;
    }

    public function setCntReceiver(?Contragent $cnt_receiver): self
    {
        $this->cnt_receiver = $cnt_receiver;

        return $this;
    }

    /**
     * @return Collection|DocProd[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(DocProd $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setDocument($this);
        }

        return $this;
    }

    public function removeProduct(DocProd $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getDocument() === $this) {
                $product->setDocument(null);
            }
        }

        return $this;
    }
}
