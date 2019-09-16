<?php


namespace App\Controllers;


use App\Json\Parser;
use App\Tariffs\Creator;
use App\Tariffs\Sort;

class Main
{
    private $tariffs;

    private function __construct()
    {
        $parser = new Parser($this->getDataFromSkynet());

        $this->tariffs = Creator::transformToTariffs($parser->jsonToObjects());
    }

    public function index()
    {
        $objects = (new Parser($this->getDataFromSkynet()))->jsonToObjects();

        $objects = Creator::transformToTariffs($objects);

        //Sort::byParent($objects);

        echo print_r($objects, 1);
    }

    /**
     * @return bool|string
     */
    private function getDataFromSkyNet()
    {
        return file_get_contents('https://www.sknt.ru/job/frontend/data.json');
    }
}