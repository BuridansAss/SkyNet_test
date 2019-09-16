<?php


namespace App\Json;


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

    public function jsonToObjects()
    {
        return json_decode($this->json);
    }
}