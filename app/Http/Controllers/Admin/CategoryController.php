<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();

        return view('admin.category.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
