<?php
namespace Jinas\Covid19;

use Jinas\Covid19\Http\Client;

class GlobalTimeSeries
{
    public const TIME_SERIES_ENDPOINT = "https://services1.arcgis.com/0MSEUqKaxRlEPj5g/arcgis/rest/services/cases_time_v3/FeatureServer/0/query?f=json&where=1%3D1&returnGeometry=false&spatialRel=esriSpatialRelIntersects&outFields=*&orderByFields=Report_Date_String%20asc&outSR=102100&resultOffset=0&resultRecordCount=2000&cacheHint=true";
    public $api_response;

    public function __construct()
    {
        $this->FetchTimeSeries($this::TIME_SERIES_ENDPOINT);
    }


    public function FetchTimeSeries(string $endpoint) : void
    {
        $client = new Client;
        $data = $client->get($endpoint);
        $this->api_response = $data["features"];
    }
    
    /**
     * GetAllTimeSeries
     * 
     *  Get all the confirmed cases,recovered,deaths in timeseries
     *
     * @return array
     */
    public function GetAllTimeSeries() : array
    {
        foreach ($this->api_response as $feature) {
            $timeseries[] = $feature["attributes"];
        }

        return $timeseries;
    }
}
