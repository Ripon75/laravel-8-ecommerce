@extends('layouts.frontend')

@section('title')
    {{$product->name}}
@endsection

@section('content')
<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">Collection / {{($product->category->name) ?? null}} / {{$product->name}}</h6>
    </div>
</div>
{{-- cart start --}}
<div class="container">
    <div class="card shadow">
        <div class="card-body product_data">
            <div class="row">
                <div class="col-md-4 border-right">
                    <img src="{{ '/uploaded/productImages/'.$product->image }}" class="w-100">
                </div>
                <div class="col-md-8">
                    {{-- Show trending --}}
                    <h2 class="mb-0">
                        {{$product->name}}
                        @if($product->trending == '1')
                        <span style="font-size: 16px" class="float-end badge bg-danger">Trending</span>
                        @endif
                    </h2>
                    <hr>
                    {{-- Product information --}}
                    <span class="me-3">Original Price : <s> Rs {{$product->original_price}}</s></span>
                    <span>Selling Price : Rs {{$product->selling_price}}</span>
                    <p class="mt-3">
                        {{$product->description}}
                    </p>
                    <hr>
                    {{-- Check stock available or not --}}
                    @if ($product->quantity > 0)
                        <span class="badge bg-success">In Stock</span>
                    @else
                        <span class="badge bg-danger">Out of Stock</span>
                    @endif

                    <div class="row mt-2">
                        {{-- Quantity part --}}
                        <div class="col-md-3">
                             {{-- Hidden input for get product data --}}
                            <input type="hidden" value="{{$product->id}}" class="product_id"/>
                            <span for="quantity"><strong>Quantity</strong></span>
                            <div class="input-group text-center mb-3 mt-1">
                                <button class="input-group-text decrement-btn">-</button>
                                <input type="text" name="quantity" value="1" class="qty-input form-control text-center"/>
                                <button class="input-group-text increment-btn">+</button>
                            </div>
                        </div>
                         {{-- Add to cart / wishlist part --}}
                        <div class="col-md-10">
                            {{-- Add to cart button show when product quantity greater than zero --}}
                            @if ($product->quantity > 0)
                            <button type="button" class="addToCart btn btn-success me-3 float-start">Add to Cart <i
                                    class="fa fa-shopping-cart"></i></button>
                            @endif
                            <button type="button" class="addToWishlist btn btn-primary me-3 float-start">Add to Wishlist <i
                                    class="fa fa-heart"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection