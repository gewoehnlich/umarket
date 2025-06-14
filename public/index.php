<?php

namespace Gewoehnlich\Umarket;

use Symfony\Component\Panther\Client;

$client = Client::createChromeClient();

$crawler = $client->request('GET', 'https://www.ozon.ru/product/1712766160');

print_r($crawler);
