<?php


namespace App\Controllers;


use App\Json\Parser;
use App\Render\Render;
use App\Tariffs\Creator;
use App\Tariffs\Sort;
use App\Tariffs\Tariff;

class Main extends BaseController
{
    private $tariffs;

    private $parser;

    public function __construct()
    {
        parent::__construct();

        $this->parser = new Parser($this->getDataFromSkynet());
        $this->tariffs = Creator::transformToTariffs($this->parser->jsonToObjects());
    }

    /**
     * index action of Main controller
     */
    public function index()
    {
        $bigTariff = [];

        /**
         * @var $tariff Tariff
         */
        foreach ($this->tariffs as $tariff) {
            $element = [];

            $element['title'] = $tariff->getTitle();
            $element['link'] = $tariff->getLink();
            $element['speed'] = $tariff->getSpeed();
            $element['prices'] = $tariff->getPrices();
            $element['freeOptions'] = $tariff->getFreeOptions();

            $bigTariff[] = $element;
        }

        $this->render->rend('tariffs', $bigTariff);
    }

    public function getVariants($tariff)
    {
        try {
            echo print_r(Creator::getTariffByName($this->parser->jsonToObjects(), $tariff['id']), 1);
        } catch (\Exception $e) {
            header('Location: /Controller404/index');
        }
    }

    /**
     * @return bool|string
     */
    private function getDataFromSkyNet()
    {
        return file_get_contents('https://www.sknt.ru/job/frontend/data.json');
    }
}