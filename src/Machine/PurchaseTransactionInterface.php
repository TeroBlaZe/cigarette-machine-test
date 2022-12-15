<?php

namespace App\Machine;

interface PurchaseTransactionInterface
{
    public function getItemQuantity(): int;

    public function getPaidAmount(): float;
}
