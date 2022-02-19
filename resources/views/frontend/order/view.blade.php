@extends('layouts.frontend')

@section('title')
Order View
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="text-white">Order view
                        <a href="{{ url('my-orders') }}" class="btn btn-warning float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Shipping Details</h4>
                            <hr>
                            <label for="">First Name</label>
                            <div class="border p-2">{{ $order->f_name }}</div>
                            <label for="">Last Name</label>
                            <div class="border p-2">{{ $order->l_name }}</div>
                            <label for="">Email</label>
                            <div class="border p-2">{{ $order->email }}</div>
                            <label for="">Contact Number</label>
                            <div class="border p-2">{{ $order->phone_num }}</div>
                            <label for="">Address</label>
                            <div class="border p-2">
                                {{ $order->address_1 }},
                                {{ $order->address_2 }},
                                {{ $order->city }},
                                {{ $order->state }},
                                {{ $order->country }},
                                {{ $order->pin_code }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4>Order Details</h4>
                            <hr>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($order->orderItems as $item)
                                    <tr>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>
                                            <img src="{{ asset('uploaded/productImages/'.$item->product->image) }}" width="40px" alt="Product Image">
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <h4 class="px-2">Grand Total : <span class="float-end">{{ $order->total_price }}</span></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection