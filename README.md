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


### Stress test using command line (nodejs)

By using the (nodejs) command line tool you'll get information about average memory peaks and time spent on page 
generation. The test will do a number of requests to your application with a query parameter
that tells the benchmark script to monitor the time and memory consumption during the request. When all requests
is finished you will get the following information:

 - Average time spent on generating the page
 - Average memory peak
 - Average number of included files
 - Average number of declared classes
 - The highest memory peak monitored during the test
 - The highest time spent on generating the page during the test
 - The number of failed requests (timeout or http status other then 200)


First of all you need to [install node](http://nodejs.org/#download) if you haven't already. After that you have installed node you have to
download the [nodejs script](https://raw.github.com/victorjonsson/PHP-Benchmark/master/php-benchmark) to your server, name
the file *php-benchmark*. Then navigate to the directory where your nodejs script is located and run one of the 
following commands:

`$ node php-benchmark http://mywebsite.com/` Will do a benchmark test with 50 requests that gives you average page generation time, memory peak,
number of loaded classes and included files.

`$ node php-benchmark http://mywebsite.com/ -n 500` Will do a benchmark test with 500 requests.

`$ node php-benchmark http://mywebsite.com/ -s 20` Will start 20 requests per second until all requests is
made. If you're doing this test to monitor the performance of your PHP code
(rather then load testing your server infrastructure) and having limited server resources it might be good to set this 
option as low as 1-2 requests per second.

`$ node php-benchmark http://mywebsite.com/ -nu` Will prevent the use of unique URL:s when requesting the application.

`$ node php-benchmark http://mywebsite.com/ -v` If a lot of the request fails it might be good to add *-v* to get more information about the failing requests.

`$ node php-benchmark http://mywebsite.com/ -f /var/log/` Will write ouput to log file in /var/log/.

`$ node php-benchmark http://mywebsite.com/ -f test.log` Will write ouput to log file test.log in current working directory.

*All options can of course be used together as well, these commands are only simple examples.*

## Comparing algorithms

### Setup (manually)

[Download](https://github.com/victorjonsson/PHP-Benchmark/archive/master.zip) the library to your server. After that all
you have to do is to  include the file `lib/autoload.php` to be able to load the classes you want to use.

### Setup (composer)

Not so much you need to do, add the dependency "phpbenchmark/phpbenchmark" to composer.json and your'e set to go.

### Example code

```php

require __DIR__.'/vendor/autoload.php';

use \PHPBenchmark\FunctionComparison;

FunctionComparison::load()
    ->setFunctionA('stream_resolve_include_path', function() {
        $bool = stream_resolve_include_path(__FILE__) !== false;
    })
    ->setFunctionB('file_exists', function() {
        $bool = file_exists(__FILE__);
    })
    ->exec();

```

Load a file having this code in the browser or call it via command line and you will find out that `stream_resolve_include_pate` wins
the game, being about 30-35% faster.


### Extending AbstractFunctionComparison 

If you would want to manage a large collections of tests you can create a class (extending [AbstractFunctionComparison](https://github.com/victorjonsson/PHP-Benchmark/blob/master/lib/PHPBenchmark/AbstractFunctionComparison.php))
for each test. Put all classes in the same directory and call `FunctionComparison::runTests( $path_to_class_directory )` and 
you'll be able to execute all tests in one request.

