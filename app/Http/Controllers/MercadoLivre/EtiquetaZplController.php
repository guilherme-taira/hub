<?php

namespace App\Http\Controllers\MercadoLivre;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

interface etiquetaZPL
{
    public function resource();
    public function get($resource);
}

class EtiquetaZplController implements etiquetaZPL
{
    const URL_BASE_ETIQUETA_ZPL = "https://api.mercadolibre.com/shipment_labels";

    private $shipment;
    private $_token;

    public function __construct($shipment, $_token)
    {
        $this->shipment = $shipment;
        $this->_token = $_token;
    }
    public function resource()
    {
        return $this->get("?shipment_ids=" . $this->getShipment() . "&response_type=zpl2");
    }

    public function get($resource)
    {

        // ENDPOINT PARA REQUISICAO
        $endpoint = self::URL_BASE_ETIQUETA_ZPL . $resource;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer {$this->get_token()}"]);
        $response = curl_exec($ch);
        curl_close($ch);
        print_r(($response));
    }

    /**
     * Get the value of shipment
     */
    public function getShipment()
    {
        return $this->shipment;
    }

    /**
     * Get the value of _token
     */
    public function get_token()
    {
        return $this->_token;
    }
}
