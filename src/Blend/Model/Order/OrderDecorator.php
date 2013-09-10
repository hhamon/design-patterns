<?php
namespace Blend\Model\Order;

use Blend\Model\Store\ProductInterface;

abstract class OrderDecorator implements OrderInterface
{
    protected $order;

    public function __construct(OrderInterface $order)
    {
        $this->order = $order;
    }

    public function count()
    {
        return count($this->order);
    }

    public function setProduct(ProductInterface $p)
    {
        $this->order->setProduct($p);
    }

    public function getProduct()
    {
        return $this->order->getProduct();
    }
}