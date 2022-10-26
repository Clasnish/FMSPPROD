<?php

namespace App\Entity;

use App\Repository\AdmissionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=AdmissionRepository::class)
 * @Vich\Uploadable
 */
class Admission
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
    private $session;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $communicated;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $Modified;

    /**
     * @ORM\OneToMany(targetEntity=Result::class, mappedBy="admission", orphanRemoval=true)
     */
    private $result;

    /**
     * @ORM\OneToMany(targetEntity=File::class, mappedBy="admission")
     */
    private $files;

    /**
     * @Vich\UploadableField(mapping="user_contracts", fileNameProperty="contract")
     * @var File
     */
    private $communicatedFile;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $active;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $inscription;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $TypeExam;

    public function __construct()
    {
        $this->result = new ArrayCollection();
        $this->files = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSession(): ?string
    {
        return $this->session;
    }

    public function setSession(string $session): self
    {
        $this->session = $session;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCommunicated(): ?string
    {
        return $this->communicated;
    }

    public function setCommunicated(?string $communicated): self
    {
        $this->communicated = $communicated;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

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

    /**
     * @return Collection<int, Result>
     */
    public function getResult(): Collection
    {
        return $this->result;
    }

    public function addResult(Result $result): self
    {
        if (!$this->result->contains($result)) {
            $this->result[] = $result;
            $result->setAdmission($this);
        }

        return $this;
    }

    public function removeResult(Result $result): self
    {
        if ($this->result->removeElement($result)) {
            // set the owning side to null (unless already changed)
            if ($result->getAdmission() === $this) {
                $result->setAdmission(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, File>
     */
    public function getFiles(): Collection
    {
        return $this->files;
    }

    public function addFile(File $file): self
    {
        if (!$this->files->contains($file)) {
            $this->files[] = $file;
            $file->setAdmission($this);
        }

        return $this;
    }

    public function removeFile(File $file): self
    {
        if ($this->files->removeElement($file)) {
            // set the owning side to null (unless already changed)
            if ($file->getAdmission() === $this) {
                $file->setAdmission(null);
            }
        }

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(?bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function __toString()
    {
        return $this->session;
    }

    public function getInscription(): ?string
    {
        return $this->inscription;
    }

    public function setInscription(?string $inscription): self
    {
        $this->inscription = $inscription;

        return $this;
    }

    public function getTypeExam(): ?string
    {
        return $this->TypeExam;
    }

    public function setTypeExam(string $TypeExam): self
    {
        $this->TypeExam = $TypeExam;

        return $this;
    }
}
