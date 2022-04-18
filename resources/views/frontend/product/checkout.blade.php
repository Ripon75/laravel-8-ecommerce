@extends('layouts.frontend')

@section('title')
    Ecommerce
@endsection

@section('content')
<div class="container">
    <form action="{{ url('place-order') }}" method="POST">
        @csrf

        <div class="row">
            {{-- User basic information start--}}
            <div class="col-md-7">
                {{-- Card --}}
                <div class="card">
                    {{-- Card header --}}
                    <div class="card-header">
                        Basic Details
                    </div>
                    {{-- Card body --}}
                    <div class="card-body">
                        <div class="row checkout-form">
                            <div class="col-md-6">
                                <label for="first_name">First Name</label>
                                <input type="text" name="f_name" value="{{ Auth::user()->name }}" class="form-control first_name"
                                    placeholder="Enter Your first Name">
                                <span id="fname_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="l_name" value="{{ Auth::user()->l_name }}" class="form-control last_name" placeholder="Enter Your Last Name">
                                <span id="lname_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="email">Email</label>
                                <input type="text" name="email" value="{{ Auth::user()->email }}" class="form-control email" placeholder="Enter Your Email">
                                <span id="email" class="text-danger"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="phone_number">Phone Number</label>
                                <input type="text" name="phone_num" value="{{ Auth::user()->phone_num }}" class="form-control phone_number"
                                    placeholder="Enter Your Phone Number">
                                <span id="phone_number" class="text-danger"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="address_1">Address 1</label>
                                <input type="text" name="address_1" value="{{ Auth::user()->address_1 }}" class="form-control address_1" placeholder="Enter Your Address 1">
                                <span id="address_1" class="text-danger"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="address_2">Address 2</label>
                                <input type="text" name="address_2" value="{{ Auth::user()->address_2 }}" class="form-control address_2" placeholder="Enter Your Address 2">
                            </div>
                            <div class="col-md-6">
                                <label for="city">City</label>
                                <input type="text" name="city" value="{{ Auth::user()->city }}" class="form-control city" placeholder="Enter Your City">
                                <span id="city" class="text-danger"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="state">State</label>
                                <input type="text" name="state" value="{{ Auth::user()->state }}" class="form-control state" placeholder="Enter Your state">
                                <span id="state" class="text-danger"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="counry">Country</label>
                                <input type="text" name="country" value="{{ Auth::user()->country }}" class="form-control country" placeholder="Enter Your Country">
                                <span id="country" class="text-danger"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="pin_code">Pin Code</label>
                                <input type="text" name="pin_code" value="{{ Auth::user()->pin_code }}" class="form-control pin_code" placeholder="Enter Your Pin Code">
                                <span id="pin_code" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End user basic information --}}

            {{-- Cart information start--}}
            <div class="col-md-5">
                {{-- Card --}}
                <div class="card">
                    {{-- Card header --}}
                    <div class="card-header">
                        Cart information
                    </div>
                    {{-- Card body --}}
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($carts as $cart)
                                <tr>
                                    <td>{{ ($cart->product->name) ?? null }}</td>
                                    <td>{{ ($cart->product_qty) ?? null }}</td>
                                    <td>{{ ($cart->product->selling_price) ?? null }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <input type="hidden" name="payment_mode" value="COD">
                        <button type="submit" class="btn btn-primary btn-sm w-100">Place Order | COD</button>
                        <button type="button" class="btn btn-success btn-sm w-100 mt-2 razorpay_btn">Pay with Razorpay</button>
                    </div>
                </div>
            </div>
            {{-- End cart information --}}
        </div>
    </form>
</div>
@endsection

@section('script')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
@endsection