<?php

namespace Gewoehnlich\Umarket;

use Symfony\Component\ErrorHandler\Debug;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Panther\Client;
use Symfony\Component\Process\Process;
use Gewoehnlich\Umarket\Core\Parser;
use Gewoehnlich\Umarket\Core\Webpage;

require_once __DIR__ . '/../vendor/autoload.php';

Debug::enable();

$url = 'https://www.ozon.ru/product/1712766160';

$webpage = Webpage::fetch($url);

$data = Parser::data($webpage);

print_r($data);
