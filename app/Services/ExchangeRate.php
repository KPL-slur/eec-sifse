<?php

namespace App\Services;

class ExchangeRate{
    function apiCall(){
        // $ex_rate_api = 'https://api.exchangeratesapi.io/latest?base=USD&symbols=IDR';
        $ex_rate_api = 'http://data.fixer.io/api/latest?access_key=8252609655d988b085806bb97c03f5ce&symbols=USD,IDR';
        $response = file_get_contents($ex_rate_api);
        $rates = json_decode($response);

        $usd = $rates->rates->USD;
        $idr = $rates->rates->IDR;
        $rate_fix = $idr / $usd;

        return $rate_fix;
    }
}