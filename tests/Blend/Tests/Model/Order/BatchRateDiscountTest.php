<?php

namespace Blend\Tests\Model\Order;

use Blend\Model\Order\BatchRateDiscount;
use Blend\Model\Order\Order;
use Blend\Model\Store\DigitalProduct;
use SebastianBergmann\Money\Currency;
use SebastianBergmann\Money\Money;

class BatchDiscountTest extends \PHPUnit_Framework_TestCase
{
    public function testOrderIsDiscounted()
    {
        $products[] = new DigitalProduct('A', 'Product A', new Money(500, new Currency('EUR')));
        $products[] = new DigitalProduct('B', 'Product B', new Money(500, new Currency('EUR')));
        $products[] = new DigitalProduct('C', 'Product C', new Money(500, new Currency('EUR')));

        $order = new BatchRateDiscount(new Order($products, new Currency('EUR')), 50, 3);

        $this->assertEquals(new Money(750, new Currency('EUR')), $order->getAmount());
    }

    public function testOrderIsNotDiscounted()
    {
        $products[] = new DigitalProduct('A', 'Product A', new Money(500, new Currency('EUR')));
        $products[] = new DigitalProduct('B', 'Product B', new Money(500, new Currency('EUR')));

        $order = new BatchRateDiscount(new Order($products, new Currency('EUR')), 50, 3);

        $this->assertEquals(new Money(1000, new Currency('EUR')), $order->getAmount());
        
    }
}
