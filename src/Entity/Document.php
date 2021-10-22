<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\DocumentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Entity(repositoryClass=DocumentRepository::class)
 */
#[ApiResource(
    collectionOperations:[
        'get'=>['normalization_context' => ['groups' => 'document:list']]
    ],
    itemOperations:[
        'get' => ['normalization_context' => ['groups' => 'document:item']]
    ]
)]
class Document
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     */
    #[Groups(['document:list', 'document:item', 'product'])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    #[Groups(['document:list', 'document:item'])]
    private $doc_num;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    #[Groups(['document:list', 'document:item'])]
    private $doc_date;

    /**
     * @ORM\ManyToOne(targetEntity=Contragent::class, inversedBy="sentDocuments")
     * @ORM\JoinColumn(nullable=false)
     */
    #[Groups(['document:list', 'document:item'])]
    private ?Contragent $cnt_seller;

    /**
     * @ORM\ManyToOne(targetEntity=Contragent::class, inversedBy="receivedDocuments")
     * @ORM\JoinColumn(nullable=false)
     */
    #[Groups(['document:list', 'document:item'])]
    private ?Contragent $cnt_receiver;

    /**
     * @ORM\OneToMany(targetEntity=DocProd::class, mappedBy="document", cascade={"persist"})
     */
    #[Groups(['document:item'])]
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?Uuid
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

    public function getDocDate(): ?\DateTimeImmutable
    {
        return $this->doc_date;
    }

    public function setDocDate(\DateTimeImmutable $doc_date): self
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
