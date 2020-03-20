<?php

namespace Jinas\Covid19\MV;

use Jinas\Covid19\MV\News\Drivers\Avas;
use Jinas\Covid19\MV\News\Drivers\Sun;

class NewsFeed
{
    /**
     * FetchNews
     *
     *  Fetch the news assosiated with covid 19 from maldivian news
     *
     * @return void
     */
    public function FetchNews()
    {
        $NewsFeed = collect(Avas::ScrapNews())->merge(Sun::ScrapNews());
        return $NewsFeed->toArray();
    }
}
