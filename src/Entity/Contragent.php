<?php

namespace App\Entity;

use App\Repository\ContragentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;

/**
 * @ORM\Entity(repositoryClass=ContragentRepository::class)
 */
class Contragent
{
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
    private $cnt_name;

    /**
     * @ORM\ManyToOne(targetEntity=ContragentType::class, inversedBy="contragents")
     */
    private $cnt_type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cnt_info;

    /**
     * @ORM\OneToMany(targetEntity=Document::class, mappedBy="cnt_seller")
     */
    private $sentDocuments;

    /**
     * @ORM\OneToMany(targetEntity=Document::class, mappedBy="cnt_receiver")
     */
    private $receivedDocuments;

    public function __construct()
    {
        $this->sentDocuments = new ArrayCollection();
        $this->receivedDocuments = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->id.' -> '.$this->cnt_name.' - '.$this->cnt_type->getCntType();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getCntName(): ?string
    {
        return $this->cnt_name;
    }

    public function setCntName(string $cnt_name): self
    {
        $this->cnt_name = $cnt_name;

        return $this;
    }

    public function getCntType(): ?ContragentType
    {
        return $this->cnt_type;
    }

    public function getCntTypeString(): string
    {
        return $this->cnt_type->getCntType();
    }

    public function setCntType(?ContragentType $cnt_type): self
    {
        $this->cnt_type = $cnt_type;

        return $this;
    }

    public function getCntInfo(): ?string
    {
        return $this->cnt_info;
    }

    public function setCntInfo(?string $cnt_info): self
    {
        $this->cnt_info = $cnt_info;

        return $this;
    }

    /**
     * @return Collection|Document[]
     */
    public function getSentDocuments(): Collection
    {
        return $this->sentDocuments;
    }

    public function addSentDocument(Document $sentDocument): self
    {
        if (!$this->sentDocuments->contains($sentDocument)) {
            $this->sentDocuments[] = $sentDocument;
            $sentDocument->setCntSeller($this);
        }

        return $this;
    }

    public function removeSentDocument(Document $sentDocument): self
    {
        if ($this->sentDocuments->removeElement($sentDocument)) {
            // set the owning side to null (unless already changed)
            if ($sentDocument->getCntSeller() === $this) {
                $sentDocument->setCntSeller(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Document[]
     */
    public function getReceivedDocuments(): Collection
    {
        return $this->receivedDocuments;
    }

    public function addReceivedDocument(Document $receivedDocument): self
    {
        if (!$this->receivedDocuments->contains($receivedDocument)) {
            $this->receivedDocuments[] = $receivedDocument;
            $receivedDocument->setCntReceiver($this);
        }

        return $this;
    }

    public function removeReceivedDocument(Document $receivedDocument): self
    {
        if ($this->receivedDocuments->removeElement($receivedDocument)) {
            // set the owning side to null (unless already changed)
            if ($receivedDocument->getCntReceiver() === $this) {
                $receivedDocument->setCntReceiver(null);
            }
        }

        return $this;
    }

}
