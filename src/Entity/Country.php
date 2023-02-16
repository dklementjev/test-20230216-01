<?php

namespace App\Entity;

use App\Repository\CountryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CountryRepository::class)]
class Country
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToOne(mappedBy: 'country', cascade: ['persist', 'remove'])]
    private ?VAT $VAT = null;

    #[ORM\Column(length: 16, name: "tax_id_prefix", nullable: true)]
    private ?string $taxIDPrefix = null;

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

    public function getVAT(): ?VAT
    {
        return $this->VAT;
    }

    public function setVAT(VAT $VAT): self
    {
        // set the owning side of the relation if necessary
        if ($VAT->getCountry() !== $this) {
            $VAT->setCountry($this);
        }

        $this->VAT = $VAT;

        return $this;
    }

    public function getTaxIDPrefix(): ?string
    {
        return $this->taxIDPrefix;
    }

    public function setTaxIDPrefix(?string $prefix): self
    {
        $this->taxIDPrefix = $prefix;

        return $this;
    }
}
