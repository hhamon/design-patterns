<?php

namespace Blend\Model\Physic;

class Mass
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function add(Mass $other)
    {
        return $this->newMass($this->value + $other->getValue());
    }

    private function newMass($value)
    {
        return new Mass($value);
    }
}
