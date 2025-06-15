<?php

namespace Gewoehnlich\Umarket;

use Symfony\Component\ErrorHandler\Debug;
use Gewoehnlich\Umarket\Core\WebScraper;

require_once __DIR__ . '/../vendor/autoload.php';

Debug::enable();

if ($argc != 2) {
    echo "Необходимо передать ссылку как параметр!\n";
    echo "Например, php public/index.php https://www.ozon.ru/product/1712766160";
    exit(1);
}

$url = $argv[1];

$data = WebScraper::handle($url);

print_r([
    'success' => true,
    'result' => $data
]);
