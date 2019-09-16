<?php


namespace App\Tariffs;


use stdClass;

class Creator
{
    /**
     * @param stdClass $jsonObject
     * @return array
     */
    public static function transformToTariffs(stdClass $jsonObject)
    {
        $result = [];

        foreach ($jsonObject->tarifs as $tariff) {
            $parentTitle  = $tariff->title;
            $freeOptions = $tariff->free_options;
            $link        = $tariff->link;

            foreach ($tariff->tarifs as $childTariff) {
                $childTariff->parentTitle  = $parentTitle;
                $childTariff->freeOptions = $freeOptions;
                $childTariff->link        = $link;

                $result[] = Tariff::create($childTariff);
            }
        }

        return $result;
    }
}