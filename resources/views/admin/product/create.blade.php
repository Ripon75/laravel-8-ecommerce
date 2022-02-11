@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        Create Product
    </div>
    <div class="card-body">
        <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="">Name</label>
                    <input type="text" placeholder="Product Name" class="form-control" name="name">
                </div>

                <div class="col-md-6 form-group">
                    <label for="">Slug</label>
                    <input type="text" placeholder="Product Slug" class="form-control" name="slug">
                </div>

                <div class="col-md-6">
                   <select class="form-select p-2" name="category_id">
                       <option>Select Category</option>
                       @foreach ($categories as $item)
                       <option class="p-2" value="{{$item->id}}"> {{ $item->name }} </option>
                       @endforeach
                   </select>
                </div>

                <div class="col-md-12">
                    <label for="">Description</label>
                    <textarea name="description" rows="3" class="form-control"></textarea>
                </div>

                 <div class="col-md-6">
                    <label for="">Original Price</label>
                    <input type="number" placeholder="Original Price" class="form-control" name="original_price">
                </div>

                 <div class="col-md-6">
                    <label for="">Selling Price</label>
                    <input type="number" placeholder="Selling Price" class="form-control" name="selling_price">
                </div>

                 <div class="col-md-6">
                    <label for="">Taxt</label>
                    <input type="number" placeholder="Taxt" class="form-control" name="taxt">
                </div>

                 <div class="col-md-6">
                    <label for="">Quantity</label>
                    <input type="number" placeholder="Quantity" class="form-control" name="quantity">
                </div>

                <div class="col-md-6">
                    <label for="">Status</label>
                    <input type="checkbox" name="status">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="">Trending</label>
                    <input type="checkbox" name="trending">
                </div>

                <div class="col-md-12 mb-3">
                    <label for="">Meta Title</label>
                    <input type="text" class="form-control" name="meta_title">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="">Meta Description</label>
                    <input type="text" class="form-control" name="meta_description">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="">Meta Keyword</label>
                    <input type="text" class="form-control" name="meta_keyword">
                </div>

                <div class="col-md-12 mb-3">
                    <label for="">Upload Image</label>
                    <input type="file" class="form-control" name="image">
                </div>

                <div class="col-md-7">
                    <button type="submit" style="float: right" class="btn btn-primary btn-sm mr-10">Submit</button>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection