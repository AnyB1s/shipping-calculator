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
        return new PricingCollection([
            new Tariff($this->office2office($package), new TariffType(TariffType::OFFICE_TO_OFFICE)),
            new Tariff($this->office2address($package), new TariffType(TariffType::OFFICE_TO_ADDRESS)),
        ]);
    }

    /**
     * @inheritDoc
     */
    public function volume(Package $package)
    {
        return 0;
    }

    private function office2office(Package $package)
    {
        $gbp = new Currency('GBP');
        $baseAmount = new Money(1000, $gbp);
        $weight = $package->weight()->quantity();

        if ($weight > 10) {
            for ($i = 10; $i < $weight; ++$i) {
                $baseAmount = $baseAmount->add(new Money(100, $gbp));
            }
        }

        return $baseAmount;
    }

    private function office2address(Package $package)
    {
        $gbp = new Currency('GBP');
        $baseAmount = new Money(1300, $gbp);
        $weight = $package->weight()->quantity();

        if ($weight > 10) {
            for ($i = 10; $i < $weight; ++$i) {
                $baseAmount = $baseAmount->add(new Money(130, $gbp));
            }
        }

        return $baseAmount;
    }
}
