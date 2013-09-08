<?php

namespace Blend\Model\Store;

use Blend\Model\Physic\Mass;
use Blend\Model\Physic\Volume;
use SebastianBergmann\Money\Money;

class Bundle extends Product
{
    /**
     * A collection of products.
     *
     * @var ProductInterface[]
     */
    protected $products;

    public function __construct($reference, $name, Money $price = null, Mass $mass = null, Volume $volume = null)
    {
        $this->reference = $reference;
        $this->products  = array();
        $this->volume    = $volume;
        $this->price     = $price;
        $this->name      = $name;
        $this->mass      = $mass;
    }

    public function add(ProductInterface $product)
    {
        $this->products[] = $product;
    }

    public function getPrice()
    {
        if ($this->price) {
            return $this->price;
        }

        return $this->getPricesSum();
    }

    public function getMass()
    {
        if ($this->mass) {
            return $this->mass;
        }
        
        return $this->getMassesSum();
    }

    public function getVolume()
    {
        if ($this->volume) {
            return $this->volume;
        }

        return $this->getVolumesSum();
    }

    private function getPricesSum()
    {
        $price = null;
        foreach ($this->products as $product) {
            if (null === $price) {
                $price = $product->getPrice();
            } else {
                $price = $price->add($product->getPrice());
            }
        }

        return $price;
    }

    private function getMassesSum()
    {
        $mass = null;
        foreach ($this->products as $product) {
            if (null === $mass) {
                $mass = $product->getMass();
            } else {
                $mass = $mass->add($product->getMass());
            }
        }

        return $mass;
    }

    private function getVolumesSum()
    {
        $volume = null;
        foreach ($this->products as $product) {
            if (null === $volume) {
                $volume = $product->getVolume();
            } else {
                $volume = $volume->add($product->getVolume());
            }
        }

        return $volume;
    }
}
