<?php

namespace Blend\Model\Store;

use Blend\Model\Physic\Mass;
use Blend\Model\Physic\Volume;
use SebastianBergmann\Money\Money;

class Product implements ProductInterface
{
    /**
     * The product's reference.
     *
     * @var string
     */
    protected $reference;

    /**
     * The product's name.
     *
     * @var string
     */
    protected $name;

    /**
     * The product's price.
     *
     * @var Money
     */
    protected $price;

    /**
     * The product's mass.
     *
     * @var Mass
     */
    protected $mass;

    /**
     * The product's volume.
     *
     * @var Volume
     */
    protected $volume;

    /**
     * Constructor.
     *
     * @param string $reference
     * @param string $name
     * @param Money $price
     * @param Mass $mass
     * @param Volume $volume
     */
    public function __construct($reference, $name, Money $price, Mass $mass, Volume $volume)
    {
        $this->reference = $reference;
        $this->name      = $name;
        $this->price     = $price;
        $this->mass      = $mass;
        $this->volume    = $volume;
    }

    /**
     * Returns the product's reference.
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Returns the product's name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the product's price.
     *
     * @return \SebastianBergmann\Money\Money
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Returns the product's weight.
     *
     * @return \Blend\Model\Physic\Mass
     */
    public function getMass()
    {
        return $this->mass;
    }

    /**
     * Returns the product's volume.
     *
     * @return \Blend\Model\Physic\Volume
     */
    public function getVolume()
    {
        return $this->volume;
    }

    public function count()
    {
        return 1;
    }
}
