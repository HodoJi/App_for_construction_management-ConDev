<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
     * Checks if User exist function
     *
     * @return bool
     * @var int $user_id
     *
     */
    public function doesUserExist(int $user_id): bool
    {
        try
        {
            return ((User::where('id', '=', $user_id)->first()) != null);
        }
        catch (\Exception $ex)
        {
            return false;
        }
    }

    /**
     * Checks if User's E-mail exist function
     *
     * @return bool
     * @var string $user_email
     *
     */
    public function doesUserEmailExist(string $user_email): bool
    {
        try
        {
            return ((User::where('email', '=', $user_email)->first()) != null);
        }
        catch (\Exception $ex)
        {
            return false;
        }
    }

    /**
     * Checks if User's Personal Key ID exist function
     *
     * @return bool
     * @var int $user_personalKey_id
     *
     */
    public function doesPersonalKeyIdExist(int $user_personalKey_id): bool
    {
        try
        {
            return ((User::where('personalId', '=', $user_personalKey_id)->first()) != null);
        }
        catch (\Exception $ex)
        {
            return false;
        }
    }

    /**
     * User removal function
     *
     * @return JsonResponse
     * @var Integer $user_id
     *
     */
    public function removeUser($user_id): JsonResponse
    {
        try
        {
            if (($userToRemove = User::where('id', '=', $user_id)->where('id', '!=', 1)->first()) == null)
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

    /**
     * @param int $construction_id
     * @return JsonResponse
     */
    public function getWorkersOnConstruction(int $construction_id): JsonResponse
    {
        $workers = DB::select("SELECT * FROM users WHERE construction_id = {$construction_id}");

        if ($workers)
        {
            return Response()->json($workers);
        }
        else
        {
            return Response()->json(array("success" => false));
        }

    }

    /**
     * Get drivers
     * @return JsonResponse
     */
    public function getDrivers(): JsonResponse
    {
        $drivers = DB::select("SELECT * FROM users WHERE role_id = 4");

        if ($drivers)
        {
            return Response()->json($drivers);
        }
        else
        {
            return Response()->json(array("success" => false));
        }

    }

    /**
     * Najdi zamestnanca podla vyhladavania a prirad k stavenisku
     * @param Request $request
     * @return JsonResponse
     */
    public function findUsersForConstruction(Request $request): JsonResponse
    {
        $authUserId = DB::table('users')
            ->where('id', '=', Auth::id())->value("role_id");
        $searchedString = trim($request->employeeName);
        if ($authUserId <= 2)
        {
            $foundUsers = DB::select("SELECT users.id, users.name, users.email, constructions.id AS cID, constructions.title  FROM users LEFT JOIN constructions ON constructions.id=users.construction_id WHERE users.name LIKE '%$searchedString%'  AND users.role_id > 1");
            if ($foundUsers)
            {
                return Response()->json(["success" => true, "users" => $foundUsers]);
            }
            else
            {
                return Response()->json(array("success" => false, "message" => "Nenašli sa žiadni zamestnanci s takýmto menom: {$searchedString}"));
            }
        }
        else
        {
            return Response()->json(array("success" => false, "message" => "Nemáš dostatočné práva na vykonanie tejto akcie."));
        }
    }

    public function assignUserToConstruction(Request $request): JsonResponse
    {
        $authUserId = DB::table('users')
            ->where('id', '=', Auth::id())->value("role_id");
        $userIdToAssign = trim($request->id);
        $constrIdToAssignTo = trim($request->constrId);
        if ($authUserId <= 2)
        {
            $alreadyAssignedToCurrentConstr = DB::select("SELECT id, construction_id FROM users WHERE id = {$userIdToAssign} AND construction_id = {$constrIdToAssignTo}");
            if ($alreadyAssignedToCurrentConstr)
            {
                return Response()->json(["success" => false, "message" => "Zamestnanec už je priradený k tomuto stavenisku!"]);
            }
            else
            {
                $constr = User::find($userIdToAssign);
                $constr->construction_id = $constrIdToAssignTo;
                $constr->update();
                return Response()->json(["success" => true, "message" => "Zamestnanec úspešne priradený k stavenisku."]);
            }
        }
        else
        {
            return Response()->json(array("success" => false, "message" => "Nemáš dostatočné práva na vykonanie tejto akcie."));
        }
    }

}
