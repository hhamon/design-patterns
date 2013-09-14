<?php

namespace Blend\Model\Order;

interface OrderInterface extends \Countable
{
    /**
     * Returns the total amount of the order.
     *
     * @return \SebastianBergmann\Money\Money
     */
    public function getAmount();

    /**
     * Returns the order's currency.
     *
     * @return \SebastianBergmann\Money\Currency
     */
    public function getCurrency();

    /**
     * Returns the list of all products in
     * this order.
     *
     * @return \Blend\Model\Store\ProductInterface[]
     */
    public function getProducts();
}
