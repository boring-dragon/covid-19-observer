<?php
class HopkinsGlobalStatsTest extends \PHPUnit\Framework\TestCase
{
    protected $api_stack;


    protected function setUp() : void
    {
        $data = json_decode(file_get_contents(__DIR__.DIRECTORY_SEPARATOR.'fixtures'.DIRECTORY_SEPARATOR.'hopkinsall.json'),true);
        $this->api_stack = $data["features"];
    }


    public function testIfGetTotalIsValid()
    {
        $globalstats = new \Jinas\Covid19\Hopkins\GlobalStats;
        $globalstats->api_response = $this->api_stack;

        $array = $globalstats->GetTotal();

        $this->assertIsArray($array);

        $this->assertArrayHasKey('total_confirmed', $array);
        $this->assertArrayHasKey('total_recovered', $array);
        $this->assertArrayHasKey('total_deaths', $array);

        $this->assertNotEmpty($array["total_confirmed"]);
        $this->assertNotEmpty($array["total_recovered"]);
        $this->assertNotEmpty($array["total_deaths"]);
    }


    public function testIfGetAllIsValid()
    {
        $globalstats = new \Jinas\Covid19\Hopkins\GlobalStats;
        $globalstats->api_response = $this->api_stack;

        $response = $globalstats->GetAll();
        $array = $response[0];

        $this->assertIsArray($globalstats->GetAll());

        $this->assertArrayHasKey('Province_State', $array);
        $this->assertArrayHasKey('Country_Region', $array);
        $this->assertArrayHasKey('Confirmed', $array);
        $this->assertArrayHasKey('Recovered', $array);
        $this->assertArrayHasKey('Deaths', $array);
        $this->assertArrayHasKey('Active', $array);
        $this->assertArrayHasKey('Lat', $array);
        $this->assertArrayHasKey('Long_', $array);
    }

    public function testIfGetAllCountriesReturnsAnArray()
    {
        $globalstats = new \Jinas\Covid19\Hopkins\GlobalStats;
        $globalstats->api_response = $this->api_stack;

        $this->assertIsArray($globalstats->GetAllCountries());
        $this->assertNotEmpty($globalstats->GetAllCountries());
    }

    public function testIfGetTotalByCountryIsValid()
    {
        $globalstats = new \Jinas\Covid19\Hopkins\GlobalStats;
        $globalstats->api_response = $this->api_stack;

        $response = $globalstats->GetTotalByCountry();
        $array = $response[0];

        $this->assertIsArray($globalstats->GetTotalByCountry());
        
        $this->assertArrayHasKey('country', $array);
        $this->assertArrayHasKey('confirmed', $array);
        $this->assertArrayHasKey('recovered', $array);
        $this->assertArrayHasKey('deaths', $array);

        $this->assertNotEmpty($array["country"]);
        $this->assertNotEmpty($array["confirmed"]);
        $this->assertNotEmpty($array["recovered"]);
        $this->assertNotEmpty($array["deaths"]);
    }

    public function testIfGetAllGroupedByCountryIsValid()
    {
        $globalstats = new \Jinas\Covid19\Hopkins\GlobalStats;
        $globalstats->api_response = $this->api_stack;

        $countries = $globalstats->GetAllCountries();
        $array = $globalstats->GetAllGroupedByCountry();

        $this->assertArrayHasKey($countries[0], $array);
    }
}
