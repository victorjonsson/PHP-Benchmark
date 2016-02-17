PHP-Benchmark
=============

This library contains classes used to compare algorithms and benchmark your application.

## Benchmarking

### Setup

1. Either [download](https://github.com/victorjonsson/PHP-Benchmark/archive/master.zip) the library to your server or 
install it in your project using [composer](http://getcomposer.org/)
2. Include the file init.php in the very beginning of the first file that receives the request to your
application (this is usually index.php). Then load the address of your website in the browser with the 
query parameters `php-benchmark-test=1` and the benchmark data will be displayed in the upper left corner
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

function xrange($start, $limit, $step = 1) {
    if ($start < $limit) {
        if ($step <= 0) {
            throw new LogicException('Step must be +ve');
        }

        for ($i = $start; $i <= $limit; $i += $step) {
            yield $i;
        }
    } else {
        if ($step >= 0) {
            throw new LogicException('Step must be -ve');
        }

        for ($i = $start; $i >= $limit; $i += $step) {
            yield $i;
        }
    }
}

FunctionComparison::load()
    ->addFunction('using array', function () {
        foreach (range(1, 9, 2) as $number) {}
    })
    ->addFunction('using generator', function () {
        foreach (xrange(1, 9, 2) as $number) {}
    })
    ->exec();
```

Load a file having this code in the browser, or call it via command line, and you will
find out that generators consumes less memory but is at the same time considerbly slower.

You can also call `->run()` to get hold of an object representing the results of the comparison test.
Read more in the [docs](https://github.com/victorjonsson/PHP-Benchmark/blob/master/DOCS.md#class-phpbenchmarktestingfunctioncomparison).
