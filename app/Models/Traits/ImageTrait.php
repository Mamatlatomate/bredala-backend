<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * @mixin \Illuminate\Database\Eloquent\Model
 *
 * @property $attribute_name
 * @property $destination_path
 * Trait ImageTrait
 */
trait ImageTrait
{
    /**
     * Return an with attribute_name (in database) => destination_path (folder name in storage).
     *
     * @return array
     */
    abstract public static function imageable(): array;

    public static function bootImageTrait()
    {
        static::deleting(function (Model $obj) {
            $imageable = $obj->imageable();
            foreach ($imageable as $attribute => $folder) {
                Storage::disk('public')->delete($obj->{$attribute});
            }
        });

        static::updating(function (Model $obj) {
            $imageable = $obj->imageable();
            foreach ($imageable as $attribute => $folder) {
                if ($obj->isDirty($attribute)) {
                    Storage::disk('public')->delete($obj->getOriginal($attribute));
                }
            }
        });
    }

    public function setAttribute($key, $value)
    {
        $imageable = $this->imageable();
        if (isset($imageable[$key])) {
            if (null == $value) {
                $this->attributes[$key] = null;
            }

            if (Str::startsWith($value, 'data:image')) {
                $image = Image::make($value);
                $extensionType = exif_imagetype($value);
                $filename = md5($value.uniqid('', true)).image_type_to_extension($extensionType);
                Storage::disk('public')->put($imageable[$key].'/'.$filename, $image->stream());
                $this->attributes[$key] = $imageable[$key].'/'.$filename;
            }

            return;
        }
        parent::setAttribute($key, $value);
    }
}
