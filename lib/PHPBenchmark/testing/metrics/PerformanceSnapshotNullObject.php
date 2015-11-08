<?php
namespace PHPBenchmark\testing\metrics;


/**
 * @package PHPBenchmark
 * @author Victor Jonsson (http://victorjonsson.se)
 * @license MIT
 */
class PerformanceSnapshotNullObject extends PerformanceSnapshot
                            implements PerformanceSnapshotInterface {


    public function __construct()
    {
    }

}