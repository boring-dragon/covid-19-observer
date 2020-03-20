# Covid-19 observer

PHP Toolkit to get data about covid19.

## Installation

```
composer require jinas/covid-19-observer
```

## Packages Used

- [Guzzle](https://github.com/guzzle/guzzle)
- [Goutte](https://github.com/FriendsOfPHP/Goutte)
- [Illuminate Collections](https://github.com/tightenco/collect)

> All the global data is from John Hopkins University CSSE
> Local Data(Maldives) by HPA, Coronamv

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

- GetTotalExceptChina(): Get total number of cases globaly Except china.
- GetTotalChina(): Get total number of cases in china.
- GetLocalTotal(): Get total Statistics In maldives.
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

### \Jinas\Covid19\GlobalStats

Wrapper around John hopkin's API.

List of available functions:

- GetTotal(): Get Total number of confirmed cases,recovered and deaths globally.
- GetAll(): Get all the attributes returned by hopkins API.
- GetAllCountries(): Get an array of available countries in Hopkin's Database.
- GetTotalByCountry(): Get the total confirmed cases,recovered,deaths in countries.
- GetAllGroupedByCountry(): Get all the attributes returned by hopkins API grouped by country region.
- 


## Source

- [John Hopkins](https://www.jhu.edu/)
- [Ministry of health republic of maldives](https://covid19.health.gov.mv)
- [Coronamv](https://coronamv.live/)
- [Avas News](https://avas.mv/)
- [Sun News](http://www.sun.mv/)

## License

MIT License 2020, Mohamed Jinas.
