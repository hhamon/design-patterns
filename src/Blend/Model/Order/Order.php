<?php

namespace Blend\Model\Order;

use Blend\Model\Store\ProductInterface;
use SebastianBergmann\Money\Currency;
use SebastianBergmann\Money\Money;

class Order implements OrderInterface
{
    private $products;
    private $currency;

    public function __construct(array $products, Currency $currency)
    {
        $this->setProducts($products);
        $this->currency = $currency;
    }

    private function setProducts(array $products)
    {
        foreach ($products as $product) {
            $this->addProduct($product);
        }
    }

    public function addProduct(ProductInterface $product)
    {
        $this->products[] = $product;
    }

    public function getAmount()
    {
        $total = new Money(0, $this->currency);
        foreach ($this->products as $product) {
            $total = $total->add($product->getPrice());
        }

        return $total;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function count()
    {
        return count($this->products);
    }

    public function __toString()
    {
        $amount = $this->getAmount();

        return $amount->getAmount() . $this->getCurrency();
    }
}
