<?php

namespace AnyB1s\ShippingCalculator;

use PHPExtra\Type\Enum\Enum;

class TariffType extends Enum
{
    const _default = self::OFFICE_TO_OFFICE;

    const OFFICE_TO_OFFICE = 'Office to Office';
    const OFFICE_TO_ADDRESS = 'Office to Address';
    const ADDRESS_TO_OFFICE = 'Address to Office';
}