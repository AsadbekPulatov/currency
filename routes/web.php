<?php

use App\Models\Currency;
use Illuminate\Support\Facades\Route;

Route::get('/{code?}', function ($code = null) {
    if ($code === null) {
        $currencies = Currency::orderby('created_date', 'ASC')
            ->get()
            ->groupby('ccy');
    } else {
        $currencies = Currency::where('ccy', $code)
            ->orderby('created_date', 'ASC')
            ->get()
            ->groupby('ccy');
    }
    foreach ($currencies as $key => $currency) {
        foreach ($currency as $item) {
            $labels[] = $item['created_date'];
            $data[$key][] = $item['rate'];
        }
        $color[$key][] = '#'. rand(0, 999999);
    }
    $labels = array_unique($labels);
    return view('welcome', compact('labels', 'data', 'color'));
});
