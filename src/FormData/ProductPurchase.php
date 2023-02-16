<?php

namespace App\FormData;

use App\Entity;

class ProductPurchase
{
    protected $product;

    protected $taxID;

    public function getProduct(): ?Entity\Product
    {
        return $this->product;
    }

    public function setProduct(?Entity\Product $product): void
    {
        $this->product = $product;
    }

    public function getTaxID(): ?string
    {
        return $this->taxID;
    }

    public function setTaxID(?string $taxID): void
    {
        $this->taxID = $taxID;
    }
}
