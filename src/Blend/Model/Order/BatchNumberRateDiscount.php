<?php

namespace Blend\Model\Order;

use SebastianBergmann\Money\Money;

class BatchNumberRateDiscount extends OrderDecorator
{
    const DEFAULT_DISCOUNT_BATCH_QUANTITY = 3;

    private $minQuantity;

    public function __construct(OrderInterface $order, $minQuantity = self::DEFAULT_DISCOUNT_BATCH_QUANTITY)
    {
        parent::__construct($order);

        $this->minQuantity = $minQuantity;
    }

    public function getAmount()
    {
        $amount = $this->order->getAmount();

        $quantity = count($this->order);
        if ($quantity > $this->minQuantity) {
            $rate = $quantity % $this->minQuantity;
            $discount = new Money(intval($amount->getAmount() * $rate), $this->getCurrency());
            $amount = $amount->subtract($discount);
        }

        return $amount;
    }
}
