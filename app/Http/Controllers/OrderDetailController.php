<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\OrderDetail;

class OrderDetailController extends Controller
{
    public function UpdateOrderDetail(Request $request) {
        
        $orderDetail = OrderDetail::find($request->id);

        if ($orderDetail === null) {
            return;
        }

        Log::info($request->Thickness);

        $orderDetail->Name = $request->Name;
        $orderDetail->Quantity = $request->Quantity;
        $orderDetail->Thickness = $request->Thickness;
        $orderDetail->Material = $request->Material;
        $orderDetail->Bending = $request->Bending == 1 ? true : false;
        $orderDetail->Threading = $request->Threading == 1 ? true : false;

        $orderDetail->save();

        return redirect('/orders/'.$request->OrderID);
    }
}