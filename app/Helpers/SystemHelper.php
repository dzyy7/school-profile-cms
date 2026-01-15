<?php

use App\Models\Setting;
use App\Models\Settings;
use Illuminate\Support\Facades\Cache;

if (!function_exists('get_setting')) {
    function get_setting($key, $default = null)
    {
        // Gunakan Cache agar tidak query DB terus menerus setiap reload page
        $settings = Cache::rememberForever('app_settings', function () {
            return Settings::pluck('value', 'key')->toArray();
        });

        return $settings[$key] ?? $default;
    }
}
