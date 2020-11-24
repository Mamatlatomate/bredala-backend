<?php

namespace App\Http\Controllers;

use Spatie\Image\Image;
use Spatie\Image\Manipulations;

class ImageController extends Controller
{
    /**
     * @param $size
     * @param $path
     *
     * @return mixed
     */
    public static function thumbnail($size, $path)
    {
        $dimensions = config("image.thumbnails.$size");

        if (! $dimensions) {
            return abort(404);
        }

        $thumbnail = get_thumbnail($path, $size);

        if (! $thumbnail['resolved']) {
            Image::load("storage/$path")
                ->fit(Manipulations::FIT_CROP, $dimensions['width'], $dimensions['height'])
                ->save($thumbnail['filepath']);
        }

        return response()->file($thumbnail['filepath']);
    }
}
