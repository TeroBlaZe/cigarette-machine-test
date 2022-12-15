<?php

namespace App\Machine;

interface PurchasedItemInterface
{
    public function getItemQuantity(): int;

    public function getTotalAmount(): float;

    /**
     * Returns the change in this format:
     *
     * Coin Count
     * 0.01 0
     * 0.02 0
     * .... .....
     *
     * @return array<int, array<float,int>>
     */
    public function getChange(): array;
}
