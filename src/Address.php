<?php

namespace AnyB1s\ShippingCalculator;

use Rinvex\Country\Country;

class Address
{
    /**
     * @var Country
     */
    private $country;

    /**
     * Address constructor.
     * @param Country $country
     */
    public function __construct(Country $country)
    {
        $this->country = $country;
    }

    public function country()
    {
        return $this->country;
    }
}
