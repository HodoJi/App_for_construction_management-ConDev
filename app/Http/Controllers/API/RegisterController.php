<?php

namespace App\Http\Controllers\API;

use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

/**
 * Class RegisterController
 * @package App\Http\Controllers\API
 */
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
    public function registerUser(Request $request): JsonResponse
    {
        try
        {
            $user = new User();
            $user->name = $request->rq_user_name;
            $user->email = $request->rq_user_email;
            $user->password = bcrypt(0); /* < default password / unused → 0 > */
            $user->role_id = $request->rq_user_role_id;
            $user->personalId = null;

            $user_personalKey_prefix = null;

            switch($user->role_id)
            {
                case 1:
                    $user_personalKey_prefix = 111;
                    break;
                case 2:
                    $user_personalKey_prefix = 222;
                    break;
                case 3:
                    $user_personalKey_prefix = 333;
                    break;
                case 4:
                    $user_personalKey_prefix = 444;
                    break;
            }

            $UserController = new UsersController();
            $RandomGenerator = new RandomGenerator();

            while(true)
            {
                if (($UserController->doesPersonalKeyIdExist($gotNewPersonalIdKey = intval(strval($user_personalKey_prefix) . $RandomGenerator->generateRandomStringOfLength(6, "0123456789")))) == false)
                {
                    $user->personalId = $gotNewPersonalIdKey;
                    break;
                }
            }

            if (($user->personalId) == null || strlen(strval($user->personalId)) < 9)
            {
                throw new ErrorException("Cannot create user with such personalId key! Check RegisterController API!");
            }

            $user->save();

            $success = true;
            $message = 'Používateľ bol úspešne vytvorený.';
        }
        catch(\Exception $defEx)
        {
            $success = false;
            $message = $defEx->getMessage();
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,
        ];

        return response()->json($response);
    }

}
