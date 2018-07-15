<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use App\OrderDetail;

class Order extends Model
{
    public function AddDetails($details) {

        $isValid = true;

        foreach ($details as $key => $row) {
            $orderDetail = new OrderDetail();

            if (!$orderDetail->SaveDetail($this->id, $row)) {
                $isValid = false;
            }
        }

        return $isValid;
    }

    public static function IsValid($id) {
        $isValid = true;

        $order = Order::find($id);

        if ($order == null) { $isValid = false; }
        else {
            $orderDetails = OrderDetail::where('OrderID', $id)->get();
            foreach ($orderDetails as $orderDetail) {
                if (!$orderDetail->IsValid()) {
                    $isValid = false;
                    break;
                }
            }
        }

        return $isValid;
    }
}
