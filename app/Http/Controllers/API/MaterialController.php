<?php


namespace App\Http\Controllers\API;


use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Class MaterialController - All functions connected with "material", "material_on_construction", "material_counter_type" tables.
 * @package App\Http\Controllers\API
 */
class MaterialController
{

    public function __construct()
    {
        //: Create Token.
        $this->apiToken = uniqid(base64_encode(Str::random(40)));
    }

    /**
     * @param int $construction_id
     * @return JsonResponse
     */
    public function getMaterialOnConstruction(int $construction_id): JsonResponse
    {
        $items = DB::select("SELECT moc.construction_id as moc_construction_id, moc.material_id as moc_material_id, moc.stock_count as moc_stock_count, material.material_title as material_title, mct.material_counter_type as mct_material_counter_type FROM material_on_construction moc " .
            "INNER JOIN material ON material.material_id = moc.material_id " .
            "INNER JOIN material_counter_type mct ON mct.material_counter_type_id = material.material_counter_type_id " .
            "GROUP BY moc_construction_id, moc_material_id, moc_stock_count, material_title, mct_material_counter_type " .
            "HAVING moc_construction_id = {$construction_id}"
        );

        if($items)
        {
            return Response()->json($items);
        }
        else
        {
            return Response()->json(array("success" => false));
        }

    }

    /**
     * @return JsonResponse
     */
    public function getMaterialList(): JsonResponse
    {
        $items = DB::select("SELECT m.material_id as material_id, m.material_title as material_title, mct.material_counter_type as mct_material_counter_type FROM material m " .
            "INNER JOIN material_counter_type mct ON m.material_counter_type_id = mct.material_counter_type_id " .
            "GROUP BY material_id, material_title, mct_material_counter_type"
        );

        if($items)
        {
            return Response()->json($items);
        }
        else
        {
            return Response()->json(array("success" => false));
        }
    }

    /**
     * @param int $material_counter_type_id
     * @return JsonResponse
     */
    public function getMaterialCounterTypeById(int $material_counter_type_id): JsonResponse
    {
        $items = DB::select("SELECT mct.material_counter_type as mct_material_counter_type FROM material_counter_type mct " .
            "WHERE material_counter_type_id = {$material_counter_type_id}"
        );

        if($items)
        {
            return Response()->json($items);
        }
        else
        {
            return Response()->json(array("success" => false));
        }
    }

}
