<?php

namespace App\Http\Controllers;

use App\City;
use App\Province;
use Illuminate\Http\Request;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class CheckOngkirController extends Controller
{
    public function index()
    {
        $provinces = Province::pluck('name', 'province_id');
        return view('index', compact('provinces'));
    }

    public function getCities($id)
    {
        $city = City::where('province_id', $id)->pluck('name', 'city_id');
        return response()->json($city);
    }

    public function check_ongkir(Request $request)
    {
        $costs = RajaOngkir::ongkir([
            'origin' => $request->city_origin,
            'destination' => $request->city_destination,
            'weight' => $request->weight,
            'courier' => $request->courier
        ])->get();

        return response()->json($costs);
    }
}
