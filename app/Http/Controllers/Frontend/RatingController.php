<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Order;
use Auth;

class RatingController extends Controller
{
    public function addRating(Request $request)
    {
        $starsRated  = $request->input('product_rating');
        $productId   = $request->input('product_id');

        $productCheck = Product::where('id', $productId)->first();
        if ($productCheck) {
            $varifiedPurchase = Order::where('orders.user_id', Auth::id())
            ->join('order_items', 'orders.id', 'order_items.order_id')
            ->where('order_items.product_id', $productId)->get();

            if ($varifiedPurchase->count() > 0) {
                $rating = Rating::where('user_id', Auth::id())
                ->where('product_id', $productId)->first();
                if ($rating) {
                    $rating->stars_rated = $starsRated;
                    $rating->update();
                }else {
                    $ratingObj              = new Rating();
                    $ratingObj->user_id     = Auth::id();
                    $ratingObj->product_id  = $productId;
                    $ratingObj->stars_rated = $starsRated;
                    $ratingObj->save();
                }
                return redirect()->back()->with('status', 'Think for rating this product');
            }else {
                return redirect()->back()->with('status', 'You can not rate product without purchase');
            }
        }else {
            return redirect()->back()->with('status', 'The link you followed was broken');
        }
    }
}