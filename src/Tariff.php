<?php

namespace AnyB1s\ShippingCalculator;

use Money\Money;

class Tariff
{
    /**
     * @var Company
     */
    private $company;
    /**
     * @var Money
     */
    private $money;
    /**
     * @var TariffType
     */
    private $type;

    public function __construct(Company $company, Money $money, TariffType $type)
    {
        $this->company = $company;
        $this->money = $money;
        $this->type = $type;
    }

    public function company()
    {
        return $this->company;
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
