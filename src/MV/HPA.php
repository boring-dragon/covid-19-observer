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
    protected function FetchFromAPI(string $endpoint): void
    {
        $client = new Client;
        $data = $client->get($endpoint);
        $this->api_response =  collect($data);
    }


    /**
     * GetGlobalTotal
     * 
     *  Get global total returned by hpa API.
     *
     * @return array
     */
    public function GetGlobalTotal(): array
    {
        $total = [
            "source" => "Ministry of Health Republic of Maldives",
            "label" => "Global Total",
            "confirmed" => (int) Arr::get($this->api_response, 'global.total.confirmed'),
            "recovered" => (int) Arr::get($this->api_response, 'global.total.recovered'),
            "deaths" => (int) Arr::get($this->api_response, 'global.total.deaths'),
            "last_updated" => Arr::get($this->api_response, 'global.last_updated')
        ];

        return $total;
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
    public function GetLocalTotal(): array
    {
        $total = collect(Arr::get($this->api_response, 'local.surveillance'));
        $newcollection = collect($total->pluck('id'));
        $combinedArray = $newcollection->combine($total->pluck('statistic'));

        return $this->tranformLocalTotal($combinedArray->toArray());
    }


    /**
     * GetAlertLevels
     *
     *  Get Local ALert levels from HPA
     *
     * @return array
     */
    public function GetAlertLevels(): array
    {
        $alerts = Arr::get($this->api_response, 'local.risk_level');
        return $alerts;
    }

    /**
     * GetRestrictedPlaces
     *
     *  Get Local Restricted places from HPA
     * @return array
     */
    public function GetRestrictedPlaces(): array
    {
        $restricted = Arr::get($this->api_response, 'local.restricted');
        return $restricted;
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
    public function GetTravelBans(): array
    {
        return Arr::get($this->api_response, 'local.travel_bans');
    }
    
    /**
     * GetClinics
     * 
     *  Get the flu clinics details from HPA.
     *
     * @return array
     */
    public function GetClinics() : array
    {
        $clinics = collect(Arr::get($this->api_response, 'local.clinics'));

        $clinics  = $clinics->map(function ($item, $key) {

            return $clinicData[] = [
                'en_name' => $item["english_name"],
                'div_name' => $item["dhivehi_name"],
                'open_hours_english' => $item["open_hours_english"],
                'open_hours_dhivehi' => $item["open_hours_dhivehi"],
                'description' => strip_tags($item["english_description"]),
                'location' => $item["location"]
            ];
        });

        return $clinics->toArray();
    }

    protected function tranformLocalTotal($totals)
    {
        return [
            'total_confirmed' => (int) $totals["CC"],
            'total_recovered' => (int) $totals["RC"],
            'total_deaths' => (int) $totals["DD"],
            'total_active' => (int) $totals["ACM"],
            'hospitalized' => (int) $totals["HOS"],
            'locals' => (int) $totals["L"],
            'foreigners' => (int) $totals["F"],
            'outside_country' => (int) $totals["ACO"],
            'quarantine' => (int) $totals["QF"],
            'isolation' => (int) $totals["IF"],
            'samples_tested' => (int) $totals["SC"],
            'samples_negative' => (int) $totals["SNG"],
            'samples_pending' => (int) $totals["SPN"]
        ];
    }
}
