<?php

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) {
    $selected_codes = $request->input('codes');
    $codes = Currency::orderby('created_date', 'ASC')
        ->get()
        ->groupby('ccy');
    $arr_codes = [];
    foreach ($codes as $key => $item) {
        $arr_codes[] = $key;
    }

    $currencies = Currency::orderby('created_date', 'ASC')
        ->get()
        ->groupby('ccy');

    foreach ($currencies as $key => $currency) {
        foreach ($currency as $item) {
            $labels[] = $item['created_date'];
            $data[$key][] = $item['rate'];
        }
        $color[$key][] = '#' . rand(0, 999999);
    }
    $labels = array_unique($labels);

    if ($selected_codes != null){
        $new_data = [];
        $new_color = [];
        foreach ($selected_codes as $item){
            $new_data[$item] = $data[$item];
            $new_color[$item] = $color[$item];
        }
        $data = $new_data;
        $color = $new_color;
    }
    return view('welcome', compact('labels', 'data', 'color', 'arr_codes', 'selected_codes'));
});
