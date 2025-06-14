<?php

namespace Gewoehnlich\Umarket;

use Symfony\Component\ErrorHandler\Debug;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Panther\Client;

require_once __DIR__ . '/../vendor/autoload.php';

Debug::enable();

$client = Client::createChromeClient(null, ['--no-sandbox', '--disable-dev-shm-usage']);
$crawler = $client->request('GET', 'https://www.ozon.ru/product/1712766160');
$html = $client->getPageSource();
file_put_contents('ozon.html', $html);
print_r($html);
