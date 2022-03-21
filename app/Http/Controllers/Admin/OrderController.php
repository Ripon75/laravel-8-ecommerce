<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('status', 0)->get();
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

    public function updateOrder(Request $request, $id)
    {
        $status = $request->input('order_status');

        $order = Order::find($id);

        $order->status = $status;
        $order->update();

        return redirect('orders')->with('statud', 'Order update successfully');
    }

    public function orderHistory()
    {
        $orders = Order::where('status', 1)->get();

        return view('admin.order.history', [
            'orders' => $orders
        ]);
    }
}
