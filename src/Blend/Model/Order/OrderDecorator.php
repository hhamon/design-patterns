<?php

namespace Blend\Model\Order;

abstract class OrderDecorator implements OrderInterface
{
    /**
     * The decorated order.
     *
     * @var Order
     */
    protected $order;

    /**
     * Constructor.
     *
     * @param OrderInterface $order The decorated order
     */
    public function __construct(OrderInterface $order)
    {
        $this->order = $order;
    }

    /**
     * Returns the number of ordered products.
     *
     * @return integer
     */
    public function count()
    {
        return count($this->order);
    }

    /**
     * Returns the list of ordered products.
     *
     * @return array
     */
    public function getProducts()
    {
        return $this->order->getProducts();
    }

    /**
     * Returns the order's currency.
     *
     * @return \SebastianBergmann\Money\Currency
     */
    public function getCurrency()
    {
        return $this->order->getCurrency();
    }
}
