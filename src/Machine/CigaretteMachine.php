<?php

namespace App\Machine;

/**
 * Class CigaretteMachine
 *
 * @package App\Machine
 */
class CigaretteMachine implements MachineInterface
{
    public const ITEM_PRICE = 4.99;

    private array $changeCoins = [2, 1, 0.5, 0.2, 0.1, 0.05, 0.02, 0.01];

    public function execute(PurchaseTransactionInterface $purchaseTransaction): PurchasedItemInterface
    {
        $boughtQuantity = $this->getAvailableQuantity($purchaseTransaction);
        $totalAmount = $boughtQuantity * self::ITEM_PRICE;

        return new PurchasedItem(
            itemQuantity: $boughtQuantity,
            totalAmount: $totalAmount,
            change: $this->calculateChange($purchaseTransaction->getPaidAmount(), $totalAmount),
        );
    }

    /**
     * Get maximum for given money
     */
    private function getAvailableQuantity(PurchaseTransactionInterface $purchaseTransaction): int
    {
        return min(
            $purchaseTransaction->getItemQuantity(),
            (int) ($purchaseTransaction->getPaidAmount() / self::ITEM_PRICE),
        );
    }

    private function calculateChange(float $paidAmount, float $totalAmount): array
    {
        if ($paidAmount <= $totalAmount) {
            return [];
        }
        $changeAmount = round($paidAmount - $totalAmount, 2);
        $change = [];

        foreach ($this->changeCoins as $coin) {
            if ($changeAmount < $coin) {
                continue;
            }
            $changeForCoin = (int) ($changeAmount / $coin);
            $changeAmount = round($changeAmount - $coin * $changeForCoin, 2);

            $change[] = [
                'Coin' => $coin,
                'Amount' => $changeForCoin,
            ];
        }

        return $change;
    }
}
