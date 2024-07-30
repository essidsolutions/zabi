<?php

namespace App\Http\Resources\Quran\Settings;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SettingsResourceCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'mosque_name' => $this->resource['company_name'],
            'mosque_address' => $this->resource['address'],
            'app_logo' => url($this->resource['app_logo']),
            'zakat_nisab' => floatval($this->resource['zakat_nisab']),
            'zakat_description' => $this->resource['zakat_description'],
            'haram_description' => $this->resource['haram_description'],
            'automatic_payer_time' => $this->resource['automatic_payer_time'] == 1,
            'ramadan_schedule' => $this->resource['ramadan_schedule'] == 1,
            'currency_symbol' => $this->resource['currency_symbol'],
            'play_store_url' => $this->resource['play_store_url'] ?? null,
            'app_store_url' => $this->resource['app_store_url'] ?? null
        ];
    }
}
