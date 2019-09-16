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

    /**
     * Create this object by static::create(stdClass $obj)
     *
     * Tariff constructor.
     * @param stdClass $object
     */
    private function __construct(stdClass $object)
    {
        $this->title    = $object->title;
        $this->link     = $object->link;
        $this->speed    = $object->speed;
        $this->priceAdd = $object->price_add;

        $this->initVariants($object->tarifs);

        if (isset($object->free_options)) {
            $this->freeOptions = $object->free_options;
        }
    }

    /**
     * @return string
     */
    public function getTitle() : string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getLink() : string
    {
        return $this->title;
    }

    /**
     * @return int
     */
    public function getSpeed() : int
    {
        return $this->title;
    }

    /**
     * @return int
     */
    public function getPriceAdd() : int
    {
        return $this->title;
    }

    /**
     * @param stdClass $object
     * @return Tariff
     */
    public static function create(stdClass $object) : Tariff
    {
        return new self($object);
    }

    /**
     * @param $variants
     */
    private function initVariants($variants) : void
    {
        foreach ($variants as $variant) {
            $this->variants[] = TariffVariant::create($variant);
        }
    }
}