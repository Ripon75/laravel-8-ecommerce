<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Review;
use Auth;

class ReviewController extends Controller
{
    public function addReview($product_slug)
    {
        $productCheck = Product::where('slug', $product_slug)->first();
        if ($productCheck) {
            $productId = $productCheck->id;
            $review = Review::where('user_id', Auth::id())->where('product_id', $productId)->first();
            if ($review) {
                return view('frontend.review.edit', [
                    'review' => $review
                ]);
            }else {
                $purchaseCheck = Order::where('orders.user_id', Auth::id())
                ->join('order_items', 'orders.id', 'order_items.order_id')
                ->where('order_items.product_id', $productId)->get();
            }
        
        return view('frontend.review.index', [
            'product'       => $productCheck,
            'purchaseCheck' => $purchaseCheck
        ]);

        }else {
            return redirect()->back()->with('status', 'This link was brokrn');
        }
    }

    public function store(Request $request)
    {
        $productId  = $request->input('product_id');
        $userReview = $request->input('user_review');
        
        $product = Product::where('id', $productId)->first();
        if ($product) {
            $reviewObj             = new Review();

            $reviewObj->user_id    = Auth::id();
            $reviewObj->product_id = $productId;
            $reviewObj->review     = $userReview;
            $res = $reviewObj->save();

            $categorySlug = $product->category->slug;
            $productSlug  = $product->slug;
            if ($res) {
                return redirect('categories/'.$categorySlug.'/'.$productSlug)->with('status', 'Thank you for writng a review');
            }

        }else {
            return redirect()->back()->with('status', 'The link is followed was broken');
        }
    }

    public function edit($product_slug)
    {
        $product = Product::where('slug', $product_slug)->first();
        if ($product) {
            $productId = $product->id;
            $review = Review::where('user_id', Auth::id())->where('product_id', $productId)->first();
            if ($review) {
                return view('frontend.review.edit', [
                    'review' => $review
                ]);
            }else {
                return redirect()->back()->with('status', 'The link is followed was broken');
            }
        }else {
            return redirect()->back()->with('status', 'The link is followed was broken');
        }
    }

    public function update(Request $request)
    {
        $userReview = $request->input('user_review');
        if ($userReview != '') {
            $reviewId = $request->input('review_id');
            $review = Review::where('id', $reviewId)->where('user_id', Auth::id())->first();
            if ($review) {
                $review->review = $userReview;
                $review->save();

                return redirect('categories/'.$review->product->category->slug.'/'.$review->product->slug)->with('status', 'Review update successfully');
            }else {
                return redirect()->back()->with('status', 'The link is followed was broken');
            }
        }else {
            return redirect()->back()->with('status', 'You can not submit empty review');
        }
    }
}
