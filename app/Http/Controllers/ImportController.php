<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Validator;
use App\Order;
use App\OrderDetail;
use App\Http\Requests\CsvImportRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ImportController extends Controller
{

    public function getImport()
    {
        return view('import');
    }

    public function parseImport(CsvImportRequest $request)
    {
        $path = $request->file('csv_file')->getRealPath();
        $data = $this->csvToArray($path);

        if (count($data) <= 0) {
            return redirect()->back();
        }

        $order = new Order();
        $order->save(); // first save to get id
        $order->AddDetails($data);
        $order->save();

        $id = $order->id;

        return redirect('/orders/'.$id);
    }

    function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }
}
