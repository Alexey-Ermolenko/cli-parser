#!/usr/bin/php
<?php
require_once __DIR__ . '/app/src/components/helpers/environmentHelper.php';
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/autoload.php';

use app\src\Context;
use app\src\display\CLIDisplay;
use app\src\display\HtmlDisplay;
use app\src\display\JsonDisplay;
use app\src\parser\FileParser;
use app\src\parser\UrlParser;

defined('APPLICATION_DIR') || define('APPLICATION_DIR', __DIR__ . '/../');
load_environment();

/*
$url = 'https://www.google.com/';
$file = '../test.html';
*/


if (php_sapi_name() !== 'cli') {
    die('is not cli mode');
}

if ($argc < 2) {
    $help = "
        Usage: php public/index.php [-p=test.html|https://www.example.com/] [-d=json|html|cli]
        Options:
                  -p   Path to html resource
                  -d   Data display method
        Example:
                  php public/index.php -p=https://www.example.com/ -d=json
                  php public/index.php -p=test.html -d=cli
    ";

    die(PHP_EOL . $help . PHP_EOL);
}

$options = getopt("p:d::");
$display_mode = env('DEFAULT_DISPLAY_MODE');
$path = null;

if (isset($options["p"])) {
    $path = $options["p"];
}

if (isset($options["d"]) &&  in_array($options["d"], [CLIDisplay::DISPLAY_MODE, HtmlDisplay::DISPLAY_MODE, JsonDisplay::DISPLAY_MODE])) {
    $display_mode = $options["d"];
}

try {
    //является ли path урлом
    if (!filter_var($path, FILTER_VALIDATE_URL) === false) {
        $context = new Context(new UrlParser());
    } else {
        $context = new Context(new FileParser());
    }

    $context->setTags($path);
    $context->display($display_mode)->view();
} catch (Exception $e) {
    echo $e->getMessage(). PHP_EOL;
}


