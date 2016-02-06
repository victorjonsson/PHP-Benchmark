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
interface PerformanceSnapshotInterface extends PerformanceInfoInterface
{
    /**
     * The number of loaded classes since last snap shot
     * @return int
     */
    public function numClassesDeclaredSincePreviousSnapshot();

    /**
     * The number of files included since last snap shot
     * @return int
     */
    public function numFilesIncludedSincePreviousSnapshot();

    /**
     * The change in memory allocation since last snap shot
     * @return float
     */
    public function memoryAllocationDifference();

}