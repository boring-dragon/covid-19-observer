<?php

class HopkinsGlobalStatsTest extends \PHPUnit\Framework\TestCase
{
    public function testIfGetTotalIsValid()
    {
        $globalstats = new \Jinas\Covid19\Hopkins\GlobalStats;
        $array = $globalstats->GetTotal();

        $this->assertIsArray($array);

        $this->assertArrayHasKey('total_confirmed', $array);
        $this->assertArrayHasKey('total_recovered', $array);
        $this->assertArrayHasKey('total_deaths', $array);
    }


    public function testIfGetAllIsValid()
    {
        $globalstats = new \Jinas\Covid19\Hopkins\GlobalStats;
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
        $this->assertIsArray($globalstats->GetAllCountries());
    }

    public function testIfGetTotalByCountryIsValid()
    {
        $globalstats = new \Jinas\Covid19\Hopkins\GlobalStats;

        $response = $globalstats->GetTotalByCountry();
        $array = $response[0];

        $this->assertIsArray($globalstats->GetTotalByCountry());
        
        $this->assertArrayHasKey('country', $array);
        $this->assertArrayHasKey('confirmed', $array);
        $this->assertArrayHasKey('recovered', $array);
        $this->assertArrayHasKey('deaths', $array);
    }

    public function testIfGetAllGroupedByCountryIsValid()
    {
        $globalstats = new \Jinas\Covid19\Hopkins\GlobalStats;

        $countries = $globalstats->GetAllCountries();
        $array = $globalstats->GetAllGroupedByCountry();

        $this->assertArrayHasKey($countries[0], $array);
    }
}
