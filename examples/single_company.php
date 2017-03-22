<?php

use AnyB1s\ShippingCalculator\PricingCollection;
use AnyB1s\ShippingCalculator\Tariff;
use Money\Money;

require_once __DIR__ . '/../vendor/autoload.php';

$from = new \AnyB1s\ShippingCalculator\Address(country('GB'));
$to = new \AnyB1s\ShippingCalculator\Address(country('BG'));

$dimensions = new \AnyB1s\ShippingCalculator\Package\Dimensions(50, 50, 50, 'kg');
$package = new \AnyB1s\ShippingCalculator\Package($from, $to, $dimensions, new \AnyB1s\ShippingCalculator\Package\Weight(100, 'kg'));

$companies = collect([
    new \AnyB1s\ShippingCalculator\Company\Bulkris(),
    new \AnyB1s\ShippingCalculator\Company\DostavkaAnglia(),
    new \AnyB1s\ShippingCalculator\Company\DostavkaGermania(),
    new \AnyB1s\ShippingCalculator\Company\EvtinoUk(),
    new \AnyB1s\ShippingCalculator\Company\KraychevTransport(),
    new \AnyB1s\ShippingCalculator\Company\Leron(),
    new \AnyB1s\ShippingCalculator\Company\Portokal(),
]);

$calculator = new \AnyB1s\ShippingCalculator\Calculator($package, $companies);

$calculator->compare()->each(function(PricingCollection $pricingCollection) {
    $pricingCollection->each(function(Tariff $tariff) {
        echo $tariff->company()->name() . PHP_EOL;
        echo $tariff->price()->absolute()->getAmount() . PHP_EOL;
    });
});