<?php


namespace App\Tariffs;


use stdClass;

class Tariff extends AbstractTariff
{
    /**
     * Tariff constructor.
     * @param stdClass $object
     */
    protected function __construct(stdClass $object)
    {
        parent::__construct($object);
    }

    /**
     * @param stdClass $object
     * @return Tariff
     */
    public static function create(stdClass $object)
    {
        return new self($object);
    }

    /**
     * dont try clone this object
     */
    private function __clone()
    {

    }

    /**
     *
     */
    private function __wakeup()
    {

    }
}