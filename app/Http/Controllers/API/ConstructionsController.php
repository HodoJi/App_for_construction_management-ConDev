<?php


namespace App\Http\Controllers\API;


use App\Models\Construction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ConstructionsController
{
    public function __construct()
    {
        //: Create Token.
        $this->apiToken = uniqid(base64_encode(Str::random(40)));
    }

    public function getList(): JsonResponse
    {

        //$selection = DB::select("SELECT id, title, created_at, updated_at FROM constructions ORDER BY created_at");
        $selection = Construction::withCount('users')->get();

        if ($selection) {
            return response()->json($selection);
        } else {
            return response()->json(array("success" => false));
        }
    }

    public function getConstructionDetailsPage($constructionId): JsonResponse
    {
        if (Auth::check()) {
            $selection = DB::select("SELECT id, title FROM constructions WHERE id = " . $constructionId);
            if ($selection) {
                return response()->json($selection);
            } else {
                return response()->json(array("success" => false, "message" => "Stavenisko neexistuje!"));
            }
        } else {
            return response()->json(array("success" => false));
        }
    }

    public function getConstructionCount(): JsonResponse
    {
        $authUserId = DB::table('users')
            ->where('id', '=', Auth::id())->value("role_id");
        if ($authUserId <= 2) {
            $numberOfConstructions = DB::select(""); //TODO: SQL QUERY NA POCET STAVENISK
            if($numberOfConstructions){
                return Response()->json($numberOfConstructions);
            }  else {
                return Response()->json(["success" => false, "message" => "Neexistuje zatiaľ žiadne stavenisko."]);
            }
        } else {
            return Response()->json(array("success" => false, "message" => "Nemáš dostatočné práva na vykonanie tejto akcie."));
        }
    }

    public function addNewConstruction(Request $request): JsonResponse
    {
        $stavenisko = trim($request->constrName);
        $authUserId = DB::table('users')
            ->where('id', '=', Auth::id())->value("role_id");
        if ($authUserId <= 2) {
            $numberOfConstructions = DB::select(""); //TODO: SQL QUERY NA POCET STAVENISK
            if($numberOfConstructions){
                return Response()->json(["success" => true, "message" => "Stavenisko ". $stavenisko." úspešne pridané!"]);
            }  else {
                return Response()->json(["success" => false, "message" => "Nastala chyba!"]);
            }
        } else {
            return Response()->json(array("success" => false, "message" => "Nemáš dostatočné práva na vykonanie tejto akcie."));
        }
    }
}
