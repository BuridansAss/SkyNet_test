<?php


namespace App\Controllers;


use App\Json\Parser;
use App\Tariffs\Creator;
use App\Tariffs\Sort;

class Main
{
    public function hi()
    {
        echo 'hi';
    }

    public function index()
    {
        $objects = (new Parser($this->getDataFromSkynet()))->jsonToObjects();

        $objects = Creator::transformToTariffs($objects);

        Sort::byParent($objects);

        echo print_r($objects, 1);
    }

    private function getDataFromSkynet()
    {
        return file_get_contents('https://www.sknt.ru/job/frontend/data.json');
    }
}