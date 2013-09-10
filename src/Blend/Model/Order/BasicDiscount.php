<?php
namespace Blend\Model\Order;

class BasicDiscount extends OrderDecorator
{
    const DEFAULT_DISCOUNT_PERCENTAGE = 10;

    protected $discount;

    public function __construct(OrderInterface $order, $discount = self::DEFAULT_DISCOUNT_PERCENTAGE)
    {
        $this->order    = $order;
        $this->discount = $discount;
    }

    public function getAmount()
    {
        return $this->order->getAmount() - $this->order->getAmount() * $this->discount / 100;
    }
}