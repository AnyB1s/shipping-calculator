<?php

namespace AnyB1s\ShippingCalculator\Package;

class Weight implements \JsonSerializable
{
    private $weight;
    private $unit;

    public function __construct(float $aWeight, string $aUnit)
    {
        $this->weight = $aWeight;
        $this->unit = $aUnit;
    }

    public function quantity()
    {
        return $this->weight;
    }

    public function isBetween(float $from, float $to)
    {
        return $this->weight > $from && $this->weight < $to;
    }

    public function isGreaterThan(float $weight)
    {
        return $this->weight > $weight;
    }

    public function isLessThan(float $weight)
    {
        return $this->weight > $weight;
    }

    public function __toString()
    {
        return $this->weight . ' ' . $this->unit;
    }

    public function jsonSerialize()
    {
        return [
            'quantity' => $this->weight,
            'unit' => $this->unit
        ];
    }
}
