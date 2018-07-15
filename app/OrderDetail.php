<?php

namespace App;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    public static $required = array('Name', 'QTY', 'Thickness', 'Material');

    protected $fillable = ['Name', 'Quantity', 'Thickness', 'Material', 'Bending', 'Threading', 'OrderID'];

    

    public function SaveDetail($orderID, $data) {

        $isValid = true;

        foreach($data as $col => $value) {
            if (!$this->SetAttribute($col, $value)) {
                $isValid = false;
            }
        }

        $this->SetAttribute('OrderID', $orderID);

        $this->save();

        return $isValid;
    }

    public function SetAttribute($key, $value) {
        if ((is_null($value) || $value == '') && in_array($key, OrderDetail::$required)) {
            Log::warning($key.' is null.');
            return false;
        }

        $key = $key == 'QTY' ? 'Quantity' : $key;

        if ($key == 'Bending' || $key == 'Threading') {
            $value = $value == 'Yes' ? 1 : 0;
        }

        $this->attributes[$key] = $value;

        return true;
    }

    public function IsValid() {
        $isValid = !(
            $this->Name == '' || 
            $this->Quantity == 0 || $this->Quantity == '' ||
            $this->Thickness == 0 || $this->Thickness == '' ||
            $this->Material == ''
        );

        return $isValid;
    }
}
