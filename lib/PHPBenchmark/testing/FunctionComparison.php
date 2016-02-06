<?php
namespace PHPBenchmark\testing;

use PHPBenchmark\testing\formatting\FormatterInterface;
use PHPBenchmark\testing\metrics\PerformanceSnapshot;


/**
 * Class that can be used to compare the performance
 * between different algorithms.
 *
 * @package PHPBenchmark
 * @author Victor Jonsson (http://victorjonsson.se)
 * @license MIT
 */
class FunctionComparison
{

    /**
     * @var int
     */
    protected $numRuns = 5000;

    /**
     * @var \Closure[]
     */
    protected $functions = array();

    /**
     * @var FormatterInterface
     */
    private $formatter;

    /**
     * @param string $description
     * @param \Closure $func
     * @return FunctionComparison
     */
    public function addFunction($description, $func)
    {
        $this->functions[$description] = $func;
        return $this;
    }

    /**
     * @return TestResult
     */
    public function run()
    {
        $results = new TestResult();
        foreach ($this->functions as $description => $func) {
            $runResult = $this->runFunction($func, $description);
            $results->addTestRunResult($runResult);
        }

        return $results;
    }

    /**
     * Will run the test and echo the result. It will display the result
     * in different formats depending on the context which in the
     * function was called.
     *
     * You can alter the formatting of the result by using the function
     * setFormatter(), giving it an object implementing \PHPBenchmark\testing\formatting\FormatterInterface
     *
     * @see FunctionComparison::run()
     */
    public function exec()
    {
        if (empty($this->formatter))
            $this->loadFormatter();

        $result = $this->run();
        echo $this->formatter->format($result);
    }

    /**
     */
    private function loadFormatter()
    {
        $formattingStrategy = '\\PHPBenchmark\\testing\\formatting\\HTMLFormatter';
        if( PHP_SAPI === 'cli' ) {
            $formattingStrategy = '\\PHPBenchmark\\testing\\formatting\\CLITableFormatter';
        }
        $this->formatter = new $formattingStrategy();
    }

    /**
     * Set which formatter that should be used when calling FunctionComparison::exec()
     * @see FunctionComparison::exec()
     *
     * @param FormatterInterface $formatter
     */
    public function setFormatter(FormatterInterface $formatter)
    {
        $this->formatter = $formatter;
    }

    /**
     * @param \Closure $func
     * @param string $desc
     * @return TestRunResult
     */
    private function runFunction($func, $desc)
    {
        $initSnapShot = new PerformanceSnapshot();

        for ($i = $this->numRuns; $i > 0; $i--)
            $func();

        $snapShot = new PerformanceSnapshot($initSnapShot);

        return new TestRunResult(
            $desc,
            $snapShot->timePassed(),
            $snapShot->memoryAllocationDifference()
        );
    }


    /**
     * The number of times each function will be called
     * @param int $numRuns
     */
    public function setNumRuns($numRuns)
    {
        $this->numRuns = $numRuns;
    }

    /**
     * The number of times each function will be called
     * @return int
     */
    public function getNumRuns()
    {
        return $this->numRuns;
    }

    /**
     * @param int $numRuns
     * @return FunctionComparison
     */
    public static function load($numRuns=500)
    {
        $self = new self();
        $self->setNumRuns($numRuns);
        return $self;
    }

    /* * * * * * * DEPRECATED * * * * * */


    /**
     * @deprecated Use FunctionComparison::addFunction() instead
     * @see FunctionComparison::addFunction()
     */
    public function setFunctionA($name, $func)
    {
        $this->addFunction($name, $func);
    }

    /**
     * @deprecated use FunctionComparison::addFunction() instead
     * @see FunctionComparison::addFunction()
     */
    public function setFunctionB($name, $func)
    {
        $this->addFunction($name, $func);
    }

}