<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
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
}
