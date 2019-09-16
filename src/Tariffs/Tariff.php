<?php


namespace App\Tariffs;


use stdClass;

class Tariff
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var array
     */
    private $variants;

    /**
     * @var string
     */
    private $link;

    /**
     * @var int
     */
    private $speed;

    /**
     * @var int
     */
    private $priceAdd;

    /**
     * @var array
     */
    private $freeOptions;

    public function __construct(stdClass $object)
    {
        $this->title = $object->title;
        $this->variants = $object->tarifs;
        $this->link = $object->link;
        $this->speed = $object->speed;
        $this->priceAdd = $object->price_add;
        $this->freeOptions = $object->free_options;
    }
}