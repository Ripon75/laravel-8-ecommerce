@extends('layouts.frontend')

@section('title')
    {{$product->name}}
@endsection

@section('content')
<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">Collection / {{$product->category->name}} / {{$product->name}}</h6>
    </div>
</div>
<div class="container">
    <div class="card shadow">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 border-right">
                    <img src="{{ '/uploaded/productImages/'.$product->image }}" class="w-100">
                </div>
                <div class="col-md-8">
                    <h2 class="mb-0">
                        {{$product->name}}
                        @if($product->trending == '1')
                        <label style="font-size: 16px" class="float-end badge bg-danger">Trending</label>
                        @endif
                    </h2>
                    <hr>
                    <label class="me-3">Original Price : <s> Rs {{$product->original_price}}</s></label>
                    <label>Selling Price : Rs {{$product->selling_price}}</label>
                    <p class="mt-3">
                        {{$product->description}}
                    </p>
                    <hr>
                    @if ($product->quantity > 0)
                        <label class="badge bg-success">In Stock</label>
                    @else
                        <label class="badge bg-danger">Out of Stock</label>
                    @endif

                    <div class="row mt-2">
                        <div class="col-md-2">
                            <label for="quantity">Quantity</label>
                            <div class="input-gropu text-center mb-3">
                                <span class="input-group-text">+</span>
                                <input type="text" name="quantity" value="1" class="form-control"/>
                                <span class="input-group-text">-</span>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <button type="button" class="btn btn-primary me-3 float-start">Add to Wishlist</button>
                            <button type="button" class="btn btn-primary me-3 float-start">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection