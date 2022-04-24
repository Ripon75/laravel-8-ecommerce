@extends('layouts.frontend')

@section('title')
Ecommerce
@endsection

@section('content')
<div class="container">
    <div class="card shadow cartItems">
        {{-- Check cart item exist or not  --}}
        @if(count($cartItems) > 0)
        <div class="card-body">
            @php $total = 0 @endphp
            @foreach ($cartItems as $item)
            <div class="row product_data">
                {{-- Product information --}}
                <div class="col-md-2">
                    <img src="{{ 'uploaded/productImages/'.$item->product->image }}" height="70px" width="70px" alt="">
                </div>
                <div class="col-md-3">
                    <h6>{{ ($item->product->name) ?? null }}</h3>
                </div>
                <div class="col-md-2">
                    <h6> Rs {{ ($item->product->selling_price) ?? 0 }}</h3>
                </div>
                {{-- Cart item increment and decrement part --}}
                <div class="col-md-3">
                    {{-- Hidden input field for identitfy product  --}}
                    <input type="hidden" value="{{ $item->product_id }}" class="product_id" />
                    {{-- Check product quantity is greather than or equal to product table --}}
                    @if($item->product->quantity >= $item->product_qty)
                    <label for="quantity">Quantity</label>
                    <div class="input-group text-center mb-3" style="width: 130px">
                        <button class="decrement-btn input-group-text changeQty">-</button>
                        <input type="text" name="quantity" value="{{ $item->product_qty }}"
                        class="qty-input form-control text-center" />
                        <button class="increment-btn input-group-text changeQty plus">+</button>
                    </div>
                    @php $total += $item->product_qty * $item->product->selling_price @endphp
                    @else
                     <div class="input-group text-center mb-3" style="width: 130px">
                        <button class="decrement-btn input-group-text changeQty">-</button>
                        <input type="text" name="quantity" value="{{ $item->product_qty }}"
                        class="qty-input form-control text-center"/>
                        <button class="input-group-text changeQty plus">+</button>
                    </div>
                    @php $total += $item->product_qty * $item->product->selling_price @endphp
                    <h5 class="badge bg-danger">Out of stock</h5>
                    @endif
                </div>
                {{--  Cart item delete --}}
                <div class="col-md-2">
                    <button class="btn btn-danger delete-cart-item">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>
            @endforeach
        </div>
        {{-- Show total price and checkout button --}}
        <div class="card-footer">
            <h6>Total Price : RS {{ $total }}
                <a href="{{ route('checkout.index') }}" class="btn btn-outline-success float-end">Process to checkout</a>
            </h6>
        </div>
        @else
        <div class="card-body text-center">
            <h2> Your <i class="fa fa-shopping-cart"></i> is empty</h2>
            <a href="{{ url('/') }}" class="btn btn-outline-primary float-end">Continue Shopping</a>
        </div>
        @endif
    </div>
</div>
@endsection