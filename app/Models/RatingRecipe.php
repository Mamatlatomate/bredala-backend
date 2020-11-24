<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RatingRecipe.
 *
 * @property \App\Models\Recipe $recipe
 *
 * @method static \Illuminate\Database\Eloquent\Builder|RatingRecipe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RatingRecipe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RatingRecipe query()
 * @mixin \Eloquent
 */
class RatingRecipe extends Model
{
    protected $fillable = ['recipe_id', 'views'];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
