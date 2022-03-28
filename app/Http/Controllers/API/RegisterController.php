<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    private $apiToken;

    public function __construct()
    {
        //: Create Token.
        $this->apiToken = uniqid(base64_encode(Str::random(40)));
    }
    /**
     * Register API
     *
     * @param Request $request
     * @return JsonResponse
     */

    public function registerUser(Request $request)
    {
        try
        {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);

            //$user->role_id = (($request->role_id) ? ($request->role_id) : 1); // MAY BE ADDED IN FUTURE.

            $user->save();

            $success = true;
            $message = 'Úspešne zaregistrovaný.';
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
