<?php
namespace PHPBenchmark\testing;

use SplPriorityQueue;

/**
 * Object representing a test result
 *
 * @package PHPBenchmark
 * @author Victor Jonsson (http://victorjonsson.se)
 * @license MIT
 */
class TestResult
{

    /**
     * @var splPriorityQueue
     */
    private $tests;

    /**
     * @var TestRunResult[]
     */
    private $computedResults;

    /**
     */
    function __construct()
    {
        $this->tests = new SplPriorityQueue();
    }

    /**
     * @param TestRunResult $result
     */
    function addTestRunResult(TestRunResult $result)
    {
        $this->computedResults = null;
        $this->tests->insert($result, $result->getTime());
    }

    /**
     * @return TestRunResult[]
     */
    function getResults()
    {
        if (null === $this->computedResults) {
            /** @var TestRunResult[] $runs */
            $runs = iterator_to_array($this->tests);
            foreach($runs as $i => $result) {
                if( isset($runs[$i+1]) ) {
                    $timesFaster = $this->calculateTimesFaster($result, $runs[$i+1]);
                    $result->setTimesFaster($timesFaster);
                    $result->toggleIsWinner(0==$i);
                }
            }
            $this->computedResults = array_reverse($runs);
        }
        return $this->computedResults;
    }

    /**
     * @return TestRunResult
     */
    public function getWinner()
    {
        return current(array_slice($this->getResults(), 0, 1));
    }

    /**
     * @return TestRunResult
     */
    public function getLooser()
    {
        return current(array_slice($this->getResults(), -1));
    }

    /**
     * @param TestRunResult $faster
     * @param TestRunResult $slower
     * @return string
     */
    private function calculateTimesFaster(TestRunResult $faster, TestRunResult $slower)
    {
        $slowerTime = $slower->getTime();
        $fasterTime = $faster->getTime();
        return (bcdiv(bcsub($slowerTime, $fasterTime, 4), $fasterTime, 2) * 100).'%';
    }
}
