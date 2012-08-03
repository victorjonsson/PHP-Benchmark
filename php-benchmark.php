<?php
/**
 * PHP Bench Mark
 * -------------------------------
 *
 * @author Victor Jonsson (http://victorjonsson.se)
 * @license Dual license under GPL and MIT v2
 * @website https://github.com/victorjonsson/PHP-Benchmark/
 * @version 0.1
 *
 * @dependencies
 *  - PHP version >= 5.2
 *  - ini setting allow_url_fopen enabled
 *
 * Documentation and issue tracking on github (https://github.com/victorjonsson/PHP-Benchmark/)
 *
 */


//
// Command line (not relying on PHP_SAPI http://www.php.net/manual/en/function.php-sapi-name.php#89858)
//
if( empty($_SERVER['REMOTE_ADDR']) ) {

    function out($m, $error=false) {
        if( $error )
            fwrite(STDERR, "$m\n");
        else
            fwrite(STDOUT, "$m\n");
    }

    function has_argument($names) {
        $names = rtrim($names, ',');
        foreach( explode(',', $names) as $arg_name ) {
            if($arg_name != '') {
                for($i=0; $i < $GLOBALS['argc']; $i++) {
                    $arg = $GLOBALS['argv'][$i];
                    if( $arg == $arg_name ) {
                        if( $GLOBALS['argc'] > $i )
                            return $GLOBALS['argv'][$i+1];
                        else
                            return true;
                    }
                }
            }
        }
        return false;
    }

    # No website given
    if( $argc == 1 ) {
        out('No website url given', true);
        die;
    }

    # not a valid website
    if( filter_var($argv[1], FILTER_VALIDATE_URL) === false ) {
        out($argv[1].' is not a valid url', true);
        die;
    }

    # setup initial parameters
    $requests = array();
    $failed = array();
    $unique_requests = has_argument('-nu') === false;
    $verbose = has_argument('-v,-verbose,verbose') !== false;
    $time_interval = has_argument('-ti');
    if( !$time_interval )
        $time_interval = 0;
    $num_request = has_argument('-n');
    if(!$num_request)
        $num_request = 50;
    $url = $argv[1] .( strpos($argv[1], '?') === false ? '?':'&'). 'php-benchmark-test=1';

    out('* Bench mark test, '.$num_request.' requests, '.$url);

    # Make the requests
    for($i=0; $i < $num_request; $i++) {
        $request_url = $url . ($unique_requests ? '&_='.uniqid(mt_rand()):'');
        $html = @file_get_contents($request_url);
        $status_ok = false;
        $status_message = false;
        if( $html ) {
            foreach( $http_response_header as $header ) {
                if(substr($header, 0, 6) == 'HTTP/1') {
                    $status_message = trim(substr($header, strpos(' ', $header), strlen($header)));
                    $status_ok = strnatcasecmp($status_message, '200 OK');
                    break;
                }
            }
        }

        # Failed for some reason
        if( !$status_ok ) {
            if( $status_message ) {
                $message = sprintf('Request #%d failed with status %s', $i, $status_message);
            }
            else {
                $message = sprintf('Request #%d failed for unknown reason, might be a timeout', $i);
            }

            out($message);

            $fail_key = $status_message ? $status_message : 'unknown';
            if( empty($failed[$fail_key]) )
                $failed[$fail_key] = array();
            $failed[$fail_key][] = $message;
        }
        else {
            $data_parts = explode('[phpbenchmark', $html);
            if(count($data_parts) == 1) {
                $message = sprintf('Request #%d failed for unknown reason, response body missing php benchmark data', $i);
                if( empty($failed['unknown']) )
                    $failed['unknown'] = array();
                $failed['unkown'][] = $message;
                out($message);
            }
            else {
                $data = array();
                $info_parts = explode(' ', $data_parts[ count($data_parts) - 1]);
                foreach($info_parts as $info) {
                    $info = explode('=', $info);
                    if(count($info) == 2) {
                        $name = trim($info[0]);
                        $val = trim($info[1]);
                        if($name == 'time' || $name == 'memory')
                            $val = (float)$val;
                        else
                            $val = (int)$val;

                        $data[ $name ] = $val;
                    }
                }

                $requests[] = $data;
            }
        }

        out('Request #'.$i.' finished'.($status_ok ? '':' (failed)'));
        usleep($time_interval);
    }

    $num_failed = count($failed);

    $avg_loaded_classes = 0;
    $avg_file_includes = 0;
    $top_mem = 0.0;
    $top_time = 0.0;
    $top_loaded_classes = 0;
    $top_file_includes = 0;
    $total_time = 0;
    $total_mem = 0;
    $total_files = 0;
    $total_classes = 0;
    foreach($requests as $d) {
        $total_time = bcadd($total_time, $d['time'], 4);
        $total_mem = bcadd($total_mem, $d['memory'], 4);
        $total_files += $d['files'];
        $total_classes += $d['classes'];
        if($top_file_includes < $d['files'])
            $top_file_includes = $d['files'];
        if($top_loaded_classes < $d['classes']);
            $top_loaded_classes = $d['classes'];
        if(bccomp((string)$top_mem, (string)$d['memory'], 5) == -1)
            $top_mem = $d['memory'];
        if(bccomp((string)$top_time, (string)$d['time'], 5) == -1)
            $top_time = $d['time'];

    }

    $avg_mem = round(bcdiv($total_mem, $num_request, 4), 4);
    $avg_time = round(bcdiv($total_time, $num_request, 4), 4);
    $avg_file = $total_files / $num_request;
    $avg_classes = $total_classes / $num_request;

    out('--------- PHP BENCHMARK TEST ------------');
    out(sprintf('A total of %d requests made (%d failed)', $num_request, $num_failed));
    out('AVERAGE:');
    out(sprintf(' - Load time: %fs', $avg_time));
    out(sprintf(' - Memory usage: %f MB', $avg_mem));
    out(sprintf(' - Number of loaded classes: %d', $avg_classes));
    out(sprintf(' - Number of included files: %d', $avg_file));
    out('SPIKES:');
    out(sprintf(' - Load time: %fs', $top_time));
    out(sprintf(' - Memory usage: %f MB', $top_mem));
    out(sprintf(' - Number of loaded classes: %d', $top_loaded_classes));
    out(sprintf(' - Number of included files: %d', $top_file_includes));

    if($num_failed > 0) {
        out('FAILED:');
        $index=0;
        foreach($failed as $type => $message) {
            foreach($message as $m) {
                $index++;
                if($index == 6 && !$verbose) {
                    out('... and '.($num_failed - 5).' more failed tests, add -v for more info');
                    break;
                }
                else {
                    out(sprintf('[%s] - %s', $type, $m));
                }
            }
        }
    }

    die(0);
}

//
// Doing test
//
elseif( isset($_GET['php-benchmark-test']) ) {
    $GLOBALS['php_benchmark_start_time'] = microtime(true);
    function php_benchmark_shutdown() {
        $total_time = microtime(true) - $GLOBALS['php_benchmark_start_time'];
        $memory = round(memory_get_usage()/1024/1024, 4);
        $num_included_files = count(get_included_files());
        $classes = count(get_declared_classes());
        echo '[phpbenchmark time='.round($total_time, 4).' memory='.$memory.' files='.$num_included_files.' classes='.$classes.']';
    }
    register_shutdown_function('php_benchmark_shutdown');
}
