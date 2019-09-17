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
     * @var int
     */
    private $basePrice;

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

    /**
     * @return int
     */
    public function getAveragePrice() : int
    {
        $average =  $this->price / $this->payPeriod;

        return (int) $average;
    }

    /**
     * @return int
     */
    public function getPrice() : int
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getPricePerMonth() : int
    {
        return (int)($this->price / (int)$this->payPeriod);
    }

    /**
     * @return string
     */
    public function getPayPeriod() : string
    {
        return $this->payPeriod;
    }

    /**
     * @return int
     */
    public function getDiscount() : int
    {
        return (int)$this->payPeriod * $this->basePrice - $this->price;
    }

    /**
     * @param $basePrice
     */
    public function setBasePrice($basePrice) : void
    {
        $this->basePrice = $basePrice;
    }

    /**
     * @return int
     */
    public function getBasePrice() : int
    {
        return $this->basePrice;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}