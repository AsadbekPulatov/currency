<?php

namespace App\Client;

use Illuminate\Support\Facades\Http;

class CurrencyClient
{
    CONST base_url = 'https://cbu.uz/uz/arkhiv-kursov-valyut/json/';
    private $type;
    private $date;

    public function __construct($date, $type = 'all')
    {
        $this->date = $date;
        $this->type = $type;
    }

    public function getCurrencies(){
        return Http::get(self::base_url.$this->type.'/'.$this->date)->json();
    }
}
