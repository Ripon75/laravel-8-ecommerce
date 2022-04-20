@extends('layouts.frontend')

@section('title')
    {{$product->name}}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if ($purchaseCheck->count() > 0)
                        <h5>You are written a review for {{ $product->name }}</h5>
                        <form action="{{ url('/add-review') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <textarea class="form-control mt-3" name="user_review" rows="5" placeholder="Write a review"></textarea>
                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </form>
                    @else
                        <div class="alert alert-danger">
                            <h5>You are not eligible to review for this product.</h5>
                            <p>
                                Only the customer who purchase this product can write a review about the product.
                            </p>
                            <a href="{{ url('/') }}" class="btn btn-primary">Home</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection