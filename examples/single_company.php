<?php

use AnyB1s\ShippingCalculator\PricingCollection;
use AnyB1s\ShippingCalculator\Tariff;

require_once __DIR__ . '/../vendor/autoload.php';

$from = new \AnyB1s\ShippingCalculator\Address(country('DE'));
$to = new \AnyB1s\ShippingCalculator\Address(country('BG'));

$dimensions = new \AnyB1s\ShippingCalculator\Package\Dimensions(50, 50, 50, 'kg');
$package = new \AnyB1s\ShippingCalculator\Package($from, $to, $dimensions, new \AnyB1s\ShippingCalculator\Package\Weight(100, 'kg'));

$companies = new Illuminate\Support\Collection([
    new \AnyB1s\ShippingCalculator\Handler\Bulkris(),
    new \AnyB1s\ShippingCalculator\Handler\DostavkaAnglia(),
    new \AnyB1s\ShippingCalculator\Handler\DostavkaGermania(),
    new \AnyB1s\ShippingCalculator\Handler\EvtinoUk(),
    new \AnyB1s\ShippingCalculator\Handler\KraychevTransport(),
    new \AnyB1s\ShippingCalculator\Handler\Leron(),
    new \AnyB1s\ShippingCalculator\Handler\Portokal(),
]);

$calculator = new \AnyB1s\ShippingCalculator\Calculator($package, $companies);

$calculator->compare()->each(function(PricingCollection $pricingCollection) {
    $pricingCollection->each(function(Tariff $tariff) {
        echo $tariff->company()->name() . PHP_EOL;
        echo $tariff->price()->absolute()->getAmount() . PHP_EOL;
    });
});