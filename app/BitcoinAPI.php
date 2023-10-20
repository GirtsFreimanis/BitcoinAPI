<?php

declare(strict_types=1);

namespace App;

class BitcoinAPI
{
    private string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function getBitcoin(): Bitcoin
    {
        $url = $this->url;
        $data = json_decode(file_get_contents($url));
        return new Bitcoin(
            $data->bpi->USD->rate_float,
            $data->bpi->USD->code,
            $data->time->updated
        );
    }
}