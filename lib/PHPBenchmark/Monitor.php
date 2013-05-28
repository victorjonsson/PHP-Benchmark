<?php
namespace PHPBenchmark;


/**
 * Class used to collect benchmark data over a given time
 *
 * @package PHPBenchmark
 * @author Victor Jonsson (http://victorjonsson.se)
 * @license MIT
 */
class Monitor {

    /**
     * @var float
     */
    private $startTime;

    /**
     * @var array
     */
    private $snapShots = array();

    /**
     * @var bool
     */
    private $displayAsHTML = false;

    /**
     * @var string
     */
    private $dataTemplateCSS = 'position: fixed; top: 20px; left:20px; box-shadow:0 0 8px #555; background: #FFF; padding: 5px; color:#000 !important; z-index: 9999';

    /**
     */
    public function __construct()
    {
        $this->startTime = self::getMicroTime();
    }

    /**
     * @param string $dataTemplateCSS
     */
    public function setDataTemplateCSS($dataTemplateCSS)
    {
        $this->dataTemplateCSS = $dataTemplateCSS;
    }

    /**
     * @return string
     */
    public function getDataTemplateCSS()
    {
        return $this->dataTemplateCSS;
    }

    /**
     * @param bool $displayAsHTML
     */
    public function init($displayAsHTML=false)
    {
        $this->displayAsHTML = $displayAsHTML;
        register_shutdown_function(array($this, 'shutDown'));
    }

    /**
     * Display benchmark data to browser or log
     */
    public function shutDown()
    {
        $data = $this->getData();
        if( $this->displayAsHTML ) {
            $log = $this->generateHTML($data);
        } else {
            $log = sprintf(
                    '[phpbenchmark time=%f memory=%f files=%d classes=%d]',
                    $data['time'],
                    $data['memory'],
                    $data['files'],
                    $data['classes']
                );
        }

        echo $log;
    }

    /**
     * @param array $data
     * @return string
     */
    private function generateHTML($data)
    {
        $table = '<table><thead><tr style="background:#EEE;"><td style="padding:5px;">&nbsp;</td><td style="padding:5px;">Time</td><td style="padding:5px;">Memory</td><td style="padding:5px;">Files</td><td style="padding:5px; text-align:right">Classes</td><td style="padding:5px; text-align:right">%</td></tr></thead><tbody>';

        $table_row = '<tr><td style="padding:5px 10px 5px 5px">%s</td><td style="padding:5px">%s</td style="padding:5px"><td style="padding:5px">%s</td style="padding:5px"><td style="padding:5px">%s</td><td style="padding:5px; text-align:right">%s</td><td style="padding:5px; text-align:right">%s</td></tr>';

        if( !empty($this->snapShots) ) {
            $last_proc = 0;
            foreach($this->snapShots as $name => $snapshot) {
                $proc = (100 * bcdiv($snapshot['time'], $data['time'], 2));
                $table .= sprintf(
                        $table_row,
                        $name,
                        $snapshot['time'],
                        $snapshot['memory'],
                        $snapshot['files'],
                        $snapshot['classes'],
                        $proc.'% <em style="font-size:70%; color:#777">('.($proc - $last_proc).'%)</em>'
                    );
                $last_proc = $proc;
            }
        }

        $table .= sprintf(
            $table_row,
            'Request finished',
            $data['time'],
            $data['memory'],
            $data['files'],
            $data['classes'],
            '100%' .( isset($last_proc) ? ( ' <em style="font-size:70%; color:#777">('.(100 - $last_proc) .'%)</em>') : '' )
        );

        $table .= '</tbody></table>';

        return sprintf('<div id="php-benchmark-result" style="%s">%s</div>', $this->dataTemplateCSS, $table);
    }

    /**
     * @param string $name
     */
    public function snapShot($name)
    {
        if( empty($this->snapShots) ) {
            $data = array(
                    'time' => $this->startTime,
                    'memory' => 0,
                    'classes' => 0,
                    'files' => 0
                );
        } else {
            $data = current(array_slice($this->snapShots, -1));
        }

        $currentData = $this->getData();

        $this->snapShots[$name] = array(
                            'time' => bcsub(self::getMicroTime(), $this->startTime, 4),
                            'memory' => $currentData['memory'],
                            'files' => $currentData['files'] - $data['files'],
                            'classes' => $currentData['classes'] - $data['classes']
                        );
    }

    /**
     * Get benchmark data at this point.
     * @return array
     */
    public function getData()
    {
        return array(
            'time' => bcsub(self::getMicroTime() , $this->startTime, 4),
            'memory' => round(memory_get_usage() / 1024 / 1024, 4),
            'files' => count(get_included_files()),
            'classes' => count(get_declared_classes())
        );
    }

    /**
     * @return array
     */
    public function snapShots()
    {
        return $this->snapShots;
    }

    /**
     * @var \PHPBenchmark\Monitor
     */
    private static $instance=null;


    /**
     * Singleton instance of this class
     * @return \PHPBenchmark\Monitor
     */
    public static function instance()
    {
        if( self::$instance === null ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @see http://se2.php.net/manual/en/function.microtime.php#101875
     * @return float
     */
    public static function getMicroTime()
    {
        list($u, $s) = explode(' ', microtime(false));
        return bcadd($u, $s, 7);
    }
}