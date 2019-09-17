<?php


namespace App\Tariffs;


use Exception;
use stdClass;

class Tariff
{
    const ID_EARTH    = 1;
    const ID_WATER    = 2;
    const ID_FIRE     = 3;
    const ID_WATER_HD = 4;
    const ID_FIRE_HD  = 5;

    const EARTH_NAME    = 'Земля';
    const WATER_NAME    = 'Вода';
    const FIRE_NAME     = 'Огонь';
    const WATER_HD_NAME = 'Вода HD';
    const FIRE_HD_NAME  = 'Огонь HD';

    /**
     * @var array
     */
    private static $tariffsMap = [
        self::ID_EARTH    => self::EARTH_NAME,
        self::ID_WATER    => self::WATER_NAME,
        self::ID_FIRE     => self::FIRE_NAME,
        self::ID_WATER_HD => self::WATER_HD_NAME,
        self::ID_FIRE_HD  => self::FIRE_HD_NAME
    ];

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
        return $this->link;
    }

    /**
     * @return int
     */
    public function getSpeed() : int
    {
        return $this->speed;
    }

    /**
     * @return string
     */
    public function getPrices() : string
    {
        $min = null;
        $max = null;

        /**
         * @var $variant TariffVariant
         */
        foreach ($this->variants as $variant) {
            $price = $variant->getAveragePrice();

            if (!isset($min) && !isset($max)) {
                $min = $price;
                $max = $price;
                continue;
            }

            if ($price < $min) {
                $min = $price;
            }

            if ($price > $max) {
                $max = $price;
            }
        }

        return $min . ' - ' . $max . ' ';
    }

    /**
     * @return int
     */
    public function getPriceAdd() : int
    {
        return $this->priceAdd;
    }

    /**
     * @return array
     */
    public function getFreeOptions() : array
    {
        if (isset($this->freeOptions)) {
            return $this->freeOptions;
        }

        return [];
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
     * @param $id
     * @return mixed
     * @throws Exception
     */
    public static function getNameById($id) : string
    {
        if (isset(self::$tariffsMap[$id])) {
            return self::$tariffsMap[$id];
        }

        throw new Exception('tariff\'s id doesn\'t exist');
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