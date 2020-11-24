<?php

namespace App\Http\Controllers\Api;

use App\Models\Tag;
use App\Transformers\TagTransformer;

class TagController extends ApiController
{
    public function index()
    {
        $tags = Tag::all();

        return fractal($tags, new TagTransformer());
    }

    public function show(Tag $tag)
    {
        return fractal($tag, new TagTransformer())->parseIncludes(['recipes']);
    }
}
