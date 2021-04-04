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

        $attributes['thumbnail'] = image_cache($recipe->image, 'small');
        $attributes['banner'] = image_cache($recipe->banner ?? $recipe->image, 'banner');

        unset($attributes['id']);

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
