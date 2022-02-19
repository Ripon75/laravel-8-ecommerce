@extends('layouts.frontend')

@section('title')
    Ecommerce
@endsection

@section('content')
<div class="container">
    <form action="{{ url('place-order') }}" method="POST">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h6>Basic Details</h6>
                        <hr>
                        <div class="row checkout-form">
                            <div class="col-md-6">
                                <label for="first_name">First Name</label>
                                <input type="text" name="f_name" value="{{ Auth::user()->name }}" class="form-control"
                                    placeholder="Enter Your first Name">
                            </div>
                            <div class="col-md-6">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="l_name" value="{{ Auth::user()->l_name }}" class="form-control" placeholder="Enter Your Last Name">
                            </div>
                            <div class="col-md-6">
                                <label for="email">Email</label>
                                <input type="text" name="email" value="{{ Auth::user()->email }}" class="form-control" placeholder="Enter Your Email">
                            </div>
                            <div class="col-md-6">
                                <label for="phone_number">Phone Number</label>
                                <input type="text" name="phone_num" value="{{ Auth::user()->phone_num }}" class="form-control"
                                    placeholder="Enter Your Phone Number">
                            </div>
                            <div class="col-md-6">
                                <label for="address_1">Address 1</label>
                                <input type="text" name="address_1" value="{{ Auth::user()->address_1 }}" class="form-control" placeholder="Enter Your Address 1">
                            </div>
                            <div class="col-md-6">
                                <label for="address_2">Address 2</label>
                                <input type="text" name="address_2" value="{{ Auth::user()->address_2 }}" class="form-control" placeholder="Enter Your Address 2">
                            </div>
                            <div class="col-md-6">
                                <label for="city">City</label>
                                <input type="text" name="city" value="{{ Auth::user()->city }}" class="form-control" placeholder="Enter Your City">
                            </div>
                            <div class="col-md-6">
                                <label for="state">State</label>
                                <input type="text" name="state" value="{{ Auth::user()->state }}" class="form-control" placeholder="Enter Your state">
                            </div>
                            <div class="col-md-6">
                                <label for="counry">Country</label>
                                <input type="text" name="country" value="{{ Auth::user()->country }}" class="form-control" placeholder="Enter Your Country">
                            </div>
                            <div class="col-md-6">
                                <label for="pin_code">Pin Code</label>
                                <input type="text" name="pin_code" value="{{ Auth::user()->pin_code }}" class="form-control" placeholder="Enter Your Pin Code">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($carts as $cart)
                                <tr>
                                    <td>{{ $cart->product->name }}</td>
                                    <td>{{ $cart->product_qty }}</td>
                                    <td>{{ $cart->product->selling_price }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary btn-sm w-100">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection