<?php

namespace App\Entity;

use App\Repository\LaboratoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LaboratoryRepository::class)
 */
class Laboratory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $Modified;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ImageUrl;

    /**
     * @ORM\OneToMany(targetEntity=Gallery::class, mappedBy="laboratory")
     */
    private $galleries;

    public function __construct()
    {
        $this->galleries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->Created;
    }

    public function setCreated(\DateTimeInterface $Created): self
    {
        $this->Created = $Created;

        return $this;
    }

    public function getModified(): ?\DateTimeInterface
    {
        return $this->Modified;
    }

    public function setModified(?\DateTimeInterface $Modified): self
    {
        $this->Modified = $Modified;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->ImageUrl;
    }

    public function setImageUrl(string $ImageUrl): self
    {
        $this->ImageUrl = $ImageUrl;

        return $this;
    }

    /**
     * @return Collection<int, Gallery>
     */
    public function getGalleries(): Collection
    {
        return $this->galleries;
    }

    public function addGallery(Gallery $gallery): self
    {
        if (!$this->galleries->contains($gallery)) {
            $this->galleries[] = $gallery;
            $gallery->setLaboratory($this);
        }

        return $this;
    }

    public function removeGallery(Gallery $gallery): self
    {
        if ($this->galleries->removeElement($gallery)) {
            // set the owning side to null (unless already changed)
            if ($gallery->getLaboratory() === $this) {
                $gallery->setLaboratory(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return $this->Name; // Remplacer champ par une propriété "string" de l'entité
    }
}
