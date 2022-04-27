<?php


namespace App\Http\Controllers\API;


use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
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

        if ($selection)
        {
            return response()->json($selection);
        }
        else
        {
            return response()->json(array("success" => false));
        }

    }
}
