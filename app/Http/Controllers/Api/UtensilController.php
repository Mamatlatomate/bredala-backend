<?php

namespace App\Http\Controllers\Api;

use App\Models\Utensil;
use App\Transformers\UtensilTransformer;

class UtensilController extends ApiController
{
    public function index()
    {
        $utensils = Utensil::all();

        return fractal($utensils, new UtensilTransformer());
    }

    public function show(Utensil $utensil)
    {
        return fractal($utensil, new UtensilTransformer());
    }
}
