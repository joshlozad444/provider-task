<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;
use Exception;

class ProviderController extends Controller
{
    public function getProviders()
    {
        return view('app')->with(['providers' => Provider::orderBy('provider_id', 'desc')->get()->toArray()]);
    }

    public function addProvider(Request $request) : string
    {
        try {
            return Provider::create([
                'provider_name' => $request->provider_name,
                'provider_url' => $request->provider_url
            ]);
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function updateProvider(Request $request, int $provider_id) : string
    {
        unset($request['_token']);
        try {
            return Provider::where('provider_id', $provider_id)
                ->update(array_filter($request->all()));
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function deleteProvider(int $provider_id) : string
    {
        try {
            return Provider::destroy($provider_id);
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }
}
