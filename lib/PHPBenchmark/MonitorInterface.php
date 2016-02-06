<?php
namespace PHPBenchmark;

use League\Event\ListenerAcceptorInterface;
use PHPBenchmark\testing\metrics\PerformanceInfoInterface;
use PHPBenchmark\testing\metrics\PerformanceSnapshotInterface;

/**
 * @package PHPBenchmark
 * @author Victor Jonsson (http://victorjonsson.se)
 * @license MIT
 */
interface MonitorInterface extends ListenerAcceptorInterface
{
    const EVENT_SHUT_DOWN = 'shutdown';

    /**
     * Save a snapshot of performance metrics at this point in time
     * @param string $name
     */
    public function snapShot($name);

    /**
     * Get benchmark data
     * @return PerformanceInfoInterface
     */
    public function getPerformanceInfo();

    /**
     * @return PerformanceSnapshotInterface[]
     */
    public function getSnapShots();

    /**
     * @return int
     */
    public function numSnapShots();
}