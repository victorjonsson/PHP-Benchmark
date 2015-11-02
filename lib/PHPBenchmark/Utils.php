<?php
namespace PHPBenchmark;

/**
 * @package PHPBenchmark
 * @author Victor Jonsson (http://victorjonsson.se)
 * @license MIT
 */
class Utils
{

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