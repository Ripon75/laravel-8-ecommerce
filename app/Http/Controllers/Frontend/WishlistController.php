<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;
use Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::where('user_id', Auth::id())->get();

        return view('frontend.wishlist', [
            'wishlists' => $wishlists
        ]);
    }

    public function add(Request $request)
    {
        $productId = $request->input('product_id');

        $product = Product::find($productId);

        if ($product) {
            $wishlist = Wishlist::where('product_id', $productId)
                        ->where('user_id', Auth::id())->first();
            if ($wishlist) {
                return response()->json(['status' => 'Product already added to wishlist']);
            }
            $wishlistObj             = new Wishlist();
            $wishlistObj->user_id    = Auth::id();
            $wishlistObj->product_id = $productId;
            $wishlistObj->save();

            return response()->json(['status' => 'Product added to wishlist']);
        }else {
            return response()->json(['status' => 'Product does not exist']);
        }
    }

    public function remove($id)
    {
        $wishlist = Wishlist::find($id);
        if ($wishlist) {
            $wishlist->delete();

            return back();
        }
    }
}
