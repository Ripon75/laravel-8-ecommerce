<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Review;
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
                $userRating = Rating::where('product_id', $product->id)->where('user_id', Auth::id())->first();
                $reviews    = Review::where('product_id', $product->id)->get();

                if ($ratings->count() > 0) {
                    $avgRatingValue = $ratingSum/$ratings->count();
                    $intgerValue    = number_format($avgRatingValue);
                }else {
                    $intgerValue = 0;
                }
                
                return view('frontend.product.show', [
                    'product'        => $product,
                    'ratings'        => $ratings,
                    'intgerValue'    => $intgerValue,
                    'userRating'     => $userRating,
                    'reviews'        => $reviews
                ]);

            } else {
                return redirect('/')->with('status', 'The link was broken');

            }

        } else {
            return redirect('/')->with('status', 'No such caregory found');
        }
    }

    public function productListAjax()
    {
        $products = Product::select('name')->get();
        $data = [];

        foreach ($products as $item) {
            $data[] = $item['name'];
        }

        return $data;
    }

    public function searchProduct(Request $request)
    {
        $productName = $request->input('product_name');
        if ($productName != '') {
            $products = Product::where('name', 'like', "%$productName%")->get();
            $trendingCategories = Category::where('popular', '1')->get();
            if ($products) {
                return view('frontend.index', [
                    'featureProducts'    => $products,
                    'trendingCategories' => $trendingCategories
                ]);
            }else {
                return redirect()->back()->with('status', 'No such a product');
            }

        }else {
            return redirect()->back();
        }
    }
}
