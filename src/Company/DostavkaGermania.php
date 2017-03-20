<?php

namespace AnyB1s\ShippingCalculator\Company;

use AnyB1s\ShippingCalculator\Address;
use AnyB1s\ShippingCalculator\Company;
use AnyB1s\ShippingCalculator\Package;
use AnyB1s\ShippingCalculator\PricingCollection;
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
    public function priceFor(Package $package) : PricingCollection
    {
        $amount = 250 * $package->weight()->quantity();

        return new PricingCollection([
            new Money($amount, new Currency('BGN'))
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
