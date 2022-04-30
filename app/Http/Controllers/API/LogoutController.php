<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;

/**
 * Class LogoutController
 * @package App\Http\Controllers\API
 */
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
        catch (QueryException $ex)
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
