<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

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
        if(Category::where('slug', $slug)->exists()) {
            $category = Category::where('slug', $slug)->first();
            $products = Product::where('category_id', $category->id)->get();

            return view('frontend.product.index', [
                'category' => $category,
                'products' => $products
            ]);
        } else {
            return redirect('/')->with('status', 'Slug not found');
        }
    }

    public function productShow($cat_slug, $prod_slug)
    {
        if(Category::where('slug', $cat_slug)->exists()) {

            if(Product::where('slug', $prod_slug)->exists()) {

                $product = Product::where('slug', $prod_slug)->first();
                
                return view('frontend.product.show', [
                    'product' => $product
                ]);

            } else {
                return redirect('/')->with('status', 'The link was broken');

            }

        } else {
            return redirect('/')->with('status', 'No such caregory found');
        }
    }
}
