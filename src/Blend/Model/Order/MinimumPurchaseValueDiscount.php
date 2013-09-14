<?php

namespace Blend\Model\Order;

use SebastianBergmann\Money\Money;

class MinimumPurchaseValueDiscount extends BasicValueDiscount
{
    private $minAmount;

    public function __construct(OrderInterface $order, Money $value, Money $minAmount)
    {
        parent::__construct($order, $value);

        $this->minAmount = $minAmount;
    }

    public function getAmount()
    {
        $amount = $this->order->getAmount();
        if ($amount->greaterThanOrEqual($this->minAmount)) {
            $amount = parent::getAmount();
        }

        return $amount;
    }
}
