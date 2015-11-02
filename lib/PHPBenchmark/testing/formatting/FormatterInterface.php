<?php
namespace PHPBenchmark\testing\formatting;


/**
 * Interface implemented by classes that can interpret \PHPBenchmark\testing\TestResult
 * into something that is human-readable
 *
 * @package PHPBenchmark
 * @author Victor Jonsson (http://victorjonsson.se)
 * @license MIT
 */
interface FormatterInterface
{

    /**
     * @param \PHPBenchmark\testing\TestResult $result
     * @return string
     */
    function format($result);

}
