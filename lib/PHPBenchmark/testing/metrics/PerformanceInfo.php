<?php
namespace PHPBenchmark\testing\metrics;
use PHPBenchmark\Utils;

/**
 * Object presenting performance related information
 *
 * @package PHPBenchmark
 * @author Victor Jonsson (http://victorjonsson.se)
 * @license MIT
 */
class PerformanceInfo implements PerformanceInfoInterface, \ArrayAccess
{
    /**
     * @var float
     */
    private $timePassed = 0;

    /**
     * @var int
     */
    private $numClassesDeclared = 0;

    /**
     * @var int
     */
    private $numFilesIncluded = 0;

    /**
     * @var float
     */
    private $memoryAllocated = 0;

    /**
     * @var float
     */
    private $created = 0;

    /**
     * @var int
     */
    private $peakMemoryAllocation;

    /**
     * PerformanceInfo constructor.
     * @param float $created
     * @param float $timePassed
     * @param int $numClassesTotal
     * @param int $numFilesIncluded
     * @param float $memoryAllocated
     */
    public function __construct($created, $timePassed, $numClassesTotal, $numFilesIncluded, $memoryAllocated)
    {
        $this->created = $created;
        $this->timePassed = $timePassed;
        $this->numClassesDeclared = $numClassesTotal;
        $this->numFilesIncluded = $numFilesIncluded;
        $this->memoryAllocated = $memoryAllocated;
        $this->peakMemoryAllocation = Utils::toMegaBytes(memory_get_peak_usage());
    }

    /**
     * @inheritDoc
     */
    public function numClassesDeclared()
    {
        return $this->numClassesDeclared;
    }

    /**
     * @inheritDoc
     */
    public function numFilesIncluded()
    {
        return $this->numFilesIncluded;
    }

    /**
     * @inheritDoc
     */
    public function timePassed()
    {
        return $this->timePassed;
    }

    /**
     * @inheritDoc
     */
    public function memoryAllocated()
    {
        return $this->memoryAllocated;
    }

    /**
     * @inheritDoc
     */
    public function creationTime()
    {
        return $this->created;
    }

    /**
     * @inheritDoc
     */
    public function peakMemoryAllocated()
    {
        return $this->peakMemoryAllocation;
    }

    /**
     * @inheritDoc
     */
    public function offsetExists($offset)
    {
        $this->warnAboutUseAsArray();
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset)
    {
        $this->warnAboutUseAsArray();
        switch($offset) {
            case 'memory':
                return $this->memoryAllocated();
                break;
            case 'files':
                return $this->numClassesDeclared();
                break;
            case 'classes':
                return $this->numClassesDeclared();
                break;
            case 'time':
                return $this->timePassed();
                break;
            default:
                return null;
                break;
        }
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value)
    {
        $this->warnAboutUseAsArray();
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset($offset)
    {
        $this->warnAboutUseAsArray();
    }

    /**
     * Warn of deprecated usage of object
     */
    private function warnAboutUseAsArray()
    {
        // Allow us as array for backwards compatibility reasons
        trigger_error(E_USER_DEPRECATED, 'Using '.self::class.' as array is deprecated');
    }
}