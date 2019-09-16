<?php


namespace App\Tariffs;


use stdClass;

class TariffVariant
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var int
     */
    private $price;

    /**
     * @var int
     */
    private $priceAdd;

    /**
     * @var string
     */
    private $payPeriod;

    /**
     * @var string
     */
    private $newPayDay;

    /**
     * @var int
     */
    private $speed;

    /**
     * Create this object by static::create(stdClass $obj)
     *
     * TariffVariant constructor.
     * @param stdClass $object
     */
    private function __construct(stdClass $object)
    {
        $this->id        = $object->ID;
        $this->title     = $object->title;
        $this->price     = $object->price;
        $this->priceAdd  = $object->price_add;
        $this->payPeriod = $object->pay_period;
        $this->newPayDay = $object->new_payday;
        $this->speed     = $object->speed;
    }

    /**
     * @param stdClass $object
     * @return TariffVariant
     */
    public static function create(stdClass $object) : TariffVariant
    {
        return new self($object);
    }

}