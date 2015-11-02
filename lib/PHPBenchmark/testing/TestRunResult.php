<?php
/**
 * Created by PhpStorm.
 * User: victorjonsson
 * Date: 01/11/15
 * Time: 11:50
 */

namespace PHPBenchmark\testing;


/**
 * Object containing information about a function test
 * @package PHPBenchmark
 * @author Victor Jonsson (http://victorjonsson.se)
 * @license MIT
 */
class TestRunResult
{
    /**
     * @var string
     */
    private $description;

    /**
     * @var float
     */
    private $time;

    /**
     * @var float
     */
    private $memUsage;

    /**
     * @var int
     */
    private $timesFaster = 0;

    /**
     * @var bool
     */
    private $isWinner = false;

    /**
     * TestResult constructor.
     * @param string $description
     * @param float $time
     * @param float $memUsage
     */
    public function __construct($description, $time, $memUsage)
    {
        $this->description = $description;
        $this->time = $time;
        $this->memUsage = $memUsage;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return float
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @return float
     */
    public function getMemUsage()
    {
        return $this->memUsage;
    }

    /**
     * @return int
     */
    public function getTimesFaster()
    {
        return $this->timesFaster;
    }

    /**
     * @param int $timesFaster
     */
    public function setTimesFaster($timesFaster)
    {
        $this->timesFaster = $timesFaster;
    }

    /**
     * @return bool
     */
    public function isWinner()
    {
        return $this->isWinner;
    }

    /**
     * @param bool $toggle
     */
    public function toggleIsWinner($toggle)
    {
        $this->isWinner = (bool)$toggle;
    }
}
