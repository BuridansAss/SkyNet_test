<?php


namespace App\Render;


class Render
{
    /**
     * @var string
     */
    private $pathToTemplatesFolder;

    /**
     * @var string
     */
    private static $controller;

    /**
     * @var string
     */
    private static $action;

    /**
     * Render constructor.
     */
    public function __construct()
    {
        $this->pathToTemplatesFolder = __DIR__ . '/../templates/';
    }

    /**
     * @param $name
     * @param array $args
     */
    public function rend($name, $args = []) : void
    {
        $$name = $args;

        include $this->pathToTemplatesFolder . 'layout/header.php';
        include $this->pathToTemplatesFolder . self::$controller . '/' . self::$action . '.php';
        include $this->pathToTemplatesFolder . 'layout/footer.php';
    }

    /**
     * @param $controller
     */
    public static function setController($controller) : void
    {
        self::$controller = $controller;
    }

    /**
     * @param $action
     */
    public static function setAction($action) :void
    {
        self::$action = $action;
    }
}