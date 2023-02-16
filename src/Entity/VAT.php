<?php

namespace App\Entity;

use App\Repository\VATRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VATRepository::class)]
class VAT
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'VAT', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Country $country = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $percent = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(Country $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getPercent(): ?string
    {
        return $this->percent;
    }

    public function setPercent(string $percent): self
    {
        $this->percent = $percent;

        return $this;
    }

    public function getTotalPrice(float $price): float
    {
        return ($price + $price * $this->getPercent() / 100);
    }
}
