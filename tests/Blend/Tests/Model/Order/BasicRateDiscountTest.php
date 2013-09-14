<?php

namespace Blend\Tests\Model\Order;

use Blend\Model\Order\BasicRateDiscount;
use Blend\Model\Order\Order;
use Blend\Model\Store\DigitalProduct;
use SebastianBergmann\Money\Currency;
use SebastianBergmann\Money\Money;

class BasicRateDiscountTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provideDiscountedAmounts
     */
    public function testGetAmount($discount, $discountedAmount)
    {
        $products[] = new DigitalProduct('A', 'Product A', new Money(4000, new Currency('EUR')));
        $products[] = new DigitalProduct('B', 'Product B', new Money(1000, new Currency('EUR')));

        $order = new BasicRateDiscount(new Order($products, new Currency('EUR')), $discount);
        
        $this->assertEquals(new Money($discountedAmount, new Currency('EUR')), $order->getAmount());
    }

    public function provideDiscountedAmounts()
    {
        return array(
            array(10, 4500),
            array(30, 3500),
            array(50, 2500),
            array(75, 1250),
            array(100, 0),
        );
    }
}
