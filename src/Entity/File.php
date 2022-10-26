<?php

namespace App\Entity;

use App\Repository\FileRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FileRepository::class)
 */
class File
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
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Comment;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $Modified;

    /**
     * @ORM\ManyToOne(targetEntity=Admission::class, inversedBy="files")
     */
    private $admission;

    /**
     * @ORM\ManyToOne(targetEntity=Result::class, inversedBy="files")
     */
    private $result;

    /**
     * @ORM\ManyToOne(targetEntity=Faculty::class, inversedBy="files")
     */
    private $faculty;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $Resultat;

    /**
     * @ORM\ManyToOne(targetEntity=Planning::class, inversedBy="Files")
     */
    private $Planning;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $DocumentType;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Autor;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $AUtorEmail;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $AutorPhone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $DocumentURL;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $DocumentTitle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->Comment;
    }

    public function setComment(?string $Comment): self
    {
        $this->Comment = $Comment;

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

    public function getAdmission(): ?Admission
    {
        return $this->admission;
    }

    public function setAdmission(?Admission $admission): self
    {
        $this->admission = $admission;

        return $this;
    }

    public function getResult(): ?Result
    {
        return $this->result;
    }

    public function setResult(?Result $result): self
    {
        $this->result = $result;

        return $this;
    }

    public function getFaculty(): ?Faculty
    {
        return $this->faculty;
    }

    public function setFaculty(?Faculty $faculty): self
    {
        $this->faculty = $faculty;

        return $this;
    }

    public function isResultat(): ?bool
    {
        return $this->Resultat;
    }

    public function setResultat(?bool $Resultat): self
    {
        $this->Resultat = $Resultat;

        return $this;
    }

    public function getPlanning(): ?Planning
    {
        return $this->Planning;
    }

    public function setPlanning(?Planning $Planning): self
    {
        $this->Planning = $Planning;

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

    public function getDocumentType(): ?string
    {
        return $this->DocumentType;
    }

    public function setDocumentType(?string $DocumentType): self
    {
        $this->DocumentType = $DocumentType;

        return $this;
    }

    public function getAutor(): ?string
    {
        return $this->Autor;
    }

    public function setAutor(string $Autor): self
    {
        $this->Autor = $Autor;

        return $this;
    }

    public function getAUtorEmail(): ?string
    {
        return $this->AUtorEmail;
    }

    public function setAUtorEmail(?string $AUtorEmail): self
    {
        $this->AUtorEmail = $AUtorEmail;

        return $this;
    }

    public function getAutorPhone(): ?string
    {
        return $this->AutorPhone;
    }

    public function setAutorPhone(?string $AutorPhone): self
    {
        $this->AutorPhone = $AutorPhone;

        return $this;
    }

    public function getDocumentURL(): ?string
    {
        return $this->DocumentURL;
    }

    public function setDocumentURL(?string $DocumentURL): self
    {
        $this->DocumentURL = $DocumentURL;

        return $this;
    }

    public function getDocumentTitle(): ?string
    {
        return $this->DocumentTitle;
    }

    public function setDocumentTitle(?string $DocumentTitle): self
    {
        $this->DocumentTitle = $DocumentTitle;

        return $this;
    }
}
