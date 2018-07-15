<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Order;
use App\OrderDetail;
use Illuminate\Support\Facades\Log;

Route::get('/', function() {
    return view('index');
});

Route::get('/orders', function () {
    $orders = Order::all();

    return view('orders.index', compact('orders'));
});

Route::get('/orders/{id}', function ($id) {
    $orderDetails = OrderDetail::where('OrderID', $id)->get();
    $order = Order::find($id);
    $isValidOrder = Order::IsValid($id);

    return view('orders.show', compact('orderDetails', 'id', 'order', 'isValidOrder'));
});

Route::get('/orders/detail/{id}', function ($id) {
    $orderDetail = OrderDetail::find($id);
    
    $orderId = $orderDetail->OrderID;

    return view('orders.detail', compact('orderDetail', 'orderId', 'id'));
});

Route::post('/orders/detail/update', array('uses' => 'OrderDetailController@UpdateOrderDetail'));
Route::post('/import_parse', 'ImportController@parseImport')->name('import_parse');