@extends('layouts.frontend')

@section('title')
    {{-- {{$product->name}} --}}
@endsection

@section('content')
<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">Collection / </h6>
    </div>
</div>
{{-- cart start --}}
<div class="container">
    <div class="card shadow">
        <div class="card-body">
            @if($wishlists->count() > 0)
            <div class="card-body">
                @foreach ($wishlists as $wishlist)
                <div class="row product_data">
                    {{-- Product information --}}
                    <div class="col-md-2">
                        <img src="{{ 'uploaded/productImages/'.$wishlist->product->image }}" height="70px" width="70px"
                            alt="">
                    </div>
                    <div class="col-md-2">
                        <h6>{{ ($wishlist->product->name) ?? null }}</h3>
                    </div>
                    <div class="col-md-2">
                        <h6> Rs {{ ($wishlist->product->selling_price) ?? 0 }}</h3>
                    </div>
                    <div class="col-md-2">
                        <input type="hidden" class="product_id" value="{{ $wishlist->product_id }}">
                        @if ($wishlist->product->quantity >= $wishlist->quntity)
                            <label for="quantity">Quantity</label>
                            <div class="input-group text-center mb-3" style="width: 130px">
                                <button class="decrement-btn input-group-text">-</button>
                                <input type="text" name="quantity" value="1"
                                class="qty-input form-control text-center" />
                                <button class="increment-btn input-group-text plus">+</button>
                            </div>
                        @else
                            <h6>Out of stock</h6>
                        @endif
                    </div>
                    {{-- Add to cart --}}
                    <div class="col-md-2">
                        <a href="" class="btn btn-success addToCart">
                            <i class="fa fa-shopping-cart"></i> Add to cart
                        </a>
                    </div>
                    {{-- Wishlist delete --}}
                    <div class="col-md-2">
                        {{-- <button class="btn btn-danger delete-cart-wishlist"><i class="fa fa-trash"></i></button> --}}
                        <a href="{{ route('remove.wishlists', $wishlist->id) }}" class="btn btn-danger">
                            <i class="fa fa-trash"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <h1>There is no product in wishlist</h1>
            @endif
        </div>
    </div>
</div>
@endsection