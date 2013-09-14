<?php

namespace Blend\Tests\Model\Order;

use Blend\Model\Order\MinimumPurchaseValueDiscount;
use Blend\Model\Order\Order;
use Blend\Model\Store\DigitalProduct;
use SebastianBergmann\Money\Currency;
use SebastianBergmann\Money\Money;

class MinimumPurchaseValueDiscountTest extends \PHPUnit_Framework_TestCase
{
    public function testOrderIsDiscounted()
    {
        $products[] = new DigitalProduct('A', 'Product A', new Money(5000, new Currency('EUR')));

        $discount  = new Money(1000, new Currency('EUR'));
        $minAmount = new Money(3500, new Currency('EUR')); 
        $order = new Order($products, new Currency('EUR'));
        $order = new MinimumPurchaseValueDiscount($order, $discount, $minAmount);

        $this->assertEquals(new Money(4000, new Currency('EUR')), $order->getAmount());
    }

    public function testOrderIsNotDiscounted()
    {
        $products[] = new DigitalProduct('A', 'Product A', new Money(3499, new Currency('EUR')));

        $discount  = new Money(1000, new Currency('EUR'));
        $minAmount = new Money(3500, new Currency('EUR'));
        $order = new Order($products, new Currency('EUR'));
        $order = new MinimumPurchaseValueDiscount($order, $discount, $minAmount);

        $this->assertEquals(new Money(3499, new Currency('EUR')), $order->getAmount());
    }
}
