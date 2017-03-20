<?php

namespace AnyB1s\ShippingCalculator;

class Package
{
    /**
     * @var Address
     */
    private $recipientAddress;
    /**
     * @var Address
     */
    private $senderAddress;
    /**
     * @var Dimensions
     */
    private $dimensions;
    /**
     * @var Package\Weight
     */
    private $weight;

    /**
     * Package constructor.
     * @param Address $senderAddress
     * @param Address $recipientAddress
     * @param Package\Dimensions $dimensions
     * @param Package\Weight $
     */
    public function __construct(Address $senderAddress, Address $recipientAddress, Package\Dimensions $dimensions, Package\Weight $weight)
    {
        $this->senderAddress = $senderAddress;
        $this->recipientAddress = $recipientAddress;
        $this->dimensions = $dimensions;
        $this->weight = $weight;
    }

    public function senderAddress()
    {
        return $this->senderAddress;
    }

    public function recipientAddress()
    {
        return $this->recipientAddress;
    }

    public function dimensions()
    {
        return $this->dimensions;
    }

    public function weight()
    {
        return $this->weight;
    }
}
