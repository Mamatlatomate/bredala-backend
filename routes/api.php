<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'middleware' => 'api',
    'namespace'  => 'Api',
], function () {
    Route::get('/recipes', 'RecipeController@index')->name('recipes.index');
    Route::get('/recipes/by-views', 'RecipeController@byViews')->name('recipes.by-views');
    Route::get('/recipe/{recipe}', 'RecipeController@show')->name('recipe.show');
    Route::post('/recipe/count-view/{recipe}', 'RecipeController@countView')->name('recipe.count-view');

    Route::get('/tags', 'TagController@index')->name('tags.index');
    Route::get('/tag/{tag}', 'TagController@show')->name('tag.show');

    Route::get('/utensils', 'UtensilController@index')->name('utensils.index');
    Route::get('/utensil/{utensil}', 'UtensilController@show')->name('utensil.show');
});
