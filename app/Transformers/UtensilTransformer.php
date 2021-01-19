<?php

namespace App\Transformers;

use App\Models\Utensil;
use League\Fractal\TransformerAbstract;

class UtensilTransformer extends TransformerAbstract
{
    public function transform(Utensil $utensil)
    {
        $url = request()->getSchemeAndHttpHost();

        $attributes = $utensil->toArray();
        $attributes['description'] = str_replace('src="/', "src=\"{$url}/", $utensil->description);

        if ($utensil->image) {
            $attributes['images'] = [
                'thumbnail' => image_cache($utensil->image, 'small'),
                'classic'   => image_cache($utensil->image, 'large'),
            ];
        }

        unset(
            $attributes['id'],
            $attributes['image'],
        );

        return $attributes;
    }
}
