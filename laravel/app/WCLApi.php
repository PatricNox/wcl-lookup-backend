<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class WCLApi extends Model
{
    public static function lookupThroughParses(array $request)
    {
        $parsesEndpoint = env('APP_WCL_API_V1_URL') . '/parses/character';
        $url = "$parsesEndpoint/{$request['character']}/{$request['realm']}/{$request['region']}";

        try {
            $response = Http::get($url, [
                'api_key' => env('APP_WCL_API_KEY'),
                'includeCombatantInfo' => true,
            ]);
        } catch (\Exception $e) {
            logger($e);
            abort($e->getStatusCode(), $e->getMessage());
        }

        return $response;
    }
}
