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
    Route::get('/recipe/{recipe}', 'RecipeController@show')->name('recipes.show');

    Route::get('/tags', 'TagController@index')->name('tags.index');
    Route::get('/tag/{tag}', 'TagController@show')->name('tags.show');
});
