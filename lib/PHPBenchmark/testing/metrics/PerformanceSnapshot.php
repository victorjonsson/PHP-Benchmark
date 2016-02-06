<?php
namespace PHPBenchmark\testing\metrics;

use PHPBenchmark\Utils;


/**
 * Object containing data that describes performance relative to
 * a previously recorded state.
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
 *  echo 'It took ' .$newSnapShot->getTimePassed(). ' seconds.';
 *
 *
 * @package PHPBenchmark
 * @author Victor Jonsson (http://victorjonsson.se)
 * @license MIT
 */
class PerformanceSnapshot extends PerformanceInfo implements PerformanceSnapshotInterface
{
    /**
     * @var int
     */
    private $numClassesDeclaredSincePreviousSnapShot = 0;

    /**
     * @var int
     */
    private $numFilesIncludedSincePreviousSnapShot = 0;

    /**
     * @var float
     */
    private $memoryAllocatedDiff = 0;


    /**
     * PerformanceSnapshot constructor.
     * @param PerformanceInfoInterface|null $prev
     */
    public function __construct(PerformanceInfoInterface $prev=null)
    {
        $timePassed = 0;
        $creationTime = Utils::getMicroTime();

        if( $prev instanceof PerformanceInfoInterface ) {
            $timePassed = bcsub($creationTime, $prev->creationTime(), 4);
        } else {
            $prev = new NullPerformanceInfoObject();
        }

        $numClassesDeclared = count(get_declared_classes());
        $numFilesIncluded = count(get_included_files());
        $this->numClassesDeclaredSincePreviousSnapShot = $numClassesDeclared - $prev->numClassesDeclared();
        $this->numFilesIncludedSincePreviousSnapShot = $numFilesIncluded - $prev->numFilesIncluded();

        $memoryAllocated = Utils::toMegaBytes(memory_get_usage());
        $this->memoryAllocatedDiff = bcsub($memoryAllocated, $prev->memoryAllocated(), 4);

        parent::__construct(
            $creationTime,
            $timePassed,
            $numClassesDeclared,
            $numFilesIncluded,
            $memoryAllocated
        );
    }

    /**
     * @inheritDoc
     */
    public function numClassesDeclaredSincePreviousSnapshot()
    {
        return $this->numClassesDeclaredSincePreviousSnapShot;
    }

    /**
     * @inheritDoc
     */
    public function numFilesIncludedSincePreviousSnapshot()
    {
        return $this->numFilesIncludedSincePreviousSnapShot;
    }

    /**
     * @inheritDoc
     */
    public function memoryAllocationDifference()
    {
        return $this->memoryAllocatedDiff;
    }
}