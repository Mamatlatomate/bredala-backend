<?php

namespace App\Transformers;

use App\Models\Recipe;
use League\Fractal\TransformerAbstract;

class RecipeTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['tags'];
    protected $availableIncludes = ['utensils'];

    public function transform(Recipe $recipe)
    {
        $url = request()->getSchemeAndHttpHost();

        $attributes = $recipe->toArray();
        $attributes['body'] = str_replace('src="/', "src=\"{$url}/", $recipe->body);

        if ($recipe->image) {
            $attributes['images'] = [
                'thumbnail' => image_cache($recipe->image, 'small'),
                'classic'   => image_cache($recipe->image, 'large'),
            ];
        }

        unset(
            $attributes['id'],
            $attributes['image'],
        );

        return $attributes;
    }

    public function includeTags(Recipe $recipe)
    {
        return $this->collection($recipe->tags, new TagTransformer());
    }

    public function includeUtensils(Recipe $recipe)
    {
        return $this->collection($recipe->utensils, new UtensilTransformer());
    }
}
