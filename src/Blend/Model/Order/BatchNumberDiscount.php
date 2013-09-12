<?php
namespace Blend\Model\Order;

class BatchNumberDiscount extends OrderDecorator
{
	const DEFAULT_DISCOUNT_BATCH_QUANTITY = 3;

	private $quantity;

	public function __construct(OrderInterface $order, $quantity = self::DEFAULT_DISCOUNT_BATCH_QUANTITY)
	{
		parent::__construct($order);
		$this->quantity = $quantity;
	}

	public function getAmount()
	{
		if (count($this->order) > $this->quantity) {
			return $this->order->getAmount() - ( (count($this->order) % $this->quantity) * $this->order->getAmount());
		}
		return $this->order->getAmount();
	}
}