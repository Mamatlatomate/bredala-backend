<?php

namespace App\Http\Controllers\Api;

use App\Models\Setting;
use App\Transformers\SettingTransformer;

class SettingController extends ApiController
{
    public function show(Setting $setting)
    {
        return fractal($setting, new SettingTransformer());
    }
}
