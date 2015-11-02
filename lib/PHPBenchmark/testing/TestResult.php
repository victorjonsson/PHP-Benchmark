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
        $this->tests->insert($result, $result->getTime());
    }

    /**
     * @return TestRunResult[]
     */
    function getResults()
    {
        /** @var TestRunResult $result */
        $runs = iterator_to_array($this->tests);
        foreach($runs as $i => $result) {
            if( isset($runs[$i+1]) ) {
                $timesFaster = $this->calculateTimesFaster($result->getTime(), $runs[$i+1]->getTime());
                $result->setTimesFaster( $timesFaster );
                $result->toggleIsWinner($i==0);
            }
        }
        return array_reverse($runs);
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