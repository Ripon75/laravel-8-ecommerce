@extends('layouts.frontend')

@section('title')
    Ecommerce
@endsection

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-body">
            @php $total = 0 @endphp
            @foreach ($cartItem as $item)
            <div class="row product_data">
                <div class="col-md-2">
                    <img src="{{ 'uploaded/productImages/'.$item->product->image }}" height="70px" width="70px" alt="">
                </div>
                <div class="col-md-3">
                    <h6>{{ $item->product->name }}</h3>
                </div>
                <div class="col-md-2">
                    <h6> Rs {{ $item->product->selling_price }}</h3>
                </div>
                <div class="col-md-3">
                    <input type="hidden" value="{{ $item->product_id }}" class="product_id" />
                    @if($item->product->quantity > $item->product_qty)
                        <label for="quantity">Quantity</label>
                        <div class="input-group text-center mb-3" style="width: 130px">
                            <button class="input-group-text changeQty increment-btn">+</button>
                            <input type="text" name="quantity" value="{{ $item->product_qty }}" class="form-control qty-input text-center" />
                            <button class="input-group-text changeQty decrement-btn">-</button>
                        </div>
                        @php $total += $item->product_qty * $item->product->selling_price @endphp
                    @else
                    <h5 class="badge bg-danger">Out of stock</h5>
                    @endif
                </div>
                <div class="col-md-2">
                    <button class="btn btn-danger delete-cart-item"><i class="fa fa-trash"></i></button>
                </div>
            </div>
            @endforeach
        </div>
        <div class="card-footer">
            <h6>Total Price : RS {{ $total }}
              <a href="{{ route('checkout.index') }}" class="btn btn-outline-success float-end">Process to checkout</a>
            </h6>
        </div>
    </div>
</div>
@endsection