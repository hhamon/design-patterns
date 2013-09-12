<?php
namespace Blend\Model\Order;

use Blend\Model\Store\ProductInterface;

interface OrderInterface extends \Countable
{
    function getAmount();
    function setProduct(ProductInterface $p);
    function getProduct();
}