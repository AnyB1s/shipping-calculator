<?php

namespace AnyB1s\ShippingCalculator\Handler;

use AnyB1s\ShippingCalculator\Address;
use AnyB1s\ShippingCalculator\Package;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Yaml\Yaml;

/**
 * Class Base
 * @package AnyB1s\ShippingCalculator\Handler
 */
abstract class Base
{
    /**
     * @var array
     */
    protected $options = [];

    /**
     * Base constructor.
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $reflect = new \ReflectionClass($this);
        $filename = strtolower($reflect->getShortName());

        $yaml = Yaml::parse(file_get_contents(__DIR__.'/../../resources/'.$filename.'.yml'));
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);

        $this->options = $resolver->resolve(array_merge($yaml, $options));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'currency' => 'BGN',
        ])->setRequired([
            'name',
            'website',
            'offices',
            'ships_from',
            'ships_to',
        ]);
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->get('name');
    }

    /**
     * @param Address $address
     * @return bool
     */
    public function canShipTo(Address $address) : bool
    {
        return array_key_exists($address->country()->getIsoAlpha2(), $this->get('ships_to'));
    }

    /**
     * @param Address $address
     * @return bool
     */
    public function canShipFrom(Address $address) : bool
    {
        return array_key_exists($address->country()->getIsoAlpha2(), $this->get('ships_from'));
    }

    public function pickupLocationsFor(Package $package)
    {
        if (! isset($this->options['ships_to'][$package->recipientAddress()->country()->getIsoAlpha2()])) {
            return [];
        }

        return $this->options['ships_to'][$package->recipientAddress()->country()->getIsoAlpha2()];
    }

    /**
     * @param mixed $name
     * @return mixed null
     */
    public function get($name)
    {
        return $this->options && array_key_exists($name, $this->options) ? $this->options[$name] : null;
    }
}