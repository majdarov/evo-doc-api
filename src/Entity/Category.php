<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category extends ProdCat
{
    /**
     * @ORM\OneToMany(targetEntity=ProdCat::class, mappedBy="parent")
     */
    private $members;

    public function __construct()
    {
        parent::__construct();
        $this->members = new ArrayCollection();
    }

    /**
     * @return Collection|ProdCat[]
     */
    public function getMembers(): Collection
    {
        return $this->members;
    }

    public function addMember(Product|Category $member): self
    {
        if (!$this->members->contains($member)) {
            $this->members[] = $member;
            $member->setParent($this);
        }

        return $this;
    }

    public function removeMember(Product $member): self
    {
        if ($this->members->removeElement($member)) {
            // set the owning side to null (unless already changed)
            if ($member->getParent() === $this) {
                $member->setParent(null);
            }
        }

        return $this;
    }
}
