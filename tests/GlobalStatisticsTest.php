<?php

class GlobalStatisticsTest extends \PHPUnit\Framework\TestCase
{
    protected $api_stack;


    protected function setUp() : void
    {
        $data = json_decode(file_get_contents(__DIR__.DIRECTORY_SEPARATOR.'fixtures'.DIRECTORY_SEPARATOR.'covid19summary.json'), true);
        $this->api_stack = $data["Countries"];
    }

    public function testCanFetchCases()
    {
        $globalstats = new \Jinas\Covid19\GlobalStatistics;

        $fetchcases = $globalstats->FetchCases();
        
        $this->assertEquals(200,$fetchcases->api_statuscode);

        //Checking if the FetchCases method is chainable
        $this->assertInstanceOf(\Jinas\Covid19\GlobalStatistics::class,$fetchcases);
    }

    public function testIfGetTotalIsValid()
    {
        $globalstats = new \Jinas\Covid19\GlobalStatistics;
        $globalstats->api_response = $this->api_stack;

        $array = $globalstats->GetTotal();

        $this->assertIsArray($array);

        $this->assertArrayHasKey('total_confirmed', $array);
        $this->assertArrayHasKey('total_recovered', $array);
        $this->assertArrayHasKey('total_deaths', $array);
        $this->assertArrayHasKey('total_active', $array);

        $this->assertNotEmpty($array["total_confirmed"]);
        $this->assertNotEmpty($array["total_recovered"]);
        $this->assertNotEmpty($array["total_deaths"]);
        $this->assertNotEmpty($array["total_active"]);

    }


    public function testIfGetAllIsValid()
    {
        $globalstats = new \Jinas\Covid19\GlobalStatistics;
        $globalstats->api_response = $this->api_stack;

        $array = $globalstats->GetAll();

        $this->assertIsArray($array);

        $index = $array[0];

        $this->assertArrayHasKey('Country', $index);
        $this->assertArrayHasKey('Slug', $index);
        $this->assertArrayHasKey('NewConfirmed', $index);
        $this->assertArrayHasKey('TotalConfirmed', $index);
        $this->assertArrayHasKey('NewDeaths', $index);
        $this->assertArrayHasKey('TotalDeaths', $index);
        $this->assertArrayHasKey('NewRecovered', $index);
        $this->assertArrayHasKey('TotalRecovered', $index);

    }
}
