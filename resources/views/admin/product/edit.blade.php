@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Edit Product</h4>
        <a href="{{ route('products.index') }}" class="btn btn-success btn-sm float-end">All Product</a>
    </div>
    <div class="card-body">
        <form action="{{route('products.update', $product->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="">Name</label>
                    <input type="text" value="{{ $product->name }}" placeholder="Product Name" class="form-control" name="name">
                </div>

                <div class="col-md-6 form-group">
                    <label for="">Slug</label>
                    <input type="text" value="{{ $product->slug }}" placeholder="Product Slug" class="form-control" name="slug">
                </div>

                <div class="col-md-6">
                   <select class="form-select p-2" name="category_id">
                       <option>Select Category</option>
                       @foreach ($categories as $item)
                    <option class="p-2" value="{{$item->id}}" {{ $product->category_id == $item->id ? 'selected' : '' }}> {{ $item->name }} </option>
                       @endforeach
                   </select>
                </div>

                <div class="col-md-12">
                    <label for="">Description</label>
                    <textarea name="description" value="{{ $product->description }}" rows="3" class="form-control"></textarea>
                </div>

                 <div class="col-md-6">
                    <label for="">Original Price</label>
                    <input type="number" value="{{ $product->original_price }}" placeholder="Original Price" class="form-control" name="original_price">
                </div>

                 <div class="col-md-6">
                    <label for="">Selling Price</label>
                    <input type="number" value="{{ $product->selling_price }}" placeholder="Selling Price" class="form-control" name="selling_price">
                </div>

                 <div class="col-md-6">
                    <label for="">Tax</label>
                    <input type="number" value="{{ $product->tax }}" placeholder="Tax" class="form-control" name="tax">
                </div>

                 <div class="col-md-6">
                    <label for="">Quantity</label>
                    <input type="number" value="{{ $product->quantity }}" placeholder="Quantity" class="form-control" name="quantity">
                </div>

                <div class="col-md-6">
                    <label for="">Status</label>
                    <input type="checkbox" {{$product->status == '1' ? 'checked' : ''}} value="{{ $product->status }}" name="status">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="">Trending</label>
                    <input type="checkbox" {{$product->trending == '1' ? 'checked' : ''}} value="{{ $product->trending }}" name="trending">
                </div>

                <div class="col-md-12 mb-3">
                    <label for="">Meta Title</label>
                    <input type="text" value="{{ $product->meta_title }}" class="form-control" name="meta_title">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="">Meta Description</label>
                    <input type="text" value="{{ $product->meta_description }}" class="form-control" name="meta_description">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="">Meta Keyword</label>
                    <input type="text" value="{{ $product->meta_keyword }}" class="form-control" name="meta_keyword">
                </div>

                <div class="col-md-12 mb-3">
                    <label for="">Upload Image</label>
                    <input type="file" class="form-control" name="image">
                     @if ($product->image)
                        <img src="/uploaded/productImages/{{$product->image}}" style="width: 70px; height:40px" alt="Product Image">
                    @endif
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-sm float-end mr-10">Update</button>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection