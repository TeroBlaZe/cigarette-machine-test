<?php

declare(strict_types=1);

namespace App\Machine;

class PurchaseTransaction implements PurchaseTransactionInterface
{
    public function __construct(
        private int $itemQuantity,
        private float $paidAmount,
    ) {
    }

    public function getItemQuantity(): int
    {
        return $this->itemQuantity;
    }

    public function getPaidAmount(): float
    {
        return $this->paidAmount;
    }
}
