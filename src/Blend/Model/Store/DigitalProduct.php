<?php

namespace Blend\Model\Store;

use Blend\Model\Physic\Mass;
use Blend\Model\Physic\Volume;
use SebastianBergmann\Money\Money;

class DigitalProduct extends Product
{
    /**
     * Constructor.
     *
     * @param string $reference
     * @param string $name
     * @param Money $price
     */
    public function __construct($reference, $name, Money $price)
    {
        $this->reference = $reference;
        $this->name = $name;
        $this->price = $price;
    }

    /**
     * Returns the product's mass.
     *
     * @return Mass
     */
    final public function getMass()
    {
        return new Mass(0);
    }

    /**
     * Returns the product's volume.
     *
     * @return Volume
     */
    final public function getVolume()
    {
        return new Volume(0);
    }
}
