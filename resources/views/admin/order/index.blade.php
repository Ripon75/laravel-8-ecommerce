@extends('layouts.admin')

@section('title')
    Orders
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>New Orders</h4>
                    <a href="{{ 'order-history' }}" class="btn btn-warning float-end">Order history</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Order Date</th>
                                <th scope="col">Traking NO</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                <td>{{ date('d-m-Y') }}</td>
                                <td>{{ $order->traking_no }}</td>
                                <td>{{ $order->total_price }}</td>
                                <td>{{ $order->status == '0' ? 'pending' : 'Completed' }}</td>
                                <td>
                                    <a href="{{ url('admin/view-order/'.$order->id) }}" class="btn btn-primary">View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection