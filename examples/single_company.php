<?php

use Money\Money;

require_once __DIR__ . '/../vendor/autoload.php';

$from = new \AnyB1s\ShippingCalculator\Address(country('DE'));
$to = new \AnyB1s\ShippingCalculator\Address(country('BG'));

$dimensions = new \AnyB1s\ShippingCalculator\Package\Dimensions(50, 50, 50, 'kg');
$package = new \AnyB1s\ShippingCalculator\Package($from, $to, $dimensions, new \AnyB1s\ShippingCalculator\Package\Weight(100, 'kg'));

$companies = collect([
    new \AnyB1s\ShippingCalculator\Company\Bulkris(),
    new \AnyB1s\ShippingCalculator\Company\DostavkaAnglia(),
    new \AnyB1s\ShippingCalculator\Company\KraychevTransport(),
    new \AnyB1s\ShippingCalculator\Company\Leron(),
    new \AnyB1s\ShippingCalculator\Company\Portokal(),
]);

$calculator = new \AnyB1s\ShippingCalculator\Calculator($package, $companies);

$calculator->result()->each(function(Money $price) {
    print_r($price);
});