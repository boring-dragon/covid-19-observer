<?php
namespace Jinas\Covid19\MV;

use Jinas\Covid19\Http\Client;

class Feed
{
    /**
     * GetTimeline
     *
     *  Get Global case Feed in dhivehi.
     *
     *  Sorted by latest first
     *
     * @return array
     */
    public function GetTimeline() : array
    {
        $client = new Client;
        $data = $client->get("https://api.coronamv.live/v1/open/global/feeds");
        $collection = collect($data["data"]);
        $latest = $collection->reverse();

        return $latest->toArray();
    }
}
