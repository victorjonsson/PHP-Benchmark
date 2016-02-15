## Table of contents

- [\PHPBenchmark\HtmlView](#class-phpbenchmarkhtmlview)
- [\PHPBenchmark\Monitor](#class-phpbenchmarkmonitor)
- [\PHPBenchmark\MonitorInterface (interface)](#interface-phpbenchmarkmonitorinterface)
- [\PHPBenchmark\PerformanceResultViewInterface (interface)](#interface-phpbenchmarkperformanceresultviewinterface)
- [\PHPBenchmark\Utils](#class-phpbenchmarkutils)
- [\PHPBenchmark\testing\AbstractFunctionComparison (abstract)](#class-phpbenchmarktestingabstractfunctioncomparison-abstract)
- [\PHPBenchmark\testing\FunctionComparison](#class-phpbenchmarktestingfunctioncomparison)
- [\PHPBenchmark\testing\TestResult](#class-phpbenchmarktestingtestresult)
- [\PHPBenchmark\testing\TestRunResult](#class-phpbenchmarktestingtestrunresult)
- [\PHPBenchmark\testing\formatting\CLITableFormatter](#class-phpbenchmarktestingformattingclitableformatter)
- [\PHPBenchmark\testing\formatting\FormatterInterface (interface)](#interface-phpbenchmarktestingformattingformatterinterface)
- [\PHPBenchmark\testing\formatting\HTMLFormatter](#class-phpbenchmarktestingformattinghtmlformatter)
- [\PHPBenchmark\testing\metrics\NullPerformanceInfoObject](#class-phpbenchmarktestingmetricsnullperformanceinfoobject)
- [\PHPBenchmark\testing\metrics\PerformanceInfo](#class-phpbenchmarktestingmetricsperformanceinfo)
- [\PHPBenchmark\testing\metrics\PerformanceInfoInterface (interface)](#interface-phpbenchmarktestingmetricsperformanceinfointerface)
- [\PHPBenchmark\testing\metrics\PerformanceSnapshot](#class-phpbenchmarktestingmetricsperformancesnapshot)
- [\PHPBenchmark\testing\metrics\PerformanceSnapshotInterface (interface)](#interface-phpbenchmarktestingmetricsperformancesnapshotinterface)

<hr /> 
### Class: \PHPBenchmark\HtmlView

> Class that can display the result of an performance monitoring as HTML

| Visibility | Function |
|:-----------|:---------|
| public | <strong>getView(</strong><em>[\PHPBenchmark\MonitorInterface](#interface-phpbenchmarkmonitorinterface)</em> <strong>$monitor</strong>)</strong> : <em>string</em> |
| protected | <strong>getContainerCSS()</strong> : <em>string</em> |
| protected | <strong>getTableCSS()</strong> : <em>string</em> |
| protected | <strong>getTableOpeningMarkup()</strong> : <em>string</em> |

*This class implements [\PHPBenchmark\PerformanceResultViewInterface](#interface-phpbenchmarkperformanceresultviewinterface)*

<hr /> 
### Class: \PHPBenchmark\Monitor

> Class used to collect benchmark data over a given time

| Visibility | Function |
|:-----------|:---------|
| public | <strike><strong>getData()</strong> : <em>[\PHPBenchmark\testing\metrics\PerformanceInfo](#class-phpbenchmarktestingmetricsperformanceinfo)</em></strike><br /><em>DEPRECATED - Use Monitor::getPerformanceInfo()</em> |
| public | <strong>getPerformanceInfo()</strong> : <em>[\PHPBenchmark\testing\metrics\PerformanceInfoInterface](#interface-phpbenchmarktestingmetricsperformanceinfointerface)</em><br /><em>Get benchmark data</em> |
| public | <strong>getSnapShots()</strong> : <em>[\PHPBenchmark\testing\metrics\PerformanceSnapshotInterface](#interface-phpbenchmarktestingmetricsperformancesnapshotinterface)[]</em> |
| public | <strong>init(</strong><em>bool/bool/true</em> <strong>$registerShutDownFunc=true</strong>)</strong> : <em>\PHPBenchmark\$this</em><br /><em>Initiate the performance monitoring</em> |
| public static | <strong>instance()</strong> : <em>[\PHPBenchmark\MonitorInterface](#interface-phpbenchmarkmonitorinterface)</em><br /><em>Singleton instance of this class</em> |
| public | <strong>numSnapShots()</strong> : <em>int</em> |
| public | <strong>snapShot(</strong><em>string</em> <strong>$name</strong>)</strong> : <em>void</em> |
| public | <strike><strong>snapShots()</strong> : <em>[\PHPBenchmark\testing\metrics\PerformanceSnapshotInterface](#interface-phpbenchmarktestingmetricsperformancesnapshotinterface)[]</em></strike><br /><em>DEPRECATED - Use Monitor::getSnapShots();</em> |

*This class extends \League\Event\Emitter*

*This class implements \League\Event\ListenerAcceptorInterface, \League\Event\EmitterInterface, [\PHPBenchmark\MonitorInterface](#interface-phpbenchmarkmonitorinterface)*

<hr /> 
### Interface: \PHPBenchmark\MonitorInterface

| Visibility | Function |
|:-----------|:---------|
| public | <strong>getPerformanceInfo()</strong> : <em>[\PHPBenchmark\testing\metrics\PerformanceInfoInterface](#interface-phpbenchmarktestingmetricsperformanceinfointerface)</em><br /><em>Get benchmark data</em> |
| public | <strong>getSnapShots()</strong> : <em>[\PHPBenchmark\testing\metrics\PerformanceSnapshotInterface](#interface-phpbenchmarktestingmetricsperformancesnapshotinterface)[]</em> |
| public | <strong>numSnapShots()</strong> : <em>int</em> |
| public | <strong>snapShot(</strong><em>string</em> <strong>$name</strong>)</strong> : <em>void</em><br /><em>Save a snapshot of performance metrics at this point in time</em> |

*This class implements \League\Event\ListenerAcceptorInterface*

<hr /> 
### Interface: \PHPBenchmark\PerformanceResultViewInterface

> Interface for classes that can generate a view displaying the result from a performance monitoring test

| Visibility | Function |
|:-----------|:---------|
| public | <strong>getView(</strong><em>[\PHPBenchmark\MonitorInterface](#interface-phpbenchmarkmonitorinterface)</em> <strong>$monitor</strong>)</strong> : <em>string</em> |

<hr /> 
### Class: \PHPBenchmark\Utils

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>getMicroTime()</strong> : <em>float</em> |
| public static | <strong>toMegaBytes(</strong><em>mixed</em> <strong>$bytes</strong>)</strong> : <em>float</em> |

<hr /> 
### <strike>Class: \PHPBenchmark\testing\AbstractFunctionComparison (abstract)</strike>

> **DEPRECATED** No longer used....

| Visibility | Function |
|:-----------|:---------|

*This class extends [\PHPBenchmark\testing\FunctionComparison](#class-phpbenchmarktestingfunctioncomparison)*

<hr /> 
### Class: \PHPBenchmark\testing\FunctionComparison

> Class that can be used to compare the performance between different algorithms.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>addFunction(</strong><em>string</em> <strong>$description</strong>, <em>\Closure</em> <strong>$func</strong>)</strong> : <em>[\PHPBenchmark\testing\FunctionComparison](#class-phpbenchmarktestingfunctioncomparison)</em> |
| public | <strong>exec()</strong> : <em>void</em><br /><em>Will run the test and echo the result. It will display the result in different formats depending on the context which in the function was called. You can alter the formatting of the result by using the function setFormatter(), giving it an object implementing \PHPBenchmark\testing\formatting\FormatterInterface</em> |
| public | <strong>getNumRuns()</strong> : <em>int</em><br /><em>The number of times each function will be called</em> |
| public static | <strong>load(</strong><em>mixed/int</em> <strong>$numRuns=500</strong>)</strong> : <em>[\PHPBenchmark\testing\FunctionComparison](#class-phpbenchmarktestingfunctioncomparison)</em> |
| public | <strong>run()</strong> : <em>[\PHPBenchmark\testing\TestResult](#class-phpbenchmarktestingtestresult)</em> |
| public | <strong>setFormatter(</strong><em>[\PHPBenchmark\testing\formatting\FormatterInterface](#interface-phpbenchmarktestingformattingformatterinterface)</em> <strong>$formatter</strong>)</strong> : <em>void</em><br /><em>Set which formatter that should be used when calling FunctionComparison::exec()</em> |
| public | <strike><strong>setFunctionA(</strong><em>mixed</em> <strong>$name</strong>, <em>mixed</em> <strong>$func</strong>)</strong> : <em>void</em></strike><br /><em>DEPRECATED - Use FunctionComparison::addFunction() instead</em> |
| public | <strike><strong>setFunctionB(</strong><em>mixed</em> <strong>$name</strong>, <em>mixed</em> <strong>$func</strong>)</strong> : <em>void</em></strike><br /><em>DEPRECATED - use FunctionComparison::addFunction() instead</em> |
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
| public | <strong>__construct(</strong><em>string</em> <strong>$description</strong>, <em>float</em> <strong>$time</strong>, <em>float</em> <strong>$memUsage</strong>)</strong> : <em>void</em><br /><em>TestResult constructor.</em> |
| public | <strong>getDescription()</strong> : <em>string</em> |
| public | <strong>getMemUsage()</strong> : <em>float</em> |
| public | <strong>getTime()</strong> : <em>float</em> |
| public | <strong>getTimesFaster()</strong> : <em>int</em> |
| public | <strong>isWinner()</strong> : <em>bool</em> |
| public | <strong>setTimesFaster(</strong><em>int</em> <strong>$timesFaster</strong>)</strong> : <em>void</em> |
| public | <strong>toggleIsWinner(</strong><em>bool</em> <strong>$toggle</strong>)</strong> : <em>void</em> |

<hr /> 
### Class: \PHPBenchmark\testing\formatting\CLITableFormatter

> Class that can interpret \PHPBenchmark\testing\TestResult and output a table that can be used in a console program

| Visibility | Function |
|:-----------|:---------|
| public | <strong>format(</strong><em>[\PHPBenchmark\testing\TestResult](#class-phpbenchmarktestingtestresult)</em> <strong>$result</strong>)</strong> : <em>string</em> |

*This class implements [\PHPBenchmark\testing\formatting\FormatterInterface](#interface-phpbenchmarktestingformattingformatterinterface)*

<hr /> 
### Interface: \PHPBenchmark\testing\formatting\FormatterInterface

> Interface implemented by classes that can interpret \PHPBenchmark\testing\TestResult into something that is human-readable

| Visibility | Function |
|:-----------|:---------|
| public | <strong>format(</strong><em>[\PHPBenchmark\testing\TestResult](#class-phpbenchmarktestingtestresult)</em> <strong>$result</strong>)</strong> : <em>string</em> |

<hr /> 
### Class: \PHPBenchmark\testing\formatting\HTMLFormatter

> Class that can interpret \PHPBenchmark\testing\TestResult and output an HTML formatted representation of the result

| Visibility | Function |
|:-----------|:---------|
| public | <strong>format(</strong><em>[\PHPBenchmark\testing\TestResult](#class-phpbenchmarktestingtestresult)</em> <strong>$result</strong>)</strong> : <em>string</em> |

*This class implements [\PHPBenchmark\testing\formatting\FormatterInterface](#interface-phpbenchmarktestingformattingformatterinterface)*

<hr /> 
### Class: \PHPBenchmark\testing\metrics\NullPerformanceInfoObject

| Visibility | Function |
|:-----------|:---------|
| public | <strong>creationTime()</strong> : <em>float</em><br /><em>Time stamp (in microseconds) of when this object was created</em> |
| public | <strong>memoryAllocated()</strong> : <em>float</em><br /><em>Total amount of memory (in megabytes) allocated at the given point the snap shot was taken</em> |
| public | <strong>numClassesDeclared()</strong> : <em>int</em> |
| public | <strong>numFilesIncluded()</strong> : <em>int</em> |
| public | <strong>peakMemoryAllocated()</strong> : <em>float</em> |
| public | <strong>timePassed()</strong> : <em>float</em> |

*This class implements [\PHPBenchmark\testing\metrics\PerformanceInfoInterface](#interface-phpbenchmarktestingmetricsperformanceinfointerface)*

<hr /> 
### Class: \PHPBenchmark\testing\metrics\PerformanceInfo

> Object presenting performance related information

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>float</em> <strong>$created</strong>, <em>float</em> <strong>$timePassed</strong>, <em>int</em> <strong>$numClassesTotal</strong>, <em>int</em> <strong>$numFilesIncluded</strong>, <em>float</em> <strong>$memoryAllocated</strong>)</strong> : <em>void</em><br /><em>PerformanceInfo constructor.</em> |
| public | <strong>creationTime()</strong> : <em>float</em><br /><em>Time stamp (in microseconds) of when this object was created</em> |
| public | <strong>memoryAllocated()</strong> : <em>float</em><br /><em>Total amount of memory (in megabytes) allocated at the given point the snap shot was taken</em> |
| public | <strong>numClassesDeclared()</strong> : <em>int</em> |
| public | <strong>numFilesIncluded()</strong> : <em>int</em> |
| public | <strong>offsetExists(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>void</em> |
| public | <strong>offsetGet(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>void</em> |
| public | <strong>offsetSet(</strong><em>mixed</em> <strong>$offset</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em> |
| public | <strong>offsetUnset(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>void</em> |
| public | <strong>peakMemoryAllocated()</strong> : <em>float</em> |
| public | <strong>timePassed()</strong> : <em>float</em> |

*This class implements [\PHPBenchmark\testing\metrics\PerformanceInfoInterface](#interface-phpbenchmarktestingmetricsperformanceinfointerface), \ArrayAccess*

<hr /> 
### Interface: \PHPBenchmark\testing\metrics\PerformanceInfoInterface

> Interface for objects representing performance related information

| Visibility | Function |
|:-----------|:---------|
| public | <strong>creationTime()</strong> : <em>float</em><br /><em>Time stamp (in microseconds) of when this object was created</em> |
| public | <strong>memoryAllocated()</strong> : <em>float</em><br /><em>Total amount of memory (in megabytes) allocated at the given point the snap shot was taken</em> |
| public | <strong>numClassesDeclared()</strong> : <em>int</em> |
| public | <strong>numFilesIncluded()</strong> : <em>int</em> |
| public | <strong>peakMemoryAllocated()</strong> : <em>float</em> |
| public | <strong>timePassed()</strong> : <em>float</em> |

<hr /> 
### Class: \PHPBenchmark\testing\metrics\PerformanceSnapshot

> Object containing data that describes performance relative to a previously recorded state.

###### Example
```php
<?php
 $initSnapShot = new PerformanceSnapShot();
 doSomeHeavyLifting();
 $snapShot = new PerformanceSnapShot($initSnapShot);
 echo 'It took ' .$snapShot->getTimePassed(). ' seconds.';
 doMoreHeavyLifting();
 $newSnapShot = new PerformanceSnapShot($snapShot);
 echo 'It took ' .$newSnapShot->getTimePassed(). ' seconds.';
```

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>[\PHPBenchmark\testing\metrics\PerformanceInfoInterface](#interface-phpbenchmarktestingmetricsperformanceinfointerface)/null/[\PHPBenchmark\testing\metrics\PerformanceInfoInterface](#interface-phpbenchmarktestingmetricsperformanceinfointerface)</em> <strong>$prev=null</strong>)</strong> : <em>void</em><br /><em>PerformanceSnapshot constructor.</em> |
| public | <strong>creationTime()</strong> : <em>float</em><br /><em>Time stamp (in microseconds) of when this object was created</em> |
| public | <strong>memoryAllocated()</strong> : <em>float</em><br /><em>Total amount of memory (in megabytes) allocated at the given point the snap shot was taken</em> |
| public | <strong>memoryAllocationDifference()</strong> : <em>float</em><br /><em>The change in memory allocation since last snap shot</em> |
| public | <strong>numClassesDeclared()</strong> : <em>int</em> |
| public | <strong>numClassesDeclaredSincePreviousSnapshot()</strong> : <em>int</em><br /><em>The number of loaded classes since last snap shot</em> |
| public | <strong>numFilesIncluded()</strong> : <em>int</em> |
| public | <strong>numFilesIncludedSincePreviousSnapshot()</strong> : <em>int</em><br /><em>The number of files included since last snap shot</em> |
| public | <strong>offsetExists(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>void</em> |
| public | <strong>offsetGet(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>void</em> |
| public | <strong>offsetSet(</strong><em>mixed</em> <strong>$offset</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em> |
| public | <strong>offsetUnset(</strong><em>mixed</em> <strong>$offset</strong>)</strong> : <em>void</em> |
| public | <strong>peakMemoryAllocated()</strong> : <em>float</em> |
| public | <strong>timePassed()</strong> : <em>float</em> |

*This class extends [\PHPBenchmark\testing\metrics\PerformanceInfo](#class-phpbenchmarktestingmetricsperformanceinfo)*

*This class implements \ArrayAccess, [\PHPBenchmark\testing\metrics\PerformanceInfoInterface](#interface-phpbenchmarktestingmetricsperformanceinfointerface), [\PHPBenchmark\testing\metrics\PerformanceSnapshotInterface](#interface-phpbenchmarktestingmetricsperformancesnapshotinterface)*

<hr /> 
### Interface: \PHPBenchmark\testing\metrics\PerformanceSnapshotInterface

> Object containing data that might describe the performance

| Visibility | Function |
|:-----------|:---------|
| public | <strong>memoryAllocationDifference()</strong> : <em>float</em><br /><em>The change in memory allocation since last snap shot</em> |
| public | <strong>numClassesDeclaredSincePreviousSnapshot()</strong> : <em>int</em><br /><em>The number of loaded classes since last snap shot</em> |
| public | <strong>numFilesIncludedSincePreviousSnapshot()</strong> : <em>int</em><br /><em>The number of files included since last snap shot</em> |

*This class implements [\PHPBenchmark\testing\metrics\PerformanceInfoInterface](#interface-phpbenchmarktestingmetricsperformanceinfointerface)*

