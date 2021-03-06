<?php

namespace AnyB1s\ShippingCalculator\Handler;

use AnyB1s\ShippingCalculator\Address;
use AnyB1s\ShippingCalculator\Company;
use AnyB1s\ShippingCalculator\Package;
use AnyB1s\ShippingCalculator\PricingCollection;
use AnyB1s\ShippingCalculator\Tariff;
use AnyB1s\ShippingCalculator\TariffType;
use Money\Currency;
use Money\Money;

class KraychevTransport extends Base implements Company
{
    public function tariff(Package $package): PricingCollection
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

        return new PricingCollection([
            new Tariff(
                $amount,
                new TariffType(TariffType::OFFICE_TO_OFFICE)
            )
        ]);
    }

    public function volume(Package $package)
    {
        return 0;
    }
}
