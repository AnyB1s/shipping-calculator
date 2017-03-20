<?php

namespace AnyB1s\ShippingCalculator;

use Money\Money;

interface Company
{
    /**
     * @return string
     */
    public function name() : string;

    /**
     * @param Address $address
     * @return bool
     */
    public function canShipTo(Address $address) : bool;

    /**
     * @param Address $address
     * @return bool
     */
    public function canShipFrom(Address $address) : bool;

    /**
     * @param Package $package
     * @return Money
     */
    public function priceFor(Package $package) : Money;

    /**
     * @param Package $package
     * @return mixed
     */
    public function volume(Package $package);
}