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

class Leron extends Base implements Company
{
    public function tariff(Package $package): PricingCollection
    {
        $amount = $this->basePrice($package->senderAddress()) * $package->weight()->quantity();

        return new PricingCollection([
            new Tariff(
                new Money($amount, new Currency('BGN')),
                new TariffType(TariffType::OFFICE_TO_OFFICE)
            )
        ]);
    }

    public function volume(Package $package)
    {
        return 0;
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
