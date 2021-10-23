<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\WCLApi;
use Illuminate\Http\Request;

class WCLController extends Controller
{
    /**
     * Lookup character through parses.
     *
     * @return Illuminate\Http\Resources\Json\ResourceCollection
     **/
    protected function lookupThroughParses(Request $request)
    {
        $request->validate([
            'character' => 'required|string',
            'realm' => 'required|string',
            'region' => 'required|string',
        ]);

        $result = WCLApi::lookupThroughParses($request->all());

        // If we found parses for a character, retrieve the latest parse by startTime.
        $latestParse = null;
        if (!empty($result->json())) {
            // Initilize startTime paramter to 0 if its null to prevent broken comparisation.
            $latestParse = array_reduce($result->json(), function ($previous, $next) {
                return $previous['startTime'] > $next['startTime'] ? $previous : $next;
            }, ['startTime' => 0]);
        }

        return response()->json($latestParse, 200);
    }
}
