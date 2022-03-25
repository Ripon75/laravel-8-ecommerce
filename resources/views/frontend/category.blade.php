@extends('layouts.frontend')

@section('title')
    Category
@endsection

@section('content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>All Category</h2>
                   <div class="row">
                    @foreach ($categories as $category)
                    <div class="col-md-3 mt-3">
                        <a href="{{route('categories.show',$category->slug)}}">
                            <div class="card">
                                <img src="{{asset('uploaded/categoryImages/'.$category->image)}}" alt="category image">
                                <div class="card-body">
                                    <h5>{{ $category->name }}</h5>
                                    <p class="float-start">{{ $category->description }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                   </div>
                </div>
            </div>
        </div>
    </div>
@endsection