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

        $this->checkTooManyFailedAttempts();

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials))
        {
            RateLimiter::clear($this->throttleKey());

            $success = true;
            $message = 'Úspešne prihlásený.';
        }
        else
        {
            RateLimiter::hit($this->throttleKey(), $seconds = 3600);

            $success = false;
            $message = 'Neautorizovaný prístup.';
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,

        ];

        return response()->json($response);
    }

    public function throttleKey()
    {
        return Str::lower(request('email')) . '|' . request()->ip();
    }

    public function checkTooManyFailedAttempts()
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 3))
        {
            return;
        }

        throw new Exception('IP address banned. Too many login attempts.');
    }
}
