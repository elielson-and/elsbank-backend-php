<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    protected $api = 'https://elsbank-authorizer.elielson.net/api';
    public function transfer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payer' => 'required',
            'payee' => 'required',
            'value' => 'required|gte:0.01'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'failed to process, missing or invalid parameter(s).'], 400);
        }

        try{
            // -- Request to the authorizer
            $response = Http::post($this->api.'/transfer', [
                'payer' => $request->payer,
                'payee' => $request->payee,
                'value' => $request->value
            ]);

            return response()->json($response->json(),$response->status());
        } catch (\Throwable $th) {
            return response()->json(['message' => 'please try again later.'],500);
        }



    }
}
