<?php

namespace App\Entity;

use App\Repository\FacultyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FacultyRepository::class)
 */
class Faculty
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
     * @ORM\Column(type="string", length=255)
     */
    private $Description;

    /**
     * @ORM\Column(type="date")
     */
    private $CreationDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ImageUrl;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $Modified;

    /**
     * @ORM\ManyToMany(targetEntity=Department::class, inversedBy="faculties")
     */
    private $department;

    /**
     * @ORM\Column(type="text")
     */
    private $Content;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="Faculties")
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity=File::class, mappedBy="faculty")
     */
    private $results;


    public function __construct()
    {
        $this->department = new ArrayCollection();
        $this->results = new ArrayCollection();
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

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->CreationDate;
    }

    public function setCreationDate(\DateTimeInterface $CreationDate): self
    {
        $this->CreationDate = $CreationDate;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->ImageUrl;
    }

    public function setImageUrl(?string $ImageUrl): self
    {
        $this->ImageUrl = $ImageUrl;

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

    /**
     * @return Collection<int, Department>
     */
    public function getDepartment(): Collection
    {
        return $this->department;
    }

    public function addDepartment(Department $department): self
    {
        if (!$this->department->contains($department)) {
            $this->department[] = $department;
        }

        return $this;
    }

    public function removeDepartment(Department $department): self
    {
        $this->department->removeElement($department);

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->Content;
    }

    public function setContent(string $Content): self
    {
        $this->Content = $Content;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, File>
     */
    public function getResults(): Collection
    {
        return $this->results;
    }

    public function addResult(File $result): self
    {
        if (!$this->results->contains($result)) {
            $this->results[] = $result;
            $result->setFaculty($this);
        }

        return $this;
    }

    public function removeResult(File $result): self
    {
        if ($this->results->removeElement($result)) {
            // set the owning side to null (unless already changed)
            if ($result->getFaculty() === $this) {
                $result->setFaculty(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->Name;
    }
}
