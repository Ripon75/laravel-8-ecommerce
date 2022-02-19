<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $oldCarts = Cart::where('user_id', Auth::id())->get();
        foreach($oldCarts as $cart) {
            if(!Product::where('id', $cart->product_id)->where('quantity', '>=', $cart->product_qty)->exists()) {
                $removeItem = Cart::where('user_id', Auth::id())->where('product_id', $cart->product_id)->first();
                $removeItem->delete();
            }
        }
        $carts = Cart::where('user_id', Auth::id())->get();

        return view('frontend.product.checkout', [
            'carts' => $carts
        ]);
    }

    public function placeOrder(Request $request)
    {
        $order             = new Order();
        $order->user_id    = Auth::id();
        $order->f_name     = $request->input('f_name');
        $order->l_name     = $request->input('l_name');
        $order->email      = $request->input('email');
        $order->phone_num  = $request->input('phone_num');
        $order->address_1  = $request->input('address_1');
        $order->address_2  = $request->input('address_2');
        $order->city       = $request->input('city');
        $order->state      = $request->input('state');
        $order->country    = $request->input('country');
        $order->pin_code   = $request->input('pin_code');
        $order->traking_no = 'JR'.rand(1111, 9999);
        $order->save();

        $carts = Cart::where('user_id', Auth::id())->get();
        foreach ($carts as $cart) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $cart->product_id,
                'quantity'   => $cart->product_qty,
                'price'      => $cart->product->selling_price
            ]);
            $product = Product::where('id', $cart->product_id)->first();
            $product->quantity = $product->quantity - $cart->product_qty;
            $product->update();
        }

        if(Auth::user()->address_1 == NULL) {
            $user            = User::where('id', Auth::id())->first();
            $user->name      = $request->input('f_name');
            $user->l_name    = $request->input('l_name');
            $user->phone_num = $request->input('phone_num');
            $user->address_1 = $request->input('address_1');
            $user->address_2 = $request->input('address_2');
            $user->city      = $request->input('city');
            $user->state     = $request->input('state');
            $user->country   = $request->input('country');
            $user->pin_code  = $request->input('pin_code');
            $user->update();
        }

        $carts = Cart::where('user_id', Auth::id())->get();
        Cart::destroy($carts);
        return redirect('/')->with('status', 'Order Place Successfully');
    }
}
