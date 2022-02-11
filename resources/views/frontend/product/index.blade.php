@extends('layouts.frontend')

@section('title')
    {{$category->name}}
@endsection

@section('content')
<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">Collection / {{$category->name}}</h6>
    </div>
</div>
    <div class="py-5">
        <div class="container">
            <div class="row">
                <h2>{{$category->name}}</h2>
                {{-- <div class="owl-carousel feature-carousel owl-theme"> --}}
                    @foreach ($products as $product)
                    <div class="col-md-3 mt-3">
                        <div class="card">
                            <a href="{{url('category/'.$category->slug .'/'.$product->slug)}}">
                               <img src="{{asset('uploaded/productImages/'.$product->image)}}" class="card-img-top" alt="product image">
                                <div class="card-body">
                                    <h5>{{ $product->name }}</h5>
                                    <span class="float-start">{{ $product->selling_price }}</span>
                                    <span class="float-end"><s>{{ $product->original_price }}</s></span>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                {{-- </div> --}}
            </div>
        </div>
    </div>
@endsection