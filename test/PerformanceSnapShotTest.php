<?php

use \PHPBenchmark\testing\metrics\PerformanceSnapshot;


class PerformanceSnapShotTest extends PHPUnit_Framework_TestCase {

    /**
     * @var \PHPBenchmark\testing\metrics\PerformanceSnapshotInterface
     */
    protected static $initSnap;

    protected function setUp()
    {
        self::$initSnap = new PerformanceSnapshot();
    }

    function testCreationOfSnapShots()
    {
        $this->assertEmpty(self::$initSnap->timePassed());
        $this->assertNotEmpty(self::$initSnap->numClassesDeclaredSincePreviousSnapshot());
        $this->assertNotEmpty(self::$initSnap->numFilesIncludedSincePreviousSnapshot());

        usleep(100);

        $snapShot = new PerformanceSnapshot(self::$initSnap);
        $this->assertNotEmpty($snapShot->timePassed());

        $bytes = str_repeat('aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 10000);
        $snapShot = new PerformanceSnapshot(self::$initSnap);
        $this->assertNotEmpty($snapShot->memoryAllocationDifference());
    }

}