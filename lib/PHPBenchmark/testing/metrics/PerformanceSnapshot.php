<?php
namespace PHPBenchmark\testing\metrics;

use PHPBenchmark\Utils;


/**
 * Object containing data that describes performance. This object
 * represents a state that is relative to the previously created
 * snapshot (given on construct)
 *
 * @example
 * <?php
 *  $initSnapShot = new PerformanceSnapShot();
 *  doSomeHeavyLifting();
 *  $snapShot = new PerformanceSnapShot($initSnapShot);
 *  echo 'It took ' .$snapShot->getTimePassed(). ' seconds.';
 *
 *  doMoreHeavyLifting();
 *  $newSnapShot = new PerformanceSnapShot($snapShot);
 *  echo 'It took ' .$snapShot->getTimePassed(). ' seconds.';
 *
 *
 * @package PHPBenchmark
 * @author Victor Jonsson (http://victorjonsson.se)
 * @license MIT
 */
class PerformanceSnapshot implements PerformanceSnapshotInterface
{


    /**
     * @var int
     */
    private $numClassesDeclared = 0;

    /**
     * @var int
     */
    private $numClassesDeclaredTotal = 0;

    /**
     * @var int
     */
    private $numFilesIncluded = 0;

    /**
     * @var int
     */
    private $numFilesIncludedTotal = 0;

    /**
     * @var float
     */
    private $timePassed = 0;

    /**
     * @var float
     */
    private $created = 0;

    /**
     * @var float
     */
    private $memoryAllocated = 0;

    /**
     * @var float
     */
    private $memoryAllocatedDiff = 0;


    /**
     * PerformanceSnapshot constructor.
     * @param PerformanceSnapshotInterface|null $prev
     */
    public function __construct(PerformanceSnapshotInterface $prev=null)
    {
        $this->created = Utils::getMicroTime();

        if( $prev instanceof PerformanceSnapshotInterface ) {
            $this->timePassed = bcsub($this->creationTime(), $prev->creationTime(), 4);
        } else {
            $prev = new PerformanceSnapshotNullObject();
            $this->timePassed = 0;
        }

        $this->numClassesDeclaredTotal = count(get_declared_classes());
        $this->numFilesIncludedTotal = count(get_included_files());

        $this->numClassesDeclared = $this->numClassesDeclaredTotal - $prev->numTotalClassesDeclared();
        $this->numFilesIncluded = $this->numFilesIncludedTotal - $prev->numTotalFilesIncluded();

        $this->memoryAllocated = round(memory_get_usage() / 1024 / 1024, 4);
        $this->memoryAllocatedDiff = bcsub($this->memoryAllocated, $prev->memoryAllocated(), 4);
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
    public function numTotalClassesDeclared()
    {
        return $this->numClassesDeclaredTotal;
    }

    /**
     * @inheritDoc
     */
    public function numTotalFilesIncluded()
    {
        return $this->numFilesIncludedTotal;
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
    public function memoryAllocationDifference()
    {
        return $this->memoryAllocatedDiff;
    }
}