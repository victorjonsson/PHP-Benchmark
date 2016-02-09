<?php
namespace PHPBenchmark;

use PHPBenchmark\testing\metrics\PerformanceInfoInterface;
use PHPBenchmark\testing\metrics\PerformanceSnapshotInterface;

/**
 * Class that can display the result of an performance monitoring as HTML
 *
 * @package PHPBenchmark
 * @author Victor Jonsson (http://victorjonsson.se)
 * @license MIT
 */
class HtmlView implements PerformanceResultViewInterface
{
    /**
     * @var int
     */
    private $highestMemoryPeak = 0;

    /**
     * @var string
     */
    private $nameOfSnapShotThatHasMemoryPeak = '';

    /**
     * @inheritdoc
     */
    public function getView(MonitorInterface $monitor)
    {
        $table = $this->getTableOpeningMarkup();
        $tableRowMarkup = $this->getTableRowMarkup();
        $performanceInfo = $monitor->getPerformanceInfo();

        $lastPercent = 0;
        foreach ($monitor->getSnapShots() as $name => $snapshot) {

            list($label, $percent) = $this->getPercentageDisplay(
                $snapshot,
                $performanceInfo,
                $lastPercent
            );

            $table .= sprintf(
                $tableRowMarkup,
                $name,
                $snapshot->timePassed(),
                $snapshot->memoryAllocated(),
                $snapshot->numFilesIncludedSincePreviousSnapshot(),
                $snapshot->numClassesDeclaredSincePreviousSnapshot(),
                $label
            );

            $lastPercent = $percent;
            $this->keepTrackOfPeakingMemoryAllocation($snapshot, $name);
        }

        $table .= sprintf(
            $tableRowMarkup,
            'Finish',
            $performanceInfo->timePassed(),
            $performanceInfo->memoryAllocated(),
            $performanceInfo->numFilesIncluded(),
            $performanceInfo->numClassesDeclared(),
            '100%' . (isset($lastPercent) ? (' <em>(' . (100 - $lastPercent) . '%)</em>') : '')
        );

        $table .= '</tbody></table>';

        return sprintf(
            '<div id="php-benchmark-result" style="%s">
                <style type="text/css" scoped="scoped">
                %s
                </style>
                %s
                %s
            </div>',
            $this->getContainerCSS(),
            $this->getTableCSS(),
            $table,
            $this->informAboutPeakingMemoryAllocation($performanceInfo)
        );
    }

    /**
     * @return string
     */
    protected function getContainerCSS()
    {
        return implode('; ', array(
            'position: fixed',
            'top: 20px',
            'left:20px',
            'box-shadow:0 0 8px #555',
            'background: #FFF',
            'padding: 5px',
            'color:#000 !important',
            'max-width: 650px',
            'z-index: 99999'
        ));
    }

    /**
     * @return string
     */
    protected function getTableCSS()
    {
        return '
            table {
                border: 0;
                margin: 0;
                padding: 0;
            }
            thead tr {
                background: #EEE;
                border: 0;
            }
            tbody tr:last-child td {
                border-top: #333 solid 2px;
            }
            td {
                padding:5px 10px 5px 5px;
                font-size: 11px;
                border:#CCC solid 1px;
                border:0;
            }
            .align-right {
                text-align: right;
            }
            em {
                font-size:80%; color:#777
            }
            .footer {
                line-height: 140%;
            }
        ';
    }

    /**
     * @return string
     */
    protected function getTableOpeningMarkup()
    {
        return '
        <table>
            <thead>
                <tr>
                    <td>&nbsp;</td>
                    <td>Time (s)</td>
                    <td>Memory (mb)</td>
                    <td>Files</td>
                    <td class="align-right">Classes</td>
                    <td class="align-right">%</td>
                </tr>
            </thead>
            <tbody>';
    }

    /**
     * @return string
     */
    private function getTableRowMarkup()
    {
        return '
            <tr>
                <td>%s</td>
                <td>%s</td>
                <td>%s</td>
                <td>%s</td>
                <td class="align-right">%s</td>
                <td class="align-right">%s</td>
            </tr>';
    }

    /**
     * @param PerformanceInfoInterface $snapshot
     * @param PerformanceInfoInterface $performanceInfo
     * @return int
     */
    private function calculatePercentageOf(
        PerformanceInfoInterface $snapshot,
        PerformanceInfoInterface $performanceInfo
    ) {
        return (100 * bcdiv($snapshot->timePassed(), $performanceInfo->timePassed(), 2));
    }

    /**
     * @param PerformanceInfoInterface $snapshot
     * @param PerformanceInfoInterface $performanceInfo
     * @param int $lastPercent
     * @return array
     */
    private function getPercentageDisplay(
        PerformanceInfoInterface $snapshot,
        PerformanceInfoInterface $performanceInfo,
        $lastPercent
    ) {
        $percent = $this->calculatePercentageOf($snapshot, $performanceInfo);
        if (0 != $percent) {
            $label =  $percent.'% <em>(' . ($percent - $lastPercent) . '%)</em>';
        } else {
            $label = $percent.'%';
        }
        return array($label, $percent);
    }

    /**
     * @param PerformanceSnapshotInterface $snapshot
     * @param $snapshotName
     */
    private function keepTrackOfPeakingMemoryAllocation(PerformanceSnapshotInterface $snapshot, $snapshotName)
    {
        if ($snapshot->peakMemoryAllocated() > $this->highestMemoryPeak) {
            $this->highestMemoryPeak = $snapshot->peakMemoryAllocated();
            $this->nameOfSnapShotThatHasMemoryPeak = $snapshotName;
        }
    }

    /**
     * @param PerformanceInfoInterface $performanceInfo
     * @return string
     */
    private function informAboutPeakingMemoryAllocation(PerformanceInfoInterface $performanceInfo)
    {
        $peakMemAllocation = $performanceInfo->peakMemoryAllocated();
        if (
            $peakMemAllocation / $performanceInfo->memoryAllocated() > 1.00001 &&
            $this->highestMemoryPeak == $peakMemAllocation
        ) {
            // We found peak mem allocation in a snapshot
            $message = 'Memory consumption peaked at &quot;'.$this->nameOfSnapShotThatHasMemoryPeak.
                '&quot; with a total allocation of <strong>'.$peakMemAllocation.'</strong> mb';

        } else {
            $message = 'Peak memory allocation was <strong>'.$peakMemAllocation.'</strong> mb';
        }

        return '<div class="footer"><em>'.$message.'</em></div>';
    }
}
