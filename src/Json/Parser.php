<?php


namespace App\Json;


use stdClass;

class Parser
{
    /**
     * @var string
     */
    private $json;

    /**
     * Parser constructor.
     * @param $json
     */
    public function __construct($json)
    {
        $this->json = $json;
    }

    /**
     * @return stdClass
     */
    public function jsonToObjects() : stdClass
    {
        return json_decode($this->json);
    }
}