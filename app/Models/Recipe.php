<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use CrudTrait;
    use Sluggable;

    protected $table = 'recipes';
    protected $guarded = ['id'];
    protected $fillable = [
        'title',
        'slug',
        'body',
        'ingredients',
        'utensils',
        'image',
        'duration',
        'difficulty',
        'price',
        'quantity',
        'advice',
    ];
    protected $casts = [
        'ingredients' => 'object',
        'utensils'    => 'object'
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source'    => 'title',
                'onUpdate'  => true,
            ],
        ];
    }


    public static function boot()
    {
        static::saving(function (Recipe $recipe) {
            if (! empty($recipe->slug)) {
                return;
            }
            $recipe->slug = SlugService::createSlug(Recipe::class, 'slug', $recipe->title);
        });

        parent::boot();
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
