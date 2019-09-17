<?php


namespace App\Controllers;


use App\Render\Render;

abstract class BaseController
{
    /**
     * @var Render
     */
    protected $render;

    /**
     * BaseController constructor.
     */
    protected function __construct()
    {
        $this->render = new Render();
    }

}