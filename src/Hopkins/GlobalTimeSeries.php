<?php
namespace Jinas\Covid19\Hopkins;

use Jinas\Covid19\Http\Client;
use Tightenco\Collect\Support\Arr;

class GlobalTimeSeries
{
    public const TIME_SERIES_ENDPOINT = "https://services1.arcgis.com/0MSEUqKaxRlEPj5g/arcgis/rest/services/cases_time_v3/FeatureServer/0/query?f=json&where=1%3D1&returnGeometry=false&spatialRel=esriSpatialRelIntersects&outFields=*&orderByFields=Report_Date_String%20asc&outSR=102100&resultOffset=0&resultRecordCount=2000&cacheHint=true";
    public $api_response;
    public $api_statuscode;

    
    /**
     * FetchTimeSeries
     *
     * @return object
     */
    public function FetchTimeSeries() : object
    {
        $client = new Client;
        $data = $client->get($this::TIME_SERIES_ENDPOINT);
        $this->api_response = Arr::get($data,'data.features');
        $this->api_statuscode = Arr::get($data,'status_code');

        return $this;
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
