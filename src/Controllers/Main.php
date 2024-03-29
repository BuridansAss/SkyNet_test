<?php


namespace App\Controllers;


use App\Json\Parser;
use App\Tariffs\Creator;
use App\Tariffs\Tariff;
use App\Tariffs\TariffVariant;
use Exception;

class Main extends BaseController
{
    private $parser;

    /**
     * Main constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->parser = new Parser($this->getDataFromSkynet());
    }

    /**
     * index action of Main controller
     */
    public function index()
    {
        $tariffs = Creator::transformToTariffs($this->parser->jsonToObjects());
        $bigTariff = [];

        /**
         * @var $tariff Tariff
         */
        foreach ($tariffs as $tariff) {
            $element = [];

            $element['title']       = $tariff->getTitle();
            $element['link']        = $tariff->getLink();
            $element['speed']       = $tariff->getSpeed();
            $element['prices']      = $tariff->getPrices();
            $element['freeOptions'] = $tariff->getFreeOptions();
            $element['id']          = $tariff::getIdByName($element['title']);
            $bigTariff[] = $element;
        }

        $this->render->rend(
            'tariffs',
            $bigTariff
        );
    }

    /**
     * @param $tariff array
     */
    public function getVariants($tariff)
    {
        try {
            $serializeVariants = [];

            if (!isset( $tariff['tariffId'])) {
                header('Location: /Controller404/index');
            }

            $tariff = Creator::getTariffById($this->parser->jsonToObjects(), $tariff['tariffId']);

            $title = $tariff->getTitle();

            /**
             * @var $variant TariffVariant
             */
            foreach ($tariff->getVariants() as $variant) {
                $element = [];

                $element['month']         = $variant->getPayPeriod();
                $element['declension']    = $variant->getMonthDeclension();
                $element['pricePerMonth'] = $variant->getPricePerMonth();
                $element['price']         = $variant->getPrice();
                $element['discount']      = $variant->getDiscount();
                $element['id']            = $variant->getId();
                $element['tariffId']      = Tariff::getIdByName($title);

                $serializeVariants[] = $element;
            }

            $this->render->rend(
                'variants',
                [
                    'variants' => $serializeVariants,
                    'title'    => $title
                ]
            );
        } catch (Exception $e) {
            header('Location: /Controller404/index');
        }
    }

    /**
     * @param $params array
     */
    public function choice($params)
    {
        try {

            if (!isset($params['tariffId']) | !isset($params['variantId'])) {
                header('Location: /Controller404/index');
            }

            $tariff = Creator::getTariffById($this->parser->jsonToObjects(), $params['tariffId']);
            $title = $tariff->getTitle();
            $variant = $tariff->getVariantById((int)$params['variantId']);

            $this->render->rend(
                'variant',
                [
                    'payPeriod'     => $variant->getPayPeriod(),
                    'declension'    => $variant->getMonthDeclension(),
                    'pricePerMonth' => $variant->getPricePerMonth(),
                    'price'         => $variant->getPrice(),
                    'activeBy'      => $variant->getNewPayDay(),
                    'title'         => $title
                ]
            );

        } catch (Exception $e) {
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