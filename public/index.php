<?php

namespace Gewoehnlich\Umarket;

use Symfony\Component\ErrorHandler\Debug;
use Gewoehnlich\Umarket\Core\WebScraper;

require_once __DIR__ . '/../vendor/autoload.php';

Debug::enable();

$url = 'https://www.ozon.ru/product/1712766160';

$data = WebScraper::handle($url);

print_r([
    'success' => true,
    'result' => $data
]);
