<?php

namespace App\Transformers;

use App\Models\Recipe;
use League\Fractal\TransformerAbstract;

class RecipeTransformer extends TransformerAbstract
{

    public function transform(Recipe $recipe)
    {
        return $recipe->toArray();
    }
}
