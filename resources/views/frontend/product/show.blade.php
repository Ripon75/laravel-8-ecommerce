@extends('layouts.frontend')

@section('title')
    {{$product->name}}
@endsection

@section('content')

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('/add-rating') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Rate this {{ $product->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- product rating --}}
                    <div class="rating-css">
                        <div class="star-icon">
                            @if ($userRating)
                                @for ($i = 1; $i <= $userRating->stars_rated; $i++)
                                    <input type="radio" value="{{ $i }}" name="product_rating" checked id="rating{{ $i }}">
                                    <label for="rating{{ $i }}" class="fa fa-star"></label>
                                @endfor
                                @for ($j = $userRating->stars_rated+1; $j <= 5; $j++)
                                    <input type="radio" value="{{ $j }}" name="product_rating" id="rating{{ $j }}">
                                    <label for="rating{{ $j }}" class="fa fa-star"></label>
                                @endfor
                            @else
                                <input type="radio" value="1" name="product_rating" checked id="rating1">
                                <label for="rating1" class="fa fa-star"></label>
                                <input type="radio" value="2" name="product_rating" id="rating2">
                                <label for="rating2" class="fa fa-star"></label>
                                <input type="radio" value="3" name="product_rating" id="rating3">
                                <label for="rating3" class="fa fa-star"></label>
                                <input type="radio" value="4" name="product_rating" id="rating4">
                                <label for="rating4" class="fa fa-star"></label>
                                <input type="radio" value="5" name="product_rating" id="rating5">
                                <label for="rating5" class="fa fa-star"></label>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

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
                    <span>Selling Price : Rs {{$product->selling_price}}</span><br>
                    @php
                        $ratingCount = number_format($avgRatingValue)
                    @endphp
                    <div class="rating">
                        {{-- Show checked stars --}}
                        @for ($i = 1; $i<=$ratingCount; $i++)
                        <i class="fa fa-star checked"></i>
                        @endfor
                        {{-- Show unchecked stars --}}
                        @for ($j = $ratingCount+1; $j<=5; $j++)
                        <i class="fa fa-star"></i>
                        @endfor
                        {{-- count how many user rated this product --}}
                        <span>
                            @if ($ratings->count() > 0)
                            {{ $ratings->count() }} Ratings
                            @else
                            No rating
                            @endif
                        </span>
                    </div>
                    <p class="mt-3">{{$product->description}}</p>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Rate this product
                    </button>
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
                            <button type="button" class="addToCart btn btn-success me-3 float-start">Add to Cart
                                <i class="fa fa-shopping-cart"></i>
                            </button>
                            @endif
                            <button type="button" class="addToWishlist btn btn-primary me-3 float-start">Add to Wishlist
                                <i class="fa fa-heart"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection