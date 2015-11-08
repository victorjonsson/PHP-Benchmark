<?php
/**
 * Created by PhpStorm.
 * User: victorjonsson
 * Date: 07/11/15
 * Time: 10:23
 */
namespace PHPBenchmark\testing\metrics;


/**
 * Object containing data that might describe the performance
 * @package PHPBenchmark
 * @author Victor Jonsson (http://victorjonsson.se)
 * @license MIT
 */
interface PerformanceSnapshotInterface
{
    /**
     * The number of loaded classes since last snap shot
     * @return int
     */
    public function numClassesDeclared();

    /**
     * @return int
     */
    public function numTotalClassesDeclared();

    /**
     * The number of files included since last snap shot
     * @return int
     */
    public function numFilesIncluded();

    /**
     * @return int
     */
    public function numTotalFilesIncluded();

    /**
     * Time passed since last snapshot (in seconds)
     * @return float
     */
    public function timePassed();

    /**
     * Time stamp of when this snap shot was taken (in microseconds)
     * @return float
     */
    public function creationTime();

    /**
     * The change in memory allocation since last snap shot
     * @return float
     */
    public function memoryAllocationDifference();

    /**
     * Total amount of memory allocated at the given point the snap shot was taken
     * @return float
     */
    public function memoryAllocated();

}