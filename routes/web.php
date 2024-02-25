<?php

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

Route::post('/auth/login', function (Request $request) {
    // Validator array containing expected values
    $validData = [
        'email' => 'opqclick@gmail.com',
        'password' => '123456',
        '2fa-code' => '123456',
        'client-id' => '1000001'
    ];

    // Custom error messages
    $messages = [
        'in' => 'false'
    ];

    // Validate request parameters against expected values
    $validator = Validator::make($request->all(), [
        'LoginForm.email' => 'required|email|in:' . $validData['email'],
        'LoginForm.password' => 'required|string|in:' . $validData['password'],
        '2fa-code' => 'required|digits:6|numeric|in:' . $validData['2fa-code'],
        'client-id' => 'required|in:' . $validData['client-id']
    ], $messages);

    // If validation fails, return error response
    if ($validator->fails()) {
        return response()->json(['success' => false], 422);
    }

    // Process successful login logic here

    // Return success response
    return response()->json([
        'identity' => [
            'id' => "1033",
            'email' => $validData['email'],
            'id_number' => Str::random(10),
            'geslacht' => 'Man',
            'naam' => 'EDO',
            'voornaam' => 'Kevin Angelo',
            'geboorte_datum' => "1997-03-16",
            'burgelijke_staat' => 'paramaribo',
            'nationaliteit' => 'SURINAMSE',
            'adres' => 'Munder',
            'ressort' => 'Munder',
            'district' => 'Paramaribo',
            'status' => 'actief'
        ],
        'token' => Str::random(256)

    ], 200);
});
