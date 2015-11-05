## Table of contents

- [\PHPBenchmark\Monitor](#class-phpbenchmarkmonitor)
- [\PHPBenchmark\Utils](#class-phpbenchmarkutils)
- [\PHPBenchmark\testing\AbstractFunctionComparison (abstract)](#class-phpbenchmarktestingabstractfunctioncomparison-abstract)
- [\PHPBenchmark\testing\FunctionComparison](#class-phpbenchmarktestingfunctioncomparison)
- [\PHPBenchmark\testing\TestResult](#class-phpbenchmarktestingtestresult)
- [\PHPBenchmark\testing\TestRunResult](#class-phpbenchmarktestingtestrunresult)
- [\PHPBenchmark\testing\formatting\CLITableFormatter](#class-phpbenchmarktestingformattingclitableformatter)
- [\PHPBenchmark\testing\formatting\FormatterInterface (interface)](#interface-phpbenchmarktestingformattingformatterinterface)
- [\PHPBenchmark\testing\formatting\HTMLFormatter](#class-phpbenchmarktestingformattinghtmlformatter)

<hr /> 
### Class: \PHPBenchmark\Monitor

> Class used to collect benchmark data over a given time

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct()</strong> : <em>void</em> |
| public | <strong>getData()</strong> : <em>array</em><br /><em>Get benchmark data at this point.</em> |
| public | <strong>getDataTemplateCSS()</strong> : <em>string</em> |
| public | <strong>init(</strong><em>bool</em> <strong>$displayAsHTML=false</strong>)</strong> : <em>void</em> |
| public static | <strong>instance()</strong> : <em>[\PHPBenchmark\Monitor](#class-phpbenchmarkmonitor)</em><br /><em>Singleton instance of this class</em> |
| public | <strong>setDataTemplateCSS(</strong><em>string</em> <strong>$dataTemplateCSS</strong>)</strong> : <em>void</em> |
| public | <strong>shutDown()</strong> : <em>void</em><br /><em>Display benchmark data to browser or log</em> |
| public | <strong>snapShot(</strong><em>string</em> <strong>$name</strong>)</strong> : <em>void</em> |
| public | <strong>snapShots()</strong> : <em>array</em> |

<hr /> 
### Class: \PHPBenchmark\Utils

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>getMicroTime()</strong> : <em>\PHPBenchmark\float</em> |

<hr /> 
### <strike>Class: \PHPBenchmark\testing\AbstractFunctionComparison (abstract)</strike>

> **DEPRECATED** No longer used....

| Visibility | Function |
|:-----------|:---------|

*This class extends [\PHPBenchmark\testing\FunctionComparison](#class-phpbenchmarktestingfunctioncomparison)*

<hr /> 
### Class: \PHPBenchmark\testing\FunctionComparison

> Abstract class that can be used to compare the performance between different algorithms.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>addFunction(</strong><em>string</em> <strong>$description</strong>, <em>\Closure</em> <strong>$func</strong>)</strong> : <em>[\PHPBenchmark\testing\FunctionComparison](#class-phpbenchmarktestingfunctioncomparison)</em> |
| public | <strong>exec()</strong> : <em>void</em><br /><em>Will run the test and echo the result. It will display the result in different formats depending on the context which in the function was called. You can alter the formatting of the result by using the function setFormatter(), giving it an object implementing \PHPBenchmark\testing\formatting\FormatterInterface</em> |
| public | <strong>getNumRuns()</strong> : <em>int</em><br /><em>The number of times each function will be called</em> |
| public static | <strong>load(</strong><em>mixed/int</em> <strong>$numRuns=500</strong>)</strong> : <em>[\PHPBenchmark\testing\FunctionComparison](#class-phpbenchmarktestingfunctioncomparison)</em> |
| public | <strong>run()</strong> : <em>[\PHPBenchmark\testing\TestResult](#class-phpbenchmarktestingtestresult)</em> |
| public | <strong>setFormatter(</strong><em>[\PHPBenchmark\testing\formatting\FormatterInterface](#interface-phpbenchmarktestingformattingformatterinterface)</em> <strong>$formatter</strong>)</strong> : <em>void</em><br /><em>Set which formatter that should be used when calling FunctionComparison::exec()</em> |
| public | <strong>setFunctionA(</strong><em>mixed</em> <strong>$name</strong>, <em>mixed</em> <strong>$func</strong>)</strong> : <em>void</em> |
| public | <strong>setFunctionB(</strong><em>mixed</em> <strong>$name</strong>, <em>mixed</em> <strong>$func</strong>)</strong> : <em>void</em> |
| public | <strong>setNumRuns(</strong><em>int</em> <strong>$numRuns</strong>)</strong> : <em>void</em><br /><em>The number of times each function will be called</em> |

<hr /> 
### Class: \PHPBenchmark\testing\TestResult

> Object representing a test result

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct()</strong> : <em>void</em> |
| public | <strong>addTestRunResult(</strong><em>[\PHPBenchmark\testing\TestRunResult](#class-phpbenchmarktestingtestrunresult)</em> <strong>$result</strong>)</strong> : <em>void</em> |
| public | <strong>getLooser()</strong> : <em>[\PHPBenchmark\testing\TestRunResult](#class-phpbenchmarktestingtestrunresult)</em> |
| public | <strong>getResults()</strong> : <em>[\PHPBenchmark\testing\TestRunResult](#class-phpbenchmarktestingtestrunresult)[]</em> |
| public | <strong>getWinner()</strong> : <em>[\PHPBenchmark\testing\TestRunResult](#class-phpbenchmarktestingtestrunresult)</em> |

<hr /> 
### Class: \PHPBenchmark\testing\TestRunResult

> Object containing information about a function test

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>string</em> <strong>$description</strong>, <em>\PHPBenchmark\testing\float</em> <strong>$time</strong>, <em>\PHPBenchmark\testing\float</em> <strong>$memUsage</strong>)</strong> : <em>void</em><br /><em>TestResult constructor.</em> |
| public | <strong>getDescription()</strong> : <em>string</em> |
| public | <strong>getMemUsage()</strong> : <em>\PHPBenchmark\testing\float</em> |
| public | <strong>getTime()</strong> : <em>\PHPBenchmark\testing\float</em> |
| public | <strong>getTimesFaster()</strong> : <em>int</em> |
| public | <strong>isWinner()</strong> : <em>bool</em> |
| public | <strong>setTimesFaster(</strong><em>int</em> <strong>$timesFaster</strong>)</strong> : <em>void</em> |
| public | <strong>toggleIsWinner(</strong><em>bool</em> <strong>$toggle</strong>)</strong> : <em>void</em> |

<hr /> 
### Class: \PHPBenchmark\testing\formatting\CLITableFormatter

> Class that can interpret \PHPBenchmark\testing\TestResult and output a table that can be used in a console program

| Visibility | Function |
|:-----------|:---------|
| public | <strong>format(</strong><em>mixed</em> <strong>$result</strong>)</strong> : <em>void</em> |

*This class implements [\PHPBenchmark\testing\formatting\FormatterInterface](#interface-phpbenchmarktestingformattingformatterinterface)*

<hr /> 
### Interface: \PHPBenchmark\testing\formatting\FormatterInterface

> Interface implemented by classes that can interpret \PHPBenchmark\testing\TestResult into something that is human-readable

| Visibility | Function |
|:-----------|:---------|
| public | <strong>abstract format(</strong><em>[\PHPBenchmark\testing\TestResult](#class-phpbenchmarktestingtestresult)</em> <strong>$result</strong>)</strong> : <em>string</em> |

<hr /> 
### Class: \PHPBenchmark\testing\formatting\HTMLFormatter

> Class that can interpret \PHPBenchmark\testing\TestResult and output an HTML formatted representation of the result

| Visibility | Function |
|:-----------|:---------|
| public | <strong>format(</strong><em>mixed</em> <strong>$result</strong>)</strong> : <em>void</em> |

*This class implements [\PHPBenchmark\testing\formatting\FormatterInterface](#interface-phpbenchmarktestingformattingformatterinterface)*


Strict standards: Only variables should be passed by reference in /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/victorjonsson/markdowndocs/src/PHPDocsMD/Reflector.php on line 117

Call Stack:
    0.0002     227576   1. {main}() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/victorjonsson/markdowndocs/bin/phpdoc-md:0
    0.0101    1626520   2. PHPDocsMD\Console\CLI->run() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/victorjonsson/markdowndocs/bin/phpdoc-md:15
    0.0108    1727640   3. Symfony\Component\Console\Application->run() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/victorjonsson/markdowndocs/src/PHPDocsMD/Console/CLI.php:29
    0.0134    2080008   4. Symfony\Component\Console\Application->doRun() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/symfony/console/Application.php:120
    0.0136    2080928   5. Symfony\Component\Console\Application->doRunCommand() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/symfony/console/Application.php:189
    0.0136    2081504   6. Symfony\Component\Console\Command\Command->run() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/symfony/console/Application.php:838
    0.0139    2086672   7. PHPDocsMD\Console\PHPDocsMDCommand->execute() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/symfony/console/Command/Command.php:256
    0.0217    2463096   8. PHPDocsMD\Console\PHPDocsMDCommand->getAnchorFromClassCollection() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/victorjonsson/markdowndocs/src/PHPDocsMD/Console/PHPDocsMDCommand.php:142
    0.0217    2464312   9. PHPDocsMD\Console\PHPDocsMDCommand->getClassEntity() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/victorjonsson/markdowndocs/src/PHPDocsMD/Console/PHPDocsMDCommand.php:193
    0.0217    2464440  10. PHPDocsMD\Reflector->getClassEntity() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/victorjonsson/markdowndocs/src/PHPDocsMD/Console/PHPDocsMDCommand.php:36
    0.0226    2477624  11. PHPDocsMD\Reflector->createFunctionEntity() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/victorjonsson/markdowndocs/src/PHPDocsMD/Reflector.php:35
    0.0227    2481424  12. PHPDocsMD\Reflector->createParameterEntity() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/victorjonsson/markdowndocs/src/PHPDocsMD/Reflector.php:69


Strict standards: Only variables should be passed by reference in /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/victorjonsson/markdowndocs/src/PHPDocsMD/Reflector.php on line 118

Call Stack:
    0.0002     227576   1. {main}() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/victorjonsson/markdowndocs/bin/phpdoc-md:0
    0.0101    1626520   2. PHPDocsMD\Console\CLI->run() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/victorjonsson/markdowndocs/bin/phpdoc-md:15
    0.0108    1727640   3. Symfony\Component\Console\Application->run() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/victorjonsson/markdowndocs/src/PHPDocsMD/Console/CLI.php:29
    0.0134    2080008   4. Symfony\Component\Console\Application->doRun() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/symfony/console/Application.php:120
    0.0136    2080928   5. Symfony\Component\Console\Application->doRunCommand() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/symfony/console/Application.php:189
    0.0136    2081504   6. Symfony\Component\Console\Command\Command->run() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/symfony/console/Application.php:838
    0.0139    2086672   7. PHPDocsMD\Console\PHPDocsMDCommand->execute() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/symfony/console/Command/Command.php:256
    0.0217    2463096   8. PHPDocsMD\Console\PHPDocsMDCommand->getAnchorFromClassCollection() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/victorjonsson/markdowndocs/src/PHPDocsMD/Console/PHPDocsMDCommand.php:142
    0.0217    2464312   9. PHPDocsMD\Console\PHPDocsMDCommand->getClassEntity() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/victorjonsson/markdowndocs/src/PHPDocsMD/Console/PHPDocsMDCommand.php:193
    0.0217    2464440  10. PHPDocsMD\Reflector->getClassEntity() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/victorjonsson/markdowndocs/src/PHPDocsMD/Console/PHPDocsMDCommand.php:36
    0.0226    2477624  11. PHPDocsMD\Reflector->createFunctionEntity() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/victorjonsson/markdowndocs/src/PHPDocsMD/Reflector.php:35
    0.0227    2481424  12. PHPDocsMD\Reflector->createParameterEntity() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/victorjonsson/markdowndocs/src/PHPDocsMD/Reflector.php:69

## Table of contents

- [\PHPBenchmark\Monitor](#class-phpbenchmarkmonitor)
- [\PHPBenchmark\Utils](#class-phpbenchmarkutils)
- [\PHPBenchmark\testing\AbstractFunctionComparison (abstract)](#class-phpbenchmarktestingabstractfunctioncomparison-abstract)
- [\PHPBenchmark\testing\FunctionComparison](#class-phpbenchmarktestingfunctioncomparison)
- [\PHPBenchmark\testing\TestResult](#class-phpbenchmarktestingtestresult)
- [\PHPBenchmark\testing\TestRunResult](#class-phpbenchmarktestingtestrunresult)
- [\PHPBenchmark\testing\formatting\CLITableFormatter](#class-phpbenchmarktestingformattingclitableformatter)
- [\PHPBenchmark\testing\formatting\FormatterInterface (interface)](#interface-phpbenchmarktestingformattingformatterinterface)
- [\PHPBenchmark\testing\formatting\HTMLFormatter](#class-phpbenchmarktestingformattinghtmlformatter)

<hr /> 
### Class: \PHPBenchmark\Monitor

> Class used to collect benchmark data over a given time

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct()</strong> : <em>void</em> |
| public | <strong>getData()</strong> : <em>array</em><br /><em>Get benchmark data at this point.</em> |
| public | <strong>getDataTemplateCSS()</strong> : <em>string</em> |
| public | <strong>init(</strong><em>bool</em> <strong>$displayAsHTML=false</strong>)</strong> : <em>void</em> |
| public static | <strong>instance()</strong> : <em>[\PHPBenchmark\Monitor](#class-phpbenchmarkmonitor)</em><br /><em>Singleton instance of this class</em> |
| public | <strong>setDataTemplateCSS(</strong><em>string</em> <strong>$dataTemplateCSS</strong>)</strong> : <em>void</em> |
| public | <strong>shutDown()</strong> : <em>void</em><br /><em>Display benchmark data to browser or log</em> |
| public | <strong>snapShot(</strong><em>string</em> <strong>$name</strong>)</strong> : <em>void</em> |
| public | <strong>snapShots()</strong> : <em>array</em> |

<hr /> 
### Class: \PHPBenchmark\Utils

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>getMicroTime()</strong> : <em>\PHPBenchmark\float</em> |

<hr /> 
### <strike>Class: \PHPBenchmark\testing\AbstractFunctionComparison (abstract)</strike>

> **DEPRECATED** No longer used....

| Visibility | Function |
|:-----------|:---------|

*This class extends [\PHPBenchmark\testing\FunctionComparison](#class-phpbenchmarktestingfunctioncomparison)*

<hr /> 
### Class: \PHPBenchmark\testing\FunctionComparison

> Abstract class that can be used to compare the performance between different algorithms.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>addFunction(</strong><em>string</em> <strong>$description</strong>, <em>\Closure</em> <strong>$func</strong>)</strong> : <em>[\PHPBenchmark\testing\FunctionComparison](#class-phpbenchmarktestingfunctioncomparison)</em> |
| public | <strong>exec()</strong> : <em>void</em><br /><em>Will run the test and echo the result. It will display the result in different formats depending on the context which in the function was called. You can alter the formatting of the result by using the function setFormatter(), giving it an object implementing \PHPBenchmark\testing\formatting\FormatterInterface</em> |
| public | <strong>getNumRuns()</strong> : <em>int</em><br /><em>The number of times each function will be called</em> |
| public static | <strong>load(</strong><em>mixed/int</em> <strong>$numRuns=500</strong>)</strong> : <em>[\PHPBenchmark\testing\FunctionComparison](#class-phpbenchmarktestingfunctioncomparison)</em> |
| public | <strong>run()</strong> : <em>[\PHPBenchmark\testing\TestResult](#class-phpbenchmarktestingtestresult)</em> |
| public | <strong>setFormatter(</strong><em>[\PHPBenchmark\testing\formatting\FormatterInterface](#interface-phpbenchmarktestingformattingformatterinterface)</em> <strong>$formatter</strong>)</strong> : <em>void</em><br /><em>Set which formatter that should be used when calling FunctionComparison::exec()</em> |
| public | <strong>setFunctionA(</strong><em>mixed</em> <strong>$name</strong>, <em>mixed</em> <strong>$func</strong>)</strong> : <em>void</em> |
| public | <strong>setFunctionB(</strong><em>mixed</em> <strong>$name</strong>, <em>mixed</em> <strong>$func</strong>)</strong> : <em>void</em> |
| public | <strong>setNumRuns(</strong><em>int</em> <strong>$numRuns</strong>)</strong> : <em>void</em><br /><em>The number of times each function will be called</em> |

<hr /> 
### Class: \PHPBenchmark\testing\TestResult

> Object representing a test result

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct()</strong> : <em>void</em> |
| public | <strong>addTestRunResult(</strong><em>[\PHPBenchmark\testing\TestRunResult](#class-phpbenchmarktestingtestrunresult)</em> <strong>$result</strong>)</strong> : <em>void</em> |
| public | <strong>getLooser()</strong> : <em>[\PHPBenchmark\testing\TestRunResult](#class-phpbenchmarktestingtestrunresult)</em> |
| public | <strong>getResults()</strong> : <em>[\PHPBenchmark\testing\TestRunResult](#class-phpbenchmarktestingtestrunresult)[]</em> |
| public | <strong>getWinner()</strong> : <em>[\PHPBenchmark\testing\TestRunResult](#class-phpbenchmarktestingtestrunresult)</em> |

<hr /> 
### Class: \PHPBenchmark\testing\TestRunResult

> Object containing information about a function test

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>string</em> <strong>$description</strong>, <em>\PHPBenchmark\testing\float</em> <strong>$time</strong>, <em>\PHPBenchmark\testing\float</em> <strong>$memUsage</strong>)</strong> : <em>void</em><br /><em>TestResult constructor.</em> |
| public | <strong>getDescription()</strong> : <em>string</em> |
| public | <strong>getMemUsage()</strong> : <em>\PHPBenchmark\testing\float</em> |
| public | <strong>getTime()</strong> : <em>\PHPBenchmark\testing\float</em> |
| public | <strong>getTimesFaster()</strong> : <em>int</em> |
| public | <strong>isWinner()</strong> : <em>bool</em> |
| public | <strong>setTimesFaster(</strong><em>int</em> <strong>$timesFaster</strong>)</strong> : <em>void</em> |
| public | <strong>toggleIsWinner(</strong><em>bool</em> <strong>$toggle</strong>)</strong> : <em>void</em> |

<hr /> 
### Class: \PHPBenchmark\testing\formatting\CLITableFormatter

> Class that can interpret \PHPBenchmark\testing\TestResult and output a table that can be used in a console program

| Visibility | Function |
|:-----------|:---------|
| public | <strong>format(</strong><em>mixed</em> <strong>$result</strong>)</strong> : <em>void</em> |

*This class implements [\PHPBenchmark\testing\formatting\FormatterInterface](#interface-phpbenchmarktestingformattingformatterinterface)*

<hr /> 
### Interface: \PHPBenchmark\testing\formatting\FormatterInterface

> Interface implemented by classes that can interpret \PHPBenchmark\testing\TestResult into something that is human-readable

| Visibility | Function |
|:-----------|:---------|
| public | <strong>abstract format(</strong><em>[\PHPBenchmark\testing\TestResult](#class-phpbenchmarktestingtestresult)</em> <strong>$result</strong>)</strong> : <em>string</em> |

<hr /> 
### Class: \PHPBenchmark\testing\formatting\HTMLFormatter

> Class that can interpret \PHPBenchmark\testing\TestResult and output an HTML formatted representation of the result

| Visibility | Function |
|:-----------|:---------|
| public | <strong>format(</strong><em>mixed</em> <strong>$result</strong>)</strong> : <em>void</em> |

*This class implements [\PHPBenchmark\testing\formatting\FormatterInterface](#interface-phpbenchmarktestingformattingformatterinterface)*


Strict standards: Only variables should be passed by reference in /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/victorjonsson/markdowndocs/src/PHPDocsMD/Reflector.php on line 117

Call Stack:
    0.0002     227576   1. {main}() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/victorjonsson/markdowndocs/bin/phpdoc-md:0
    0.0099    1626520   2. PHPDocsMD\Console\CLI->run() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/victorjonsson/markdowndocs/bin/phpdoc-md:15
    0.0105    1727640   3. Symfony\Component\Console\Application->run() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/victorjonsson/markdowndocs/src/PHPDocsMD/Console/CLI.php:29
    0.0146    2080008   4. Symfony\Component\Console\Application->doRun() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/symfony/console/Application.php:120
    0.0147    2080928   5. Symfony\Component\Console\Application->doRunCommand() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/symfony/console/Application.php:189
    0.0147    2081504   6. Symfony\Component\Console\Command\Command->run() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/symfony/console/Application.php:838
    0.0150    2086672   7. PHPDocsMD\Console\PHPDocsMDCommand->execute() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/symfony/console/Command/Command.php:256
    0.0232    2463224   8. PHPDocsMD\Console\PHPDocsMDCommand->getAnchorFromClassCollection() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/victorjonsson/markdowndocs/src/PHPDocsMD/Console/PHPDocsMDCommand.php:142
    0.0232    2464440   9. PHPDocsMD\Console\PHPDocsMDCommand->getClassEntity() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/victorjonsson/markdowndocs/src/PHPDocsMD/Console/PHPDocsMDCommand.php:193
    0.0232    2464568  10. PHPDocsMD\Reflector->getClassEntity() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/victorjonsson/markdowndocs/src/PHPDocsMD/Console/PHPDocsMDCommand.php:36
    0.0241    2477752  11. PHPDocsMD\Reflector->createFunctionEntity() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/victorjonsson/markdowndocs/src/PHPDocsMD/Reflector.php:35
    0.0242    2481552  12. PHPDocsMD\Reflector->createParameterEntity() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/victorjonsson/markdowndocs/src/PHPDocsMD/Reflector.php:69


Strict standards: Only variables should be passed by reference in /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/victorjonsson/markdowndocs/src/PHPDocsMD/Reflector.php on line 118

Call Stack:
    0.0002     227576   1. {main}() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/victorjonsson/markdowndocs/bin/phpdoc-md:0
    0.0099    1626520   2. PHPDocsMD\Console\CLI->run() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/victorjonsson/markdowndocs/bin/phpdoc-md:15
    0.0105    1727640   3. Symfony\Component\Console\Application->run() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/victorjonsson/markdowndocs/src/PHPDocsMD/Console/CLI.php:29
    0.0146    2080008   4. Symfony\Component\Console\Application->doRun() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/symfony/console/Application.php:120
    0.0147    2080928   5. Symfony\Component\Console\Application->doRunCommand() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/symfony/console/Application.php:189
    0.0147    2081504   6. Symfony\Component\Console\Command\Command->run() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/symfony/console/Application.php:838
    0.0150    2086672   7. PHPDocsMD\Console\PHPDocsMDCommand->execute() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/symfony/console/Command/Command.php:256
    0.0232    2463224   8. PHPDocsMD\Console\PHPDocsMDCommand->getAnchorFromClassCollection() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/victorjonsson/markdowndocs/src/PHPDocsMD/Console/PHPDocsMDCommand.php:142
    0.0232    2464440   9. PHPDocsMD\Console\PHPDocsMDCommand->getClassEntity() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/victorjonsson/markdowndocs/src/PHPDocsMD/Console/PHPDocsMDCommand.php:193
    0.0232    2464568  10. PHPDocsMD\Reflector->getClassEntity() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/victorjonsson/markdowndocs/src/PHPDocsMD/Console/PHPDocsMDCommand.php:36
    0.0241    2477752  11. PHPDocsMD\Reflector->createFunctionEntity() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/victorjonsson/markdowndocs/src/PHPDocsMD/Reflector.php:35
    0.0242    2481552  12. PHPDocsMD\Reflector->createParameterEntity() /Users/victorjonsson/htdocs/PHP-Benchmark/vendor/victorjonsson/markdowndocs/src/PHPDocsMD/Reflector.php:69

## Table of contents

- [\PHPBenchmark\Monitor](#class-phpbenchmarkmonitor)
- [\PHPBenchmark\Utils](#class-phpbenchmarkutils)
- [\PHPBenchmark\testing\AbstractFunctionComparison (abstract)](#class-phpbenchmarktestingabstractfunctioncomparison-abstract)
- [\PHPBenchmark\testing\FunctionComparison](#class-phpbenchmarktestingfunctioncomparison)
- [\PHPBenchmark\testing\TestResult](#class-phpbenchmarktestingtestresult)
- [\PHPBenchmark\testing\TestRunResult](#class-phpbenchmarktestingtestrunresult)
- [\PHPBenchmark\testing\formatting\CLITableFormatter](#class-phpbenchmarktestingformattingclitableformatter)
- [\PHPBenchmark\testing\formatting\FormatterInterface (interface)](#interface-phpbenchmarktestingformattingformatterinterface)
- [\PHPBenchmark\testing\formatting\HTMLFormatter](#class-phpbenchmarktestingformattinghtmlformatter)

<hr /> 
### Class: \PHPBenchmark\Monitor

> Class used to collect benchmark data over a given time

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct()</strong> : <em>void</em> |
| public | <strong>getData()</strong> : <em>array</em><br /><em>Get benchmark data at this point.</em> |
| public | <strong>getDataTemplateCSS()</strong> : <em>string</em> |
| public | <strong>init(</strong><em>bool</em> <strong>$displayAsHTML=false</strong>)</strong> : <em>void</em> |
| public static | <strong>instance()</strong> : <em>[\PHPBenchmark\Monitor](#class-phpbenchmarkmonitor)</em><br /><em>Singleton instance of this class</em> |
| public | <strong>setDataTemplateCSS(</strong><em>string</em> <strong>$dataTemplateCSS</strong>)</strong> : <em>void</em> |
| public | <strong>shutDown()</strong> : <em>void</em><br /><em>Display benchmark data to browser or log</em> |
| public | <strong>snapShot(</strong><em>string</em> <strong>$name</strong>)</strong> : <em>void</em> |
| public | <strong>snapShots()</strong> : <em>array</em> |

<hr /> 
### Class: \PHPBenchmark\Utils

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>getMicroTime()</strong> : <em>\PHPBenchmark\float</em> |

<hr /> 
### <strike>Class: \PHPBenchmark\testing\AbstractFunctionComparison (abstract)</strike>

> **DEPRECATED** No longer used....

| Visibility | Function |
|:-----------|:---------|

*This class extends [\PHPBenchmark\testing\FunctionComparison](#class-phpbenchmarktestingfunctioncomparison)*

<hr /> 
### Class: \PHPBenchmark\testing\FunctionComparison

> Abstract class that can be used to compare the performance between different algorithms.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>addFunction(</strong><em>string</em> <strong>$description</strong>, <em>\Closure</em> <strong>$func</strong>)</strong> : <em>[\PHPBenchmark\testing\FunctionComparison](#class-phpbenchmarktestingfunctioncomparison)</em> |
| public | <strong>exec()</strong> : <em>void</em><br /><em>Will run the test and echo the result. It will display the result in different formats depending on the context which in the function was called. You can alter the formatting of the result by using the function setFormatter(), giving it an object implementing \PHPBenchmark\testing\formatting\FormatterInterface</em> |
| public | <strong>getNumRuns()</strong> : <em>int</em><br /><em>The number of times each function will be called</em> |
| public static | <strong>load(</strong><em>mixed/int</em> <strong>$numRuns=500</strong>)</strong> : <em>[\PHPBenchmark\testing\FunctionComparison](#class-phpbenchmarktestingfunctioncomparison)</em> |
| public | <strong>run()</strong> : <em>[\PHPBenchmark\testing\TestResult](#class-phpbenchmarktestingtestresult)</em> |
| public | <strong>setFormatter(</strong><em>[\PHPBenchmark\testing\formatting\FormatterInterface](#interface-phpbenchmarktestingformattingformatterinterface)</em> <strong>$formatter</strong>)</strong> : <em>void</em><br /><em>Set which formatter that should be used when calling FunctionComparison::exec()</em> |
| public | <strong>setFunctionA(</strong><em>mixed</em> <strong>$name</strong>, <em>mixed</em> <strong>$func</strong>)</strong> : <em>void</em> |
| public | <strong>setFunctionB(</strong><em>mixed</em> <strong>$name</strong>, <em>mixed</em> <strong>$func</strong>)</strong> : <em>void</em> |
| public | <strong>setNumRuns(</strong><em>int</em> <strong>$numRuns</strong>)</strong> : <em>void</em><br /><em>The number of times each function will be called</em> |

<hr /> 
### Class: \PHPBenchmark\testing\TestResult

> Object representing a test result

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct()</strong> : <em>void</em> |
| public | <strong>addTestRunResult(</strong><em>[\PHPBenchmark\testing\TestRunResult](#class-phpbenchmarktestingtestrunresult)</em> <strong>$result</strong>)</strong> : <em>void</em> |
| public | <strong>getLooser()</strong> : <em>[\PHPBenchmark\testing\TestRunResult](#class-phpbenchmarktestingtestrunresult)</em> |
| public | <strong>getResults()</strong> : <em>[\PHPBenchmark\testing\TestRunResult](#class-phpbenchmarktestingtestrunresult)[]</em> |
| public | <strong>getWinner()</strong> : <em>[\PHPBenchmark\testing\TestRunResult](#class-phpbenchmarktestingtestrunresult)</em> |

<hr /> 
### Class: \PHPBenchmark\testing\TestRunResult

> Object containing information about a function test

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>string</em> <strong>$description</strong>, <em>\PHPBenchmark\testing\float</em> <strong>$time</strong>, <em>\PHPBenchmark\testing\float</em> <strong>$memUsage</strong>)</strong> : <em>void</em><br /><em>TestResult constructor.</em> |
| public | <strong>getDescription()</strong> : <em>string</em> |
| public | <strong>getMemUsage()</strong> : <em>\PHPBenchmark\testing\float</em> |
| public | <strong>getTime()</strong> : <em>\PHPBenchmark\testing\float</em> |
| public | <strong>getTimesFaster()</strong> : <em>int</em> |
| public | <strong>isWinner()</strong> : <em>bool</em> |
| public | <strong>setTimesFaster(</strong><em>int</em> <strong>$timesFaster</strong>)</strong> : <em>void</em> |
| public | <strong>toggleIsWinner(</strong><em>bool</em> <strong>$toggle</strong>)</strong> : <em>void</em> |

<hr /> 
### Class: \PHPBenchmark\testing\formatting\CLITableFormatter

> Class that can interpret \PHPBenchmark\testing\TestResult and output a table that can be used in a console program

| Visibility | Function |
|:-----------|:---------|
| public | <strong>format(</strong><em>mixed</em> <strong>$result</strong>)</strong> : <em>void</em> |

*This class implements [\PHPBenchmark\testing\formatting\FormatterInterface](#interface-phpbenchmarktestingformattingformatterinterface)*

<hr /> 
### Interface: \PHPBenchmark\testing\formatting\FormatterInterface

> Interface implemented by classes that can interpret \PHPBenchmark\testing\TestResult into something that is human-readable

| Visibility | Function |
|:-----------|:---------|
| public | <strong>abstract format(</strong><em>[\PHPBenchmark\testing\TestResult](#class-phpbenchmarktestingtestresult)</em> <strong>$result</strong>)</strong> : <em>string</em> |

<hr /> 
### Class: \PHPBenchmark\testing\formatting\HTMLFormatter

> Class that can interpret \PHPBenchmark\testing\TestResult and output an HTML formatted representation of the result

| Visibility | Function |
|:-----------|:---------|
| public | <strong>format(</strong><em>mixed</em> <strong>$result</strong>)</strong> : <em>void</em> |

*This class implements [\PHPBenchmark\testing\formatting\FormatterInterface](#interface-phpbenchmarktestingformattingformatterinterface)*

