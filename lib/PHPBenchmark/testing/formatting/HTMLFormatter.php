<?php
namespace PHPBenchmark\testing\formatting;


/**
 * Class that can interpret \PHPBenchmark\testing\TestResult
 * and output an HTML formatted representation of the result
 *
 * @package PHPBenchmark
 * @author Victor Jonsson (http://victorjonsson.se)
 * @license MIT
 */
class HTMLFormatter implements FormatterInterface
{

    private $table = '
        <table border="1" cellspacing="2" cellpadding="4">
            <thead>
                <tr>
                    <td><strong>Function description</strong></td>
                    <td><strong>Execution time (s)</strong></td>
                    <td><strong>Memory usage (mb)</strong></td>
                    <td><strong>Times faster</strong></td>
                </tr>
            </thead>
            <tbody>
                %rows%
            </tbody>
        </table>';


    private $row = '<tr %s>
                        <td>%s</td>
                        <td>%f</td>
                        <td>%f</td>
                        <td class="times_faster">%s</td>
                    </tr>';


    /**
     * @inheritdoc
     */
    function format($result)
    {
        $rows = '';
        foreach($result->getResults() as $result) {
            $rows .= sprintf(
                    $this->row,
                    $result->isWinner() ? ' class="winner"':'',
                    $result->getDescription(),
                    $result->getTime(),
                    $result->getMemUsage(),
                    $result->getTimesFaster()
                );
        }

        return str_replace('%rows%', $rows, $this->table);
    }


}