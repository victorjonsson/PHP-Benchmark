PHP-Benchmark
=============

This library contains classes used to compare algorithms and benchmark your application.

## Benchmarking

Gives you information about average memory peaks and time spent on page generation. The test will do a number of requests to your application with a query parameter
that tells the benchmark script to monitor the time and memory consumption during the request. When all requests
is finished you will get the following information:

 - Average time spent on generating the page
 - Average memory peak
 - Average number of included files
 - Average number of declared classes
 - The highest memory peak monitored during the test
 - The highest time spent on generating the page during the test
 - The number of failed requests (timeout or http status other then 200)

You execute the tests via command line, either using PHP CLI or Nodejs CLI.


### Setup

 1. Download the [script](https://raw.github.com/victorjonsson/PHP-Benchmark/master/php-benchmark.php) to your server.
 2. Open the file that is the first file to recieve the application request (this is usually index.php).
 3. Include the benchmark script in the top of the file.


### Usage

#### Retrieve benchmark data upon page load

Install this package somewhere on your server using composer

#### Stress test using command line (nodejs)

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

## Display benchmark data on page load

Benchmark data will be displayed in the browser upon page load if you add query
parameters `?php-benchmark-test=1&display-test-data=1` to the URL of your application.