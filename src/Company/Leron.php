<?php

namespace AnyB1s\ShippingCalculator\Company;

use AnyB1s\ShippingCalculator\Address;
use AnyB1s\ShippingCalculator\Company;
use AnyB1s\ShippingCalculator\Package;
use Money\Currency;
use Money\Money;

class Leron implements Company
{
    public function name(): string
    {
        return 'Leron';
    }

    public function canShipTo(Address $address): bool
    {
        return 'BG' === $address->country()->getIsoAlpha2();
    }

    public function canShipFrom(Address $address): bool
    {
        return in_array($address->country()->getIsoAlpha2(), ['GB', 'DE', 'ES']);
    }

    public function priceFor(Package $package): Money
    {
        $amount = $this->basePrice($package->senderAddress()) * $package->weight()->quantity();

        return new Money($amount, new Currency('BGN'));
    }

    public function volume(Package $package)
    {
        // TODO: Implement volume() method.
    }

    private function basePrice(Address $address)
    {
        switch ($address->country()->getIsoAlpha2()) {
            case 'GB':
                return 200;
            case 'DE':
                return 300;
            case 'ES':
                return 550;
        }
    }
}
