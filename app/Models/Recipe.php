<?php

namespace App\Models;

use App\Models\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Cviebrock\EloquentSluggable\Sluggable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Cviebrock\EloquentSluggable\Services\SlugService;

/**
 * App\Models\Recipe.
 *
 * @property int                                                        $id
 * @property string                                                     $title
 * @property string                                                     $slug
 * @property string|null                                                $body
 * @property object|null                                                $ingredients
 * @property object|null                                                $utensils
 * @property string|null                                                $image
 * @property string|null                                                $duration
 * @property string|null                                                $difficulty
 * @property string|null                                                $price
 * @property string|null                                                $quantity
 * @property string|null                                                $advice
 * @property \Illuminate\Support\Carbon|null                            $created_at
 * @property \Illuminate\Support\Carbon|null                            $updated_at
 * @property \App\Models\RatingRecipe|null                              $rating
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @property int|null                                                   $tags_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe findSimilarSlugs($attribute, $config, $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe query()
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereAdvice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereDifficulty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereIngredients($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereUtensils($value)
 * @mixin \Eloquent
 *
 * @property int $views_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereViewsCount($value)
 *
 * @property string   $status
 * @property int|null $utensils_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereStatus($value)
 * @method static Builder|Recipe published()
 */
class Recipe extends Model
{
    use CrudTrait;
    use ImageTrait;
    use Sluggable;

    protected $table = 'recipes';
    protected $guarded = ['id'];
    protected $fillable = [
        'title',
        'slug',
        'body',
        'ingredients',
        'image',
        'duration',
        'difficulty',
        'price',
        'quantity',
        'advice',
        'views_count',
        'status',
    ];
    protected $casts = [
        'ingredients' => 'object',
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

    public function imageable()
    {
        return [
            'image' => 'recipes',
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

    public function utensils()
    {
        return $this->belongsToMany(Utensil::class);
    }

    public function openRecipe()
    {
        $link = config('recipe.client_url')."/recette/$this->slug?previsualisation=true";

        return '<a href="'.$link.'" target="_blank" class="btn btn-sm btn-secondary" data-button-type="delete"><i class="la la-eye"></i> Voir la recette</a>';
    }

    public function scopePublished(Builder $builder)
    {
        return $builder->whereStatus('published');
    }
}
