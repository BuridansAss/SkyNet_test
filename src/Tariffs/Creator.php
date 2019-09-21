<?php


namespace App\Tariffs;


use Exception;
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

    /**
     * @param stdClass $jsonObject
     * @param $id
     * @return Tariff
     * @throws Exception
     */
    public static function getTariffById(stdClass $jsonObject, $id) : Tariff
    {
        try {
            $tariffName = Tariff::getNameById($id);

            foreach ($jsonObject->tarifs as $tariff) {

                if ($tariff->title === $tariffName) {
                    return Tariff::create($tariff);
                }

                continue;
            }
        } catch (Exception $e) {
            header('/Controller404/index');
        }

        throw new Exception('Can\'t create TariffObject');
    }
}