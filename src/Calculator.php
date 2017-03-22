<?php

namespace AnyB1s\ShippingCalculator;

use Illuminate\Support\Collection;

class Calculator
{
    /**
     * @var Collection
     */
    private $companies;
    /**
     * @var Package
     */
    private $package;

    /**
     * Calculator constructor.
     * @param Package $package
     * @param Collection $companies
     */
    public function __construct(Package $package, Collection $companies)
    {
        $this->package = $package;
        $this->companies = $companies;
    }

    /**
     * @return Collection
     */
    public function compare()
    {
        return $this->companies
            ->filter(function (Company $company) {

                return $company->canShipTo($this->package->recipientAddress());
            })->filter(function (Company $company) {

                return $company->canShipFrom($this->package->senderAddress());
            })->map(function (Company $company) {

                return $company->tariff($this->package);
            });
    }
}
