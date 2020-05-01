<?php
/*
    This class is a wrapper around HPA API end-point
*/
namespace Jinas\Covid19\MV;

use Jinas\Covid19\Http\Client;
use Tightenco\Collect\Support\Arr;

class HPA
{
    public $api_response;

    public function __construct()
    {
        $this->FetchFromAPI("http://covid19.health.gov.mv/api/fetch_stats");
    }
    /**
     * FetchFromAPI
     *
     *  Fetch data from hpa API
     *
     * @param  mixed $endpoint
     * @return void
     */
    protected function FetchFromAPI(string $endpoint) : void
    {
        $client = new Client;
        $data = $client->get($endpoint);
        $this->api_response =  collect($data);
    }
    
    /**
     * GetTotalExceptChina
     *
     *  Get total number of cases globaly Except china
     *
     * @return array
     */
    public function GetTotalExceptChina() : array
    {
        $total = collect([
            "source" => "Ministry of Health Republic of Maldives",
            "label" => "Outside China",
            "confirmed" => Arr::get($this->api_response, 'global.not_china.confirmed.total'),
            "recovered" => Arr::get($this->api_response, 'global.not_china.recovered.total'),
            "deaths" => Arr::get($this->api_response, 'global.not_china.deaths.total'),
            "last_updated" => Arr::get($this->api_response, 'global.last_updated')
        ]);

        return $total->toArray();
    }
    
    /**
     * GetTotalChina
     *
     *  Get total number of cases in china
     *
     * @return array
     */
    public function GetTotalChina() : array
    {
        $total = collect([
            "source" => "Ministry of Health Republic of Maldives",
            "label" => "In China",
            "confirmed" => Arr::get($this->api_response, 'global.china.confirmed.total'),
            "recovered" => Arr::get($this->api_response, 'global.china.recovered.total'),
            "deaths" => Arr::get($this->api_response, 'global.china.deaths.total'),
            "last_updated" => Arr::get($this->api_response, 'global.last_updated')
        ]);

        return $total->toArray();
    }
    
    /**
     * GetLocalTotal
     *
     *  Get total Statistics In maldives
     *
     *  (Locally)
     *
     * @return array
     */
    public function GetLocalTotal() : array
    {
        $total = collect(Arr::get($this->api_response, 'local.surveillance'));
        $newcollection = collect($total->pluck('id'));
        $combinedArray = $newcollection->combine($total->pluck('statistic'));

        return $combinedArray->toArray();
    }

    
    /**
     * GetAlertLevels
     *
     *  Get Local ALert levels from HPA
     *
     * @return array
     */
    public function GetAlertLevels() : array
    {
        $alerts = collect(Arr::get($this->api_response, 'local.risk_level'));
        return $alerts->toArray();
    }
    
    /**
     * GetRestrictedPlaces
     *
     *  Get Local Restricted places from HPA
     * @return array
     */
    public function GetRestrictedPlaces() : array
    {
        $restricted = collect(Arr::get($this->api_response, 'local.restricted'));
        return $restricted->toArray();
    }
    
    /**
     * GetTravelBans
     *
     *  Get all the travel bannned country from maldives.
     *
     *  From HPA.
     *
     * @return array
     */
    public function GetTravelBans() : array
    {
        return Arr::get($this->api_response, 'local.travel_bans');
    }
}
