<?php

declare(strict_types=1);

namespace App;

class Bitcoin
{
    private float $price;
    private string $currency;
    private string $updated;

    public function __construct(
        float  $price,
        string $currency,
        string $updated
    )
    {
        $this->price = $price;
        $this->currency = $currency;
        $this->updated = $updated;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getUpdated(): string
    {
        return $this->updated;
    }
}