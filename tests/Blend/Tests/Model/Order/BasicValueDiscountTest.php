<?php

namespace Blend\Tests\Model\Order;

use Blend\Model\Order\BasicValueDiscount;
use Blend\Model\Order\Order;
use Blend\Model\Store\DigitalProduct;
use SebastianBergmann\Money\Currency;
use SebastianBergmann\Money\Money;

class BasicValueDiscountTest extends \PHPUnit_Framework_TestCase
{
    public function testOrderIsDiscounted()
    {
        $products[] = new DigitalProduct('A', 'Product A', new Money(32, new Currency('EUR')));

        $coupon = new Money(6, new Currency('EUR'));
        $order  = new Order($products, new Currency('EUR'));
        $order  = new BasicValueDiscount($order, $coupon);

        $this->assertEquals(new Money(26, new Currency('EUR')), $order->getAmount());
        
    }
}
