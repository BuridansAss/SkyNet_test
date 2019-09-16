<?php


namespace App\Tariffs;


class Sort
{
    const EARTH = 'Земля';
    const WATER = 'Воды';
    const FIRE  = 'Огонь';

    public static function byParent($arrayTariffs)
    {
        foreach ($arrayTariffs as $tariff) {

            if (mb_stristr($tariff->getParentTitle(), self::EARTH)) {
                echo $tariff->getParentTitle() . PHP_EOL;
            }
        }
    }
}