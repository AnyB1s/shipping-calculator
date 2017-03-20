<?php

namespace AnyB1s\ShippingCalculator\Package;

class Dimensions
{
    private $width;
    private $height;
    private $length;
    private $unit;

    /**
     * Dimensions constructor.
     * @param $width
     * @param $height
     * @param $length
     * @param $unit
     */
    public function __construct(float $width, float $height, float $length, string $unit)
    {
        $this->width = $width;
        $this->height = $height;
        $this->length = $length;
        $this->unit = $unit;
    }

    /**
     * @return float
     */
    public function width(): float
    {
        return $this->width;
    }

    /**
     * @return float
     */
    public function height(): float
    {
        return $this->height;
    }

    /**
     * @return float
     */
    public function length(): float
    {
        return $this->length;
    }

    /**
     * @return string
     */
    public function unit(): string
    {
        return $this->unit;
    }
}
