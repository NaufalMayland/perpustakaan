<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GetWilayahController extends Controller
{
    public function getProvinsi()
    {
        $response = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json");        
        return response()->json($response->json());
    }

    public function getKabupaten($provinsiId)
    {
        $response = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/regencies/{$provinsiId}.json");        
        return response()->json($response->json());
    }

    public function getKecamatan($kabupatenId)
    {
        $response = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/districts/{$kabupatenId}.json");        
        return response()->json($response->json());
    }

    public function getKelurahan($kecamatanId)
    {
        $response = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/villages/{$kecamatanId}.json");        
        return response()->json($response->json());
    }
}
