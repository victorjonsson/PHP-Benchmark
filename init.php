<?php
/**
 * File used to initiate performance monitoring.
 *
 * @website https://github.com/victorjonsson/PHP-Benchmark/
 * @package PHPBenchmark
 * @author Victor Jonsson (http://victorjonsson.se)
 * @license MIT
 */

// Load class loader
$localAutLoaderFile = __DIR__.'/vendor/autoload.php';
if (file_exists($localAutLoaderFile)) {
    require_once $localAutLoaderFile;
} else {
    require_once __DIR__.'/../../autoload.php';
}

// Only activate monitor if query string contains "php-benchmark-test"
if (empty($_GET['php-benchmark-test']) ) {
    return;
}

use League\Event\Event;
use PHPBenchmark\HtmlView;
use PHPBenchmark\Monitor;
use PHPBenchmark\MonitorInterface;

Monitor::instance()
    ->init()
    ->addListener(Monitor::EVENT_SHUT_DOWN, function(Event $evt, MonitorInterface $monitor) {
        $htmlView = new HtmlView();
        echo $htmlView->getView($monitor);
    });
