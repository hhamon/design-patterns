<?php

namespace Blend\Model\Store;

interface ProductInterface
{
    /**
     * Returns the product's reference.
     *
     * @return string
     */
    public function getReference();

    /**
     * Returns the product's name.
     *
     * @return string
     */
    public function getName();

    /**
     * Returns the product's price.
     *
     * @return \SebastianBergmann\Money\Money
     */
    public function getPrice();

    /**
     * Returns the product's weight.
     *
     * @return \Blend\Model\Physic\Mass
     */
    public function getMass();

    /**
     * Returns the product's volume.
     *
     * @return \Blend\Model\Physic\Volume
     */
    public function getVolume();
}
