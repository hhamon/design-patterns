<?php

namespace Blend\Tests\Model\Order;

use Blend\Model\Order\BasicValueDiscount;
use Blend\Model\Order\MinimumPurchaseValueDiscount;
use Blend\Model\Order\Order;
use Blend\Model\Store\DigitalProduct;
use SebastianBergmann\Money\Currency;
use SebastianBergmann\Money\Money;

class ChainDiscountTest extends \PHPUnit_Framework_TestCase
{
    public function testOrderIsDiscounted()
    {
        $products[] = new DigitalProduct('A', 'Product A', new Money(1200, new Currency('EUR')));
        $products[] = new DigitalProduct('B', 'Product B', new Money(5000, new Currency('EUR')));
        $products[] = new DigitalProduct('C', 'Product C', new Money(1000, new Currency('EUR')));
        // Total is 7200

        $order = new Order($products, new Currency('EUR'));
        $order = new BasicValueDiscount($order, new Money(600, new Currency('EUR')));
        $order = new MinimumPurchaseValueDiscount($order, new Money(300, new Currency('EUR')), new Money(4500, new Currency('EUR')));
   
        $this->assertEquals(new Money(6300, new Currency('EUR')), $order->getAmount());
    }
}
