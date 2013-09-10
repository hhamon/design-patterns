<?php
namespace Blend\Model\Order;

use Blend\Model\Store\ProductInterface;

class Order implements OrderInterface
{
    private $product;

    public function __construct(ProductInterface $product)
    {
        $this->setProduct($product);
    }

    public function setProduct(ProductInterface $product)
    {
        $this->product = $product;
    }

    public function getAmount()
    {
        return $this->product->getPrice()->getAmount();
    }

    protected function getCurrency()
    {
        return $this->product->getPrice()->getCurrency();
    }

    public function __toString()
    {
        return $this->getAmount() . $this->getCurrency();
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function count()
    {
        return count($this->product);
    }
}