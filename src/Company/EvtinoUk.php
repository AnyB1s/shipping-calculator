<?php

namespace AnyB1s\ShippingCalculator\Company;

use AnyB1s\ShippingCalculator\Address;
use AnyB1s\ShippingCalculator\Company;
use AnyB1s\ShippingCalculator\Package;
use AnyB1s\ShippingCalculator\PricingCollection;
use Money\Currency;
use Money\Money;

class EvtinoUk implements Company
{
    /**
     * @inheritDoc
     */
    public function name() : string
    {
        return 'Evtino.co.uk';
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
        return 'GB' === $address->country()->getIsoAlpha2();
    }

    /**
     * @inheritDoc
     */
    public function priceFor(Package $package) : PricingCollection
    {
        $gbp = new Currency('GBP');
        $baseAmount = new Money(100, $gbp);
        $weight = $package->weight()->quantity();

        if ($weight > 10) {
            for ($i = 10; $i < $weight; ++$i) {
                $baseAmount = $baseAmount->add(new Money(100, $gbp));
            }
        }

        return new PricingCollection([ $baseAmount ]);
    }

    /**
     * @inheritDoc
     */
    public function volume(Package $package)
    {
        return 0;
    }
}
