<?php

namespace App\Http\Controllers\Api;

use App\Models\Recipe;
use App\Transformers\RecipeTransformer;

class RecipeController extends ApiController
{
    public function index()
    {
        $recipes = Recipe::published()->orderByDesc('created_at')->get();

        return fractal($recipes, new RecipeTransformer());
    }

    public function show(Recipe $recipe)
    {
        return fractal($recipe, new RecipeTransformer())->parseIncludes(['utensils']);
    }

    public function byViews()
    {
        $recipes = Recipe::published()->orderByDesc('views_count')->limit(6)->get();

        return fractal($recipes, new RecipeTransformer());
    }

    public function countView(Recipe $recipe)
    {
        $recipe->increment('views_count');

        return $recipe->save();
    }
}
