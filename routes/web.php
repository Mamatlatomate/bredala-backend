<?php

use Illuminate\Support\Facades\Route;

Route::get('cache/resolve/{size}/{path}', 'ImageController@thumbnail')->where('path', '.*');
