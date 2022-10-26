<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Compagnie
 *
 * @ORM\Table(name="compagnie")
 * @ORM\Entity
 */
class Compagnie
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
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="rccm", type="string", length=50, nullable=true)
     */
    private $rccm;

    /**
     * @var string|null
     *
     * @ORM\Column(name="vat_number", type="string", length=50, nullable=true)
     */
    private $vatNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="adress1", type="string", length=255, nullable=false)
     */
    private $adress1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="adress2", type="string", length=255, nullable=true)
     */
    private $adress2;

    /**
     * @var string
     *
     * @ORM\Column(name="tel1", type="string", length=20, nullable=false)
     */
    private $tel1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="tel2", type="string", length=20, nullable=true)
     */
    private $tel2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="fax", type="string", length=20, nullable=true)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email2", type="string", length=255, nullable=true)
     */
    private $email2;

    /**
     * @var string
     *
     * @ORM\Column(name="home_link", type="string", length=255, nullable=false)
     */
    private $homeLink;

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
     * @var string|null
     *
     * @ORM\Column(name="facebook", type="string", length=255, nullable=true)
     */
    private $facebook;

    /**
     * @var string|null
     *
     * @ORM\Column(name="linkin", type="string", length=255, nullable=true)
     */
    private $linkin;

    /**
     * @var string|null
     *
     * @ORM\Column(name="twitter", type="string", length=255, nullable=true)
     */
    private $twitter;

    /**
     * @var string
     *
     * @ORM\Column(name="instagram", type="string", length=255, nullable=false)
     */
    private $instagram;

    /**
     * @var string|null
     *
     * @ORM\Column(name="po_box", type="string", length=10, nullable=true)
     */
    private $poBox;

    /**
     * @var string|null
     *
     * @ORM\Column(name="country", type="string", length=50, nullable=true)
     */
    private $country;

    /**
     * @var string|null
     *
     * @ORM\Column(name="city", type="string", length=100, nullable=true)
     */
    private $city;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="label", type="string", length=255, nullable=true)
     */
    private $label;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image_url", type="string", length=255, nullable=true)
     */
    private $imageUrl;

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

    public function getRccm(): ?string
    {
        return $this->rccm;
    }

    public function setRccm(?string $rccm): self
    {
        $this->rccm = $rccm;

        return $this;
    }

    public function getVatNumber(): ?string
    {
        return $this->vatNumber;
    }

    public function setVatNumber(?string $vatNumber): self
    {
        $this->vatNumber = $vatNumber;

        return $this;
    }

    public function getAdress1(): ?string
    {
        return $this->adress1;
    }

    public function setAdress1(string $adress1): self
    {
        $this->adress1 = $adress1;

        return $this;
    }

    public function getAdress2(): ?string
    {
        return $this->adress2;
    }

    public function setAdress2(?string $adress2): self
    {
        $this->adress2 = $adress2;

        return $this;
    }

    public function getTel1(): ?string
    {
        return $this->tel1;
    }

    public function setTel1(string $tel1): self
    {
        $this->tel1 = $tel1;

        return $this;
    }

    public function getTel2(): ?string
    {
        return $this->tel2;
    }

    public function setTel2(?string $tel2): self
    {
        $this->tel2 = $tel2;

        return $this;
    }

    public function getFax(): ?string
    {
        return $this->fax;
    }

    public function setFax(?string $fax): self
    {
        $this->fax = $fax;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getEmail2(): ?string
    {
        return $this->email2;
    }

    public function setEmail2(?string $email2): self
    {
        $this->email2 = $email2;

        return $this;
    }

    public function getHomeLink(): ?string
    {
        return $this->homeLink;
    }

    public function setHomeLink(string $homeLink): self
    {
        $this->homeLink = $homeLink;

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

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function setFacebook(?string $facebook): self
    {
        $this->facebook = $facebook;

        return $this;
    }

    public function getLinkin(): ?string
    {
        return $this->linkin;
    }

    public function setLinkin(?string $linkin): self
    {
        $this->linkin = $linkin;

        return $this;
    }

    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    public function setTwitter(?string $twitter): self
    {
        $this->twitter = $twitter;

        return $this;
    }

    public function getInstagram(): ?string
    {
        return $this->instagram;
    }

    public function setInstagram(string $instagram): self
    {
        $this->instagram = $instagram;

        return $this;
    }

    public function getPoBox(): ?string
    {
        return $this->poBox;
    }

    public function setPoBox(?string $poBox): self
    {
        $this->poBox = $poBox;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

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

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(?string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }


}
