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

class Portokal implements Company
{
    public function name(): string
    {
        return 'Portokal';
    }

    public function canShipTo(Address $address): bool
    {
        return 'BG' === $address->country()->getIsoAlpha2();
    }

    public function canShipFrom(Address $address): bool
    {
        return 'GB' === $address->country()->getIsoAlpha2();
    }

    public function priceFor(Package $package): PricingCollection
    {
        $gbp = new Currency('GBP');
        $baseAmount = new Money(500, $gbp);
        $weight = $package->weight()->quantity();

        if ($weight > 5) {
            for ($i = 5; $i < $weight; ++$i) {
                $multiplier = ($i <= 100 ? 80 : 70);

                $baseAmount = $baseAmount->add(new Money($multiplier, $gbp));
            }
        }

        return new PricingCollection([ new Tariff($baseAmount, new TariffType(TariffType::OFFICE_TO_OFFICE)) ]);
    }

    public function volume(Package $package)
    {
        return 0;
    }
}
