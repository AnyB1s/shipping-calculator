<?php

namespace AnyB1s\ShippingCalculator\Company;

use AnyB1s\ShippingCalculator\Address;
use AnyB1s\ShippingCalculator\Company;
use AnyB1s\ShippingCalculator\Package;
use Money\Currency;
use Money\Money;

class KraychevTransport implements Company
{
    public function name(): string
    {
        return 'Kraychev Transport';
    }

    public function canShipTo(Address $address): bool
    {
        return in_array($address->country()->getIsoAlpha2(), ['BG', 'DE', 'AT']);
    }

    public function canShipFrom(Address $address): bool
    {
        return in_array($address->country()->getIsoAlpha2(), ['BG', 'DE', 'AT']);
    }

    public function priceFor(Package $package): Money
    {
        $lev = new Currency('BGN');
        $amount = new Money(0, $lev);
        $weight = $package->weight()->quantity();

        for ($i = 1; $i <= $weight; $i++) {
            if ($i < 15) {
                $amount = $amount->add(new Money(400, $lev));
                continue;
            }

            $amount = $amount->add(new Money(300, $lev));
        }

        return $amount;
    }

    public function volume(Package $package)
    {
        // TODO: Implement volume() method.
    }
}
