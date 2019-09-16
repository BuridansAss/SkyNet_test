<?php


namespace App\Tariffs;


use stdClass;

abstract class AbstractTariff
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var String
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
     * @var string;
     */
    private $parentTitle;

    /**
     * @var array
     */
    private $freeOptions;

    /**
     * @var string
     */
    private $link;

    /**
     * AbstractTariff constructor.
     * @param stdClass $object
     */
    protected function __construct(stdClass $object)
    {
        $this->id          = $object->ID;
        $this->title       = $object->title;
        $this->price       = $object->price;
        $this->priceAdd    = $object->price_add;
        $this->payPeriod   = $object->pay_period;
        $this->newPayDay   = $object->new_payday;
        $this->speed       = $object->speed;
        $this->parentTitle = $object->parentTitle;
        $this->link        = $object->link;

        if (isset($object->freeOptions)) {
            $this->freeOptions = $object->freeOptions;
        }
    }

    /**
     * @return string
     */
    public function getParentTitle()
    {
        return $this->parentTitle;
    }


}