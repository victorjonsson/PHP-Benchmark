<?php
/**
 * Created by PhpStorm.
 * User: victorjonsson
 * Date: 01/11/15
 * Time: 20:29
 */

namespace PHPBenchmark\testing;

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
     * @var \splPriorityQueue
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
        $this->tests = new \SplPriorityQueue();
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
        if( $this->computedResults === null ) {
            /** @var TestRunResult $result */
            $runs = iterator_to_array($this->tests);
            foreach($runs as $i => $result) {
                if( isset($runs[$i+1]) ) {
                    $timesFaster = $this->calculateTimesFaster($result->getTime(), $runs[$i+1]->getTime());
                    $result->setTimesFaster( $timesFaster );
                    $result->toggleIsWinner($i==0);
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
     * @param int $faster
     * @param int $slower
     * @return float
     */
    private function calculateTimesFaster($faster, $slower)
    {
        return (bcdiv(bcsub($slower, $faster, 4), $faster, 2) * 100).'%';
    }
}