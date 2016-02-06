<?php
namespace PHPBenchmark;

use PHPBenchmark\MonitorInterface;

/**
 * Interface for classes that can generate a view displaying the result
 * from a performance monitoring test
 *
 * @package PHPBenchmark
 * @author Victor Jonsson (http://victorjonsson.se)
 * @license MIT
 */
interface PerformanceResultViewInterface
{
    /**
     * @param \PHPBenchmark\MonitorInterface $monitor
     * @return string
     */
    public function getView(MonitorInterface $monitor);
}