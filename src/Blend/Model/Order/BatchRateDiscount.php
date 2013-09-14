<?php

namespace Blend\Model\Order;

class BatchRateDiscount extends BasicRateDiscount
{
    const DEFAULT_DISCOUNT_BATCH_QUANTITY = 3;

    private $minQuantity;

    public function __construct(OrderInterface $order, $discount = parent::DEFAULT_DISCOUNT_PERCENTAGE, $minQuantity = self::DEFAULT_DISCOUNT_BATCH_QUANTITY)
    {
        parent::__construct($order, $discount);

        $this->minQuantity = $minQuantity;
    }

    public function getAmount()
    {
        $amount = $this->order->getAmount();

        $quantity = count($this->order);
        if ($quantity >= $this->minQuantity) {
            $parts = $amount->allocateByRatios(array(100 - $this->discount, $this->discount));
            $amount = $parts[0];
        }

        return $amount;
    }
}
