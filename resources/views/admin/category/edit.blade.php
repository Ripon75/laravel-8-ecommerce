@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Edit Category</h4>
        <a href="{{ route('categories.index')}}" class="btn btn-success btn-sm float-end">All Category</a>
    </div>
    <div class="card-body">
        <form action="{{ route('categories.update', $category->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="">Name</label>
                    <input type="text" placeholder="Name" value="{{$category->name}}" class="form-control" name="name">
                </div>

                <div class="col-md-6">
                    <label for="">Slug</label>
                    <input type="text" placeholder="Slug" value="{{$category->slug}}" class="form-control" name="slug">
                </div>

                <div class="col-md-12">
                    <label for="">Description</label>
                    <textarea name="description" rows="3" class="form-control">{{$category->description}}</textarea>
                </div>

                <div class="col-md-6">
                    <label for="">Status</label>
                    <input type="checkbox" {{$category->status == '1' ? 'checked' : ''}} name="status">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="">Popular</label>
                    <input type="checkbox" {{$category->popular == '1' ? 'checked' : ''}} name="popular">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="">Meta Title</label>
                    <input type="text" value="{{$category->meta_title}}" class="form-control" name="meta_title">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="">Meta Description</label>
                    <input type="text" value="{{$category->meta_descrip}}" class="form-control" name="meta_descrip">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="">Meta Keyword</label>
                    <input type="text" value="{{$category->meta_keyword}}" class="form-control" name="meta_keyword">
                </div>

                <div class="col-md-12 mb-3">
                    <label for="">Upload Image</label>
                    <input type="file" class="form-control" name="image">
                    @if ($category->image)
                        <img src="/uploaded/categoryImages/{{$category->image}}" style="width: 70px; height:40px" alt="Category Image">
                    @endif
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-sm mr-10 float-end">Update</button>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection