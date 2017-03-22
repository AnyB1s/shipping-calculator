<?php

namespace AnyB1s\ShippingCalculator\Company;

use AnyB1s\ShippingCalculator\Address;
use AnyB1s\ShippingCalculator\Company;
use AnyB1s\ShippingCalculator\Package;
use AnyB1s\ShippingCalculator\PricingCollection;
use AnyB1s\ShippingCalculator\Tariff;
use AnyB1s\ShippingCalculator\TariffType;
use Money\Currency;
use Money\Money;

/**
 * Class Bulkris.
 */
class Bulkris implements Company
{
    /**
     * @return string
     */
    public function name(): string
    {
        return 'Bul Kris';
    }

    /**
     * @param Address $address
     * @return bool
     */
    public function canShipTo(Address $address) : bool
    {
        return in_array($address->country()->getIsoAlpha2(), ['DE', 'BG']);
    }

    public function canShipFrom(Address $address) : bool
    {
        return in_array($address->country()->getIsoAlpha2(), ['DE', 'BG']);
    }

    public function tariff(Package $package) : PricingCollection
    {
        $weight = $package->weight()->quantity();
        switch ($weight) {
            default:
            case $weight <= 15:
                $base = 0;
                break;
            case $weight > 15 && $weight <= 200:
                $base = 3000;
                break;
            case $weight > 200 && $weight <= 500:
                $base = 30000;
                break;
            case $weight > 500 && $weight <= 1000:
                $base = 66000;
                break;
        }

        $amount = 200 * $package->dimensions()->width() + $base;

        return new PricingCollection([
            new Tariff(
                $this,
                new Money($amount, new Currency('EUR')),
                new TariffType(TariffType::OFFICE_TO_OFFICE)
            )
        ]);
    }

    public function volume(Package $package)
    {
        return 0;
    }
}
