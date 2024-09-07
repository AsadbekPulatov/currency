<?php

namespace App\Services;

use App\Models\Currency;
use DateInterval;
use DatePeriod;
use DateTime;

class CurrencyCheckService
{
    public function beforeCheck($arr, $col)
    {
        $new_arr = [];
        foreach ($arr as $item) {
            $new_arr[] = intval($item[$col]);
        }
        return array_unique($new_arr);
    }

    public function check($vars, $startDate, $endDate)
    {
        $currencies = $this->getCurrensies($startDate, $endDate);

        $period = new DatePeriod(
            new DateTime($startDate),
            new DateInterval('P1D'), // Interval of 1 day
            (new DateTime($endDate))->modify('+1 day') // Include the end date
        );

        foreach ($period as $date) {
            $formattedDate = $date->format('Y-m-d');
            $response[$formattedDate] = ['data' => [], 'status' => true];
        }
        if (count($currencies) != 0){
            foreach ($currencies as $key => $currency) {
                if (count($currency) == 0) {
                    $status = true;
                } else $status = false;

                $arr1 = $this->beforeCheck($currency, 'code');
                $arr2 = $this->beforeCheck($vars[$key], 'Code');

                $check = array_diff($arr2, $arr1);
                $response[$key] = ['data' => $check, 'status' => $status];
            }
        }
        return $response;
    }

    public function getCurrensies($startDate, $endDate)
    {
        return Currency::whereBetween('created_date', [$startDate, $endDate])->get()->groupby('created_date');
    }
}
