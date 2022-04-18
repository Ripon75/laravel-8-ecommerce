<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Rating;
use Auth;

class FrontendController extends Controller
{
    public function index()
    {
        $featureProducts    = Product::where('trending', '1')->get();
        $trendingCategories = Category::where('popular', '1')->get();
        
        return view('frontend.index', [
            'featureProducts'    => $featureProducts,
            'trendingCategories' => $trendingCategories
        ]);
    }

    public function category()
    {
        $categories = Category::get();

        return view('frontend.category', [
            'categories' => $categories
        ]);
    }

    public function categoryShow($slug)
    {
        $category = Category::where('slug', $slug)->first();
        if ($category) {
            $products = Product::where('category_id', $category->id)->get();

            return view('frontend.product.index', [
                'category' => $category,
                'products' => $products
            ]);

        }else {
            return redirect('/')->with('status', 'Category not found');
        }
    }

    public function productShow($cat_slug, $prod_slug)
    {
        if(Category::where('slug', $cat_slug)->exists()) {

            if(Product::where('slug', $prod_slug)->exists()) {

                $product    = Product::where('slug', $prod_slug)->first();
                $ratings    = Rating::where('product_id', $product->id)->get();
                $ratingSum  = Rating::where('product_id', $product->id)->sum('stars_rated');
                $userRating = Rating::where('product_id', $product->id)
                ->where('user_id', Auth::id())->first();

                if ($ratings->count() > 0) {
                    $avgRatingValue = $ratingSum/$ratings->count();
                }else {
                    $avgRatingValue = 0;
                }
                
                return view('frontend.product.show', [
                    'product'        => $product,
                    'ratings'        => $ratings,
                    'avgRatingValue' => $avgRatingValue,
                    'userRating'     => $userRating
                ]);

            } else {
                return redirect('/')->with('status', 'The link was broken');

            }

        } else {
            return redirect('/')->with('status', 'No such caregory found');
        }
    }
}
