PHP-Benchmark
=============

Simple to use benchmark script for your PHP-application. Gives you information about average page generation time and memory consumption.

### Dependencies

- PHP version >= 5.2
- allow_url_fopen has to be enabled in php.ini


## Setup

 1. Download the [script](https://raw.github.com/victorjonsson/PHP-Benchmark/master/php-benchmark.php) to your server.
 2. Open the file that is the first file to recieve the application request (this is usually index.php).
 3. Include the benchmark script in the top of the file.


## Usage

Open your shell interpreter and navigate to the directory where the index.php file of your appliaction is located. Use the following commands to run the
benchmark tests.

`$ php index.php http://mywebsite.com/` Will do a benchmark test with 50 requests that gives you average page generation time, memory consumption,
number of loaded classes and included files.

`$ php index.php http://mywebsite.com/ -n 500` Will do a benchmark test with 500 requests.

`$ php index.php http://mywebsite.com/ -nu` Will prevent the script from using unique URL:s when requesting the website.

`$ php index.php http://mywebsite.com/ -v` If a lot of the request fails it might be good to add *-v* to get more information about what fails.
