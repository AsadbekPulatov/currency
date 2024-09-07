<?php

namespace App\Services;

use App\Models\Currency;

class CurrencySaveService
{
    public function beforeSaved($vars)
    {
        foreach ($vars as &$item) {
            unset($item['id']);
            $item['Date'] = date('Y-m-d', strtotime($item['Date']));
        }
        return $vars;
    }

    public function save($vars)
    {
        $vars = $this->beforeSaved($vars);
        Currency::insert($vars);
    }

    public function syncSave($isCheck, $vars)
    {
        $new_vars = [];
        foreach ($isCheck as $key => $check) {
            if ($check['status']) {
                foreach ($vars[$key] as $item) {
                    $new_vars[] = $item;
                }
            } else {
                foreach ($vars[$key] as $item) {
                    if (in_array(intval($item['Code']), $check['data'])) {
                        $new_vars[] = $item;
                    }
                }
            }
        }
        $this->save($new_vars);
    }
}
