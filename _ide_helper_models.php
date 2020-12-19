<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\RatingRecipe.
 *
 * @property \App\Models\Recipe $recipe
 * @method static \Illuminate\Database\Eloquent\Builder|RatingRecipe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RatingRecipe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RatingRecipe query()
 * @mixin \Eloquent
 */
	class RatingRecipe extends \Eloquent {}
}

namespace App\Models{
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
 */
	class Recipe extends \Eloquent {}
}

namespace App\Models{
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
	class Tag extends \Eloquent {}
}

namespace App{
/**
 * App\User.
 *
 * @property int                                                                                                       $id
 * @property string                                                                                                    $name
 * @property string                                                                                                    $email
 * @property \Illuminate\Support\Carbon|null                                                                           $email_verified_at
 * @property string                                                                                                    $password
 * @property string|null                                                                                               $remember_token
 * @property \Illuminate\Support\Carbon|null                                                                           $created_at
 * @property \Illuminate\Support\Carbon|null                                                                           $updated_at
 * @property \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property int|null                                                                                                  $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class User extends \Eloquent {}
}

