<?php

namespace Blend\Tests\Model\Store;

use Blend\Model\Physic\Mass;
use Blend\Model\Physic\Volume;
use Blend\Model\Store\Bundle;
use Blend\Model\Store\DigitalProduct;
use Blend\Model\Store\HardProduct;
use SebastianBergmann\Money\Currency;
use SebastianBergmann\Money\Money;

class BundleTest extends \PHPUnit_Framework_TestCase
{
    public function testBundleWithFixedPrice()
    {
        $price  = new Money(3500, new Currency('EUR'));
        $bundle = new Bundle('ABC123', 'Fake Bundle', $price);

        $this->assertSame($price, $bundle->getPrice());
    }

    public function testSimpleBundle()
    {
        $currency = new Currency('EUR');
   
        $bundle = new Bundle('ABC123', 'Simple Bundle');
        $bundle->add(new HardProduct('DEF000', 'A', new Money(9010, $currency), new Mass(10000), new Volume(4)));
        $bundle->add(new HardProduct('FGH111', 'B', new Money(4930, $currency), new Mass(4000),  new Volume(7)));
        $bundle->add(new HardProduct('IJK222', 'C', new Money(575, $currency),  new Mass(2500),  new Volume(1)));
        
        $this->assertEquals(new Money(14515, $currency), $bundle->getPrice());
        $this->assertEquals(new Mass(16500), $bundle->getMass());
        $this->assertEquals(new Volume(12), $bundle->getVolume());
    }

    public function testDigitalBundle()
    {
        $currency = new Currency('EUR');
        $bundle = new Bundle('ABC123', 'Digital Bundle', new Money(2500, $currency));
        $bundle->add(new DigitalProduct('DEF000', 'A', new Money(1900, $currency)));
        $bundle->add(new DigitalProduct('DEF111', 'B', new Money(1000, $currency)));
        $bundle->add(new DigitalProduct('DEF222', 'C', new Money(900, $currency)));

        $this->assertEquals(new Volume(0), $bundle->getVolume());
        $this->assertEquals(new Mass(0), $bundle->getMass());
    }
    
    public function testSuperDuperBundleWithFixedPrice()
    {
        $currency = new Currency('EUR');
        $bundle = new Bundle('ABC123', 'Super Duper Bundle', new Money(9900, $currency));

        $b1 = new Bundle('B1', 'Simple Bundle');
        $b1->add(new HardProduct('P11', 'P1', new Money(1000, $currency), new Mass(150), new Volume(10)));
        $b1->add(new HardProduct('P12', 'P2', new Money(1900, $currency), new Mass(90), new Volume(25)));
        $b1->add(new DigitalProduct('P13', 'P3', new Money(900, $currency)));

        $b2 = new Bundle('B2', 'Great Bundle');
        $b2->add(new HardProduct('P21', 'P1', new Money(3000, $currency), new Mass(400), new Volume(28)));
        $b2->add(new DigitalProduct('P22', 'P2', new Money(700, $currency)));

        $bundle->add($b1);
        $bundle->add($b2);
        $bundle->add(new HardProduct('X0', 'X1', new Money(4000, $currency), new Mass(130), new Volume(5)));

        $this->assertEquals(new Money(9900, $currency), $bundle->getPrice());
        $this->assertEquals(new Mass(770), $bundle->getMass());
        $this->assertEquals(new Volume(68), $bundle->getVolume());
    }

    public function testSuperDuperBundleWithDynamicPrice()
    {
        $currency = new Currency('EUR');
        $bundle = new Bundle('ABC123', 'Super Duper Bundle');

        $b1 = new Bundle('B1', 'Simple Bundle');
        $b1->add(new HardProduct('P11', 'P1', new Money(1000, $currency), new Mass(150), new Volume(10)));
        $b1->add(new HardProduct('P12', 'P2', new Money(1900, $currency), new Mass(90), new Volume(25)));
        $b1->add(new DigitalProduct('P13', 'P3', new Money(900, $currency)));

        $b2 = new Bundle('B2', 'Great Bundle');
        $b2->add(new HardProduct('P21', 'P1', new Money(3000, $currency), new Mass(400), new Volume(28)));
        $b2->add(new DigitalProduct('P22', 'P2', new Money(700, $currency)));

        $bundle->add($b1);
        $bundle->add($b2);
        $bundle->add(new HardProduct('X0', 'X1', new Money(4000, $currency), new Mass(130), new Volume(5)));

        $this->assertEquals(new Money(11500, $currency), $bundle->getPrice());
        $this->assertEquals(new Mass(770), $bundle->getMass());
        $this->assertEquals(new Volume(68), $bundle->getVolume());
    }
    
    public function testBundleWithFixedMass()
    {
        $mass   = new Mass(450);
        $bundle = new Bundle('ABC123', 'Fake Bundle', null, $mass);

        $this->assertSame($mass, $bundle->getMass());
    }

    public function testBundleWithFixedVolume()
    {
        $volume = new Volume(0.75);
        $bundle = new Bundle('ABC123', 'Fake Bundle', null, null, $volume);

        $this->assertSame($volume, $bundle->getVolume());
    }
}
