<?php

namespace App\Entity;

use App\Repository\ContragentTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;

#[ORM\Entity(repositoryClass: ContragentTypeRepository::class)]
class ContragentType
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\Column(type: "uuid", unique: true)]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private $id;

    #[ORM\Column(type: "string", length: 255)]
    private $cnt_type;

    #[ORM\OneToMany(targetEntity: Contragent::class, mappedBy: "cnt_type")]
    private $contragents;

    public function __construct()
    {
        $this->contragents = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->cnt_type;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCntType(): ?string
    {
        return $this->cnt_type;
    }

    public function setCntType(string $cnt_type): self
    {
        $this->cnt_type = $cnt_type;

        return $this;
    }

    /**
     * @return Collection|Contragent[]
     */
    public function getContragents(): Collection
    {
        return $this->contragents;
    }

    public function addContragent(Contragent $contragent): self
    {
        if (!$this->contragents->contains($contragent)) {
            $this->contragents[] = $contragent;
            $contragent->setCntType($this);
        }

        return $this;
    }

    public function removeContragent(Contragent $contragent): self
    {
        if ($this->contragents->removeElement($contragent)) {
            // set the owning side to null (unless already changed)
            if ($contragent->getCntType() === $this) {
                $contragent->setCntType(null);
            }
        }

        return $this;
    }
}
