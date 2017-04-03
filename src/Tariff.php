<?php

namespace AnyB1s\ShippingCalculator;

use Money\Money;

class Tariff
{
    /**
     * @var Money
     */
    private $money;
    /**
     * @var TariffType
     */
    private $type;

    public function __construct(Money $money, TariffType $type)
    {
        $this->money = $money;
        $this->type = $type;
    }

    public function price()
    {
        return $this->money;
    }

    public function type()
    {
        return $this->type;
    }
}
