#!/usr/bin/env php
<?php

declare(strict_types=1);

$autoloadPath1 = __DIR__ . '/../../../autoload.php';
$autoloadPath2 = __DIR__ . '/../vendor/autoload.php';
if (file_exists($autoloadPath1)) {
    require_once $autoloadPath1;
} else {
    require_once $autoloadPath2;
}

use Hexhat\Coins\Help;
use Hexhat\Coins\Config;
use Hexhat\Coins\Connect;
use Hexhat\Coins\Cron;
use Hexhat\Coins\Report;

use function Hexhat\Coins\Library\checkExtensions;

checkExtensions(['curl', 'intl', 'json'], get_loaded_extensions());

// Get cli args
$options = getopt('hcrvs:', [
    'help',
    'cron',
    'report', 'verbose',
    'sort:'
]);
$optionsFirstKey = array_key_first($options);

// Process cli args
// Arguments are prioritized depending on its order in the switch construction
switch (true) {
    case ($optionsFirstKey == 'help' ||
          $optionsFirstKey == 'h'):
        $help = new Help();
        echo $help->getHelp();
        exit(0);

    case ($optionsFirstKey == 'cron' ||
          $optionsFirstKey == 'c'):
        $getConfig = new Config();
        $config = $getConfig->getConfig();
        $connect = new Connect();
        $response = $connect->dialUp($config);
        $result = new Cron();
        echo $result->getTotal($config, $response);
        exit(0);

    case ($optionsFirstKey == 'report'  ||
          $optionsFirstKey == 'r'       ||
          $optionsFirstKey == 'verbose' ||
          $optionsFirstKey == 'v'):
        $getConfig = new Config();
        $config = $getConfig->getConfig();
        $connect = new Connect();
        $response = $connect->dialUp($config);
        $result = new Report();
        echo $result->getReport($config, $response);
        exit(0);

    default:
        $help = new Help();
        echo $help->getHelp();
        exit(1);
}
