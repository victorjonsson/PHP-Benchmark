<?php

if( isset($_GET['php-benchmark-test']) ) {
    require __DIR__.'/lib/PHPBenchmark/Monitor.php';
    \PHPBenchmark\Monitor::instance()->init( !empty($_GET['display-data']) );
}
