<?php
declare(strict_types=1);

namespace App;

use GuzzleHttp\Client;

class BitcoinAPI
{
    private string $url;
    private Client $httpClient;

    public function __construct(string $url, Client $httpClient)
    {
        $this->url = $url;
        $this->httpClient = $httpClient;
    }

    public function getBitcoin(): Bitcoin
    {
        $response = $this->httpClient->get($this->url);
        $data = json_decode($response->getBody()->getContents());

        return new Bitcoin(
            $data->bpi->USD->rate_float,
            $data->bpi->USD->code,
            $data->time->updated
        );
    }
}
