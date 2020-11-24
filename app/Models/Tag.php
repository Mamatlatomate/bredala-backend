<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Cviebrock\EloquentSluggable\Services\SlugService;

/**
 * App\Models\Tag.
 *
 * @property int                                                           $id
 * @property string                                                        $name
 * @property string                                                        $slug
 * @property \Illuminate\Support\Carbon|null                               $created_at
 * @property \Illuminate\Support\Carbon|null                               $updated_at
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Recipe[] $recipes
 * @property int|null                                                      $recipes_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Tag findSimilarSlugs($attribute, $config, $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
