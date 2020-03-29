<?php
namespace Jinas\Covid19;

use Jinas\Covid19\Http\Client;

class GlobalStatistics
{
    protected $api_response;
    public $updated_at;
    public const CASES_ENDPOINT = "https://api.covid19api.com/summary";


    public function __construct()
    {
        $this->FetchCases($this::CASES_ENDPOINT);
    }


     /**
     * FetchCases
     *
     *  Fetch the cases from API
     *
     * @return void
     */
    protected function FetchCases(string $endpoint) : void
    {
        $client = new Client;
        $data = $client->get($endpoint);
        $this->updated_at = $data["Date"];
        $this->api_response = $data["Countries"];
    }
    
    /**
     * GetTotal
     *
     *  Get Total number of confirmed cases,recovered and deaths globally
     *  
     *  From covid19api API. 
     * @return array
     */
    public function GetTotal() : array
    {
        $cases = collect($this->GetAll());

        $data = [
            'total_confirmed' => $cases->sum('TotalConfirmed'),
            'total_recovered' => $cases->sum('TotalRecovered'),
            'total_deaths' => $cases->sum('TotalDeaths'),
            'total_active' => ($cases->sum('TotalConfirmed') - $cases->sum('TotalRecovered') - $cases->sum('TotalDeaths'))
        ];

        return $data;
    }
    
    /**
     * GetAll
     * 
     *  Get all the country data from covid19api. 
     *
     * @return array
     */
    public function GetAll() : array
    {
        $countries = collect($this->api_response);

        $countries->shift();

        return $countries->toArray();
    }

}