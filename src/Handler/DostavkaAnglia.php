<?php

namespace AnyB1s\ShippingCalculator\Handler;

use AnyB1s\ShippingCalculator\Address;
use AnyB1s\ShippingCalculator\Company;
use AnyB1s\ShippingCalculator\Package;
use AnyB1s\ShippingCalculator\Package\Weight;
use AnyB1s\ShippingCalculator\PricingCollection;
use AnyB1s\ShippingCalculator\Tariff;
use AnyB1s\ShippingCalculator\TariffType;
use Money\Currency;
use Money\Money;

class DostavkaAnglia extends Base implements Company
{
    public function tariff(Package $package): PricingCollection
    {
        $amount = $this->multiplierFor($package->weight()) * $package->weight()->quantity();

        return new PricingCollection([
            new Tariff(
                new Money($amount, new Currency($this->get('currency'))),
                new TariffType(TariffType::OFFICE_TO_OFFICE)
            )
        ]);
    }

    public function volume(Package $package): mixed
    {
        return 0;
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
