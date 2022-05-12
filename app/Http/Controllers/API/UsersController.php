<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Class UsersController
 * @package App\Http\Controllers\API
 */
class UsersController extends Controller
{
    private $apiToken;

    public function __construct()
    {
        //: Create Token.
        $this->apiToken = uniqid(base64_encode(Str::random(40)));
    }

    /**
     * Users List API
     *
     * @return JsonResponse
     */
    public function getUsersList(): JsonResponse
    {
        $users = DB::select("SELECT * FROM users");

        if ($users)
        {
            return response()->json($users);
        }
        else
        {
            return response()->json(array("success" => false));
        }
    }

    /**
     * Checks if user exist function
     *
     * @var Integer $user_id
     *
     * @return bool
     */
    public function doesUserExist($user_id): bool
    {
        try
        {
            return ( (User::where('id', '=', $user_id)->first()) != null );
        }
        catch (\Exception $ex)
        {
            return false;
        }
    }

    /**
     * User removal function
     *
     * @var Integer $user_id
     *
     * @return JsonResponse
     */
    public function removeUser($user_id): JsonResponse
    {
        try
        {
            if( ( $userToRemove = User::where('id', '=', $user_id)->where('id', '!=', 1)->first() ) == null )
            {
                $success = false;
                $message = "Daný používateľ neexistuje alebo ho nie je možné odstrániť!";
            }
            else
            {
                $userToRemove->delete();
                $success = true;
                $message = "Používateľ {$userToRemove->name} bol odstránený.";
            }
        }
        catch (\Exception $ex)
        {
            $success = false;
            $message = "Chyba!: {$ex->getMessage()}";
        }

        $result = [
            "success" => $success,
            "message" => $message
        ];

        return response()->json($result);
    }

    public function getWorkersOnConstruction(int $construction_id): JsonResponse
    {
        $workers = DB::select("SELECT *  FROM users " .
            "WHERE construction_id = {$construction_id} AND role_id = '3'"
        );

        if($workers)
        {
            return Response()->json($workers);
        }
        else
        {
            return Response()->json(array("success" => false));
        }

    }

    public function getDrivers(): JsonResponse
    {
        $drivers = DB::select("SELECT *  FROM users WHERE role_id = '4'");

        if($drivers)
        {
            return Response()->json($drivers);
        }
        else
        {
            return Response()->json(array("success" => false));
        }

    }


}
