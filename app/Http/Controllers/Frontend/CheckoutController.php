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
            // Check product quantity
            $product = Product::where('id', $cart->product_id)
                              ->where('quantity', '>=', $cart->product_qty)->first();
            if (!$product) {
                $removeItem = Cart::where('user_id', Auth::id())
                                  ->where('product_id', $cart->product_id)->first();
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
        $order = new Order();

        $order->user_id      = Auth::id();
        $order->f_name       = $request->input('f_name');
        $order->l_name       = $request->input('l_name');
        $order->email        = $request->input('email');
        $order->phone_num    = $request->input('phone_num');
        $order->address_1    = $request->input('address_1');
        $order->address_2    = $request->input('address_2');
        $order->city         = $request->input('city');
        $order->state        = $request->input('state');
        $order->country      = $request->input('country');
        $order->pin_code     = $request->input('pin_code');
        $order->payment_mode = $request->input('payment_mode');
        $order->payment_id   = $request->input('payment_id');
        // to calculate total price
        $total = 0;
        $carts = Cart::where('user_id', Auth::id())->get();

        foreach ($carts as $cart) {
            $total += $total + $cart->product->selling_price * $cart->product_qty;
        }

        $order->total_price = $total;
        $order->traking_no  = 'JR'.rand(1111, 9999);
        $order->save();

        $carts = Cart::where('user_id', Auth::id())->get();

        foreach ($carts as $cart) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $cart->product_id,
                'quantity'   => $cart->product_qty,
                'price'      => ($cart->product->selling_price) ?? 0
            ]);
            $product = Product::where('id', $cart->product_id)->first();
            $product->quantity = $product->quantity - $cart->product_qty;
            $product->update();
        }

        if(Auth::user()->address_1 == NULL) {
            $user = User::where('id', Auth::id())->first();

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

        $cartItems = Cart::where('user_id', Auth::id())->get();
        Cart::destroy($cartItems);

        if ($request->input('payment_mode') == 'Paid by Razorpay') {
            return response()->json(['status' => 'Order Place Successfully']);
        }
        return redirect('/')->with('status', 'Order Place Successfully');
    }

    public function razorpayCheck(Request $request)
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();

        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item->product->selling_price*$item->product_qty;
        }

        $firstName   = $request->input('first_name');
        $lastName    = $request->input('last_name');
        $email       = $request->input('email');
        $phoneNumber = $request->input('phone_number');
        $address1    = $request->input('address_1');
        $city        = $request->input('city');
        $state       = $request->input('state');
        $country     = $request->input('country');
        $pinCode     = $request->input('pin_code');

        return response()->json([
            'first_name'   => $firstName,
            'last_name'    => $lastName,
            'email'        => $email,
            'phone_num'    => $phoneNumber,
            'address_1'    => $address1,
            'city'         => $city,
            'state'        => $state,
            'country'      => $country,
            'pin_code'     => $pinCode,
            'total_price'  => $totalPrice
        ]);
    }
}
