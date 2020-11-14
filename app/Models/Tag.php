<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use CrudTrait;
    use Sluggable;

    protected $table = 'tags';
    protected $guarded = ['id'];
    protected $fillable = ['name', 'slug'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source'    => 'name',
                'onUpdate'  => true,
            ],
        ];
    }


    public static function boot()
    {
        static::saving(function (Tag $tag) {
            if (! empty($tag->slug)) {
                return;
            }
            $tag->slug = SlugService::createSlug(Tag::class, 'slug', $tag->name);
        });

        parent::boot();
    }

    public function recipes()
    {
        return $this->morphedByMany(Recipe::class, 'taggable');
    }
}
