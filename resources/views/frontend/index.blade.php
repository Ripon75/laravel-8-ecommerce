@extends('layouts.frontend')

@section('title')
    Ecommerce
@endsection

@section('content')
{{-- @include('layouts.inc.slider') --}}
{{-- feature product --}}
    <div class="py-5">
        <div class="container">
            <div class="row">
                <h2>Feature Products</h2>
                {{-- <div class="owl-carousel feature-carousel owl-theme"> --}}
                    @foreach ($featureProducts as $product)
                    <div class="col-md-3 mt-3">
                        <a href="{{ route('prosucts.show',[$product->category->name,$product->slug]) }}">
                            <div class="card">
                                <img src="{{asset('uploaded/productImages/'.$product->image)}}" alt="product image">
                                <div class="card-body">
                                    <h5>{{ $product->name }}</h5>
                                    <span class="float-start">{{ $product->selling_price }}</span>
                                    <span class="float-end"><s>{{ $product->original_price }}</s></span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
                {{-- </div> --}}
            </div>
        </div>
    </div>
    {{-- category section --}}
     <div class="py-5">
        <div class="container">
            <div class="row">
                <h2>Trending Category</h2>
                {{-- <div class="owl-carousel feature-carousel owl-theme"> --}}
                    @foreach ($trendingCategories as $tCategory)
                    <div class="col-md-3 mt-3">
                         <a href="{{route('categories.show',$tCategory->slug)}}">
                             <div class="card">
                            <img src="{{asset('uploaded/categoryImages/'.$tCategory->image)}}" alt="category image">
                            <div class="card-body">
                                <h5>{{ $tCategory->name }}</h5>
                               <p>{{$tCategory->description}}</p>
                            </div>
                        </div>
                         </a>
                    </div>
                @endforeach
                {{-- </div> --}}
            </div>
        </div>
    </div>
@endsection

{{-- @section('script')
    <script>
        $('.feature-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:3
                }
            }
        })
    </script>
@endsection --}}