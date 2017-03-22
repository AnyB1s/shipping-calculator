<?php

namespace AnyB1s\ShippingCalculator;

use Illuminate\Support\Collection;

class PricingCollection extends Collection
{
    /**
     * @inheritDoc
     */
    public function __construct($items)
    {
        $items = array_filter($items, function($item) {
            return $item instanceof Tariff;
        });

        parent::__construct($items);
    }
}