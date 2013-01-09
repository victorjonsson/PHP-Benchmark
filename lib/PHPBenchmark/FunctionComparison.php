<?php
namespace PHPBenchmark;


/**
 * Class that can be used to compare the performance between two functions
 *
 * @package PHPBenchmark
 * @author Victor Jonsson (http://victorjonsson.se)
 * @license MIT
 */
class FunctionComparison extends AbstractFunctionComparison {

    /**
     * @var \Closure
     */
    private $func_a;

    /**
     * @var \Closure
     */
    private $func_b;

    /**
     * @var array
     */
    private $preparations = array('before'=>array('a'=>false, 'b'=>false), 'after'=>array('a'=>false, 'b'=>false));

    /**
     * @param string $name
     * @param \Closure $func
     * @return \PHPBenchmark\FunctionComparison
     */
    public function setFunctionA($name, $func) {
        $this->func_a_name = $name;
        $this->func_a = $func;
        return $this;
    }

    /**
     * @param string $name
     * @param \Closure $func
     * @return \PHPBenchmark\FunctionComparison
     */
    public function setFunctionB($name, $func) {
        $this->func_b_name = $name;
        $this->func_b = $func;
        return $this;
    }

    /**
     * Runs function A
     */
    public function functionA() {
        $f = $this->func_a;
        $f();
    }

    /**
     * Runs function B
     */
    public function functionB() {
        $f = $this->func_b;
        $f();
    }

    /**
     * Add a function to be called before running any of the functions
     * @param string $func Either 'a' or 'b'
     * @param \Closure $callback
     * @return \PHPBenchmark\FunctionComparison
     */
    public function before($func, $callback)
    {
        $this->preparations['before'][$func] = $callback;
        return $this;
    }

    /**
     * Add a function to be called after running any of the functions
     * @param string $func Either 'a' or 'b'
     * @param \Closure $callback
     * @return \PHPBenchmark\FunctionComparison
     */
    public function after($func, $callback)
    {
        $this->preparations['after'][$func] = $callback;
        return $this;
    }

    /**
     * Function called once before running all A tests
     */
    protected function beforeFunctionA()
    {
        if( is_callable($this->preparations['before']['a']) )
            $this->preparations['before']['a']();
    }

    /**
     * Function called once after all A tests have run
     */
    protected function afterFunctionA()
    {
        if( is_callable($this->preparations['after']['a']) )
            $this->preparations['after']['a']();
    }

    /**
     * Function called once before running all B tests
     */
    protected function beforeFunctionB()
    {
        if( is_callable($this->preparations['before']['b']) )
            $this->preparations['before']['b']();
    }

    /**
     * Function called once after all A tests have run
     */
    protected function afterFunctionB()
    {
        if( is_callable($this->preparations['after']['b']) )
            $this->preparations['after']['b']();
    }

    /**
     * @param int $num_runs
     * @return \PHPBenchmark\FunctionComparison
     */
    public static function load($num_runs=500)
    {
        $instance = new self();
        $instance->setNumRuns($num_runs);
        return $instance;
    }

    /**
     * Instantiate and call exec() on all classes implementing AbstractFunctionComparison
     * in given path
     * @param string $path
     */
    public static function runTests( $path )
    {
        foreach(self::findComparisonTests($path) as $test)
            $test->exec();
    }

    /**
     * Find all classes implementing AbstractFunctionComparison in given path
     * @param string $path
     * @return \PHPBenchmark\AbstractFunctionComparison[]
     */
    public static function findComparisonTests( $path )
    {
        $tests = array();
        foreach( glob($path.'/*.php') as $file ) {
            require_once $file;
            $class = pathinfo($file, PATHINFO_FILENAME);
            if( class_exists($class, false) && is_subclass_of($class, '\\PHPBenchmark\\AbstractFunctionComparison') )
                $tests[] = new $class();
        }

        return $tests;
    }
}