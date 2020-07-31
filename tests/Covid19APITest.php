<?php

class Covid19APITest extends \PHPUnit\Framework\TestCase
{
    protected $api_stack;

    protected function setUp(): void
    {
        $this->api_stack = new \Jinas\Covid19\Adapters\Covid19API();
    }

    public function testIfGetTotalIsValid()
    {
        $array = $this->api_stack->GetTotal();

        $this->assertIsArray($array);

        $this->assertArrayHasKey('total_confirmed', $array);
        $this->assertArrayHasKey('total_recovered', $array);
        $this->assertArrayHasKey('total_deaths', $array);
        $this->assertArrayHasKey('total_active', $array);

        $this->assertNotEmpty($array['total_confirmed']);
        $this->assertNotEmpty($array['total_recovered']);
        $this->assertNotEmpty($array['total_deaths']);
        $this->assertNotEmpty($array['total_active']);
    }

    public function testIfGetAllIsValid()
    {
        $array = $this->api_stack->GetAll();

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
