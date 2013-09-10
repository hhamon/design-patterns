<?php
namespace Blend\Model\Order;

class BatchDiscount extends BasicDiscount
{
    const DEFAULT_DISCOUNT_BATCH_QUANTITY = 3;

    private $quantity;

    public function __construct(OrderInterface $order, $discount = parent::DEFAULT_DISCOUNT_PERCENTAGE, $quantity = self::DEFAULT_DISCOUNT_BATCH_QUANTITY)
    {
        parent::__construct($order, $discount);
        $this->quantity = $quantity;
    }

    public function getAmount()
    {
        if (count($this->order) >= $this->quantity) {
            return $this->order->getAmount() - $this->order->getAmount() * $this->discount / 100;
        }
        return $this->order->getAmount();
    }
}