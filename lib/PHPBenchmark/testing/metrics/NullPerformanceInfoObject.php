<?php
namespace PHPBenchmark\testing\metrics;


/**
 * @package PHPBenchmark
 * @author Victor Jonsson (http://victorjonsson.se)
 * @license MIT
 */
class NullPerformanceInfoObject implements PerformanceInfoInterface {

    /**
     * @inheritDoc
     */
    public function numClassesDeclared()
    {
        return 0;
    }

    /**
     * @inheritDoc
     */
    public function numFilesIncluded()
    {
        return 0;
    }

    /**
     * @inheritDoc
     */
    public function memoryAllocated()
    {
        return 0;
    }

    /**
     * @inheritDoc
     */
    public function timePassed()
    {
        return 0;
    }

    /**
     * @inheritDoc
     */
    public function creationTime()
    {
        return 0;
    }

    /**
     * @inheritDoc
     */
    public function peakMemoryAllocated()
    {
        return 0;
    }


}