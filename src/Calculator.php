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
                $package = $this->package;

                return $company->canShipTo($package->recipientAddress())&& $company->canShipFrom($package->senderAddress());
            })->map(function (Company $company) {
                return new Result($company, $company->priceFor($this->package));
            });
    }
}
