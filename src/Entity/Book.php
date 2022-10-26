<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookRepository::class)
 */
class Book
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
    private $Title;

    /**
     * @ORM\Column(type="text")
     */
    private $Description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Author;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Publishing;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $ReleaseDate;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $BookType;

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
     * @ORM\ManyToOne(targetEntity=Library::class, inversedBy="books")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Library;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

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

    public function getAuthor(): ?string
    {
        return $this->Author;
    }

    public function setAuthor(?string $Author): self
    {
        $this->Author = $Author;

        return $this;
    }

    public function getPublishing(): ?string
    {
        return $this->Publishing;
    }

    public function setPublishing(?string $Publishing): self
    {
        $this->Publishing = $Publishing;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->ReleaseDate;
    }

    public function setReleaseDate(?\DateTimeInterface $ReleaseDate): self
    {
        $this->ReleaseDate = $ReleaseDate;

        return $this;
    }

    public function isBookType(): ?bool
    {
        return $this->BookType;
    }

    public function setBookType(?bool $BookType): self
    {
        $this->BookType = $BookType;

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

    public function getLibrary(): ?Library
    {
        return $this->Library;
    }

    public function setLibrary(?Library $Library): self
    {
        $this->Library = $Library;

        return $this;
    }
}
