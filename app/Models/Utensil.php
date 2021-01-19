<?php

namespace App\Models;

use App\Models\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Cviebrock\EloquentSluggable\Services\SlugService;

/**
 * App\Models\Utensil.
 *
 * @property int                             $id
 * @property string                          $name
 * @property string                          $slug
 * @property string                          $image
 * @property string                          $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Utensil findSimilarSlugs($attribute, $config, $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Utensil newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Utensil newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Utensil query()
 * @method static \Illuminate\Database\Eloquent\Builder|Utensil whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Utensil whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Utensil whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Utensil whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Utensil whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Utensil whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Utensil whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Utensil extends Model
{
    use CrudTrait;
    use ImageTrait;
    use Sluggable;

    protected $table = 'utensils';
    protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'slug',
        'image',
        'description',
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source'    => 'name',
                'onUpdate'  => true,
            ],
        ];
    }

    public function imageable()
    {
        return [
            'image' => 'utensils',
        ];
    }

    public static function boot()
    {
        static::saving(function (Utensil $utensil) {
            if (! empty($utensil->slug)) {
                return;
            }
            $utensil->slug = SlugService::createSlug(Utensil::class, 'slug', $utensil->name);
        });

        parent::boot();
    }

    public function recipes()
    {
        $this->hasMany(Recipe::class);
    }
}
