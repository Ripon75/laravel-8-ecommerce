<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::get();
        return view('admin.product.index', [
            'products' => $products
        ]);
    }

    public function create()
    {
        $categories = Category::get();

        return view('admin.product.create', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'slug' => ['required', 'unique:products']
        ]);

        if ($request->slug) {
            $slug = Str::slug($request->slug, '-');
        }

        $name          = $request->input('name');
        $slug          = $request->input('slug');
        $description   = $request->input('description', null);
        $categoryId    = $request->input('category_id');
        $originalPrice = $request->input('original_price', 0);
        $sellingPrice  = $request->input('selling_price', 0);
        $tax           = $request->input('tax',0);
        $quantity      = $request->input('quantity');
        $status        = $request->input('status')  == TRUE ? '1' : '0';
        $trending      = $request->input('trending') == TRUE ? '1' : '0';
        $metaTitle     = $request->input('meta_title', null);
        $metaDescript  = $request->input('meta_description', null);
        $metaKeyword   = $request->input('meta_keyword', null);

        $product = new Product();
        if($request->hasFile('image')) {
            $file     = $request->file('image');
            $ext      = $file->getClientOriginalExtension();
            $fileName = time().'.'.$ext;
            $file->move('uploaded/productImages', $fileName);
            $product->image = $fileName;
        }

        $product->name             = $name;
        $product->slug             = $slug;
        $product->category_id      = $categoryId;
        $product->description      = $description;
        $product->original_price   = $originalPrice;
        $product->selling_price    = $sellingPrice;
        $product->tax              = $tax;
        $product->quantity         = $quantity;
        $product->status           = $status;
        $product->trending         = $trending;
        $product->meta_title       = $metaTitle;
        $product->meta_description = $metaDescript;
        $product->meta_keyword     = $metaKeyword;
        $product->save();

        return redirect()->route('products.index')->with('status', 'product added successfully');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $categories = Category::get();
        $product    = Product::find($id);

        return view('admin.product.edit', [
            'categories' => $categories,
            'product'    => $product
        ]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required'],
            'slug' => ['required', "unique:products,slug,$id"]
        ]);

        if ($request->slug) {
            $slug = Str::slug($request->slug, '-');
        }

        $name          = $request->input('name');
        $slug          = $request->input('slug');
        $description   = $request->input('description', null);
        $categoryId    = $request->input('category_id');
        $originalPrice = $request->input('original_price', 0);
        $sellingPrice  = $request->input('selling_price', 0);
        $tax           = $request->input('tax',0);
        $quantity      = $request->input('quantity');
        $status        = $request->input('status')  == TRUE ? '1' : '0';
        $trending      = $request->input('trending') == TRUE ? '1' : '0';
        $metaTitle     = $request->input('meta_title', null);
        $metaDescript  = $request->input('meta_description', null);
        $metaKeyword   = $request->input('meta_keyword', null);
        
        $product = Product::find($id);
        if($request->hasFile('image')) {
            $old_image = 'uploaded/productImages/' . $product->image;
            if (File::exists($old_image)) {
                File::delete($old_image);
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileName = time().'.'.$ext;
            $file->move('uploaded/productImages', $fileName);
            $product->image = $fileName;
        }

        $product->name             = $name;
        $product->slug             = $slug;
        $product->category_id      = $categoryId;
        $product->description      = $description;
        $product->original_price   = $originalPrice;
        $product->selling_price    = $sellingPrice;
        $product->tax              = $tax;
        $product->quantity         = $quantity;
        $product->status           = $status;
        $product->trending         = $trending;
        $product->meta_title       = $metaTitle;
        $product->meta_description = $metaDescript;
        $product->meta_keyword     = $metaKeyword;
        $product->save();

        return redirect()->route('products.index')->with('status', 'product update successfully');
    }

 
    public function destroy($id)
    {
        //
    }
}
