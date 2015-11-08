<?php

use \PHPBenchmark\testing\FunctionComparison;
use \PHPBenchmark\testing\formatting\HTMLFormatter;
use \PHPBenchmark\testing\formatting\CLITableFormatter;


class FunctionComparisonTest extends PHPUnit_Framework_TestCase {

    private static $slowFunc;
    private static $fastFunc;

    /**
     * @var \PHPBenchmark\testing\FunctionComparison
     */
    private $funcComparison;

    protected function setUp()
    {
        self::$fastFunc = function() {
        };

        self::$slowFunc = function() {
            usleep(10);
        };

        $this->funcComparison = new FunctionComparison();
        $this->funcComparison->addFunction('fast', self::$fastFunc);
        $this->funcComparison->addFunction('slow', self::$slowFunc);
    }

    function testFunctionComparison()
    {
        $result = $this->funcComparison->run();

        $winner = $result->getWinner();
        $looser = $result->getLooser();

        $this->assertEquals('fast', $winner->getDescription());
        $this->assertNotEmpty($winner->getMemUsage());
        $this->assertNotEmpty($winner->getTimesFaster());

        $this->assertEquals('slow', $looser->getDescription());
        $this->assertNotEmpty($looser->getMemUsage());
        $this->assertEmpty($looser->getTimesFaster());
    }


    function testWithMultipleComparisons()
    {
        $this->funcComparison->addFunction('also slow', self::$slowFunc);
        $this->funcComparison->addFunction('slow again', self::$slowFunc);
        $results = $this->funcComparison->run()->getResults();
        $this->assertEquals(4, count($results));
        $this->assertEquals('fast', $results[0]->getDescription());
    }

    function testHtmlFormatter()
    {
        $htmlFormatter = new HTMLFormatter();
        $formatted = $htmlFormatter->format($this->funcComparison->run());
        $this->assertNotEmpty($formatted);
        $this->assertTrue(strpos($formatted, '<table') !== false);
    }

    function testCLIFormatter()
    {
        $cliFormatter = new CLITableFormatter();
        $formatted = $cliFormatter->format($this->funcComparison->run());
        $this->assertNotEmpty($formatted);
        $this->assertTrue(strpos($formatted, '<table') === false);
    }

    function testExecSendingCorrectlyFormattedOutput()
    {
        ob_start();
        $this->funcComparison->exec();
        $output = ob_get_clean();
        $this->assertTrue(strpos($output, '<table') === false, 'Output should not contain html');
    }
}