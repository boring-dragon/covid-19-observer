<?php

namespace Jinas\Covid19\MV;

use Jinas\Covid19\Http\Client;

class MvCases
{
    protected const API_URL = 'https://covid19.health.gov.mv/api/fetch_cases';

    protected $api_response;

    public function __construct()
    {
        $this->FetchCases();
    }

    /**
     * GetAll.
     *
     *  Get all returned by the API
     *
     * @return array
     */
    public function GetAll(): array
    {
        return $this->api_response;
    }

    /**
     * GetCases.
     *
     *  Get all the cases returned by the API
     *
     * @return array
     */
    public function GetCases(): array
    {
        return $this->api_response['cases'];
    }

    /**
     * FilterCasesByAge.
     *
     *  Filter cases by there age
     *
     * @param string $operator
     * @param mixed  $value
     *
     * @return array
     */
    public function FilterCasesByAge(string $operator, $value): array
    {
        $cases = collect($this->GetCases());

        $filtered = $cases->where('age', $operator, $value);

        return $filtered->toArray();
    }

    /**
     * FilterCasesByNationality.
     *
     *  Filter cases by nationality.
     *
     * Ex: FilterCasesByNationality("Bangladesh")
     *
     * @param mixed $nationality
     *
     * @return void
     */
    public function FilterCasesByNationality(string $nationality): array
    {
        $cases = collect($this->GetCases());

        $filtered = $cases->where('nationality', '=', $nationality);

        return $filtered->toArray();
    }

    /**
     * FilterCasesByGender.
     *
     *  Filter cases by gender
     *
     *  Ex: FilterCasesByGender("female");
     *
     * @param mixed $gender
     *
     * @return void
     */
    public function FilterCasesByGender(string $gender): array
    {
        $cases = collect($this->GetCases());

        $filtered = $cases->where('gender', '=', ucfirst($gender));

        return $filtered->toArray();
    }

    /**
     * FetchCases.
     *
     *  Fetch the cases from API
     *
     * @return void
     */
    protected function FetchCases(): void
    {
        $client = new Client();
        $this->api_response = $client->get($this::API_URL);
    }
}
