<?php

namespace Blend\Model\Order;

use SebastianBergmann\Money\Money;

class BasicValueDiscount extends OrderDecorator
{
    private $value;

    public function __construct(OrderInterface $order, Money $value)
    {
        parent::__construct($order);

        $this->value = $value;
    }

    /**
     * Returns the total amount of the order.
     *
     * @return \SebastianBergmann\Money\Money
     */
    public function getAmount()
    {
        $amount = $this->order->getAmount();

        return $amount->subtract($this->value);
    }
}
