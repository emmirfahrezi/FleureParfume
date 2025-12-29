<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;



class WilayahController extends Controller
{
    public function provinsi()
    {
        return Http::get(
            'https://emsifa.github.io/api-wilayah-indonesia/api/provinces.json'
        )->json();
    }

    public function kabupaten($id)
    {
        return Http::get(
            "https://emsifa.github.io/api-wilayah-indonesia/api/regencies/$id.json"
        )->json();
    }
}
