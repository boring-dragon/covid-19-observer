<?php
namespace Jinas\Covid19\Adapters;

use Jinas\Covid19\Http\Client;
use Tightenco\Collect\Support\Arr;
use Jinas\Covid19\Adapters\IBaseAdapter;

class Covid19API implements IBaseAdapter
{
    public $api_response;
    public $updated_at;

    protected $client;

    public function __construct()
    {
        $this->client = new Client;
        $this->FetchCases();
    }
   


    /**
    * FetchCases
    *
    *  Fetch the cases from API
    *
    * @return void
    */
    protected function FetchCases() : void
    {
        $data = $this->client->get(sprintf('%s/%s', Arr::get(IBaseAdapter::COVID19API,'base_path.path'), Arr::get(IBaseAdapter::COVID19API, 'getsummary.path')));
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

        $total = [
            'total_confirmed' => $cases->sum('TotalConfirmed'),
            'total_recovered' => $cases->sum('TotalRecovered'),
            'total_deaths' => $cases->sum('TotalDeaths'),
            'total_active' => ($cases->sum('TotalConfirmed') - $cases->sum('TotalRecovered') - $cases->sum('TotalDeaths')),
            'new_confirmed' => $cases->sum('NewConfirmed'),
            'new_deaths' => $cases->sum('NewDeaths'),
            'new_recovered' => $cases->sum('NewRecovered')
        ];

        return $total;
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
        $countryData = collect($this->api_response);

        $countryData->shift();

        return $countryData->toArray();
    }

    public function GetAllCountries() : array
    {
        $countries = $this->client->get(sprintf('%s/%s',  Arr::get(IBaseAdapter::COVID19API,'base_path.path'), Arr::get(IBaseAdapter::COVID19API, 'getcountries.path')));
        return $countries;
    }
}
