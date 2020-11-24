<?php

namespace App\Transformers;

use App\Models\Tag;
use League\Fractal\TransformerAbstract;

class TagTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['recipes'];

    public function transform(Tag $tag)
    {
        return [
            'name' => $tag->name,
            'slug' => $tag->slug,
        ];
    }

    public function includeRecipes(Tag $tag)
    {
        return $this->collection($tag->recipes, new RecipeTransformer());
    }
}
