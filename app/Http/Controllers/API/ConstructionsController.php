<?php


namespace App\Http\Controllers\API;


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

        $selection = DB::select("SELECT id, title, created_at, updated_at FROM constructions ORDER BY created_at");

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
}
