<?php

require __DIR__.'/../vendor/autoload.php';

use PHPBenchmark\testing\FunctionComparison;


FunctionComparison::load()
    ->addFunction('Short sleep', function() {
        usleep(1);
    })
    ->addFunction('Longer sleep', function() {
        usleep(10);
    })
    ->addFunction('Even longer sleep and allocating memory', function() {
        static $str='';
        usleep(100);
        $str .= str_repeat((string)mt_rand(), 10);
    })
    ->exec();