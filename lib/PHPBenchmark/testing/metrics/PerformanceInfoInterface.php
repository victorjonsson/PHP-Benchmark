<?php
namespace PHPBenchmark\testing\metrics;

/**
 * Interface for objects representing performance related information
 *
 * @package PHPBenchmark
 * @author Victor Jonsson (http://victorjonsson.se)
 * @license MIT
 */
interface PerformanceInfoInterface
{
    /**
     * @return int
     */
    public function numClassesDeclared();

    /**
     * @return int
     */
    public function numFilesIncluded();

    /**
     * Total amount of memory (in megabytes) allocated at the given
     * point the snap shot was taken
     * @return float
     */
    public function memoryAllocated();

    /**
     * @return float
     */
    public function peakMemoryAllocated();

    /**
     * @return float
     */
    public function timePassed();

    /**
     * Time stamp (in microseconds) of when this object was created
     * @return float
     */
    public function creationTime();
}