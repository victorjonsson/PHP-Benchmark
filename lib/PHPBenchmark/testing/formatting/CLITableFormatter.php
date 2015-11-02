<?php
namespace PHPBenchmark\testing\formatting;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Output\BufferedOutput;


/**
 * Class that can interpret \PHPBenchmark\testing\TestResult
 * and output a table that can be used in a console program
 *
 * @package PHPBenchmark
 * @author Victor Jonsson (http://victorjonsson.se)
 * @license MIT
 */
class CLITableFormatter implements FormatterInterface
{

    /**
     * @inheritdoc
     */
    function format($result)
    {
        $out = new BufferedOutput();
        $table = new Table($out);
        $rows = array();
        $headers = array(
            'Function description',
            'Execution time (s)',
            'Memory usage (mb)',
            'Times faster'
        );

        foreach($result->getResults() as $result) {
            $rows[] = array(
                $result->getDescription(),
                $result->getTime(),
                $result->getMemUsage(),
                $result->getTimesFaster()
            );
        }

        $table->setHeaders($headers);
        $table->setRows($rows);
        $table->render();

        return $out->fetch();
    }


}