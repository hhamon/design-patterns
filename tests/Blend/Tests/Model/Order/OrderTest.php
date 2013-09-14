<?php

namespace Blend\Tests\Model\Order;

use Blend\Model\Store\DigitalProduct;
use Blend\Model\Order\Order;
use SebastianBergmann\Money\Money;
use SebastianBergmann\Money\Currency;

class OrderTest extends \PHPUnit_Framework_TestCase
{
    public function testGetAmount()
    {
        $products[] = new DigitalProduct('A', 'Product A', new Money(500, new Currency('EUR')));
        $products[] = new DigitalProduct('B', 'Product B', new Money(1000, new Currency('EUR')));

        $order = new Order($products, new Currency('EUR'));

        $this->assertEquals(new Money(1500, new Currency('EUR')), $order->getAmount());
    }
}
