<?php

namespace App\Http\Controllers\Api;

use App\Models\Recipe;
use App\Transformers\RecipeTransformer;

class RecipeController extends ApiController
{
    public function index()
    {
        $recipes = Recipe::all();

        return fractal($recipes, new RecipeTransformer());
    }
}
