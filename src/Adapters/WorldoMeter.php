<?php

namespace Jinas\Covid19\Adapters;

use Goutte\Client;
use Tightenco\Collect\Support\Arr;

class WorldoMeter implements IBaseAdapter
{
    protected $crawler;

    public function __construct()
    {
        $this->GetHtml();
    }
    
    /**
     * GetTotal
     * 
     *  Get the total confirmed, deaths and recovered cases from worldometer
     *
     * @return array
     */
    public function GetTotal(): array
    {
        $rawdata = [];
        $this->crawler->filter('div[class*="maincounter-number"] span')->each(function ($node) use (&$rawdata) {
            $rawdata[] = filter_var($node->text(), FILTER_SANITIZE_NUMBER_INT);
        });

        $labels = collect(['total_confirmed', 'total_deaths', 'total_recovered']);
        $total = $labels->combine($rawdata);
        //$total->push(['total_active' => ($total->get('total_confirmed') - $total->get('total_recovered') - $total->get('total_deaths'))]);
        return $total->toArray();
    }
    
    /**
     * GetAll
     * 
     *  Get Extra Information in Worldometer
     *
     * @return array
     */
    public function GetAll(): array
    {
        $rawdata = [];
        $this->crawler->filter('div[class*="number-table-main"]')->each(function ($node) use (&$rawdata) {
            $rawdata[] = filter_var($node->text(), FILTER_SANITIZE_NUMBER_INT);
        });

        $this->crawler->filter('span[class*="number-table"]')->each(function ($node) use (&$rawdata) {
            $rawdata[] = filter_var($node->text(), FILTER_SANITIZE_NUMBER_INT);
        });

        $labels = collect([
            'active_cases',
            'closed_cases',
            'mild_condition',
            'critical_condition',
            'discharged',
            'discharged_deaths'
        ]);

        $data = $labels->combine($rawdata);

        return $data->toArray();
    }

    protected function GetHtml(): void
    {
        $goutte = new Client();
        $this->crawler = $goutte->request('GET', Arr::get(IBaseAdapter::WORLDOMETER, 'base_path.path'));
    }
}
