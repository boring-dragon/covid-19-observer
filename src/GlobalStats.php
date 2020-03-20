<?php
namespace Jinas\Covid19;

use Jinas\Covid19\Http\Client;
use Tightenco\Collect\Support\Arr;

class GlobalStats
{
    public const CASES_ENDPOINT = "https://services1.arcgis.com/0MSEUqKaxRlEPj5g/arcgis/rest/services/ncov_cases/FeatureServer/1/query?f=json&where=1%3D1&returnGeometry=false&spatialRel=esriSpatialRelIntersects&outFields=*&orderByFields=Confirmed%20desc%2CCountry_Region%20asc%2CProvince_State%20asc&outSR=102100&resultOffset=0&resultRecordCount=300&cacheHint=true";
    public $api_response;

    public function __construct()
    {
        $this->FetchCases($this::CASES_ENDPOINT);
    }
   
    /**
     * FetchCases
     *
     *  Fetch the cases from hopkin's API
     *
     * @return void
     */
    protected function FetchCases(string $endpoint) : void
    {
        $client = new Client;
        $data = $client->get($endpoint);
        $this->api_response = $data["features"];
    }
    
    /**
     * GetTotal
     * 
     *  Get Total number of confirmed cases,recovered and deaths globally
     * 
     *  From hopkins API.
     *
     * @return array
     */
    public function GetTotal() : array
    {
        $cases = collect($this->GetAll());

        $data = [
            'total_confirmed' => $cases->sum('Confirmed'),
            'total_recovered' => $cases->sum('Recovered'),
            'total_deaths' => $cases->sum('Deaths')
        ];

        return $data;
    }
    
    /**
     * GetAll
     *
     *  Get all the attributes returned by hopkins API
     *
     * @return array
     */
    public function GetAll() : array
    {
        foreach ($this->api_response as $feature) {
            $sliced_array[] = Arr::only($feature["attributes"], [
            'Province_State',
            'Country_Region',
            'Confirmed',
            'Recovered',
            'Deaths',
            'Active',
            'Lat',
            'Long_'
            ]);
        }

        return $sliced_array;
    }
    
    /**
     * GetAllCountries
     *
     *  Get an array of countries infected by covid-19
     *
     *  List Available countries in hopkin's API
     *
     * @return array
     */
    public function GetAllCountries() : array
    {
        foreach ($this->GetAll() as $item) {
            $countries[] = Arr::only($item, ['Country_Region']);
        }
        $flattened = Arr::flatten($countries);
        $removedDuplicates = array_unique($flattened);
        
        return $removedDuplicates;
    }
    
    /**
     * GetTotalByCountry
     *
     *  Get the total confirmed cases,recovered,deaths in countries
     *
     *  Queried
     *
     * @return array
     */
    public function GetTotalByCountry() : array
    {
        $countries = $this->GetAllCountries();

        $AllCases = collect($this->GetAll());

        foreach ($countries as $country) {
            $deaths = $AllCases->where('Country_Region', $country)->sum('Deaths');
            $recovered = $AllCases->where('Country_Region', $country)->sum('Recovered');
            $confirmed = $AllCases->where('Country_Region', $country)->sum('Confirmed');

            
            $countryTotal[] = array(
                'country' => $country,
                'confirmed' => $confirmed,
                'recovered' => $recovered,
                'deaths' => $deaths
            );
        }

        return $countryTotal;
    }
    
    /**
     * GetAllGroupedByCountry
     *
     *  Get all the attributes returned by hopkins API grouped by country region
     *
     * @return array
     */
    public function GetAllGroupedByCountry() : array
    {
        $attributes = collect($this->GetAll());
        $grouped = $attributes->groupBy('Country_Region');

        return $grouped->toArray();
    }
}
