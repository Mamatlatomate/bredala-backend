<?php

namespace App\Transformers;

use App\Models\Recipe;
use League\Fractal\TransformerAbstract;

class RecipeTransformer extends TransformerAbstract
{
    public function transform(Recipe $recipe)
    {
        $url = request()->getSchemeAndHttpHost();

        $attributes = $recipe->toArray();
        $attributes['body'] = str_replace('src="/', "src=\"{$url}/", $recipe->body);

        if ($recipe->image) {
            $attributes['images'] = [
                'thumbnail' => image_cache($recipe->image, 'small'),
                'classic'   => image_cache($recipe->image, 'medium'),
            ];
        }

        unset(
            $attributes['id'],
            $attributes['image'],
        );

        return $attributes;
    }
}
