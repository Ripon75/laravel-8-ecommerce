<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::get();
        return view('admin.order.index', [
            'orders' => $orders
        ]);
    }

    // order single  view
    public function show($id)
    {
        $order = Order::find($id);

        return view('admin.order.view', [
            'order' => $order
        ]);
    }
}
