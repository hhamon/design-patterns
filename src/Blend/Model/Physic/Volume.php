<?php

namespace Blend\Model\Physic;

class Volume
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

    public function add(Volume $other)
    {
        return $this->newVolume($this->value + $other->getValue());
    }

    private function newVolume($value)
    {
        return new Volume($value);
    }
}
