<?php

namespace App\Http\Controllers\API;


use App\Models\Material;
use App\Models\MaterialOnConstruction;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrdersController
{
    public function createOrder(Request $request): JsonResponse
    {
        try
        {
        $order = Order::create($request->all());
        $order->save();

            $success = true;
            $message = 'Používateľ bol úspešne vytvorený.';
        }
        catch(\Exception $defEx)
        {
            $success = false;
            $message = $defEx->getMessage();
        }

        $response = [
            'success' => $success,
            'message' => $message,
        ];

        return response()->json($response);
    }

    public function getOrders($constructionId): JsonResponse
    {
        $orders = Order::with('users')->with('statuses')->with('materials')->with('constructions')->whereIn('construction_id', [$constructionId])->get();

        if($orders)
        {
            return Response()->json($orders);
        }
        else
        {
            return Response()->json(array("success" => false));
        }
    }

    public function changeStatus(Request $Request,$id): JsonResponse
    {

        try
        {
        $order = Order::find($id);
        $order->user_id=$Request->driver_id;



        if($order->status_id<=3){
            $order->status_id = $order->status_id+1;
            $order->save();
        }

        if($order->status_id===4){
                $oldCount = MaterialOnConstruction::select('stock_count')->whereIn('construction_id',[$Request->construction_id])->whereIn('material_id',[$Request->material_id])->first()->stock_count;
                $material = MaterialOnConstruction::whereIn('construction_id',[$Request->construction_id])->whereIn('material_id',[$Request->material_id])->update(['stock_count' => $oldCount+$Request->amount]);
                //ked je objednávka v stave doručená materialy sa pridaju na stavbu
                $order->delete();

        }



        $success = true;
        $message = '';
    }
        catch(\Exception $defEx)
        {
            $success = false;
            $message = $defEx->getMessage();
        }

        $response = [
            'success' => $success,
            'message' => $message,
        ];

        return response()->json($response);
    }



}
