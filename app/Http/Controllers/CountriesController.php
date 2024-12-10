<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CountriesController extends Controller
{
    /* public function importCountries() {
        $response = Http::get('https://restcountries.com/v3.1/all');
        dd($response);
        if($response->successful()){
                
            $countries = $response->json();
            foreach ($countries as $countryData) {
                Country::create([
                    'name' => $countryData['name']['common'],
                ]);
            }
        }

        return 'Países importados con éxito';
    } */
}
