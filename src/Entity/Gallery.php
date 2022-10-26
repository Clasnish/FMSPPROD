<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gallery
 *
 * @ORM\Table(name="gallery")
 * @ORM\Entity
 */
class Gallery
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255, nullable=true)
     */
    private $link;

    /**
     * @var string|null
     *
     * @ORM\Column(name="comment", type="text", length=65535, nullable=true)
     */
    private $comment;

    /**
     * @var string|null
     *
     * @ORM\Column(name="size", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $size;

    /**
     * @var string|null
     *
     * @ORM\Column(name="heigt", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $heigt;

    /**
     * @var string|null
     *
     * @ORM\Column(name="weight", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $weight;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified", type="datetime", nullable=false)
     */
    private $modified;

    /**
     * @ORM\ManyToOne(targetEntity=Laboratory::class, inversedBy="galleries")
     * @ORM\JoinColumn(nullable=false)
     */
    private $laboratory;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

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

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(?string $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getHeigt(): ?string
    {
        return $this->heigt;
    }

    public function setHeigt(?string $heigt): self
    {
        $this->heigt = $heigt;

        return $this;
    }

    public function getWeight(): ?string
    {
        return $this->weight;
    }

    public function setWeight(?string $weight): self
    {
        $this->weight = $weight;

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
        return $this->modified;
    }

    public function setModified(\DateTimeInterface $modified): self
    {
        $this->modified = $modified;

        return $this;
    }

    public function getLaboratory(): ?Laboratory
    {
        return $this->laboratory;
    }

    public function setLaboratory(?Laboratory $laboratory): self
    {
        $this->laboratory = $laboratory;

        return $this;
    }
    

}
