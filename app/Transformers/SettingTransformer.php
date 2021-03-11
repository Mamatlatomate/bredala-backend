<?php

namespace App\Transformers;

use App\Models\Setting;
use League\Fractal\TransformerAbstract;

class SettingTransformer extends TransformerAbstract
{
    public function transform(Setting $setting)
    {
        $url = request()->getSchemeAndHttpHost();

        $attributes = [
            'key'  => $setting->key,
            'name' => $setting->name,
        ];

        // $setting->type correspond forcément à un type de fields laravel backpack
        switch ($setting->type) {
            case 'ckeditor':
                $attributes['value'] = str_replace('src="/', "src=\"{$url}/", $setting->value);
                break;

            default:
                $attributes['value'] = $setting->value;
        }

        return $attributes;
    }
}
