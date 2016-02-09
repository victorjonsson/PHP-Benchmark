<?php
namespace PHPBenchmark;

use League\Event\Emitter;
use PHPBenchmark\testing\metrics\PerformanceInfo;
use PHPBenchmark\testing\metrics\PerformanceSnapshot;
use PHPBenchmark\testing\metrics\PerformanceSnapshotInterface;


/**
 * Class used to collect benchmark data over a given time
 *
 * @package PHPBenchmark
 * @author Victor Jonsson (http://victorjonsson.se)
 * @license MIT
 */
class Monitor extends Emitter implements MonitorInterface
{
    /**
     * @var PerformanceSnapshotInterface[]
     */
    private $snapShots = array();

    /**
     * @var float
     */
    private $startTime;

    /**
     * Initiate the performance monitoring
     * @param bool|true $registerShutDownFunc
     * @return $this
     */
    public function init($registerShutDownFunc=true)
    {
        $this->snapShots['Start'] = new PerformanceSnapshot();
        $this->startTime = $this->snapShots['Start']->creationTime();

        if ($registerShutDownFunc) {
            $self = $this;
            register_shutdown_function(function() use($self) {
                $self->emit(self::EVENT_SHUT_DOWN, $self);
            });
        }

        return $this;
    }

    /**
     * @param string $name
     */
    public function snapShot($name)
    {
        $previous = end($this->snapShots);
        $newSnapShot = new PerformanceSnapshot($previous ? $previous : null);
        $this->snapShots[$name] = $newSnapShot;
    }

    /**
     * @inheritDoc
     */
    public function getPerformanceInfo()
    {
        return new PerformanceInfo(
            Utils::getMicroTime(),
            bcsub(Utils::getMicroTime(), $this->startTime, 4),
            count(get_declared_classes()),
            count(get_included_files()),
            round(memory_get_usage() / 1024 / 1024, 4)
        );
    }

    /**
     * @deprecated Use Monitor::getPerformanceInfo()
     * @return PerformanceInfo
     */
    public function getData()
    {
        return $this->getPerformanceInfo();
    }

    /**
     * @inheritDoc
     */
    public function getSnapShots()
    {
        return $this->snapShots;
    }

    /**
     * @deprecated Use Monitor::getSnapShots();
     * @return testing\metrics\PerformanceSnapshotInterface[]
     */
    public function snapShots()
    {
        return $this->snapShots;
    }

    /**
     * @inheritDoc
     */
    public function numSnapShots()
    {
        return count($this->snapShots);
    }

    /**
     * @var \PHPBenchmark\Monitor
     */
    private static $instance = null;

    /**
     * Singleton instance of this class
     * @return \PHPBenchmark\MonitorInterface
     */
    public static function instance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}
