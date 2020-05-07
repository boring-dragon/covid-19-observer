# Covid-19 observer

[![Build Status](https://travis-ci.org/jinas123/covid-19-observer.svg?branch=master)](https://travis-ci.org/jinas123/covid-19-observer)

PHP Toolkit to get data about covid19.

## Installation

```
composer require jinas/covid-19-observer
```

## Packages Used

- [Guzzle](https://github.com/guzzle/guzzle)
- [Goutte](https://github.com/FriendsOfPHP/Goutte)
- [Illuminate Collections](https://github.com/tightenco/collect)

> All the global data is from John Hopkins University CSSE, COVID19API, COVIDREST,WOLRDOMETER
> Local Data(Maldives) by HPA, Coronamv

## Usage

Load the adapter you want to use into statistics class LoadAdaptermethod

```php

use Jinas\Covid19\Statistics;

$stats = Statistics::LoadAdapter(
    new \Jinas\Covid19\Adapters\WorldoMeter
);

// Returns the total number of confirmed,recovered and deaths
$stats->GetTotal(); 

```

## Available Adapters

\Jinas\Covid19\Adapters

- JohnHopkins
- Covid19API
- CovidRest
- WorldoMeter

## Available Helper Classes

### \Jinas\Covid19\MV\MaldivesStats

Wrapper around coronamv API.

List of available functions:

- GetTotal(): Get the total statistics numbers in maldives.
- GetCases(): Get all the cases in maldives.
- GetCasesSortedByRecent(): Get all the cases in maldives sorted by recent case.
- GetCasesGroupedByAtoll(): Get all the cases in maldives grouped by administrative atoll in an array.
- GetAlertLevels(): Get all the Alert levels in maldives [ national and island alerts]
- GetAlertLevelsSortedByLevel(): Get all the alert levels in maldives sorted by highest level.

### \Jinas\Covid19\MV\HPA

Wrapper around HPA MV API.

List of available functions:

- GetGlobaTotal(): Get total number of cases globaly.
- GetLocalTotal(): Get total Statistics In maldives.
- GetClinics(): Get the flu clinics details from HPA.
- GetAlertLevels(): Get Local Alert levels from HPA API.
- GetRestrictedPlaces(): Get Local Restricted places from HPA.
- GetTravelBans(): Get all the travel bannned countries.

### \Jinas\Covid19\MV\NewsFeed

Fetch the news assosiated with covid 19 from maldivian news websites.

List of available functions:

- FetchNews(): Fetch news assosiated with covid 19 in avas and sun news as an array.

### \Jinas\Covid19\MV\Feed

Get Global case Feed in dhivehi. Wrapper around coronamv feeds API.

List of available functions:

- GetTimeline(): Get Global case Feed in dhivehi.

### \Jinas\Covid19\Adapters\JohnHopkins

Wrapper around John hopkin's API.

List of available functions:

- GetTotal(): Get Total number of confirmed cases,recovered and deaths globally.
- GetAll(): Get all the attributes returned by hopkins API.
- GetAllCountries(): Get an array of available countries in Hopkin's Database.
- GetTotalByCountry(): Get the total confirmed cases,recovered,deaths in countries.
- GetAllGroupedByCountry(): Get all the attributes returned by hopkins API grouped by country region.
- GetTimeSeries() :  Get all the confirmed cases,recovered,deaths in timeseries


### \Jinas\Covid19\Adapters\Covid19API

Wrapper around covid19api.com API.

List of available functions:

- GetTotal(): Get Total number of confirmed cases,recovered,active and deaths globally.
- GetAll(): Get all the attributes returned by API.

## Source

- [John Hopkins](https://www.jhu.edu/)
- [WorldoMeter](https://www.worldometers.info/coronavirus/)
- [CovidRest](http://covid-rest.herokuapp.com/)
- [Covid19API](https://covid19api.com/)
- [Ministry of health republic of maldives](https://covid19.health.gov.mv)
- [Coronamv](https://coronamv.live/)
- [Avas News](https://avas.mv/)
- [Sun News](http://www.sun.mv/)

## Showcase

- [Coronamv](https://coronamv.live/), (Web) by [Baraveli](https://baraveli.xyz/)
- [COVID19](https://covid19.kodeserve.mv/), (Web) by [KodeServe](https://kodeserve.mv/)


## License

MIT License 2020, Mohamed Jinas.
