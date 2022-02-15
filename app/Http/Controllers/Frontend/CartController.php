<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Auth;

class CartController extends Controller
{
    public function addProduct(Request $request)
    {
        $productId = $request->input('product_id');
        $productQty = $request->input('product_qty');
        if(Auth::check())
        {
            $productCheck = Product::where('id', $productId)->first();
            if($productCheck)
            {
                if(Cart::where('product_id', $productId)->where('user_id', Auth::id())->exists())
                {
                    return response()->json(['status'=> $productCheck->name.' Already Added to Cart']);
                }
                else
                {
                    $cart              = new Cart();
                    $cart->product_id  = $productId;
                    $cart->user_id     = Auth::id();
                    $cart->product_qty = $productQty;
                    $cart->save();
                    return response()->json(['status'=> $productCheck->name.' Added to Cart']);
                }
            }
        }
        else
        {
            return response()->json(['status'=> 'Loging to continue']);
        }
    }

    // cart view
    public function cartView()
    {
        $cartItem = Cart::where('user_id', Auth::id())->get();

        return view('frontend.cart', [
            'cartItem' => $cartItem
        ]);
    }

    // cart update
     public function UpdateCart(Request $request)
    {
        $productId = $request->input('product_id');
        $productQty = $request->input('product_qty');
        if(Auth::check()) {
            if(Cart::where('product_id', $productId)->where('user_id', Auth::id())->exists()) {
                $cart = Cart::where('product_id', $productId)->where('user_id', Auth::id())->first();
                $cart->product_qty = $productQty;
                $cart->update();

                return response()->json(['status'=> 'Product Updated']);
            }
        }else {
            return response()->json(['status'=> 'Please Loging to Continue']);
        }
    }

    // delete cart item
    public function deleteProduct(Request $request)
    {
        if(Auth::check()) {
           $productId = $request->input('product_id');
            if(Cart::where('product_id', $productId)->where('user_id', Auth::id())->exists()) {
                $cartItem = Cart::where('product_id', $productId)
                                ->where('user_id', Auth::id())->first();
                $cartItem->delete();

                return response()->json(['status'=> 'Product Deleted Successfully']);
            }

        } else {
            return response()->json(['status'=> 'Please Login to Continue']);
        }
    }
}
