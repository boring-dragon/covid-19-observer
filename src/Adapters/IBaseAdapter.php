<?php
namespace Jinas\Covid19\Adapters;

interface IBaseAdapter
{
    public const JOHNHOPKINS_API = [
        "getcases" => [
            "method" => "GET",
            "path" => "https://services1.arcgis.com/0MSEUqKaxRlEPj5g/arcgis/rest/services/ncov_cases/FeatureServer/1/query?f=json&where=1%3D1&returnGeometry=false&spatialRel=esriSpatialRelIntersects&outFields=*&orderByFields=Confirmed%20desc%2CCountry_Region%20asc%2CProvince_State%20asc&outSR=102100&resultOffset=0&resultRecordCount=300&cacheHint=true"
        ],

        "gettimeseries" => [
            "method" => "GET",
            "path" => "https://services1.arcgis.com/0MSEUqKaxRlEPj5g/arcgis/rest/services/cases_time_v3/FeatureServer/0/query?f=json&where=1%3D1&returnGeometry=false&spatialRel=esriSpatialRelIntersects&outFields=*&orderByFields=Report_Date_String%20asc&outSR=102100&resultOffset=0&resultRecordCount=2000&cacheHint=true"
        ]
    ];
    public const COVID19API = [
        "base_path" => [
            "method" => "GET",
            "path" => "https://api.covid19api.com"
        ],

        "getcountries" => [
            "method"    => "GET",
            "path"      => "countries"
        ],
        "getsummary" => [
            "method"    => "GET",
            "path"      => "summary"
        ]
    ];

    public const COVIDREST_API = [
        "base_path" => [
            "method" => "GET",
            "path" => "http://covid-rest.herokuapp.com"
        ],

        "getsummary" => [
            "method" => "GET",
            "path" => "summary"

        ]
    ];


    public function GetTotal(): array;
    public function GetAll(): array;
}