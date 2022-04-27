<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\RateLimiter;

class LoginController extends Controller
{
    public function loginUser(Request $request)
    {

        $credentials = [
            'personalId' => $request->personalId,
            'password' => "0"
        ];

        if (Auth::attempt($credentials))
        {
            $success = true;
            $message = 'Úspešne prihlásený.';
        }
        else
        {
            $success = false;
            $message = 'Neautorizovaný prístup.';
        }

        // Response
        $response = [
            'success' => $success,
            'message' => $message,

        ];

        return response()->json($response);
    }

}
