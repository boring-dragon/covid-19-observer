<?php
// Adapter for http://covid-rest.herokuapp.com/
namespace Jinas\Covid19\Adapters;

use Jinas\Covid19\Http\Client;
use Tightenco\Collect\Support\Arr;

class CovidRest implements IBaseAdapter
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client;
    }
    /**
     * GetTotal
     * 
     *  Get the total returned by the API
     *
     * @return array
     */
    public function GetTotal(): array
    {
        $Apitotal = $this->client->get(sprintf('%s/%s', Arr::get(IBaseAdapter::COVIDREST_API, 'base_path.path'), Arr::get(IBaseAdapter::COVIDREST_API, 'getsummary.path')));
        $total = collect([
            'country_name' => Arr::get($Apitotal, 'data.country_name'),
            'total_confirmed' => Arr::get($Apitotal, 'data.total_cases'),
            'new_cases' => Arr::get($Apitotal, 'data.new_cases'),
            'total_deaths' => Arr::get($Apitotal, 'data.total_death'),
            'new_death' => Arr::get($Apitotal, 'data.new_death'),
            'total_recovered' => Arr::get($Apitotal, 'data.total_recovered'),
            'total_active' => Arr::get($Apitotal, 'data.total_active'),
            'critical_cases' => Arr::get($Apitotal, 'data.critical_cases'),
        ]);
        return $total->toArray();
    }

    /**
     * GetAll
     * 
     *  Get all the data returned by the API
     *
     * @return array
     */
    public function GetAll(): array
    {
        $country = $this->client->get(Arr::get(IBaseAdapter::COVIDREST_API, 'base_path.path'));

        return $country["data"];
    }
}
