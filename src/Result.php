<?php

namespace AnyB1s\ShippingCalculator;

class Result
{
    /**
     * @var Company
     */
    private $company;
    /**
     * @var PricingCollection
     */
    private $prices;

    public function __construct(Company $company, PricingCollection $prices)
    {
        $this->company = $company;
        $this->prices = $prices;
    }

    public function company()
    {
        return $this->company;
    }

    public function prices()
    {
        return $this->prices;
    }
}
