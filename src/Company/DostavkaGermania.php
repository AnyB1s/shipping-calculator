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
 * Class DostavkaGermania
 * @package AnyB1s\ShippingCalculator\Company
 */
class DostavkaGermania implements Company
{
    /**
     * @inheritDoc
     */
    public function name() : string
    {
        return 'Dostavka Germania';
    }

    /**
     * @inheritDoc
     */
    public function canShipTo(Address $address) : bool
    {
        return 'BG' === $address->country()->getIsoAlpha2();
    }

    /**
     * @inheritDoc
     */
    public function canShipFrom(Address $address) : bool
    {
        return 'DE' === $address->country()->getIsoAlpha2();
    }

    /**
     * @inheritDoc
     */
    public function tariff(Package $package) : PricingCollection
    {
        if ($package->goingTo('DE')) {
            $amount = 250 * $package->weight()->quantity();
        } else {
            $amount = 290 * $package->weight()->quantity();
        }

        return new PricingCollection([
            new Tariff(
                $this,
                new Money($amount, new Currency('BGN')),
                new TariffType(TariffType::OFFICE_TO_OFFICE)
            )
        ]);
    }

    /**
     * @inheritDoc
     */
    public function volume(Package $package)
    {
        return 0;
    }
}
