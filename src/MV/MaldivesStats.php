<?php
/*
    This class is a wrapper around coronamv maldives end-point
*/
namespace Jinas\Covid19\MV;

use Jinas\Covid19\Http\Client;
use Tightenco\Collect\Support\Arr;

class MaldivesStats
{
    protected $maldivesData = [];

    public function __construct()
    {
        $this->FetchFromAPI("https://api.coronamv.live/v1/open/maldives");
    }
    
   
    
    /**
     * FetchFromAPI
     *
     *  Fetch Maldives data from coronamv API
     *
     * @param  mixed $endpoint
     * @return void
     */
    protected function FetchFromAPI(string $endpoint) : void
    {
        $client = new Client;
        $data = $client->get($endpoint);
        $this->maldivesData =  Arr::get($data,'data.data');
    }

    /**
    * GetTotal
    *
    *  Get the total statistics numbers in maldives
    *
    * @return array
    */
    public function GetTotal() : array
    {
        $total = collect([
            "total_confirmed" => intval($this->maldivesData["total_confirmed"]),
            "total_recovered" => intval($this->maldivesData["total_recovered"]),
            "total_active" => intval($this->maldivesData["total_active"]),
            "total_deaths" => intval($this->maldivesData["total_death"])
        ]);

        return $total->toArray();
    }
    
    /**
     * GetCases
     *
     *  Get all the cases in maldives
     *
     * @return array
     */
    public function GetCases() : array
    {
       return $this->maldivesData["cases"];
    }
    
    
    /**
     * GetCasesSortedByRecent
     *
     *  Get all the cases in maldives sorted by recent case
     *
     * @return array
     */
    public function GetCasesSortedByRecent() : array
    {
        $cases = collect($this->maldivesData["cases"]);

        $casesSortedByRecent = $cases->sortByDesc(function ($case, $key) {
            return $case["date"];
        });

        return $casesSortedByRecent->toArray();
    }
    
    /**
     * GetCasesGroupedByAtoll
     *
     *  Get all the cases in maldives grouped by administrative atoll in an array
     *
     * @return array
     */
    public function GetCasesGroupedByAtoll() : array
    {
        $cases = collect($this->maldivesData["cases"]);

        $groupedcases = $cases->groupBy('administrative_atoll');

        return $groupedcases->toArray();
    }
    
    /**
     * GetAlertLevels
     *
     *  Get all the Alert levels in maldives [ national and island alerts]
     *
     * @return array
     */
    public function GetAlertLevels() : array
    {
        return $this->maldivesData["risks"];
    }
    
    /**
     *  GetAlertLevelsSortedByLevel
     *
     *  Get all the alert levels in maldives sorted by highest level
     *
     * @return array
     */
    public function GetAlertLevelsSortedByLevel() : array
    {
        $risks = collect($this->maldivesData["risks"]);

        $risksSorted = $risks->sortByDesc(function ($risk, $key) {
            return $risk["level"];
        });

        return $risksSorted->toArray();
    }
}
