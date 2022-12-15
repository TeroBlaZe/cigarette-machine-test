<?php

declare(strict_types=1);

namespace App\Machine;

class PurchasedItem implements PurchasedItemInterface
{
    public function __construct(
        private int $itemQuantity,
        private float $totalAmount,
        private array $change = [],
    ) {
    }

    public function getItemQuantity(): int
    {
        return $this->itemQuantity;
    }

    public function getTotalAmount(): float
    {
        return $this->totalAmount;
    }

    public function getChange(): array
    {
        return $this->change;
    }
}
