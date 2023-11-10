<?php
declare(strict_types=1);

require_once "vendor/autoload.php";

use App\BitcoinAPI;
use Brick\Math\RoundingMode;
use Brick\Money\CurrencyConverter;
use Brick\Money\Exception\CurrencyConversionException;
use Brick\Money\ExchangeRateProvider\ConfigurableProvider;
use Brick\Money\Money;

$url = "https://api.coindesk.com/v1/bpi/currentprice.json";

$ApiData = new BitcoinAPI($url);
$bitcoin = $ApiData->getBitcoin();
echo "current data for Bitcoin:\n";
echo "price: {$bitcoin->getPrice()}\n";
echo "Currency: {$bitcoin->getCurrency()}\n";
echo "Last updated: {$bitcoin->getUpdated()}\n";

$provider = new ConfigurableProvider();
$provider->setExchangeRate('EUR', 'USD', '1.0987');
$provider->setExchangeRate('USD', 'EUR', '0.9123');
$converter = new CurrencyConverter($provider);

$money = Money::of((int)$bitcoin->getPrice(), $bitcoin->getCurrency());

$currency = "b";
while ($currency != "q") {
    $currency = readline("Enter currency code (ex. EUR)> ");
    try {
        echo $converter->convert($money, $currency, null, RoundingMode::DOWN);
    } catch (CurrencyConversionException $e) {
        echo "currency not found\n";
    }
    echo "\n";
}