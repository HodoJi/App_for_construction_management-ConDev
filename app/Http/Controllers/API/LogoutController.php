<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    public function logout()
    {
        try
        {
            Session::flush();
            $success = true;
            $message = 'Úspešne odhlásený.';
        }
        catch (\Illuminate\Database\QueryException $ex)
        {
            $success = false;
            $message = $ex->getMessage();
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,
        ];

        return response()->json($response);
    }

}
