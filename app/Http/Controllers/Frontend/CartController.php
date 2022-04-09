<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Auth;

class CartController extends Controller
{
    public function addProductCart(Request $request)
    {
        $productId  = $request->input('product_id');
        $productQty = $request->input('product_qty');
        if(Auth::check()) {
            $productCheck = Product::where('id', $productId)->first();
            if($productCheck) {
                $card = Cart::where('product_id', $productId)
                                   ->where('user_id', Auth::id())->first();
                if($card) {
                    return response()->json(['status'=> $productCheck->name.' Already Added to Cart']);
                }else{
                    $cart              = new Cart();
                    $cart->product_id  = $productId;
                    $cart->user_id     = Auth::id();
                    $cart->product_qty = $productQty;
                    $cart->save();
                    return response()->json(['status'=> $productCheck->name.' Added to Cart']);
                }
            }
        } else{
            return response()->json(['status'=> 'Loging to continue']);
        }
    }

    // cart view
    public function cartView()
    {
        if(Auth::check()) {
            $cartItem = Cart::where('user_id', Auth::id())->get();
        }else {
            return response()->json(['status', 'Please loging to show cart']);
        }

        return view('frontend.cart', [
            'cartItem' => $cartItem
        ]);
    }

    // cart update
     public function UpdateProductCart(Request $request)
    {
        $productId  = $request->input('product_id');
        $productQty = $request->input('product_qty');
        if(Auth::check()) {
            $cart = Cart::where('product_id', $productId)->where('user_id', Auth::id())->first();
            if($cart) {
                $cart->product_qty = $productQty;
                $cart->update();

                return response()->json(['status'=> 'Product updated successfully']);
            }
        }else {
            return response()->json(['status'=> 'Please Loging to Continue']);
        }
    }

    // delete cart item
    public function deleteProductCart(Request $request, $id)
    {
        if(Auth::check()) {
        //    $productId = $request->input('product_id');
           $cartItem = Cart::where('product_id', $id)
                           ->where('user_id', Auth::id())->first();
            if($cartItem) {
                $cartItem->delete();

                return back()->with('status', 'Product Deleted Successfully');
            }
        } else {
            return back()->with('status', 'Please Login to Continue');
        }
    }

    public function cartCount()
    {
        $cartCount = Cart::where('user_id', Auth::id())->count();

        return response()->json(['count' => $cartCount]);
    }
}
