<?php

namespace Blend\Tests\Model\Order;

use Blend\Model\Order\Order;
use Blend\Model\Store\Product;
use SebastianBergmann\Money\Money;
use Blend\Model\Physic\Mass;
use Blend\Model\Physic\Volume;
use SebastianBergmann\Money\Currency;
use Blend\Model\Order\BasicDiscount;
use Blend\Model\Order\BatchDiscount;
use Blend\Model\Store\Bundle;

class BasicOrderTest extends \PHPUnit_Framework_TestCase
{
    public function testBasicOrder()
    {
        $order = new Order(new Product("test", "testproduct", new Money(5, new Currency("EUR")), new Mass(2), new Volume(2)));

        $this->assertEquals(5, $order->getAmount());
    }

    public function testBasicDiscount()
    {
        $order    = new Order(new Product("test", "testproduct", new Money(5, new Currency("EUR")), new Mass(2), new Volume(2)));
        $discount = new BasicDiscount($order, 50);
        $this->assertEquals(2.5, $discount->getAmount()); /* 50% discount */

        $order    = new Order(new Product("test", "testproduct", new Money(5, new Currency("EUR")), new Mass(2), new Volume(2)));
        $discount = new BasicDiscount($order, 75);
        $this->assertEquals(1.25, $discount->getAmount()); /* 75% discount */
    }

    public function testBatchDiscount()
    {
        $order    = new Order(new Product("test", "testproduct", new Money(5, new Currency("EUR")), new Mass(2), new Volume(2)));
        $discount = new BatchDiscount($order, 50, 3);
        $this->assertEquals(5, $discount->getAmount()); /* Not enough products in the batch */

        $bundle   = new Bundle("testbundleref", "testbundle");
        $order    = new Order($bundle);
        $discount = new BatchDiscount($order, 50, 3);
        $bundle->add(new Product("test", "testproduct", new Money(5, new Currency("EUR")), new Mass(2), new Volume(2)));
        $bundle->add(new Product("test", "testproduct", new Money(5, new Currency("EUR")), new Mass(2), new Volume(2)));
        $bundle->add(new Product("test", "testproduct", new Money(5, new Currency("EUR")), new Mass(2), new Volume(2)));

        $this->assertEquals(7.5, $discount->getAmount()); /* Enough products in the batch */
    }

    public function testDecoratorChain()
    {
        $bundle   = new Bundle("testbundleref", "testbundle");
        $order    = new Order($bundle);
        $basicDiscount = new BasicDiscount($order, 50);
        $batchDiscount = new BatchDiscount($basicDiscount, 50, 3);

        $bundle->add(new Product("test", "testproduct", new Money(5, new Currency("EUR")), new Mass(2), new Volume(2)));
        $bundle->add(new Product("test", "testproduct", new Money(5, new Currency("EUR")), new Mass(2), new Volume(2)));
        $bundle->add(new Product("test", "testproduct", new Money(5, new Currency("EUR")), new Mass(2), new Volume(2)));
        $bundle->add(new Product("test", "testproduct", new Money(5, new Currency("EUR")), new Mass(2), new Volume(2)));

        $this->assertEquals(5, $batchDiscount->getAmount());
    }
}
