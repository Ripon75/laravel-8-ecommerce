<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::get();

        return view('admin.category.index', [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'slug' => ['required', 'unique:categories']
        ]);

        if ($request->slug) {
            $slug = Str::slug($request->slug, '-');
        }
        $category = new Category();
        if ($request->hasFile('image')) {
            $file     = $request->file('image');
            $ext      = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $ext;
            $file->move('uploaded/categoryImages', $fileName);
            $category->image = $fileName;
        }
        $name         = $request->input('name');
        $slug         = $request->input('slug');
        $description  = $request->input('description');
        $status       = $request->input('status') == TRUE ? '1' : '0';
        $popular      = $request->input('popular') == TRUE ? '1' : '0';
        $metaTitle    = $request->input('meta_title');
        $metaDescript = $request->input('meta_descrip');
        $metaKeyword  = $request->input('meta_keyword');

        $category->name          = $name;
        $category->slug          = $slug;
        $category->description   = $description;
        $category->status        = $status;
        $category->popular       = $popular;
        $category->meta_title    = $metaTitle;
        $category->meta_descript = $metaDescript;
        $category->meta_keyword  = $metaKeyword;
        $category->save();

        return redirect()->route('category.index')->with('status', 'Category Added Successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $category = Category::find($id);

        return view('admin.category.edit', [
            'category' => $category
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required'],
            'slug' => ['required', "unique:categories,slug,$id"]
        ]);

        if ($request->slug) {
            $slug = Str::slug($request->slug, '-');
        }
        $category = Category::find($id);
        if ($request->hasFile('image')) {
            $old_image = 'uploaded/categoryImages/' . $category->image;
            if (File::exists($old_image)) {
                File::delete($old_image);
            }
            $file = $request->file('image');
            $ext  = $file->getClientOriginalExtension();
            $fileName        = time() . '.' . $ext;
            $file->move('uploaded/categoryImages', $fileName);
            $category->image = $fileName;
        }
        $name         = $request->input('name');
        $slug         = $request->input('slug');
        $description  = $request->input('description');
        $status       = $request->input('status') == TRUE ? '1' : '0';
        $popular      = $request->input('popular') == TRUE ? '1' : '0';
        $metaTitle    = $request->input('meta_title');
        $metaDescript = $request->input('meta_descrip');
        $metaKeyword  = $request->input('meta_keyword');

        $category->name          = $name;
        $category->slug          = $slug;
        $category->description   = $description;
        $category->status        = $status;
        $category->popular       = $popular;
        $category->meta_title    = $metaTitle;
        $category->meta_descript = $metaDescript;
        $category->meta_keyword  = $metaKeyword;
        $category->save();

        return redirect()->route('category.index')->with('status', 'Category Added Successfully');
    }

    public function destroy($id)
    {
        //
    }
}
