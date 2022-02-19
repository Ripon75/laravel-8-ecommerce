<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Auth;

class UserController extends Controller
{
     public function index()
    {
        $orders = Order::where('user_id', Auth::id())->get();
        return view('frontend.order.index', [
            'orders' =>$orders
        ]);
    }

    public function viewOrder($id)
    {
        $order = Order::where('id', $id)->where('user_id', Auth::id())->first();
        // return $order->orderItems->product->name;

        return view('frontend.order.view', [
            'order' => $order
        ]);
    }
}
