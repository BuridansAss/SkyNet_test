<?php


namespace App\Tariffs;


use stdClass;

class Creator
{
    /**
     * @param stdClass $jsonObject
     * @return array
     */
    public static function transformToTariffs(stdClass $jsonObject) : array
    {
        $result = [];

        foreach ($jsonObject->tarifs as $tariff) {
           $result[] = Tariff::create($tariff);
        }

        return $result;
    }
}