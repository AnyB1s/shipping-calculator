<?php

namespace AnyB1s\ShippingCalculator\Company;

use AnyB1s\ShippingCalculator\Address;
use AnyB1s\ShippingCalculator\Company;
use AnyB1s\ShippingCalculator\Package;
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

    public function priceFor(Package $package): Money
    {
        $gbp = new Currency('GBP');
        $baseAmount = new Money(500, $gbp);
        $weight = $package->weight()->quantity();

//        if ( $packge->type()->is( PackageType::PERSONAL ) ) {
//            throw new \Exception('wtf dude');
//        }

        if ($weight > 5) {
            for ($i = 5; $i < $weight; ++$i) {
                $multiplier = ($i <= 100 ? 80 : 70);

                $baseAmount = $baseAmount->add(new Money($multiplier, $gbp));
            }
        }

        $this->price = $baseAmount;

        return $baseAmount;
    }

    public function volume(Package $package)
    {
        // TODO: Implement volume() method.
    }

}