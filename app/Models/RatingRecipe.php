<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RatingRecipe extends Model
{
    protected $fillable = ['recipe_id', 'views'];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
