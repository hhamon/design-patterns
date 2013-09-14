<?php

namespace Blend\Model\Order;

class BasicRateDiscount extends OrderDecorator
{
    const DEFAULT_DISCOUNT_PERCENTAGE = 10;

    protected $discount;

    public function __construct(OrderInterface $order, $discount = self::DEFAULT_DISCOUNT_PERCENTAGE)
    {
        parent::__construct($order);

        $this->discount = $discount;
    }

    public function getAmount()
    {
        $amount = $this->order->getAmount();
        $parts = $amount->allocateByRatios(array(100 - $this->discount, $this->discount));

        return $parts[0];
    }
}
