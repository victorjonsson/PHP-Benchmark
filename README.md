PHP-Benchmark
=============

This library contains classes used to compare algorithms and benchmark your application.

## Benchmarking

### Setup

1. Either [download](https://github.com/victorjonsson/PHP-Benchmark/archive/master.zip) the library to your server or 
install it in your project using [composer](http://getcomposer.org/)
2. Include the file init.php in the very beginning of the first file that receives the request to your
application (this is usually index.php). Then load the address of your website in the browser with the 
query parameters `php-benchmark-test=1&display-data=1` and the benchmark data will be displayed in the upper left corner
of your website.

![Becnhmark 1](http://victorjonsson.github.com/PHP-Benchmark/sc-1.png)

#### Taking snapshots

If you want to take snapshots from the benchmark data during the request you may do so by adding the following code.

```php
 \PHPBenchmark\Monitor::instance()->snapshot('Bootstrap finished');
````

Inserting some snapshots in the source code of WordPress gave me the following benchmark data

![Becnhmark 1](http://victorjonsson.github.com/PHP-Benchmark/sc-2.png)

## Comparing algorithms

### Setup (composer)

Add the dependency "phpbenchmark/phpbenchmark" to composer.json and your'e set to go.

### Example code

```php

require __DIR__.'/vendor/autoload.php';

use \PHPBenchmark\testing\FunctionComparison;

FunctionComparison::load()
    ->addFunction('stream_resolve_include_path', function() {
        $bool = stream_resolve_include_path(__FILE__) !== false;
    })
    ->addFunction('file_exists', function() {
        $bool = file_exists(__FILE__);
    })
    ->exec();

```

Load a file having this code in the browser, or call it via command line, and you will
find out which function that wins the game.

You can also call `->run()` to get hold of an object representing the results of the comparison test.
Read more in the [docs](https://github.com/victorjonsson/PHP-Benchmark/blob/master/DOCS.md#class-phpbenchmarktestingfunctioncomparison).
