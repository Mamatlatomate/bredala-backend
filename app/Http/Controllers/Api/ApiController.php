<?php

namespace App\Http\Controllers\Api;

use App\Models\Tag;
use App\Models\Recipe;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class ApiController extends Controller
{
    public function __construct()
    {
        Route::bind('recipe', function ($slug) {
            return Recipe::whereSlug($slug)->firstOrFail();
        });

        Route::bind('tag', function ($slug) {
            return Tag::whereSlug($slug)->firstOrFail();
        });
    }
}
