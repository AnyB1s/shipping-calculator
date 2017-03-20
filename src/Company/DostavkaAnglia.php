<?php

namespace AnyB1s\ShippingCalculator\Company;

use AnyB1s\ShippingCalculator\Address;
use AnyB1s\ShippingCalculator\Company;
use AnyB1s\ShippingCalculator\Package;
use AnyB1s\ShippingCalculator\Package\Weight;
use Money\Currency;
use Money\Money;

class DostavkaAnglia implements Company
{
    public function name(): string
    {
        return 'Dostavka Anglia';
    }

    public function canShipTo(Address $address): bool
    {
        return 'BG' === $address->country()->getIsoAlpha2();
    }

    public function canShipFrom(Address $address): bool
    {
        return 'GB' === $address->country()->getIsoAlpha2();
    }

    public function priceFor(Package $package): Money
    {
        $amount = $this->multiplierFor($package->weight()) * $package->weight()->quantity();

        return new Money($amount, new Currency('BGN'));
    }

    public function volume(Package $package): mixed
    {
        // TODO: Implement volume() method.
    }

    /**
     * @param Weight $weight
     * @return int
     */
    private function multiplierFor(Weight $weight)
    {
        if ($weight->quantity() <= 10) {
            return 200;
        }

        if ($weight->quantity() <= 50) {
            return 180;
        }

        return 150;
    }
}
