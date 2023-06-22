<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function getProviders(Request $oRequest)
    {
        if (!$oRequest->offset) {
            return view('app')->with(
                Provider::orderBy('provider_id')
                    ->take(10)
                    ->get()
                    ->toArray()
            );
        }
        return Provider::orderBy('provider_id')
                ->take(10)
                ->get()
                ->toArray();
    }

    public function addProvider()
    {

    }

    public function updateProvider()
    {

    }

    public function deleteProvider()
    {
        
    }
}
