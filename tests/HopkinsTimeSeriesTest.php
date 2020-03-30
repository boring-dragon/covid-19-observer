<?php

class HopkinsTimeSeriesTest extends \PHPUnit\Framework\TestCase
{
    protected $api_stack;


    protected function setUp() : void
    {
        $data = json_decode(file_get_contents(__DIR__.DIRECTORY_SEPARATOR.'fixtures'.DIRECTORY_SEPARATOR.'hopkinstimeseries.json'), true);
        $this->api_stack = $data["features"];
    }

    public function testCanFetchTimeSeries()
    {
        $globalstats = new \Jinas\Covid19\Hopkins\GlobalTimeSeries;

        $fetchcases = $globalstats->FetchTimeSeries();
        
        $this->assertEquals(200,$globalstats->api_statuscode);

        //Checking if the FetchCases method is chainable
        $this->assertInstanceOf(\Jinas\Covid19\Hopkins\GlobalTimeSeries::class,$fetchcases);
    }
}