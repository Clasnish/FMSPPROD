<?php

namespace App\Entity;

use App\Repository\PlanningRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlanningRepository::class)
 */
class Planning
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
     * @ORM\Column(type="integer")
     */
    private $AcademicYear;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Active;

    /**
     * @ORM\OneToMany(targetEntity=File::class, mappedBy="Planning")
     */
    private $Files;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $Modified;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $comment;

    public function __construct()
    {
        $this->Files = new ArrayCollection();
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

    public function getAcademicYear(): ?int
    {
        return $this->AcademicYear;
    }

    public function setAcademicYear(int $AcademicYear): self
    {
        $this->AcademicYear = $AcademicYear;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->Active;
    }

    public function setActive(bool $Active): self
    {
        $this->Active = $Active;

        return $this;
    }

    /**
     * @return Collection<int, File>
     */
    public function getFiles(): Collection
    {
        return $this->Files;
    }

    public function addFile(File $file): self
    {
        if (!$this->Files->contains($file)) {
            $this->Files[] = $file;
            $file->setPlanning($this);
        }

        return $this;
    }

    public function removeFile(File $file): self
    {
        if ($this->Files->removeElement($file)) {
            // set the owning side to null (unless already changed)
            if ($file->getPlanning() === $this) {
                $file->setPlanning(null);
            }
        }

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

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function __toString()
    {
        return $this->Name;
    }

}
