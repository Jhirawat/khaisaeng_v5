<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        return view('locations');
    }

    public function getProvinces()
    {
        $response = Http::get('https://raw.githubusercontent.com/kongvut/thai-province-data/master/api_province_with_amphure_tambon.json');
        $locations = $response->json();
        $provinces = array_column($locations, 'name_th', 'id');

        return response()->json($provinces);
    }

    public function getDistricts($provinceId)
    {
        $response = Http::get('https://raw.githubusercontent.com/kongvut/thai-province-data/master/api_province_with_amphure_tambon.json');
        $locations = $response->json();
        $districts = [];

        foreach ($locations as $province) {
            if ($province['id'] == $provinceId) {
                $districts = array_column($province['amphure'], 'name_th', 'id');
                break;
            }
        }

        return response()->json($districts);
    }

    public function getSubdistricts($districtId)
    {
        $response = Http::get('https://raw.githubusercontent.com/kongvut/thai-province-data/master/api_province_with_amphure_tambon.json');
        $locations = $response->json();
        $subdistricts = [];

        foreach ($locations as $province) {
            foreach ($province['amphure'] as $district) {
                if ($district['id'] == $districtId) {
                    $subdistricts = array_column($district['tambon'], 'name_th', 'id');
                    break 2;
                }
            }
        }

        return response()->json($subdistricts);
    }

    public function getPostalCode($subdistrictId)
    {
        $response = Http::get('https://raw.githubusercontent.com/kongvut/thai-province-data/master/api_province_with_amphure_tambon.json');
        $locations = $response->json();
        $postalCode = '';

        foreach ($locations as $province) {
            foreach ($province['amphure'] as $district) {
                foreach ($district['tambon'] as $subdistrict) {
                    if ($subdistrict['id'] == $subdistrictId) {
                        $postalCode = $subdistrict['zip_code'];
                        break 3;
                    }
                }
            }
        }

        return response()->json(['postal_code' => $postalCode]);
    }
}
