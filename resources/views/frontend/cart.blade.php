@extends('layouts.frontend')

@section('title')
    Ecommerce
@endsection

@section('content')
<div class="container">
    <div class="cart shadow">
        <div class="card-body">
            @foreach ($cartItem as $item)
            <div class="row product_data">
                <div class="col-md-2">
                    <img src="{{ 'uploaded/productImages/'.$item->product->image }}" height="70px" width="70px" alt="">
                </div>
                <div class="col-md-5">
                    <h6>{{ $item->product->name }}</h3>
                </div>
                <div class="col-md-3">
                    <input type="hidden" value="{{ $item->product_id }}" class="product_id" />
                    <label for="quantity">Quantity</label>
                    <div class="input-group text-center mb-3" style="width: 130px">
                        <button class="input-group-text increment-btn">+</button>
                        <input type="text" name="quantity" value="{{ $item->product_qty }}" class="form-control qty-input text-center" />
                        <button class="input-group-text decrement-btn">-</button>
                    </div>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-danger delete-cart-item"><i class="fa fa-trash"></i></button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection